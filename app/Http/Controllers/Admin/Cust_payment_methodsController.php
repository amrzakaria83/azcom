<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Cust_payment_method;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;

class Cust_payment_methodsController extends Controller
{

    public function index(Request $request)
    {
        $data = Cust_payment_method::get();

        if ($request->ajax()) {
            $data = Cust_payment_method::query();
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
                        $type = '<div class="badge badge-light-info fw-bold">'.trans('cust_payment_method.administrator').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-primary fw-bold">'.trans('cust_payment_method.teacher').' </div>';
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
                                <a href="'.route('admin.cust_payment_methods.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.cust_payment_methods.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
        return view('admin.cust_payment_method.index');
    }

    public function show($id)
    {
        $data = Cust_payment_method::find($id);
        return view('admin.cust_payment_method.show', compact('data'));
    }

    public function create()
    {
        return view('admin.cust_payment_method.create');
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

        $row = Cust_payment_method::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar ?? null,
            'note' => $request->note,
            'status' => $request->status ?? 0 ,
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
        $data = Cust_payment_method::find($id);
        return view('admin.cust_payment_method.edit', compact('data'));
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
        
        $cust_payment_method = Cust_payment_method::find($request->id);
        $data = Cust_payment_method::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'favcolor' => $request->favcolor,
            'note' => $request->note,
            'status' => $request->status ,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $cust_payment_method->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $cust_payment_method->syncRoles([]);
        // $cust_payment_method->assignRole($role->name);

        return redirect('admin/cust_payment_methods')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Cust_payment_method::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
}
