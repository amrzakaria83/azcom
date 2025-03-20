<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ScratchVideoRequest;
use App\Models\ScratchVideo;
use Illuminate\Support\Str;
use DataTables;
use Validator;

class ScratchVideoController extends Controller
{
    protected $viewPath = 'teacher.scratchvideo';
    private $route = 'teacher.scratchvideos';

    public function __construct(ScratchVideo $model)
    {
        $this->objectModel = $model;
    }

    public function index(Request $request)
    {
        $data = $this->objectModel::get();

        if ($request->ajax()) {
            $data = $this->objectModel::query();
            $data = $data->where('employee_id', auth()->id());
            // $data = $data->orWhere('employee_id', null);
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '';
                            $checkbox .= '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                            </div>';
                    return $checkbox;
                })
                ->addColumn('link', function($row){
                    $link = '<a href="'.$row->link.'" target="_blank" class="btn btn-sm btn-dark btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    مشاهدة الفيديو
                </a>';
                    return $link;
                })
                ->addColumn('is_active', function($row){
                    if($row->is_active == 1) {
                        $is_active = '<div class="badge badge-light-success fw-bold">مقعل</div>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">غير مفعل</div>';
                    }
                    
                    return $is_active;
                })
                ->addColumn('status', $this->viewPath .'.active_btn')
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route($this->route.'.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('from_date') && $request->get('to_date')) {
                        $instance->whereBetween('created_at', [$request->get('from_date'), $request->get('to_date')]);
                    }

                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('code', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['checkbox','link','is_active', 'status','actions'])
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

    public function store(ScratchVideoRequest $request)
    {

        $data = $request->validated();

        $result = $this->objectModel::create([
            'code' => Str::random(12),
            'employee_id' => auth()->id(),
            'permission' => $request->permission,
            'used' => 0,
            'is_active' => $request->is_active,
        ]);

        if($request->hasFile('video') && $request->file('video')->isValid()){
            $result->addMediaFromRequest('video')->toMediaCollection('photo');
        }
        $result->link = $result->getFirstMediaUrl('photo');
        $result->save();

        for ($i=1; $i < $request->qty; $i++) { 
            $data = $this->objectModel::create([
                'code' => Str::random(12),
                'employee_id' => auth()->id(),
                'permission' => $request->permission,
                'used' => 0,
                'link' => $result->getFirstMediaUrl('photo'),
                'is_active' => $request->is_active,
            ]);
        }

        return redirect(route($this->route . '.index'))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::find($id);
        return view($this->viewPath .'.edit', compact('data'));
    }

    public function update(ScratchVideoRequest $request)
    {

        $data = $request->validated();

        $result = $this->objectModel::whereId($request->id)->first();
        $result->update([
            'permission' => $request->permission,
            'is_active' => $request->is_active,
        ]);

        return redirect(route($this->route . '.index'))->with('message', 'تم التعديل بنجاح')->with('status', 'success');
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

    public function changeActive(Request $request)
    {
        if ($request->status == 'active') {
            $data['is_used'] = '1';
        } else {
            $data['is_used'] = '0';
        }
        
        $this->objectModel::where('id', $request->id)->update($data);
        return 1;
    }
}
