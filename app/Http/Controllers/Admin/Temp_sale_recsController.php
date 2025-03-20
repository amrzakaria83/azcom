<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Temp_sale_rec;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Temp_sale_recsController extends Controller
{

    public function index(Request $request)
    {
        $data = Temp_sale_rec::get();

        if ($request->ajax()) {
            $data = Temp_sale_rec::query();
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
                    return $name;
                })
                ->addColumn('description', function($row){
 
                    $description = '<span>'.$row->description.'</span>';
                    
                    
                    return $description;
                })
                ->addColumn('note', function($row){

                    $note = $row->note;
                    
                    return $note;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-Temp_sale_rec-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
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
                                <a href="'.route('admin.social_styls.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.social_styls.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            ->orWhere('description', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','description','note','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.social_styl.index');
    }

    public function show($id)
    {
        $data = Temp_sale_rec::find($id);
        return view('admin.social_styl.show', compact('data'));
    }

    public function create()
    {
        return view('admin.social_styl.create' );
    }
    
    public function store(Request $request)
    {
        $rule = [
            'cut_sale_id' => 'required|numeric', // Uncomment and add other rules as needed
        ];
    
        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        try {
            $existingRecord = Temp_sale_rec::where('cut_sale_id', $request->cut_sale_id)->where('status_order_req', 0)->first();
    
        if ($existingRecord) {
            $row = Temp_sale_rec::create([
                'emp_id' => Auth::guard('admin')->user()->id,
                'cut_sale_id' => $request->cut_sale_id,
                'sale_type_id' => $request->sale_type_id,
                'product_id' => $request->product_id,
                'valued_time' => $request->valued_time ?? Carbon::now(),
                'percent' => $request->percent,
                'quantityproduc' => $request->quantityproduc,
                'sellpriceproduct' => $request->sellpriceproduct,
                'sellpriceph' => $request->sellpriceproduct * ((100 - $request->percent)/ 100),
                'totalsellprice' => ($request->sellpriceproduct * ((100 - $request->percent)/ 100)) * $request->quantityproduc, 

                'note' => $request->note,
                'method_for_payment' => $request->method_for_payment,
                'note1' => $request->note1,
                'note2' => $request->note2,
                'note3' => $request->note3,
                'status_order' => $request->status_order ?? 0,
                'status_order_req' => 0,
                'parent_order' => $existingRecord->parent_order,
                'status' => 0,
            ]);
        } else {
            $row = Temp_sale_rec::create([
                'emp_id' => Auth::guard('admin')->user()->id,
                'cut_sale_id' => $request->cut_sale_id,
                'sale_type_id' => $request->sale_type_id,
                'product_id' => $request->product_id,
                'valued_time' => $request->valued_time ?? Carbon::now(),
                'percent' => $request->percent,
                'quantityproduc' => $request->quantityproduc,
                'sellpriceproduct' => $request->sellpriceproduct,
                'sellpriceph' => $request->sellpriceproduct * ((100 - $request->percent)/ 100),
                'totalsellprice' => ($request->sellpriceproduct * ((100 - $request->percent)/ 100)) * $request->quantityproduc, 
                'note' => $request->note,
                'method_for_payment' => $request->method_for_payment,
                'note1' => $request->note1,
                'note2' => $request->note2,
                'note3' => $request->note3,
                'status_order' => $request->status_order ?? 0,
                'status_order_req' => 0,
                'parent_order' => null,
                'status' => 0,
            ]);
    
            $row->update(['parent_order' => $row->id]);
        }
        $dataparent = Temp_sale_rec::find($row->id);
        $tempsaleparent = Temp_sale_rec::where('parent_order', $dataparent->parent_order)
        ->where('status_order_req', 0)->orderBy('id', 'DESC')->with('getprod', 'getcust')->get();
        $totalv = $tempsaleparent->sum('totalsellprice');

        return response()->json([
            'dataparent' => $dataparent->id,
            'totalv' => $totalv,
            'tempsaleparent' => $tempsaleparent,
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in store method: ' . $e->getMessage());
        return response()->json(['message' => 'Server Error'], 500);
    }
    }


    public function edit($id)
    {
        $data = Temp_sale_rec::find($id);

        return view('admin.social_styl.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));

        $rule = [
            'name_en' => 'required|string'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Temp_sale_rec::find($request->id);
        $data = Temp_sale_rec::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'description' => $description,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('gift');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/social_styls')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {

        try{
            Temp_sale_rec::whereIn('id',$request->id)->update([
                'status_order_req' => 2,//0 = request - 1 = approved - 2 = cancel - 3 = nextstep
            ]);
            Temp_sale_rec::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }


}
