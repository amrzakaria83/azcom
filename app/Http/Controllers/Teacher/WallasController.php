<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\ClassroomStudent;
use App\Classes\FcmNotification;
use App\Http\Requests\WallaRequest;
use App\Models\Walla;
use App\Models\Employee;
use DataTables;
use Validator;

class WallasController extends Controller
{
    protected $viewPath = 'teacher.walla';
    private $route = 'teacher.wallas';

    public function __construct(Walla $model)
    {
        $this->objectModel = $model;
    }

    public function index(Request $request)
    {
        $data = $this->objectModel::get();
        $teachers = Employee::with('classrooms')->whereHas('classrooms', function($q) {
            $q->where('employee_id', auth()->id());
        })->get(); 

        $class_ids = [];
        foreach ($teachers[0]->classrooms as $key => $classroom) {
            $class_ids[] = $classroom->classroom_id ;
        }

        if ($request->ajax()) {
            $data = $this->objectModel::query();
            $data = $data->whereIn('classroom_id', $class_ids);
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

        $teachers = Employee::with('classrooms')->whereHas('classrooms', function($q) {
            $q->where('employee_id', auth()->id());
        })->get(); 

        $class_ids = [];
        foreach ($teachers[0]->classrooms as $key => $classroom) {
            $class_ids[] = $classroom->classroom_id ;
        }

        return view($this->viewPath .'.create', compact('class_ids'));
    }

    public function store(WallaRequest $request)
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
        
        $this->fcmNotification($data['classroom_id'], $data['name'],htmlspecialchars(trim(strip_tags($data['description']))), 0);

        return redirect(route($this->route . '.index'))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::find($id);

        $teachers = Employee::with('classrooms')->whereHas('classrooms', function($q) {
            $q->where('employee_id', auth()->id());
        })->get(); 

        $class_ids = [];
        foreach ($teachers[0]->classrooms as $key => $classroom) {
            $class_ids[] = $classroom->classroom_id ;
        }

        return view($this->viewPath .'.edit', compact('data','class_ids'));
    }

    public function update(WallaRequest $request)
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

    public function fcmNotification($classroom_id, $title, $body, $type_id)
    {   

        $token = [];
        foreach (ClassroomStudent::where('classroom_id', $classroom_id)->get() as $key => $student) {
            if ($student->student->token != null) {
                $token[] = $student->student->token;
            }
        }
        $send_noti = new FcmNotification($token, $title, $body, "walls", $type_id, $student->student->id);
        $send_noti->sendNotification();

    }
}
