<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cycle_msg_prod;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Cycle_msg_prodsController extends Controller
{

    public function index(Request $request)
    {
        $data = Cycle_msg_prod::get();

        if ($request->ajax()) {
            $data = Cycle_msg_prod::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getprod->name_en.'</a></div>';
                    // $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.date('y-m-d', strtotime($row->valued_to)).'</a></div>';
                    return $name;
                })
                ->addColumn('valued_to', function($row){

                    $valued_to = date('y-m-d', strtotime($row->valued_to));
                    
                    return $valued_to;
                })
                ->addColumn('title', function($row){

                    $title = '<span class="text-success fs-1">'.$row->title.'</span>';
                    
                    return $title;
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
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-product-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
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
                                <a href="'.route('admin.cycle_msg_prods.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.cycle_msg_prods.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                ->rawColumns(['name','valued_to','title','description','note','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.cycle_msg_prod.index');
    }

    public function show($id)
    {
        $data = Cycle_msg_prod::find($id);
        return view('admin.cycle_msg_prod.show', compact('data'));
    }

    public function create()
    {
        $prod = Product::where('status', 0)->get();
        return view('admin.cycle_msg_prod.create', compact('prod') );
    }

    public function store(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));

        $rule = [
            'prod_id' => 'required',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Cycle_msg_prod::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'prod_id' => $request->prod_id,
            'title' => $request->title,
            'description' => $description,
            'valued_to' => $request->valued_to,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('prodcut');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/cycle_msg_prods')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Cycle_msg_prod::find($id);
        $datacenter = Center::where('status', 0)->get();

        return view('admin.cycle_msg_prod.edit', compact('data','datacenter'));
    }

    public function update(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));

        $rule = [
            'prod_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Cycle_msg_prod::find($request->id);
        $data = Cycle_msg_prod::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'prod_id' => $request->prod_id,
            'title' => $request->title,
            'description' => $description,
            'valued_to' => $request->valued_to,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('prodcut');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/cycle_msg_prods')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Cycle_msg_prod::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

}
