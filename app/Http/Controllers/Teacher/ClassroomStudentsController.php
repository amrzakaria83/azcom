<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomStudentRequest;
use App\Models\ClassroomStudent;
use App\Models\Student;
use App\Models\User;
use DataTables;
use Validator;

class ClassroomStudentsController extends Controller
{
    protected $viewPath = 'teacher.classroomstudent';
    private $route = 'teacher.classroomstudents';

    public function __construct(ClassroomStudent $model)
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
                ->addColumn('student', function($row){
                    $student = '<div class="d-flex flex-column"><a href="'.route('teacher.students.show', $row->student->id).'" class="text-gray-800 text-hover-primary mb-1">
                    '.$row->student->name.'
                    </a>';
                    return $student;
                })
                ->addColumn('phone', function($row){
                    $phone = '<div class="d-flex flex-column"><a href="'.route('teacher.students.show', $row->student->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->student->phone.'</a>';
                    return $phone;
                })
                ->addColumn('actions', function($row){
                    $actions = '';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    $instance->where(function($w) use($request){
                        $classroom_id = $request->get('classroom_id');
                        $w->where('classroom_id', $classroom_id);
                    });
                })
                ->rawColumns(['student','checkbox','phone'])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }

    public function create($classroom_id)
    {

        return view($this->viewPath .'.create', compact('classroom_id'));
    }

    public function store(ClassroomStudentRequest $request)
    {

        if ($request->student_id) {
            $data = $this->objectModel::create([
                'classroom_id' => $request->classroom_id,
                'student_id' => $request->student_id
            ]);
        } else {
            if ($request->user_id) {
            
            } else if ($request->username && $request->password) {
                $user = User::where('phone', $request->username)->first();
                if ($user) {
                    return redirect()->back()->with('message', ' بيانات الدخول موجوده من قبل')->with('status', 'error'); 
                }
    
                $row = User::create([
                    'name' => $request->name,
                    'phone' => $request->username,
                    'password' => Hash::make($request->password),
                    'is_active' => '1',
                ]);
    
                $request->user_id = $row->id;
            } else {
                return redirect()->back()->with('message', 'حساب الدخول مطلوب')->with('status', 'error');
            }
    
            $data = $request->validated();
    
            if ($request->username && $request->password) {
                $data['user_id'] = $row->id;
            }
            
            $result = Student::create($data);
    
            if($request->hasFile('photo') && $request->file('photo')->isValid()){
                $result->addMediaFromRequest('photo')->toMediaCollection('photo');
            }
    
            if($request->hasFile('photo2') && $request->file('photo2')->isValid()){
                $result->addMediaFromRequest('photo2')->toMediaCollection('photo2');
            }

            $data = $this->objectModel::create([
                'classroom_id' => $request->classroom_id,
                'student_id' => $result->id
            ]);
        }
        
        
        return redirect()->back()->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
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
