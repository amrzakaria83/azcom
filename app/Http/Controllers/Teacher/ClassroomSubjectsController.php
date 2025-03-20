<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomSubjectRequest;
use App\Models\ClassroomSubject;
use App\Models\Subject;
use App\Models\User;
use DataTables;
use Validator;

class ClassroomSubjectsController extends Controller
{
    protected $viewPath = 'teacher.classroomsubject';
    private $route = 'teacher.classroomsubjects';

    public function __construct(ClassroomSubject $model)
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
                ->addColumn('subject', function($row){
                    $subject = '<div class="d-flex flex-column">'.$row->subject->name.'</div>';
                    return $subject;
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
                ->rawColumns(['subject','checkbox'])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }


    public function store(ClassroomSubjectRequest $request)
    {

        $data = $request->validated();
        $result = $this->objectModel::create($data);
        
        
        return redirect()->back()->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function getSubjectByClass ($id) {
        $data = $this->objectModel::where('classroom_id', $id)->with('subject')->get();
        return response()->json($data);
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
