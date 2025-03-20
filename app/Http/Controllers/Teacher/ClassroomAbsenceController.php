<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\AbsenceRequest;
use App\Models\Absence;
use App\Models\User;
use \Carbon\Carbon;
use DataTables;
use Validator;

class ClassroomAbsenceController extends Controller
{
    protected $viewPath = 'teacher.absence';
    private $route = 'teacher.absences';

    public function __construct(Absence $model)
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
                })
                ->rawColumns(['subject','checkbox'])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }


    public function store(AbsenceRequest $request)
    {

        $data = $request->validated();

        foreach ($data['student_id'] as $key => $student) {

            $result = $this->objectModel::create([
                'classroom_id' => $data['classroom_id'],
                'student_id' => $student,
                'date' => Carbon::parse($data['date'])->format('Y-m-d') ,
                'note' => $data['note'] ?? NULL
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
