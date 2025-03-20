<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Type_tool;
use App\Models\Employee;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ToolsController extends Controller
{

    public function index(Request $request)
    {
        $data = Tool::get();

        if ($request->ajax()) {
            $data = Tool::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
                    // $name .='<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">('.$row->getemp->name_en.')</a></div>';
                    $name .= '<span>'.date('Y-m-d ', strtotime($row->created_at)).'</span>';
                    return $name;
                })
                ->addColumn('type_tool_id', function($row){
 
                    $type_tool_id = '<span>'.$row->gettype->name_en.'</span>';
                    
                    return $type_tool_id;
                })
                ->addColumn('empreceved_id', function($row){
 
                    $empreceved_id = '<span>'.$row->getemp->name_en.'</span>';
                    
                    
                    return $empreceved_id;
                })
                ->addColumn('description', function($row){
 
                    $description = '<span>'.$row->description.'</span>';
                    
                    
                    return $description;
                })
                ->addColumn('note', function($row){

                    $note = $row->note;
                    
                    return $note;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-tool-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
                        //     '.trans('lang.work_hours').'
                        //     </button></div> ';
                    } 
                     else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.tools.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.tools.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('empreceved_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('empreceved_id', $request->get('empreceved_id'));
                    });
                    }
                    if (!empty($request->get('type_tool_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('type_tool_id', $request->get('type_tool_id'));
                    });
                    }
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('description', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','type_tool_id','empreceved_id','description','note','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.tool.index');
    }

    public function show($id)
    {
        $data = Tool::find($id);
        return view('admin.tool.show', compact('data'));
    }

    public function create()
    {
        $dataemp = Employee::where('is_active' , '1')->get();
        $datatype = Type_tool::where('status' , 0)->get();
        return view('admin.tool.create' ,compact('dataemp','datatype'));
    }

    public function store(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));

        $rule = [
            'name_en' => 'required|string',
            'empreceved_id' => 'required'
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Tool::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'type_tool_id' => $request->type_tool_id,
            'description' => $description,
            'note' => $request->note,
            'empreceved_id' => $request->empreceved_id,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('file');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/tools')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Tool::find($id);
        $dataemp = Employee::where('is_active' , '1')->get();

        return view('admin.tool.edit', compact('data','dataemp'));
    }

    public function update(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));

        $rule = [
            'name_en' => 'required|string',
            'empreceved_id' => 'required'

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Tool::find($request->id);
        $data = Tool::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'type_tool_id' => $request->type_tool_id,
            'description' => $description,
            'note' => $request->note,
            'empreceved_id' => $request->empreceved_id,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('file');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/tools')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Tool::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function storetype(Request $request)
    {

        $rule = [
            'name_en' => 'required|string'
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $row = Type_tool::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('file');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }

}
