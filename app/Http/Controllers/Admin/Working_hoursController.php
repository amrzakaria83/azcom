<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Working_hour;
use App\Models\Type_center;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Working_hoursController extends Controller
{

    public function index(Request $request)
    {
        $data = Working_hour::get();

        if ($request->ajax()) {
            $data = Working_hour::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getemp->name_en.'</a></div>';
                    $name .= '<span>'.$row->created_at.'</span></div>';
                    return $name;
                })
                ->addColumn('phone', function($row){

                    $phone = $row->value;
                    
                    return $phone;
                })
                ->addColumn('type', function($row){

                    $type = $row->gettype->name_en .'<br>';
                    $statusresponse = $row->statusresponse;// "0 = waitting - 1 = approved - 2 = rejected - 3 = delayed
                    if($statusresponse === 0){
                        $type .= '<br><span class="text-info">'.trans('lang.director').':'.trans('lang.waiting').trans('lang.approved').'</span>';
                    } elseif($statusresponse === 1){
                        $type .= '<br><span class="text-success">'.trans('lang.director').':'.trans('lang.approved').'</span>';
                    } elseif($statusresponse === 2){
                        $type .= '<br><span class="text-danger">'.trans('lang.director').':'.trans('lang.reject').'</span>';
                    }
                    else{ 
                        $type .= '<br><span class="text-warning">'.trans('lang.director').':'.trans('lang.delay').'</span>';
                    }
                    return $type;
                })
                ->addColumn('is_active', function($row){

                    $is_active = $row->note .'<br>';
                    $is_active .= $row->notepayment;
                    
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.expense_requests.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.expense_requests.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    if ($request->get('type')) {
                        $instance->where('type', $request->get('type'));
                    }
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','phone','type','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.center.index');
    }

    public function show($id)
    {
        $data = Working_hour::find($id);
        return view('admin.center.show', compact('data'));
    }

    public function create()
    {
        $data = Type_center::where('status' , 0)->get();
        return view('admin.center.create', compact('data'));
    }

    public function store(Request $request)
    {
        $rule = [
            'value' => 'required',
            'type_id' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Working_hour::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'type_id' => $request->type_id,
            'value' => $request->value,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            'statusresponse' => 0, // "0 = waitting - 1 = approved - 2 = rejected - 3 = delayed 
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/expense_requests')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Working_hour::find($id);
        $datatype = Type_center::where('status' , 0)->get();

        return view('admin.center.edit', compact('data','datatype'));
    }

    public function update(Request $request)
    {
        $rule = [

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Working_hour::find($request->id);
        $data = Working_hour::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'type_id' => $center->type_id,
            'value' => $center->value,
            'note' => $center->note,
            'status' => $request->status ?? 0,
            'notepayment' => $request->notepayment,
            'statusresponse' => $request->statusresponse, // "0 = waitting - 1 = approved - 2 = rejected - 3 = delayed 
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $center->syncRoles([]);
        // $center->assignRole($role->name);

        return redirect('admin/expense_requests')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Working_hour::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function storetype(Request $request)
    {
        $rule = [
            'name_en' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Type_center::create([
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
