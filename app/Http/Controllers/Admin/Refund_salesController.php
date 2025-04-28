<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($request->ajax()) {
            $data = Refund_sale::query()
                ->with(['getprod', 'getcust', 'getheader', 'getrefcause'])
                ->whereNotNull('parent_id')
                ->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    return '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                    </div>';
                })
                ->addColumn('name_en', function($row){
                    // Changed to show customer name instead of non-existent name_en
                    $customerName = $row->getcust->name ?? 'N/A';
                    return '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$customerName.'</a></div>';
                })
                ->addColumn('note', function($row){
                    return $row->note;
                })
                ->addColumn('type', function($row){
                    // Changed to match your refund status field
                    switch($row->status_requ_ref) {
                        case 0: 
                            return '<div class="badge badge-light-info fw-bold">'.trans('refund_sale.request').'</div>';
                        case 1:
                            return '<div class="badge badge-light-primary fw-bold">'.trans('refund_sale.approved').'</div>';
                        case 2:
                            return '<div class="badge badge-light-warning fw-bold">'.trans('refund_sale.partial_cancel').'</div>';
                        case 3:
                            return '<div class="badge badge-light-danger fw-bold">'.trans('refund_sale.canceled').'</div>';
                        case 4:
                            return '<div class="badge badge-light-success fw-bold">'.trans('refund_sale.completed').'</div>';
                        default:
                            return '<div class="badge badge-light-secondary fw-bold">'.trans('refund_sale.unknown').'</div>';
                    }
                })
                ->addColumn('is_active', function($row){
                    // Changed to match your status field (assuming 0 is active)
                    if($row->status == 0) {
                        return '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                    } else {
                        return '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                })
                ->addColumn('actions', function($row){
                    return '<div class="ms-2">
                        <a href="'.route('admin.refund_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2">
                            <i class="bi bi-eye-fill fs-1x"></i>
                        </a>
                        <a href="'.route('admin.refund_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2">
                            <i class="bi bi-pencil-square fs-1x"></i>
                        </a>
                    </div>';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->has('status') && in_array($request->get('status'), ['0', '1'])) {
                        $instance->where('status', $request->get('status'));
                    }
                    if ($request->has('status_requ_ref')) {
                        $instance->where('status_requ_ref', $request->get('status_requ_ref'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhereHas('getcust', function($q) use ($search) {
                                $q->where('name', 'LIKE', "%$search%");
                            })
                            ->orWhere('note', 'LIKE', "%$search%")
                            ->orWhereHas('getprod', function($q) use ($search) {
                                $q->where('name_en', 'LIKE', "%$search%");
                            });
                        });
                    }
                })
                ->rawColumns(['name_en', 'note', 'type', 'is_active', 'checkbox', 'actions'])
                ->make(true);
        }
        return view('admin.refund_sale.index');
    }

    // public function index(Request $request)
    // {

    //     if ($request->ajax()) {
            

    //         $data = Refund_sale::query()
    //         ->with(['getprod', 'getcust', 'getheader', 'getrefcause'])
    //         ->whereNotNull('parent_id')
    //         ->groupBy(['parent_id', 'cust_id'])
    //         ->orderBy('id', 'DESC');

    //         return Datatables::of($data)
    //             ->addColumn('checkbox', function($row){
    //                 $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
    //                                 <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
    //                             </div>';
    //                 return $checkbox;
    //             })
    //             ->addColumn('name_en', function($row){
    //                 $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
    //                 return $name_en;
    //             })
    //             ->addColumn('note', function($row){

    //                 $note = $row->note;
                    
    //                 return $note;
    //             })
    //             ->addColumn('type', function($row){
    //                 if($row->type == 'dash') {
    //                     $type = '<div class="badge badge-light-info fw-bold">'.trans('refund_sale.administrator').'</div>';
    //                 } else {
    //                     $type = '<div class="badge badge-light-primary fw-bold">'.trans('refund_sale.teacher').' </div>';
    //                 }
                    
    //                 return $type;
    //             })
    //             ->addColumn('is_active', function($row){
    //                 if($row->status == 0) {
    //                     $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
    //                 } else {
    //                     $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
    //                 }
                    
    //                 return $is_active;
    //             })
    //             ->addColumn('actions', function($row){
    //                 $actions = '<div class="ms-2">
    //                             <a href="'.route('admin.refund_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    //                                 <i class="bi bi-eye-fill fs-1x"></i>
    //                             </a>
    //                             <a href="'.route('admin.refund_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    //                                 <i class="bi bi-pencil-square fs-1x"></i>
    //                             </a>
    //                         </div>';
    //                 return $actions;
    //             })
    //             ->filter(function ($instance) use ($request) {
    //                 if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
    //                     $instance->where('is_active', $request->get('is_active'));
    //                 }
    //                 if ($request->get('type')) {
    //                     $instance->where('type', $request->get('type'));
    //                 }
    //                 if (!empty($request->get('search'))) {
    //                         $instance->where(function($w) use($request){
    //                         $search = $request->get('search');
    //                         $w->orWhere('name_en', 'LIKE', "%$search%")
    //                         ->orWhere('note', 'LIKE', "%$search%")
    //                         ->orWhere('email', 'LIKE', "%$search%");
    //                     });
    //                 }
    //             })
    //             ->rawColumns(['name_en','note','type','is_active','checkbox','actions'])
    //             ->make(true);
    //     }
    //     return view('admin.refund_sale.index');
    // }

    public function show($id)
    {
        $data = Refund_sale::find($id);
        return view('admin.refund_sale.show', compact('data'));
    }

    public function create()
    {
        return view('admin.refund_sale.create');
    }
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'cust_id' => 'required',
            'refund_causes_id' => 'required|numeric',
            'kt_docs_repeater_basic' => 'required|array|min:1',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('message', $validator->messages()->first())
                ->with('status', 'error');
        }

        try {
            DB::beginTransaction();

            $parentId = null;
            $totalValue = 0;
            $repeaterItems = $request['kt_docs_repeater_basic'];
            $isSingleItem = count($repeaterItems) === 1;

            foreach ($repeaterItems as $key => $item) {
                // For the first item, set parent_id to its own ID (self-reference)
                $currentParentId = ($key === 0) ? null : $parentId;
                    
                // Create refund sale record
                $refundSale = Refund_sale::create([
                    'emp_id' => Auth::guard('admin')->user()->id,
                    'cust_id' => $item['cust_id'] ?? $request->cust_id,
                    'prod_id' => $item['prod_id'] ?? null,
                    'bill_sale_header_id' => $item['bill_sale_header_id'] ?? null,
                    'approv_quantity_ref' => $item['approv_quantity_ref'] ?? null,
                    'approv_sellpriceproduct_ref' => $item['approv_sellpriceproduct_ref_hidden'] ?? null,
                    'status_requ_ref' => $item['status_requ_ref'] ?? 1,
                    'refund_causes_id' => $item['refund_causes_id'] ?? $request->refund_causes_id,
                    'parent_id' => $currentParentId,
                    'value' => $item['value'] ?? 0,
                    'note' => $item['note'] ?? $request->note,
                    'status' => 0,
                ]);

                $totalValue += $refundSale->value;

                // Set parent ID for first item
                if ($key === 0) {
                    $parentId = $refundSale->id;
                    // For single item, set parent to itself
                    if ($isSingleItem) {
                        $refundSale->update(['parent_id' => $parentId]);
                    }
                }
            }

            // Get customer record
            $customer = Cut_sale::findOrFail($request->cust_id);

            // Create transaction record
            Trans_cust::create([
                'emp_id' => Auth::guard('admin')->user()->id,
                'cust_id' => $customer->id,
                'model_name' => 'Refund_sale',
                'id_model' => $parentId,
                'total_value' => $totalValue,
                'status_trans' => 1, // 0 = increased credit, 1 = decreased credit
                'note' => $request->note,
                'value_befor' => $customer->value,
                'status' => 0,
            ]);

            // Update customer balance
            $customer->update([
                'value' => $customer->value - $totalValue,
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('message', 'Refund processed successfully')
                ->with('status', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->with('message', 'Error processing refund: ' . $e->getMessage())
                ->with('status', 'error');
        }
    }
    


    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     $rule = [
    //         'cust_id' => 'required',
    //     ];

    //     $validate = Validator::make($request->all(), $rule);
    //     if ($validate->fails()) { 
    //         return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
    //     } 
    //     if (count($request['kt_docs_repeater_basic']) > 1) {  
    //         $parentId = null;
            
    //         foreach ($request['kt_docs_repeater_basic'] as $key => $value) {
    //             // Create the record
    //             $row = Refund_sale::create([
    //                 'emp_id' => Auth::guard('admin')->user()->id,
    //                 'cust_id' => $value['cust_id'] ?? $request->cust_id,
    //                 'prod_id' => $value['prod_id'] ?? null,
    //                 'bill_sale_header_id' => $value['bill_sale_header_id'] ?? null,
    //                 'approv_quantity_ref' => $value['approv_quantity_ref'] ?? null,
    //                 'approv_sellpriceproduct_ref' => $value['approv_sellpriceproduct_ref_hidden'] ?? null,
    //                 'status_requ_ref' => $value['status_requ_ref'] ?? 1,
    //                 'refund_causes_id' => $value['refund_causes_id'] ?? $request->refund_causes_id,
    //                 'parent_id' => $parentId,  // Set parent_id from the variable
    //                 'value' => $value['value'] ?? 0,
    //                 'note' => $value['note'] ?? $request->note,
    //                 'status' => 0,
    //             ]);
                
    //             // For the first item, set its ID as parent_id for subsequent items
    //             if ($key === 0) {
    //                 $parentId = $row->id;
    //             }
    //         }
        
    //     } else {
    //         $custsal = Cut_sale::find($request->cust_id);
    //         $row = Refund_sale::create([
    //             'emp_id' => Auth::guard('admin')->user()->id,
    //             'cust_id' => $request->cust_id,
    //             'prod_id' => $request->prod_id,
    //             'bill_sale_header_id' => $request->bill_sale_header_id ?? null,
    //             'approv_quantity_ref' => $request->approv_quantity_ref ?? null,
    //             'approv_sellpriceproduct_ref' => $request->approv_sellpriceproduct_ref_hidden ?? null,
    //             'status_requ_ref' => $request->status_requ_ref ?? 1,// 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = done 
    //             'refund_causes_id' => $request->refund_causes_id,
    //             'parent_id' => $request->parent_id ?? null,
    //             'value' => $request->value ?? 0,
    //             'note' => $request->note,
    //             'status' => 0 ,
    //         ]);
            
    //         $trans_cust = Trans_cust::create([
    //             'emp_id' => Auth::guard('admin')->user()->id,
    //             'cust_id' => $row->cust_id,
    //             'model_name' => 'Refund_sale',
    //             'id_model' => $row->id,
    //             'total_value' => $row->value,
    //             'status_trans' => 1, // 0 = increased creadite - 1 = decreased creadite 
    //             'note' => $request->note,
    //             'value_befor' => $row->balance_befor,
    //             'status' => 0 ,
    //         ]);
    //         $custsal->update([
    //             'value' => $custsal->value - $row->value,

    //         ]);
    //         $row->update([
    //             'parent_id' => $row->id ,
    //         ]);
    //         }

    //     return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    // }

    public function edit($id)
    {
        $data = Refund_sale::find($id);
        return view('admin.refund_sale.edit', compact('data'));
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
        
        $refund_sale = Refund_sale::find($request->id);
        $data = Refund_sale::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'cust_id' => $request->cust_id,
            'value' => $request->value,
            'note' => $request->note,
            'balance_befor' => $request->balance_befor,
            'status' => $request->status ,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $refund_sale->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $refund_sale->syncRoles([]);
        // $refund_sale->assignRole($role->name);

        return redirect('admin/refund_sales')->with('message', 'Modified successfully')->with('status', 'success');
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
