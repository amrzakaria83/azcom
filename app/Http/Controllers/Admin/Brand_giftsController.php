<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Brand_gift;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Brand_giftsController extends Controller
{

    public function index(Request $request)
    {
        $data = Brand_gift::get();

        if ($request->ajax()) {
            $data = Brand_gift::query();
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
                    $class_gift = $row->class_gift;
                    if($class_gift === 0){

                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.trans('lang.general_gifts').'</a></div>';
                    } elseif($class_gift === 1){
                        
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-info text-hover-primary mb-1">'.trans('lang.specital_gifts').'</a></div>';
                    } else {
                        
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-primary mb-1">'.trans('lang.valuable_gifts').'</a></div>';
                    }
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
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-brand_gift-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
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
                                <a href="'.route('admin.brand_gifts.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.brand_gifts.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
        return view('admin.brand_gift.index');
    }

    public function show($id)
    {
        $data = Brand_gift::find($id);
        return view('admin.brand_gift.show', compact('data'));
    }

    public function create()
    {
        return view('admin.brand_gift.create' );
    }

    public function store(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));

        $rule = [
            'name_en' => 'required|string',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Brand_gift::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'description' => $description,
            'note' => $request->note,
            'class_gift' => $request->class_gift, // 0 = general - 1 =  specital - 2 = Valuable gift 
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('file');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/brand_gifts')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Brand_gift::find($id);

        return view('admin.brand_gift.edit', compact('data'));
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
        
        $center = Brand_gift::find($request->id);
        $data = Brand_gift::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'description' => $description,
            'note' => $request->note,
            'class_gift' => $request->class_gift,// 0 = general - 1 =  specital - 2 = Valuable gift 
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('file');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/brand_gifts')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Brand_gift::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

}
