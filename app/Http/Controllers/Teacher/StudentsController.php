<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\Models\Absence;
use App\Models\Student;
use App\Models\Employee;
use App\Models\User;
use DataTables;
use Validator;

class StudentsController extends Controller
{
    protected $viewPath = 'teacher.student';
    private $route = 'teacher.students';

    public function __construct(Student $model)
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
                                <a href="'.route($this->route.'.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('teacher.users.show', $row->user_id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-shield-lock-fill fs-1x"></i>
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
        $data = $this->objectModel::find($id);

        $teachers = Employee::with('classrooms')->whereHas('classrooms', function($q) use ($data) {
            $q->whereIn('classroom_id', $data->classes->pluck('classroom_id'));
            $q->where('employee_id', auth()->id());
        })->get(); 

        $class_ids = [];
        foreach ($teachers[0]->classrooms as $key => $classroom) {
            $class_ids[] = $classroom->classroom_id ;
        }
        $absences = Absence::where('student_id', $id)->whereIn('classroom_id', $class_ids)->get();
        
        $abs = [];
        foreach ($absences as $key => $absence) {
            
            $abs[] =   array(
                "id"=> $absence->id,
                "title"=> $absence->student->name,
                "start"=> $absence->date
            );

        }

        $absence = json_encode($abs);

        return view($this->viewPath .'.show', ['data' => $data, 'absence' => $absence, 'teachers' => $teachers]);
    }

    public function create()
    {
        return view($this->viewPath .'.create');
    }

    public function store(StudentRequest $request)
    {

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
        
        $result = $this->objectModel::create($data);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $result->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        if($request->hasFile('photo2') && $request->file('photo2')->isValid()){
            $result->addMediaFromRequest('photo2')->toMediaCollection('photo2');
        }
        
        return redirect(route($this->route . '.index'))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::find($id);
        return view($this->viewPath .'.edit', compact('data'));
    }

    public function update(StudentRequest $request)
    {

        $data = $request->validated();

        if ($request->user_id) {

        } else {
            return redirect()->back()->with('message', 'حساب الدخول مطلوب')->with('status', 'error');
        }
        
        $result = $this->objectModel::whereId($request->id)->first();
        $result->update($data);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $result->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        if($request->hasFile('photo2') && $request->file('photo2')->isValid()){
            $result->addMediaFromRequest('photo2')->toMediaCollection('photo2');
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
}
