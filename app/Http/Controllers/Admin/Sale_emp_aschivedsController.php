<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Sale_emp_aschived;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale_type;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Sale_emp_aschivedsController extends Controller
{

    public function index(Request $request)
    {
        $data = Sale_emp_aschived::get();

        if ($request->ajax()) {
            $data = Sale_emp_aschived::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getemp->name_en.'</a><div>';

                    return $name_en;
                })
                ->addColumn('note', function($row){
                    $note = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getprod->name_en.'</a><div>';


                    return $note;
                })
                ->addColumn('description', function($row){

                    $description = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getsaletype->name_en.'</a><div>';
                    $description .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->percent.'%</a><div>';

                    
                    return $description;
                })
                ->addColumn('status', function($row){
                    if($row->status == 0 ) {
                        $status = '<div class="badge badge-light-success fw-bold">مقعل</div>';
                    } else {
                        $status = '<div class="badge badge-light-danger fw-bold">غير مفعل</div>';
                    }
                    
                    return $status;
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
                                <a href="'.route('admin.sale_emp_aschiveds.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.sale_emp_aschiveds.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
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
                ->rawColumns(['name_en','description','note','status','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.sale_emp_aschived.index');
    }

    public function show($id)
    {
        $data = Sale_emp_aschived::find($id);
        return view('admin.sale_emp_aschived.show', compact('data'));
    }

    public function create()
    {
        $dataemp = Employee::where('is_active' , '1')->get();
        $dataprod = Product::where('status' , 0)->get();
        $datasale_type = Sale_type::where('status' , 0)->get();
        return view('admin.sale_emp_aschived.create', compact('dataemp','dataprod','datasale_type'));
    }

    public function store(Request $request)
    {
        $rule = [
            'prod_id' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $inputs = $request->all();

        $aa = array_filter($inputs, function ($value, $key) {
            return str_starts_with($key, 't');
        }, ARRAY_FILTER_USE_BOTH);

        $az = [];
        foreach($aa as $az ){
            $values = array_values($az);
            if (!empty($az)) {

                foreach($az as $yy =>  $key){
                    $existcontact = Sale_emp_aschived::where('empsaled_id', $request->empsaled_id)->where('prod_id', $request->prod_id)->where('sale_type_id', $yy)->where('status', 0)->get();
                    if (!empty($existcontact)){
                        foreach($existcontact as $exi){
                            $exi->update([
                                'status' => 1,
                            ]);
                        }
                    }
                        $row = Sale_emp_aschived::create([
                                    'emp_id' => Auth::guard('admin')->user()->id,
                                    'empsaled_id' => $request->empsaled_id,
                                    'prod_id' => $request->prod_id,
                                    'sale_type_id' => $yy,
                                    'percent' => $key,
                                    'note' => $request->note,
                                    'status' => $request->status ?? 0,
                        ]);
                    }
                }
            }
        return redirect('admin/sale_emp_aschiveds')->with('message', 'Added successfully')->with('status', 'success');
    }
    public function storemodel(Request $request)
    {
        $rule = [
            'prod_id' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        $row = Sale_emp_aschived::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'empsaled_id' => $request->empsaled_id,
            'prod_id' => $request->prod_id,
            'sale_type_id' => $request->sale_type_id,
            'percent' => $request->percent,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);
        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }
    public function edit($id)
    {
        $data = Sale_emp_aschived::find($id);
        $dataemp = Employee::find($data->empsaled_id);
        $dataprod = Product::find($data->prod_id);
        $datasale_type = Sale_type::find($data->sale_type_id);
        return view('admin.sale_emp_aschived.edit', compact('data','dataemp','dataprod','datasale_type'));
    }

    public function update(Request $request)
    {
        $rule = [
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $data = Sale_emp_aschived::find($request->id);
        $data->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'percent' => $request->percent,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/sale_emp_aschiveds')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Sale_emp_aschived::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
}
