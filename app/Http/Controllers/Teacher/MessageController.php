<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Classes\FcmNotification;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\Employee;
use DataTables;
use Validator;

class MessageController extends Controller
{
    protected $viewPath = 'teacher.message';
    private $route = 'teacher.messages';

    public function __construct(Message $model)
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

    public function getMsg($student_id, $teacher_id)
    {
        $teacher = Employee::find($teacher_id);
        $student = Student::find($student_id);

        $this->objectModel::where('sender_type', 'student')
        ->where('sender_id', $student_id)
        ->where('receiver_type', 'teacher')
        ->where('receiver_id', $teacher_id)
        ->update([
            'status' => 'read'
        ]);

        $data1 = $this->objectModel::orderBy('id', 'DESC')
        ->where('sender_type', 'student')
        ->where('sender_id', $student_id)
        ->where('receiver_type', 'teacher')
        ->where('receiver_id', $teacher_id)->get();

        $data2 = $this->objectModel::orderBy('id', 'DESC')
        ->where('sender_type', 'teacher')
        ->where('sender_id', $teacher_id)
        ->where('receiver_type', 'student')
        ->where('receiver_id', $student_id)->get();
        
        // $r = array_merge($data1->toArray(),$data2->toArray());
        $data = $data1->merge($data2);

        $msgs = $data->sortBy("id");
        return view('teacher.student.chat', compact('msgs','teacher','student'));
    }

    public function getMsgDetails($student_id, $teacher_id)
    {
        $teacher = Employee::find($teacher_id);
        $student = Student::find($student_id);

        $this->objectModel::where('sender_type', 'student')
        ->where('sender_id', $student_id)
        ->where('receiver_type', 'teacher')
        ->where('receiver_id', $teacher_id)
        ->update([
            'status' => 'read'
        ]);

        $data1 = $this->objectModel::orderBy('id', 'DESC')
        ->where('sender_type', 'student')
        ->where('sender_id', $student_id)
        ->where('receiver_type', 'teacher')
        ->where('receiver_id', $teacher_id)->get();

        $data2 = $this->objectModel::orderBy('id', 'DESC')
        ->where('sender_type', 'teacher')
        ->where('sender_id', $teacher_id)
        ->where('receiver_type', 'student')
        ->where('receiver_id', $student_id)->get();
        
        // $r = array_merge($data1->toArray(),$data2->toArray());
        $data = $data1->merge($data2);

        $msgs = $data->sortBy("id");
        return view($this->viewPath. '.show', compact('msgs','teacher','student'));
    }

    public function store(Request $request)
    {

        $result = $this->objectModel::create([
            "message" => $request->msg,
            "status" => 'unread',
            "sender_type" => "teacher",
            "sender_id" => $request->teacher_id,
            "receiver_type" => 'student',
            "receiver_id" => $request->student_id
        ]);

        $teacher = Employee::find($request->teacher_id);
        $student = Student::find($request->student_id);

        $data1 = $this->objectModel::orderBy('id', 'DESC')
        ->where('sender_type', 'student')
        ->where('sender_id', $request->student_id)
        ->where('receiver_type', 'teacher')
        ->where('receiver_id', $request->teacher_id)->get();

        $data2 = $this->objectModel::orderBy('id', 'DESC')
        ->where('sender_type', 'teacher')
        ->where('sender_id', $request->teacher_id)
        ->where('receiver_type', 'student')
        ->where('receiver_id', $request->student_id)->get();
        
        // $r = array_merge($data1->toArray(),$data2->toArray());
        $data = $data1->merge($data2);

        $msgs = $data->sortBy("id");
        
        $this->fcmNotification($request->student_id, "لديك رسالة جديده",$teacher->name, $result->id);

        return view('teacher.student.chat', compact('msgs','teacher','student'));
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

    public function fcmNotification($student_id, $title, $body, $type_id)
    {   
        $student = Student::find($student_id);
        $token = [];
        
        if ($student->token != null) {
            $token[] = $student->token;
            $send_noti = new FcmNotification($token, $title, $body, "chat", $type_id, $student->id);
            $send_noti->sendNotification();
        }

    }
}
