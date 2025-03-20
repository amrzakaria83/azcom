<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomEmployeeRequest;
use App\Models\ClassroomTeacher;
use App\Models\Employee;
use App\Models\User;
use DataTables;
use Validator;

class ClassroomEmployeesController extends Controller
{
    protected $viewPath = 'teacher.classroomemployee';
    private $route = 'teacher.classroomemployees';

    public function __construct(ClassroomTeacher $model)
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
                ->addColumn('teacher', function($row){
                    $teacher = '<div class="d-flex flex-column"><a href="'.route('teacher.employees.show', $row->teacher->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->teacher->name.'</a></div>';
                    return $teacher;
                })
                ->addColumn('job_title', function($row){
                    $job_title = '<div class="d-flex flex-column"><a href="'.route('teacher.employees.show', $row->teacher->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->teacher->job_title.'</a></div>';
                    return $job_title;
                })
                ->addColumn('phone', function($row){
                    $phone = '<div class="d-flex flex-column"><a href="'.route('teacher.employees.show', $row->teacher->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->teacher->phone.'</a></div>';
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
                ->rawColumns(['teacher','job_title','checkbox','phone'])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }


    public function store(ClassroomEmployeeRequest $request)
    {

        $data = $request->validated();
        $result = $this->objectModel::create($data);
        
        
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
