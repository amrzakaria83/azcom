<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Event_content;
use App\Models\Event_type;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Event_contentsController extends Controller
{

    public function index(Request $request)
    {
        $data = Event_content::get();

        if ($request->ajax()) {
            $data = Event_content::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a>';
                    $name_en .= '<span>'.$row->email.'</span></div>';
                    return $name_en;
                })
                ->addColumn('type_id', function($row){
 
                    $type_id = '<span>'.$row->geteventtype->name_en.'</span>';
                    
                    
                    return $type_id;
                })
                ->addColumn('from_time', function($row){
                    // $from_time = $row->from_time ;
                    $from_time = date('Y-m-d H:i', strtotime($row->from_time));
                    return $from_time;
                })
                ->addColumn('to_time', function($row){
                    // $to_time = $row->to_time ;
                    $to_time = date('Y-m-d H:i', strtotime($row->to_time));

                    return $to_time;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                    } 
                     else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.event_contents.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.event_contents.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                            
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name_en', 'LIKE', "%$search%")
                            ->orWhere('type_id', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','type_id','from_time','to_time','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.event_content.index');
    }

    public function show($id)
    {
        $data = Event_content::find($id);
        return view('admin.event_content.show', compact('data'));
    }

    public function create($id)
    {
        $data = Event::find($id);
        $datatype = Event_type::where('status', 0)->get();
        $datacontent = Event_content::where('status', 0)
        ->where('event_id' ,$data)
        ->get();
        return view('admin.event_content.create', compact('data','datatype','datacontent'));
    }

    public function store(Request $request)
    {
        $rule = [
            'event_id' => 'required',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $row = Event_content::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'event_id' => $request->event_id,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'type_event_content' => $request->type_event_content, // 0 = schedoul - 1 = logistic - 2 = point discus - 3 = recommended activities - 4 = other
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/event_contents')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Event::find($id);

        return view('admin.event_content.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $rule = [
            'event_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Event_content::find($request->id);
        $data = Event_content::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'event_id' => $request->event_id,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'type_event_content' => $request->type_event_content, // 0 = schedoul - 1 = logistic - 2 = point discus - 3 = recommended activities - 4 = other
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/event_contents')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Event_content::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function storeventtype(Request $request)
    {
        $rule = [
            'name_en' => 'required',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Event_type::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }
    
}
