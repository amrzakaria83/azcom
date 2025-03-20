<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Student;
use App\Models\Blog;
use App\Classes\FcmNotification;
use DataTables;
use Validator;

class BlogsController extends Controller
{
    protected $viewPath = 'teacher.blog';
    private $route = 'teacher.blogs';

    public function __construct(Blog $model)
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
                    $checkbox = '';
                            $checkbox .= '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                            </div>';
                    return $checkbox;
                })
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

                    if ($request->get('type') == 'news' || $request->get('type') == 'video' || $request->get('type') == 'gallery') {
                        $instance->where('type', $request->get('type'));
                    }

                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('type', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['checkbox','actions'])
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

    public function store(BlogRequest $request)
    {

        $data = $request->validated();
        $result = $this->objectModel::create($data);

        if($request->hasFile('photo')){
            $result->addMultipleMediaFromRequest(['photo'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('photo');
            });
        }

        if($request->hasFile('video') && $request->file('video')->isValid()){
            $result->addMediaFromRequest('video')->toMediaCollection('video');
        }
        
        $this->fcmNotification($data['name'],htmlspecialchars(trim(strip_tags($data['description']))), 0);

        return redirect(route($this->route . '.index'))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::find($id);
        return view($this->viewPath .'.edit', compact('data'));
    }

    public function update(BlogRequest $request)
    {

        $data = $request->validated();

        $result = $this->objectModel::whereId($request->id)->first();
        $result->update($data);

        if($request->hasFile('photo')){
            $result->addMultipleMediaFromRequest(['photo'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('photo');
            });
        }

        if($request->hasFile('video') && $request->file('video')->isValid()){
            $result->addMediaFromRequest('video')->toMediaCollection('video');
        }

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

    public function fcmNotification($title, $body, $type_id)
    {   
        $token = [];
        foreach (Student::all() as $key => $student) {
            if ($student->token != null) {
                $token[] = $student->token;
            }
        }
        $send_noti = new FcmNotification($token, $title, $body, "blog", $type_id,$student->id);
        $send_noti->sendNotification();

    }
}
