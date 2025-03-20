<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Cut_sale;
use App\Models\Center;
use App\Models\Area;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Cut_salesController extends Controller
{

    public function index(Request $request)
    {
        $data = Cut_sale::get();

        if ($request->ajax()) {
            $data = Cut_sale::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'
                    .$row->name_en.'</a></div>';
                    $tax_id = $row->tax_id; 
                    if (!empty($tax_id)) {
                        $name_en .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'
                        .trans('lang.tax_id').': '
                    .$row->tax_id.'</a></div>';
                    }
                    return $name_en;
                })
                ->addColumn('type_type', function($row){
 
                    $type = $row->type_type; // 0 = center - 1 = newcustomer 
                    if ($type === 0){
                        $type_type = '<span class="text-info fs-3">'.trans('lang.center').'</span>';
                    } else {
                        $type_type = '<span class="text-danger fs-3">'.trans('lang.other').'</span>';
                    }
                    
                    return $type_type;
                })
                ->addColumn('phone', function($row){

                    $phone = $row->phone;
                    
                    return $phone;
                })
                
                ->addColumn('note', function($row){

                    $note = $row->note;
                    
                    return $note;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-Cut_sale-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
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
                                <a href="'.route('admin.cut_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.cut_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            ->orWhere('type_type', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','type_type','note','phone','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.cut_sale.index');
    }

    public function show($id)
    {
        $data = Cut_sale::find($id);
        return view('admin.cut_sale.show', compact('data'));
    }

    public function create()
    {
        $oldcustid = Cut_sale::where('status', 0)->pluck('center_id')->toArray();
        // Filter out null values from the array
            $oldcustid = array_filter($oldcustid, function ($value) {
                return !is_null($value);
            });
        // Ensure $oldcustid is an array, even if it's empty
        $oldcustid = $oldcustid ?? [];
        // Debugging: Check the filtered array
        // Fetch data from the Center model
        $data = Center::where('status', 0)->whereNotIn('id', $oldcustid)->get();
        $dataarea = Area::where('status' , 0)->get();

        return view('admin.cut_sale.create',compact('data','dataarea') );
    }

    public function store(Request $request)
    {

        $rule = [
            'type_type' => 'required',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } ;
        if ($request->type_type == 0){
            $datacenter = Center::find($request->center_id);
            $row = Cut_sale::create([
                'emp_id' => Auth::guard('admin')->user()->id,
                'type_type' => $request->type_type, // 0 = center - 1 = newcustomer 
                'center_id' => $request->center_id ?? null,
                'name_ar' => $datacenter->name_ar ?? null,
                'name_en' => $datacenter->name_en,
                'phone' => $datacenter->phone,
                'address' => $datacenter->address,
                'email' => $datacenter->email ?? null,
                'tax_id' => $request->tax_id ?? null,
                'area_id' => $datacenter->area_id ?? null,
                'lat' => $request->lat ?? null,
                'lng' => $request->lng ?? null,
                'note' => $datacenter->note,
                'status' => $datacenter->status ?? 0,
                'value' => $request->value ?? 0,
                
            ]);
        } else {
            $row = Cut_sale::create([
                'emp_id' => Auth::guard('admin')->user()->id,
                'type_type' => $request->type_type, // 0 = center - 1 = newcustomer 
                'center_id' => $request->center_id ?? null,
                'name_ar' => $request->name_ar ?? null,
                'name_en' => $request->name_en,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'tax_id' => $request->tax_id,
                'note' => $request->note,
                'status' => $request->status ?? 0,
                'value' => $request->value ?? 0,
                
            ]);
    
            // if($request->hasFile('photo') && $request->file('photo')->isValid()){
            //     $row->addMediaFromRequest('photo')->toMediaCollection('gift');
            // }
        }
        

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Cut_sale::find($id);

        return view('admin.cut_sale.edit', compact('data'));
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
        
        $center = Cut_sale::find($request->id);
        $data = Cut_sale::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'tax_id' => $request->tax_id,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('gift');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/cut_sales')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Cut_sale::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

}
