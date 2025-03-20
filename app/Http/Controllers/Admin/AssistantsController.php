<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Assistant;
use App\Models\Center;
use App\Models\Working_hour;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AssistantsController extends Controller
{

    public function index(Request $request)
    {
        $data = Assistant::get();

        if ($request->ajax()) {
            $data = Assistant::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a>';
                    $name .= '<span>'.$row->email.'</span></div>';
                    return $name;
                })
                ->addColumn('phone', function($row){
 
                    $phone = '<span>'.$row->phone.'</span>';
                    $phone .= '<br><span>'.$row->phone2.'</span>';
                    $phone .= '<br><span class="text-info">'.$row->address.'</span>';
                    
                    return $phone;
                })
                ->addColumn('center_id', function($row){

                    $center_id = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary  fs-1">'.$row->getcenter->name_en.'</a></div><br>';

                    $ass = Working_hour::where('model_name' , "assistant")->where('id_model' , $row->id)->where('status' , 0)->get();
                    if (!empty($ass)) {
                        foreach($ass as $work){

                            if($work->dynamic_work == 2){
                                $center_id .= '<div class="badge badge-light-success fw-bold">24'.trans('lang.hour').'</div><br>';
                            } else{
                                $center_id .= '<br><div class="badge badge-light-info fw-bold">'.trans('lang.start_from').':'.date('h:i A', strtotime($work->from_time)).'</div>';
                                $center_id .= '<div class="badge badge-light-info fw-bold">'.trans('lang.end_to').':'.date('h:i A', strtotime($work->to_time)).'</div>';
                            }

                            if($work->on_workrule == 2){
                                $center_id .= '<div class="badge badge-light-success fw-bold">'.trans('lang.all').':'.trans('lang.days').'</div>';
                            } else{
                                $work_days = json_decode($work->work_days);
                                if (!empty($work_days)) {
                                    $daysOfWeek = [trans('lang.saturday'),trans('lang.sunday'),trans('lang.monday'),trans('lang.tuesday'),trans('lang.wednesday'),trans('lang.thursday'),trans('lang.friday')];
                                    $selectedDays = array_map(function ($dayIndex) use ($daysOfWeek) {
                                        return $daysOfWeek[$dayIndex];
                                    }, $work_days);
                                    $daysString = implode(', ', $selectedDays);
                                    $center_id .= '<br><div class="badge badge-light-info fw-bold">'.$daysString.'</div>';
                                }
                            }

                        }

                    }

                    
                    return $center_id;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-assistant-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
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
                                <a href="'.route('admin.assistants.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.assistants.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div><br>';
                            if($row->status == 0){
                                $actions .= '<div><button type="button" class="btn btn-success btn-sm col-12" data-bs-toggle="modal" data-bs-target="#kt_modal_1b"data-assistant-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
                                <i class="bi bi-plus-square fs-1x"></i>'.trans('lang.work_hours').'
                                </button></div> ';
        
                            }
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
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
                ->rawColumns(['name','phone','center_id','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.assistant.index');
    }

    public function show($id)
    {
        $data = Assistant::find($id);
        return view('admin.assistant.show', compact('data'));
    }

    public function create()
    {
        $datacenter = Center::where('status', 0)->get();
        return view('admin.assistant.create', compact('datacenter'));
    }

    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'center_id' => 'required|numeric',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Assistant::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'center_id' => $request->center_id,
            'name_en' => $request->name_en,
            'email' => $request->email ?? null,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'address' => $request->address,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('file');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/assistants')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Assistant::find($id);
        $datacenter = Center::where('status', 0)->get();

        return view('admin.assistant.edit', compact('data','datacenter'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Assistant::find($request->id);
        $data = Assistant::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'center_id' => $request->center_id ?? $center->center_id,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'address' => $request->address,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('file');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/assistants')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Assistant::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function storeworkhour(Request $request)
    {
        $rule = [
            'dynamic_work' => 'required|numeric',
            'on_workrule' => 'required|numeric',
            'id_model' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Working_hour::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'id_model' => $request->id_model,
            'model_name' => $request->model_name,
            'dynamic_work' => $request->dynamic_work,
            'on_workrule' => $request->on_workrule,
            'from_time' => $request->dynamic_work == 2 ? null : $request->from_time,
            'to_time' => $request->dynamic_work == 2 ? null : $request->to_time,
            'work_days' => $request->on_workrule == 2 ? null : json_encode($request->work_days) ,
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
    
    // public function showworkhour(Request $request)
    // {


    //     return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    // }
}
