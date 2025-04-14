<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Hierarchy_emp;
use App\Models\Area;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Helper;

class EmployeesController extends Controller
{

    public function index(Request $request)
    {
        $data = Employee::get();

        if ($request->ajax()) {
            $data = Employee::query();
            $data = $data->orderBy('id', 'DESC');

            $helper = new Helper;
            $ids = $helper->emp_ids();
            if (auth()->user()->role_id != 1) {
                $data = $data->whereIn('id', $ids);
            }

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
                    $existhierarchy = Hierarchy_emp::where('emphier_id' , $row->id)->first();
                    if(!empty($existhierarchy) && $row->is_active == 1){
                        $name .= '<div class="ms-2">
                        <a href="'.route('admin.employees.editehierarchy', $row->id).'" class="btn btn-sm  btn-primary btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            '.trans('lang.editview').'-'.trans('employee.hierarchy').'
                        </a><dive';
                        }
                    
                    elseif($row->is_active == 1) {
                    $name .= '<div class="ms-2">
                                <a href="'.route('admin.employees.createhierarchy', $row->id).'" class="btn btn-sm  btn-success btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    '.trans('employee.hierarchy').'
                                </a><dive';
                    }
                    return $name;
                })
                ->addColumn('phone', function($row){
                    $phone = '<span>'.$row->phone.'</span>';
                    if($row->phone2 != null){
                        $phone .= '<br><span>'.$row->phone2.'</span>';
                    }
                    if($row->phone3 != null){
                        $phone .= '<br><span>'.$row->phone3.'</span>';
                    }
                    
                    return $phone;
                })
                ->addColumn('method_for_payment', function($row){
                    if($row->method_for_payment == 0) {
                        $method_for_payment = '<div class="badge badge-light-info fw-bold">'.trans('employee.cash').'</div>';
                    } else {
                        $method_for_payment = '<div class="badge badge-light-primary fw-bold">'.trans('employee.bank_transfer').' </div>';
                        $method_for_payment .= '<div class="badge badge-light-primary fw-bold">'.$row->acc_bank_no.' </div>';
                    }
                    if($row->salary != null){
                        $method_for_payment .= '<br><span>'.trans('lang.salary').'('.$row->salary.')</span>';
                    }
                    if($row->social_insurance_no != null){
                        $method_for_payment .= '<br><span >'.trans('lang.social_insurance_no').'</span><br><span class="text-info">('.$row->social_insurance_no.')</span>';
                    }
                    if($row->medical_insurance_no != null){
                        $method_for_payment .= '<br><span >'.trans('lang.medical_insurance_no').'</span><br><span class="text-danger">('.$row->medical_insurance_no.')</span>';
                    }
                    
                    return $method_for_payment;
                })
                ->addColumn('is_active', function($row){
                    if($row->is_active == 1) {
                    $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                    
                    $currentTime = Carbon::now();
                    $timestamp = Carbon::parse($row->birth_date);
                    $timeDifference = $currentTime->diff($timestamp);
                    $years = $timeDifference->y;
                    $months = $timeDifference->m;
                    $days = $timeDifference->d;
                    $timeString = '';
                    if ($years > 0) {
                        $timeString .= $years .trans('lang.year').'-';
                    }
                    if ($months > 0) {
                        $timeString .= $months .trans('lang.month').'-';
                    }
                    $timeString .= $days . trans('lang.day');
                    $is_active .= '<br><span>'.trans('employee.age').':'.$timeString.'</span>';
                    
                    $currentTime = Carbon::now();
                    $timestamp = Carbon::parse($row->work_date);
                    $timeDifference = $currentTime->diff($timestamp);
                    $years = $timeDifference->y;
                    $months = $timeDifference->m;
                    $days = $timeDifference->d;
                    $timeString = '';
                    if ($years > 0) {
                        $timeString .= $years .trans('lang.year').'-';
                    }
                    if ($months > 0) {
                        $timeString .= $months .trans('lang.month').'-';
                    }
                    $timeString .= $days . trans('lang.day');
                    $is_active .= '<br><span>'.trans('employee.work_duration').':</span><br><span>'.$timeString.'</span>';
                    if($row->address != null){
                        $is_active .= '<br><span class="text-info">'.$row->address.'</span>';
                    }
                    } elseif ($row->is_active == 2){
                        $is_active = '<div class="badge badge-light-info fw-bold">'.trans('employee.suspended').'</div>';
                    } elseif ($row->is_active == 3){
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.terminated').'</div>';
                        $is_active .= '<div class="badge badge-light-danger fw-bold">'.date('Y-m-d ', strtotime($row->updated_at)).'</div>';

                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    
                    // if($row->type == '0') {
                    //     $is_active .= '<div class="badge badge-light-info fw-bold">'.trans('employee.admim').'</div>';
                    // } else {
                    //     $is_active .= '<div class="badge badge-light-primary fw-bold">'.trans('employee.teacher').' </div>';
                    // }
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.employees.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.employees.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('employeeid')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('id', $request->get('employeeid'));
                    });
                    }
                    if (!empty($request->get('method_for_payment')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('method_for_payment', $request->get('method_for_payment'));
                    });
                    }
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
                ->rawColumns(['name','phone','method_for_payment','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.employee.index');
    }

    public function show($id)
    {
        $data = Employee::find($id);

        return view('admin.employee.show', compact('data'));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rule = [
            'name_en' => 'required|string',
            'email' => 'email|unique:employees',
            'phone' => 'required|unique:employees',
            'type' => 'required',
            'password' => 'nullable|min:8',
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Employee::create([
            'name_en' => $request->name_en,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'phone3' => $request->phone3,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id ?? 0,
            'type' => $request->type,
            'national_id' => $request->national_id,
            'birth_date' => $request->birth_date,
            'work_date' => $request->work_date,
            'address1' => $request->address1,
            'bank_name' => $request->bank_name,
            'social_insurance_no' => $request->social_insurance_no,
            'medical_insurance_no' => $request->medical_insurance_no,
            'salary' => $request->salary,
            // 'note' => $request->note,
            'gender' => $request->gender,
            'method_for_payment' => $request->method_for_payment, // 0 = cash, 1 = bank_transefer
            'acc_bank_no' => $request->acc_bank_no,
            'is_active' => $request->is_active ?? '0',// 0 = not active, 1 = active, 2 = suspended , 3 = terminated
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        if($request->hasFile('attach') && $request->file('attach')->isValid()){
            $row->addMediaFromRequest('attach')->toMediaCollection('attach');
        }

        $role = Role::find($request->role_id);
        $row->syncRoles([]);
        $row->assignRole($role->name);

        return redirect('admin/employees')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Employee::find($id);
        return view('admin.employee.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'email' => 'required|string',
            'type' => 'required',
            'password' => 'nullable|min:8',
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $employee = Employee::find($request->id);
        $data = Employee::where('id', $request->id)->update([
            'name_en' => $request->name_en,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'phone3' => $request->phone3,
            'password' => ($request->password) ? Hash::make($request->password): $employee->password,
            'role_id' => $request->role_id ?? 0,
            'type' => $request->type,// 0 = admin
            'national_id' => $request->national_id,
            'birth_date' => $request->birth_date,
            'work_date' => $request->work_date,
            'address1' => $request->address1,
            'bank_name' => $request->bank_name,
            'social_insurance_no' => $request->social_insurance_no,
            'medical_insurance_no' => $request->medical_insurance_no,
            'salary' => $request->salary,
            // 'note' => $request->note,
            'gender' => $request->gender,
            'method_for_payment' => $request->method_for_payment, // 0 = cash, 1 = bank_transefer
            'acc_bank_no' => $request->acc_bank_no,
            'is_active' => $request->is_active ?? '0',// 0 = not active, 1 = active, 2 = suspended , 3 = terminated
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        if($request->hasFile('attach') && $request->file('attach')->isValid()){
            $employee->addMediaFromRequest('attach')->toMediaCollection('attach');
        }

        $role = Role::find($request->role_id);
        $employee->syncRoles([]);
        $employee->assignRole($role->name);

        return redirect('admin/employees')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Employee::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function createhierarchy($id)
    {
        $data = Employee::find($id);
        $dataemp = Employee::where('is_active' , '1')->get();
        $dataarea = Area::where('status' , 0)->get();

        return view('admin.employee.createhierarchy', compact ('data','dataemp','dataarea'));
    }
    public function storehierarchy(Request $request)
    {
        // dd($request->all());
        $rule = [
            'type_hierarchy' => 'required',

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Hierarchy_emp::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'emphier_id' => $request->id,
            'type_hierarchy' => $request->type_hierarchy,
            'parent_id' => $request->parent_id ?? null,
            'above_hierarchy' =>  $request->above_hierarchy,
            'status_area' => $request->status_area,
            'area' => json_encode($request->area) ?? null,
            'status_prod' => $request->status_prod,
            'prod' => json_encode($request->prod) ?? null,
            'status' => $request->status ?? 0,
            
        ]);

        

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/employees')->with('message', 'Added successfully')->with('status', 'success');
    }
    public function editehierarchy($id)
    {
        $data = Hierarchy_emp::where('emphier_id' , $id)->first();
        $dataemp = Employee::where('is_active' , '1')->get();
        $dataarea = Area::where('status' , 0)->get();

        return view('admin.employee.editehierarchy', compact ('data','dataemp','dataarea'));
    }
}
