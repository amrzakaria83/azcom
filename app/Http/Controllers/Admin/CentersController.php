<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Type_center;
use App\Models\Working_hour;
use App\Models\Area;
use App\Models\Governorate;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;

class CentersController extends Controller
{

    public function index(Request $request)
    {
        $data = Center::get();

        if ($request->ajax()) {
            $data = Center::query();
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

                    $name .= '<span>'.$row->email.'</span>';
                    
                    return $name;
                })

                ->addColumn('inform', function($row){

                    $inform = '<div class="badge badge-light-success fw-bold">'.$row->phone.'</div>';
                    $inform .= '<div class="badge badge-light-success fw-bold">'.$row->phone2.'</div><br>';
                    $inform .= '<div class="badge badge-light-success fw-bold">'.$row->landline.'</div><br>';
                    $inform .= '<div class="badge badge-light-success fw-bold">'.$row->landline2.'</div><br>';
                    $inform .= '<div class="badge badge-light-info fw-bold">'.$row->website.'</div>';
                    
                    return $inform;
                })

                ->addColumn('type', function($row){

                    $type = '<div class="badge badge-light-danger fw-bold fs-3">'.$row->gettype->name_en.'</div><br>';
                    $ass = Working_hour::where('model_name' , "center")->where('id_model' , $row->id)->where('status' , 0)->get();
                    if (!empty($ass)) {
                        foreach($ass as $work){

                            if($work->dynamic_work == 2){
                                $type .= '<div class="badge badge-light-success fw-bold">24'.trans('lang.hour').'</div><br>';
                            } else{
                                $type .= '<br><div class="badge badge-light-info fw-bold">'.trans('lang.start_from').':'.date('h:i A', strtotime($work->from_time)).'</div>';
                                $type .= '<div class="badge badge-light-info fw-bold">'.trans('lang.end_to').':'.date('h:i A', strtotime($work->to_time)).'</div>';
                            }

                            if($work->on_workrule == 2){
                                $type .= '<div class="badge badge-light-success fw-bold">'.trans('lang.all').':'.trans('lang.days').'</div>';
                            } else{
                                $work_days = json_decode($work->work_days);
                                if (!empty($work_days)) {
                                    $daysOfWeek = [trans('lang.saturday'),trans('lang.sunday'),trans('lang.monday'),trans('lang.tuesday'),trans('lang.wednesday'),trans('lang.thursday'),trans('lang.friday')];
                                    $selectedDays = array_map(function ($dayIndex) use ($daysOfWeek) {
                                        return $daysOfWeek[$dayIndex];
                                    }, $work_days);
                                    $daysString = implode(', ', $selectedDays);
                                    $type .= '<br><div class="badge badge-light-info fw-bold">'.trans('lang.work').'-'.trans('lang.days').':'.$daysString.'</div>';
                                }
                            }
                        }
                    }
                    return $type;
                })
                ->addColumn('address', function($row){
                    $address = '';
                    $address .= $row->address.'<br>';
                    // $address .= $row->map_location.'<br>'; 
                    $areaid = $row->area_id;
                    $arfind = Area::find($areaid);
                    if ($arfind->country_id === "EGY"){
                        $address .= '<span class="fs-5 text-info">'.$arfind->getcity->city_name_en.'</span><br>';
                        $gov = $arfind->getcity->governorate_id;
                        $namgov = Governorate::find($gov);
                        $address .= '<span>'.trans('lang.governorate').':'.$namgov->governorate_name_en.'</span><br>';
                        $address .= '<span>'.trans('lang.egypt').'</span>';
                    } elseif ($arfind->country_id === "UAE"){
                        $address .= '<span class="fs-5 text-info">'.$arfind->getcity->name_en.'</span><br>';
                        $address .= '<span>'.trans('lang.uae').'</span><br>';
                    }
                    

                    return $address;
                })
                ->addColumn('is_active', function($row){

                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-center-id="'. $row->id .'" data-centername="'. $row->name_en .'">
                        //     '.trans('lang.work_hours').'
                        //     </button></div> ';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    $is_active .= $row->note;

                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.centers.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.centers.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div><br>';
                    if($row->status == 0){
                        $actions .= '<div><button type="button" class="btn btn-success btn-sm col-12" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-center-id="'. $row->id .'" data-centername="'. $row->name_en .'">
                        <i class="bi bi-plus-square fs-1x"></i>'.trans('lang.work_hours').'
                        </button></div> ';

                    }

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
                            $w->orWhere('name_en', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','inform', 'type','address','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.center.index');
    }

    public function show($id)
    {
        $data = Center::find($id);
        return view('admin.center.show', compact('data'));
    }

    public function create()
    {
        $data = Type_center::where('status' , 0)->get();
        $dataarea = Area::where('status' , 0)->get();
        return view('admin.center.create', compact('data','dataarea'));
    }

    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required',
            'type_id' => 'required|numeric',
            'phone' => 'required',
            'area_id' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Center::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'type_id' => $request->type_id,
            'area_id' => $request->area_id ?? null,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'landline' => $request->landline,
            'landline2' => $request->landline2,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'map_location' => $request->map_location,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/centers')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Center::find($id);
        $datatype = Type_center::where('status' , 0)->get();
        $dataarea = Area::where('status' , 0)->get();

        return view('admin.center.edit', compact('data','datatype','dataarea'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required',
            'phone' => 'required'

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Center::find($request->id);
        $data = Center::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'type_id' => $request->type_id ?? $center->type_id,
            'area_id' => $request->area_id ?? $center->area_id,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'landline' => $request->landline,
            'landline2' => $request->landline2,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'map_location' => $request->map_location,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $center->syncRoles([]);
        // $center->assignRole($role->name);

        return redirect('admin/centers')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Center::whereIn('id',$request->id)->delete();
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
        // dd($request->work_days);
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
}
