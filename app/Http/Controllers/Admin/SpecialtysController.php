<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Specialty;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;

class SpecialtysController extends Controller
{

    public function index(Request $request)
    {
        $data = Specialty::get();

        if ($request->ajax()) {
            $data = Specialty::query();
            // $data = $data->orderBy('id', 'DESC');
            $data = $data->orderBy('status', 'ASC');

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
                ->addColumn('type', function($row){
                    if($row->type_specialty == 0) {

                        $type = '<div class="badge badge-light-danger fw-bold">'.trans('lang.main').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-info fw-bold">'.trans('lang.sub').'</div>';
                        $asd = Specialty::find($row->parent_id);
                        $type .= '<div class="badge badge-light-info fw-bold">'.$asd->name_en.'</div>';

                    }
                    return $type;
                })
                ->addColumn('note', function($row){

                    $note = $row->note.'<br>';
                    
                    return $note;
                })
                ->addColumn('is_active', function($row){

                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                    } 
                     else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.specialtys.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('type', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','type','note','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.specialty.index');
    }

    public function show($id)
    {
        $data = Specialty::find($id);
        return view('admin.specialty.show', compact('data'));
    }

    public function create()
    {
        $data = Specialty::where('status' , 0)->get();
        return view('admin.specialty.create', compact('data'));
    }

    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required',
            'type_specialty' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Specialty::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'parent_id' => $request->type_specialty == 0 ? null : $request->parent_id,
            'type_specialty' => $request->type_specialty,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/specialtys')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Specialty::find($id);

        return view('admin.specialty.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $rule = [

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Specialty::find($request->id);
        $data = Specialty::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $center->syncRoles([]);
        // $center->assignRole($role->name);

        return redirect('admin/specialtys')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Specialty::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    
}
