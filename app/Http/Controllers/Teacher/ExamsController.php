<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;
use App\Models\Question;
use App\Models\Exam;
use App\Models\ExmQuestion;
use App\Models\Result;
use App\Models\ResultAnswer;
use App\Models\Employee;
use App\Models\ClassroomStudent;
use App\Classes\FcmNotification;
Use Carbon\Carbon;
use DataTables;
use Validator;

class ExamsController extends Controller
{
    protected $viewPath = 'teacher.exam';
    private $route = 'teacher.exams';

    public function __construct(Exam $model)
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
                                <a href="'.route($this->route.'.results', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-list fs-1x"></i>
                                </a>
                                <a href="'.route($this->route.'.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                ->rawColumns(['checkbox','actions'])
                ->make(true);
        }
        return view($this->viewPath .'.index');
    }

    public function show($id)
    {
        $data = $this->objectModel::with('questions')->find($id);
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

    public function store(ExamRequest $request)
    {

        $data = $request->validated();

        $result = $this->objectModel::create($data);

        $this->fcmNotification($data['classroom_id'], "تم اضافة اختبار جديد", $data['name'], 0);
        
        return redirect(route($this->route . '.edit', $result->id))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::with('questions')->find($id);

        $teachers = Employee::with('classrooms')->whereHas('classrooms', function($q) {
            $q->where('employee_id', auth()->id());
        })->get(); 

        $class_ids = [];
        foreach ($teachers[0]->classrooms as $key => $classroom) {
            $class_ids[] = $classroom->classroom_id ;
        }

        return view($this->viewPath .'.edit', compact('data','class_ids'));
    }

    public function update(ExamRequest $request)
    {

        $data = $request->validated();

        $result = $this->objectModel::whereId($request->id)->first();

        $result->update($data);

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

    public function examquestion(Request $request)
    {
        $data = ExmQuestion::get();

        if ($request->ajax()) {
            $data = ExmQuestion::query();
            $data = $data->with('question');
            $data = $data->where('exam_id', $request->get('exam_id'));
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '';
                    
                    $checkbox .= '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                            </div>';
                            
                    return $checkbox;
                })
                ->addColumn('question', function($row){
                    $checkbox = '<div class="ms-5">'.$row->question->name.'</div>';
                            
                    return $checkbox;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <button type="button" onclick="delete_question('.$row->id.')" class="delete_question btn btn-sm btn-icon btn-danger btn-active-dark me-2">
                                    <i class="bi bi-trash fs-1x"></i>
                                </button>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    // if ($request->get('exam_id')) {
                    //     $instance->where('exam_id', $request->get('exam_id'));
                    // }
                })
                ->rawColumns(['question','checkbox','actions'])
                ->make(true);
        }
        return view($this->viewPath .'.index');
    }

    public function deleteque($id)
    {   

        try{
            ExmQuestion::whereId($id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

    public function allquestion(Request $request)
    {
        $data = Question::get();

        if ($request->ajax()) {
            $data = Question::query();
            $data = $data->orderBy('id', 'DESC');
            $data = $data->where('employee_id', auth()->id());
            $data = $data->orWhere('employee_id', null);

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
                    if ($request->get('filtter_subject_id')) {
                        $instance->where('subject_id', $request->get('filtter_subject_id'));
                    }
                    if ($request->get('filtter_section_id')) {
                        $instance->where('section_id', $request->get('filtter_section_id'));
                    }
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->where('name', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['checkbox','actions'])
                ->make(true);
        }
        return view($this->viewPath .'.index');
    }

    public function addque(Request $request)
    {   

        try{
            foreach ($request->id as $itm) {
                ExmQuestion::create([
                    "exam_id" => $request->exam_id,
                    "question_id" => $itm,
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json(['message' => $request->id]);
        }
        return response()->json(['message' => 'success']);

    }

    public function studentexam(Request $request)
    {

        $teachers = Employee::with('classrooms')->whereHas('classrooms', function($q) {
            $q->where('employee_id', auth()->id());
        })->get(); 

        $class_ids = [];
        foreach ($teachers[0]->classrooms as $key => $classroom) {
            $class_ids[] = $classroom->classroom_id ;
        }
        
        $exam_ids = [];

        $exam_ids = $this->objectModel::whereIn('classroom_id', $class_ids)->pluck('id');
 
        if ($request->ajax()) { 
            $data = Result::query();
            $data = $data->whereIn('exam_id', $exam_ids);
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column p-3">'.$row->exam->name.'</div>';
                    return $name;
                })
                ->addColumn('subject', function($row){
                    $subject = '<div class="d-flex flex-column p-3">'.$row->exam->subject->name.'</div>';
                    return $subject;
                })
                ->addColumn('degree', function($row){
                    $degree = '<div class="d-flex flex-column">'.$row->result .'/'. $row->total .'</div>';
                    return $degree;
                })
                ->addColumn('date', function($row){
                    $date = '<div class="d-flex flex-column">'.$row->date.'</div>';
                    return $date;
                })
                ->addColumn('time', function($row){
                    $time = '<div class="d-flex flex-column">'. Carbon::parse($row->start_time)->format("h:i a") .'<br>
                    '. Carbon::parse($row->start_time)->format("h:i a").'</div>';
                    return $time;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route($this->route.'.studentexamshow', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    $instance->where('student_id', $request->get('student_id'));
                })
                ->rawColumns(['name','subject','degree','date','time','actions'])
                ->make(true);
        }

        
    }

    public function studentexamshow($id)
    {
        $data = Result::find($id);
        return view('teacher.student.exam-show', compact('data'));
    }

    public function Results($id)
    {
        $data = $this->objectModel::with('results')->find($id);
        return view($this->viewPath .'.results', compact('data'));
    }

    public function deleteresult($id)
    {   

        try{
            Result::whereId($id)->delete();
            ResultAnswer::where('result_id', $id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return redirect()->back()->with('status', 'success');

    }

    public function fcmNotification($classroom_id, $title, $body, $type_id)
    {   
        $token = [];
        foreach (ClassroomStudent::where('classroom_id', $classroom_id)->get() as $key => $student) {
            if ($student->student->token != null) {
                $token[] = $student->student->token;
            }
        }
        $send_noti = new FcmNotification($token, $title, $body, "exam", $type_id, $student->student->id);
        $send_noti->sendNotification();

    }
}
