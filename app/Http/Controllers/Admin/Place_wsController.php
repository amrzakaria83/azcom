<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Place_w;
use App\Models\Contact;
use App\Models\Center;
use App\Models\Area;
use App\Models\Governorate;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Place_wsController extends Controller
{

    public function index(Request $request)
    {
        $data = Place_w::get();

        if ($request->ajax()) {
            $data = Place_w::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-primary mb-1 fs-2">'.$row->getcontact->name_en.'</a></div>';
                    $name_en .= '<span>'.trans('lang.place').' '.trans('lang.work').'</span></div><br>';
                    $name_en .= '<span>'.$row->getcenter->name_en.'</span></div>';
                    $areaid = $row->getcenter->area_id ?? null;
                    $arfind = Area::find($areaid);
                    if ($arfind->country_id === "EGY"){
                        $name_en .= '<span class="fs-6 text-info">'.$arfind->getcity->city_name_en.'</span><br>';
                        $gov = $arfind->getcity->governorate_id;
                        $namgov = Governorate::find($gov);
                        $name_en .= '<span>'.trans('lang.governorate').':'.$namgov->governorate_name_en.'</span><br>';
                        $name_en .= '<span>'.trans('lang.egypt').'</span>';
                    } elseif ($arfind->country_id === "UAE"){
                        $name_en .= '<span class="fs-6 text-info">'.$arfind->getcity->name_en.'</span><br>';
                        $name_en .= '<span>'.trans('lang.uae').'</span><br>';
                    }

                    return $name_en;
                })
                ->addColumn('from_time', function($row){
                    
                    $from_time = date('h:i A', strtotime($row->from_time));
                    
                    return $from_time;
                })
                ->addColumn('to_time', function($row){

                    $to_time = date('h:i A', strtotime($row->to_time));

                    return $to_time;
                })
                ->addColumn('on_workrule', function($row){
                    $on_workrule = '';
                    if($row->on_workrule == 2){
                        $on_workrule .= '<div class="badge badge-light-success fw-bold">'.trans('lang.all').':'.trans('lang.days').'</div>';
                    } else{
                        $work_days = json_decode($row->work_days);
                        if (!empty($work_days)) {
                            $daysOfWeek = [trans('lang.saturday'),trans('lang.sunday'),trans('lang.monday'),trans('lang.tuesday'),trans('lang.wednesday'),trans('lang.thursday'),trans('lang.friday')];
                            $selectedDays = array_map(function ($dayIndex) use ($daysOfWeek) {
                                return $daysOfWeek[$dayIndex];
                            }, $work_days);
                            $daysString = implode(', ', $selectedDays);
                            $on_workrule .= '<div class="badge badge-light-info fw-bold">'.$daysString.'</div>';
                        }
                    }
                    return $on_workrule;
                })
                ->addColumn('is_active', function($row){

                    $is_active = '';

                    $is_active = $row->note .'<br>';
                    
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
                            $w->orWhere('name_en', 'LIKE', "%$search%")
                            ->orWhere('from_time', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','from_time','to_time','on_workrule','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.place_w.index');
    }

    public function show($id)
    {
        $data = Place_w::find($id);
        return view('admin.place_w.show', compact('data'));
    }

    public function create()
    {
        $datacont = Contact::where('status' , 0)->get();
        $datacenter = Center::where('status', 0)->get();
        return view('admin.place_w.create', compact('datacont','datacenter'));
    }

    public function store(Request $request)
    {
        $rule = [
            'contact_id' => 'required|numeric',
            'center_id' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Place_w::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'contact_id' => $request->contact_id,
            'center_id' => $request->center_id,
            'note' => $request->note,
            'dynamic_work' => $request->dynamic_work, // 0 = hours - 1 = unregular - 2 = 24 hours
            'on_workrule' => $request->on_workrule,// 0 = weekly - 1 = unregular - 2 = 7 days work
            'from_time' => $request->dynamic_work == 2 ? null : $request->from_time,
            'to_time' => $request->dynamic_work == 2 ? null : $request->to_time,
            'work_days' => $request->on_workrule == 2 ? null : json_encode($request->work_days), // json_encode 0 = Saturday - 1 = Sunday - 2 = Monday - 3 = Tuesday - 4 = Wednesday - 5 = Thursday - 6 =  Friday
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/place_ws')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Place_w::find($id);
        $datatype = Contact::where('status' , 0)->get();

        return view('admin.place_w.edit', compact('data','datatype'));
    }

    public function update(Request $request)
    {
        $rule = [

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Place_w::find($request->id);
        $data = Place_w::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'contact_id' => $request->contact_id,
            'center_id' => $request->center_id,
            'note' => $request->note,
            'dynamic_work' => $request->dynamic_work, // 0 = hours - 1 = unregular - 2 = 24 hours
            'on_workrule' => $request->on_workrule,// 0 = weekly - 1 = unregular - 2 = 7 days work
            'from_time' => $request->dynamic_work == 2 ? null : $request->from_time,
            'to_time' => $request->dynamic_work == 2 ? null : $request->to_time,
            'work_days' => $request->on_workrule == 2 ? null : json_encode($request->work_days), // json_encode 0 = Saturday - 1 = Sunday - 2 = Monday - 3 = Tuesday - 4 = Wednesday - 5 = Thursday - 6 =  Friday
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $center->syncRoles([]);
        // $center->assignRole($role->name);

        return redirect('admin/place_ws')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Place_w::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    
}
