<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Hierarchy_emp;
use App\Models\Area;
use App\Models\Center;
use App\Models\Governorate;
use App\Models\Emirate;
use App\Models\Employee;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\RequiredIf;

class Hierarchy_empsController extends Controller
{

    public function index(Request $request)
    {
        $data = Hierarchy_emp::get();

        if ($request->ajax()) {
            $data = Hierarchy_emp::query();
            // $data = $data->where('status', 0);
            // $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getemp->name_en.'</a></div>';
                    return $name_en;
                })
                ->addColumn('type_hierarchy', function($row){
                    if($row->type_hierarchy == 0) {

                        $type_hierarchy = '<div class="badge badge-light-danger fw-bold">'.trans('lang.main').'</div>';
                    } else {
                        $type_hierarchy = '<div class="badge badge-light-info fw-bold">'.trans('lang.sub').'</div>';
                        
                        $type_hierarchy .= '<div class="badge badge-light-success fw-bold">'.$row->getaboveemp->name_en.'</div>';

                    }
                    return $type_hierarchy;
                })
                // ->addColumn('status_area', function($row){
                //     if($row->status_area == 1) {

                //         $status_area = '<div class="badge badge-light-danger fw-bold">'.trans('lang.no_area').'</div>';
                //     } else if($row->status_area == 0 && $row->area != null) {
                //         $areas = json_decode($row->area);
                //         $area_names = Area::whereIn('id', $areas)->pluck('name_en')->toArray();
                //         $rows_area = .implode(', ', $area_names) ;
                //         foreach($area_names as $areaname){
                //             $status_area = '<div class="badge badge-light-success fw-bold">'.$areaname.'</div>';
                //         }
                //     } else {    
                //         $status_area = '<div class="badge badge-light-info fw-bold">'.trans('lang.sub').'</div>';

                //     }
                //     return $status_area;
                // })
                ->addColumn('status_area', function($row) {
                    if ($row->status_area == 1) {
                        $status_area = '<div class="badge badge-light-danger fw-bold">'.trans('lang.no_area').'</div>';
                        return $status_area;
                    } 
                    else if ($row->status_area == 0 && $row->area != null) {
                        $areaIds = json_decode($row->area, true);
                        
                        if (empty($areaIds)) {
                            $status_area = '<div class="badge badge-light-info fw-bold">'.trans('lang.sub').'</div>';
                            return $status_area;
                        }
                        
                        $areas = Area::whereIn('id', $areaIds)->get();
                        $badges = '';
                        
                        foreach ($areas as $area) {
                            $badges .= '<div class="badge badge-light-info fw-bold me-1">'.$area->name_en.'</div>';
                        }
                        
                        return $badges;
                    } 
                    else {
                        return '<div class="badge badge-light-info fw-bold">'.trans('lang.sub').'</div>';
                    }
                })

                ->addColumn('note', function($row){

                    $note = $row->note;
                    
                    return $note;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-product-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
                        //     '.trans('lang.work_hours').'
                        //     </button></div> ';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.hierarchy_emps.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('country_id', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','type_hierarchy','status_area','note','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.hierarchy_emp.index');
    }

    public function show($id)
    {
        $data = Area::find($id);
        return view('admin.hierarchy_emp.show', compact('data'));
    }

    public function create()
    {
        return view('admin.hierarchy_emp.create' );
    }

    public function store(Request $request)
    {
        $rule = [
            'country_id' => 'required',
            'citySelect' => 'required_if:country_id,EGY',
            'emeratSelect' => 'required_if:country_id,UAE',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        if($request->country_id === "EGY"){
            $egy_or_uea_id = $request->citySelect;
        } elseif($request->country_id === "UAE"){
            $egy_or_uea_id = $request->emeratSelect;
        }

        $row = Area::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'country_id' => $request->country_id,
            'name_en' => $request->name_en,
            'egy_or_uea_id' => $egy_or_uea_id,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('prodcut');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/hierarchy_emps')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Area::find($id);

        return view('admin.hierarchy_emp.edit', compact('data'));
    }

    public function update(Request $request)
    {

        $rule = [

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Area::find($request->id);
        $data = Area::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('prodcut');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/hierarchy_emps')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Area::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

    public function getGovernorate(Request $request)
    {
        $countryId = 'EGY';
        $governorate = Governorate::where('countrycodealpha3', $countryId)->get();
            
        return response()->json($governorate);
    }

    public function getCitiesByGovernorate(Request $request)
    {
        $governorateId = $request->input('governorate_id');
        $governorate = Governorate::findOrFail($governorateId);
        $cities = $governorate->cities;
        return response()->json($cities);
    }
    public function getemrate(Request $request)
    {
        $countryId = 'UAE';
        $governorate = Emirate::where('countrycodealpha3', $countryId)->get();
        
        return response()->json($governorate);
    }
    public function indextreehie()
    {
   
        $data = Hierarchy_emp::where('status', 0)->orderBy('id', 'desc')->with('getemp','getaboveemp')->get();

        // Build a collection for efficient lookup
        $accountCollection = $data->keyBy('id');

        return view('admin.hierarchy_emp.indextreehie', compact('data'));
    }

}
