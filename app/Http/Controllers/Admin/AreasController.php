<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Center;
use App\Models\Governorate;
use App\Models\Emirate;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\RequiredIf;

class AreasController extends Controller
{

    public function index(Request $request)
    {
        $data = Area::get();

        if ($request->ajax()) {
            $data = Area::query();
            $data = $data->orderBy('country_id', 'ASC');
            // $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
                    return $name;
                })
                ->addColumn('country_id', function($row){
                    if ($row->country_id === "EGY"){
                        $country_id = '<span class="fs-2 text-info">'.$row->getcity->city_name_en.'</span><br>';
                        $gov = $row->getcity->governorate_id;
                        $namgov = Governorate::find($gov);
                        $country_id .= '<span>'.trans('lang.governorate').':'.$namgov->governorate_name_en.'</span><br>';
                        $country_id .= '<span>'.trans('lang.egypt').'</span>';
                    } elseif ($row->country_id === "UAE"){
                        $country_id = '<span class="fs-2 text-info">'.$row->getcity->name_en.'</span><br>';
                        $country_id .= '<span>'.trans('lang.uae').'</span>';
                    }

                    return $country_id;
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
                                <a href="'.route('admin.areas.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            ->orWhere('country_id', 'LIKE', "%$search%")
                            ->orWhere('note', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','country_id','note','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.area.index');
    }

    public function show($id)
    {
        $data = Area::find($id);
        return view('admin.area.show', compact('data'));
    }

    public function create()
    {
        return view('admin.area.create' );
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

        return redirect('admin/areas')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Area::find($id);

        return view('admin.area.edit', compact('data'));
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

        return redirect('admin/areas')->with('message', 'Modified successfully')->with('status', 'success');
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

}
