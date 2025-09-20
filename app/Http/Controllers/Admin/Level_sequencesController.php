<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Models\Level_sequence;

use DataTables;
use Validator;
use Auth;

class Level_sequencesController extends Controller
{
    protected $viewPath = 'admin.level_sequence';
    private $route = 'admin.level_sequences';

    public function __construct(Level_sequence $model)
    {
        $this->objectModel = $model;
    }

    public function index(Request $request)
    {
        $data = $this->objectModel::get();

        if ($request->ajax()) {
            $data = $this->objectModel::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_ar', function($row){
                    $name_ar = '<div class="d-flex flex-column"><a href="javascript:;" class="text-info text-hover-primary mb-1">'
                    .$row->name_ar ?? ''. '</a></div>';
                    return $name_ar;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-info text-hover-primary mb-1">'
                    .$row->name_en ?? ''. '</a></div>';
                    return $name_en;
                })
                
                ->addColumn('description', function($row){
                    $description = '<div class="d-flex flex-column"><a href="javascript:;" class="text-info text-hover-primary mb-1">'
                    .$row->description ?? ''. '</a></div>';
                    return $description;
                })
                
                ->addColumn('type', function($row){
                    if($row->type == 0) {
                        $type = '<div class="badge badge-light-success fw-bold">'.trans('lang.main').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-danger fw-bold">'.trans('lang.sub').'</div>';
                        
                    }
                    
                    return $type;
                })
                ->addColumn('status', function($row){
                    if($row->status == 0) {
                        $status = '<div class="badge badge-light-success fw-bold">مقعل</div>';
                    } else {
                        $status = '<div class="badge badge-light-danger fw-bold">غير مفعل</div>';
                    }
                    
                    return $status;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route($this->route.'.show', $row->id).'"  class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route($this->route.'.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->where('name', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['checkbox','name_ar','name_en',
                'description','type','note','status_view',
                'status','actions'
                ])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }

    public function show($id)
    {
        $data = $this->objectModel::find($id);
        return view($this->viewPath .'.show', compact('data'));
    }

    public function create()
    {

        return view($this->viewPath .'.create');
    }

    public function store(Request $request)
    {

        $rule = [
            'name_en' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        
        $row = $this->objectModel::create([
            
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'type' => $request->type, // 0 = sub have parent_id - 1 =  major
            'parent_id' => $request->parent_id ?? null,
            'note' => $request->note,
            'description' => $request->description , 
            'status' => $request->status ?? 0,
            
        ]);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }
        return redirect('admin/')->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::find($id);
        return view($this->viewPath .'.edit', compact('data'));
    }

    public function update(RoleRequest $request)
     {
        $rule = [
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $data = $this->objectModel::find($request->id);
        $data->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'type' => $request->type, // 0 = sub have parent_id - 1 =  major
            'parent_id' => $request->parent_id ?? null,
            'note' => $request->note,
            'description' => $request->description , 
            'status' => $request->status ?? 0,
        ]);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }
        return redirect('admin/')->with('message', 'تم التعديل بنجاح')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            $this->objectModel::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
}
