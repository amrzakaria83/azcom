<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Refund_sale;
use App\Models\Refund_cause;
use App\Models\Cut_sale;
use App\Models\Trans_cust;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;

class Refund_salesController extends Controller
{

    public function index(Request $request)
    {
        $data = Refund_sale::get(); 

        if ($request->ajax()) {
            $data = Refund_sale::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
                    return $name_en;
                })
                ->addColumn('note', function($row){

                    $note = $row->note;
                    
                    return $note;
                })
                ->addColumn('type', function($row){
                    if($row->type == 'dash') {
                        $type = '<div class="badge badge-light-info fw-bold">'.trans('cust_collection.administrator').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-primary fw-bold">'.trans('cust_collection.teacher').' </div>';
                    }
                    
                    return $type;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.cust_collections.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.cust_collections.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            ->orWhere('note', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','note','type','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.cust_collection.index');
    }

    public function show($id)
    {
        $data = Refund_sale::find($id);
        return view('admin.cust_collection.show', compact('data'));
    }

    public function create()
    {
        return view('admin.cust_collection.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $rule = [
            'cust_id' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Refund_sale::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'cust_id' => $request->cust_id,
            'prod_id' => $request->prod_id,
            'bill_sale_header_id' => $request->bill_sale_header_id ?? null,
            'approv_quantity_ref' => $request->approv_quantity_ref ?? null,
            'approv_sellpriceproduct_ref' => $request->approv_sellpriceproduct_ref ?? null,
            'status_requ_ref' => $request->status_requ_ref,// 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = done 
            'refund_causes_id' => $request->refund_causes_id,
            'parent_id' => $request->parent_id ?? null,
            'note' => $request->note,
            'status' => 0 ,
        ]);
        $custsal = Cut_sale::find($row->cust_id);
        $trans_cust = Trans_cust::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'cust_id' => $row->cust_id,
            'model_name' => 'Refund_sale',
            'id_model' => $row->id,
            'total_value' => $row->value,
            'status_trans' => 1, // 0 = increased creadite - 1 = decreased creadite 
            'note' => $request->note,
            'value_befor' => $row->balance_befor,
            'status' => 0 ,
        ]);
        $custsal->update([
            'value' => $custsal->value - $row->value,
        ]);
        // if($request->hasFile('photo') && $request->file('photo')->isValid()){
        //     $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        // }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Refund_sale::find($id);
        return view('admin.cust_collection.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $rule = [
            'cust_id' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $cust_collection = Refund_sale::find($request->id);
        $data = Refund_sale::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'cust_id' => $request->cust_id,
            'value' => $request->value,
            'note' => $request->note,
            'balance_befor' => $request->balance_befor,
            'status' => $request->status ,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $cust_collection->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $cust_collection->syncRoles([]);
        // $cust_collection->assignRole($role->name);

        return redirect('admin/cust_collections')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Refund_sale::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
}
