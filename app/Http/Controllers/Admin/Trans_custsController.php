<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Trans_cust;
use App\Models\Refund_sale;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;

class Trans_custsController extends Controller
{

    public function index(Request $request)
    {
        $data = Trans_cust::get(); 

        if ($request->ajax()) {
            $data = Trans_cust::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a></div>';
                    return $name_en;
                })
                ->addColumn('model_name', function($row){

                    $model_name = '';
                    $transname = $row->model_name;
                    if($transname === 'Cust_collection' ){
                        $model_name .='<span class="text-info">'.trans('lang.cust_collection').'</span><br>';
                        // $model_name .='<span class="text-success text-center">('.$row->id_model.')</span>';
                    } elseif ($transname === 'Refund_sale'){
                        $model_name .='<a href="'.route('admin.trans_custs.showrefund_sale', $row->id_model).'"><span class="text-info">'.trans('lang.returns').'</span><br>';
                        $model_name .='<span class="text-success text-center">('.$row->id_model.')</span></a>';
                    }
                    
                    
                    return $model_name;
                })

                ->addColumn('total_value', function($row){
                    
                    $tvalue = $row->total_value;
                    if($tvalue > 0){
                        $total_value ='<span class="text-info">'.$tvalue.'</span><br>';
                    } else {
                        $total_value ='<span class="text-danger">'.trans('lang.not_defined').'</span><br>';
                    }
                    
                    return $total_value;
                })
                
                ->addColumn('created_at', function($row){

                    $created_at = $row->created_at;
                    
                    return $created_at;
                })
                
                ->addColumn('note', function($row){

                    $note = $row->note;
                    
                    return $note;
                })

                ->addColumn('type', function($row){
                    if($row->type == 'dash') {
                        $type = '<div class="badge badge-light-info fw-bold">'.trans('trans_cust.administrator').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-primary fw-bold">'.trans('trans_cust.teacher').' </div>';
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
                                <a href="'.route('admin.trans_custs.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.trans_custs.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    // Search logic
                    if (!empty($request->get('search'))) {
                        $search = $request->get('search'); // Define $search variable
                        $instance->where(function ($query) use ($search) {
                            $query->whereHas('getcust', function ($q) use ($search) {
                                $q->where('name_en', 'LIKE', "%$search%");
                            });
                        });
                    }
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    if ($request->get('type')) {
                        $instance->where('type', $request->get('type'));
                    }
                    // if (!empty($request->get('search'))) {
                    //         $instance->where(function($w) use($request){
                    //         $search = $request->get('search');
                    //         $w->orWhere('name_en', 'LIKE', "%$search%")
                    //         ->orWhere('note', 'LIKE', "%$search%")
                    //         ->orWhere('email', 'LIKE', "%$search%");
                    //     });
                    // }
                })
                ->rawColumns(['name_en','note','created_at','total_value','model_name','type','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.trans_cust.index');
    }

    public function show($id)
    {
        $data = Trans_cust::find($id);
        return view('admin.trans_cust.show', compact('data'));
    }

    public function create()
    {
        return view('admin.trans_cust.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Trans_cust::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => 0 ,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/trans_custs')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Trans_cust::find($id);
        return view('admin.trans_cust.edit', compact('data'));
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
        
        $trans_cust = Trans_cust::find($request->id);
        $data = Trans_cust::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $trans_cust->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $trans_cust->syncRoles([]);
        // $trans_cust->assignRole($role->name);

        return redirect('admin/trans_custs')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Trans_cust::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function showrefund_sale($id)
    {
        // $data = Trans_cust::find($id);
        $datareffirst = Refund_sale::find($id);
        $dataref = Refund_sale::where('parent_id',$id)->get();

        return view('admin.refund_sale.show', compact('datareffirst','dataref'));
    }
}
