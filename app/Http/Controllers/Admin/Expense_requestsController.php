<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Expense_request;
use App\Models\Type_expense;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Helper;

class Expense_requestsController extends Controller
{

    public function index(Request $request)
    {
        $data = Expense_request::get();

        if ($request->ajax()) {
            $data = Expense_request::query();
            $data = $data->orderBy('id', 'DESC');

            
            $helper = new Helper;
            $ids = $helper->emp_ids();
            if (auth()->user()->role_id != 1) {
                $data = $data->whereIn('emp_id', $ids);
            }

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getemp->name_en.'</a></div>';
                    if(!empty($row->emp_id_dirctor)){

                        $name .= '<span>'.$row->getempdirector->name_en.'</span><br>';
                        }
                    $name .= '<span>'.$row->created_at.'</span></div>';
                    return $name;
                })
                ->addColumn('phone', function($row){

                    $phone = $row->value;
                    
                    return $phone;
                })
                ->addColumn('type', function($row){

                    $type = $row->gettype->name_en ;
                    $statusresponse = $row->statusresponse;// "0 = waitting - 1 = approved - 2 = rejected - 3 = delayed
                    if($statusresponse === 0){
                        $type .= '<br><span class="text-info">'.trans('lang.director').':'.trans('lang.waiting').trans('lang.approved').'</span>';
                    } elseif($statusresponse === 1){
                        $type .= '<br><span class="text-success">'.trans('lang.director').':'.trans('lang.approved').'</span>';
                    } elseif($statusresponse === 2){
                        $type .= '<br><span class="text-danger">'.trans('lang.director').':'.trans('lang.reject').'</span>';
                    }
                    else{ 
                        $type .= '<br><span class="text-warning">'.trans('lang.director').':'.trans('lang.delay').'</span>';
                    }
                    return $type;
                })
                ->addColumn('is_active', function($row){

                    $is_active = $row->note .'<br>';
                    $is_active .= $row->notepayment;
                    
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.expense_requests.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.expense_requests.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('from_time') || $request->get('to_date'))) {
                        $instance->whereDate('created_at', '>=', $request->get('from_time'));
                        $instance->whereDate('created_at', '<=', $request->get('to_date'));
                    }
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    if ($request->get('type')) {
                        $instance->where('type', $request->get('type'));
                    }
                     // Search logic
                     if (!empty($request->get('search'))) {
                        $search = $request->get('search'); // Define $search variable
                        $instance->where(function ($query) use ($search) {
                            $query->whereHas('getemp', function ($q) use ($search) {
                                $q->where('name_en', 'LIKE', "%$search%");
                            });
                        });
                    }
                    // if (!empty($request->get('search'))) {
                    //         $instance->where(function($w) use($request){
                    //         $search = $request->get('search');
                    //         $w->orWhere('name', 'LIKE', "%$search%")
                    //         ->orWhere('phone', 'LIKE', "%$search%")
                    //         ->orWhere('email', 'LIKE', "%$search%");
                    //     });
                    // }
                })
                ->rawColumns(['name','phone','type','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.expense_request.index');
    }

    public function show($id)
    {
        $data = Expense_request::find($id);
        return view('admin.expense_request.show', compact('data'));
    }

    public function create()
    {
        $data = Type_expense::where('status' , 0)->get();
        return view('admin.expense_request.create', compact('data'));
    }

    public function store(Request $request)
    {
        $rule = [
            'value' => 'required',
            'type_id' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Expense_request::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'type_id' => $request->type_id,
            'value' => $request->value,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            'statusresponse' => 0, // "0 = waitting - 1 = approved - 2 = rejected - 3 = delayed 
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/expense_requests')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Expense_request::find($id);
        $datatype = Type_expense::where('status' , 0)->get();

        return view('admin.expense_request.edit', compact('data','datatype'));
    }

    public function update(Request $request)
    {
        $rule = [

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $expense_request = Expense_request::find($request->id);
        $data = Expense_request::where('id', $request->id)->update([
            'emp_id_dirctor' => Auth::guard('admin')->user()->id,
            'type_id' => $expense_request->type_id,
            'value' => $expense_request->value,
            'note' => $expense_request->note,
            'status' => $request->status ?? 0,
            'notepayment' => $request->notepayment,
            'statusresponse' => $request->statusresponse, // "0 = waitting - 1 = approved - 2 = rejected - 3 = delayed 
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $expense_request->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $expense_request->syncRoles([]);
        // $expense_request->assignRole($role->name);

        return redirect('admin/expense_requests')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Expense_request::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function storetype(Request $request)
    {
        $rule = [
            'name_en' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Type_expense::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }
}
