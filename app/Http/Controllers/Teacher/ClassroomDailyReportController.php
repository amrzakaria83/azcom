<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\ClassroomStudent;
use App\Classes\FcmNotification;
use App\Http\Requests\DailyReportRequest;
use App\Models\DailyReport;
use App\Models\User;
use DataTables;
use Validator;

class ClassroomDailyReportController extends Controller
{
    protected $viewPath = 'teacher.dailyreport';
    private $route = 'teacher.dailyreports';

    public function __construct(DailyReport $model)
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
                    if ($row->subject_id) {
                        $subject = '<div class="d-flex flex-column">'.$row->subject->name.'</div>';
                    } else {
                        $subject = '----';
                    }
                    return $subject;
                })
                ->addColumn('link', function($row){
                    if ($row->getMedia('photo')->count()) {
                        $link = '<div class="d-flex flex-column"><a href="'.$row->getFirstMediaUrl('photo').'" target="blank">'.trans('classroom.attachment').'</a></div>';
                    } else {
                        $link = '----';
                    }
                    return $link;
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
                ->rawColumns(['link','subject','checkbox'])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }


    public function store(DailyReportRequest $request)
    {

        $data = $request->validated();
        $result = $this->objectModel::create($data);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $result->addMediaFromRequest('photo')->toMediaCollection('photo');
        }
        
        $this->fcmNotification($data['classroom_id'], "تم اضافه جديده في الارشيف",$data['name'], 0);
        
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

    public function fcmNotification($classroom_id, $title, $body, $type_id)
    {   

        $token = [];
        foreach (ClassroomStudent::where('classroom_id', $classroom_id)->get() as $key => $student) {
            if ($student->student->token != null) {
                $token[] = $student->student->token;
            }
        }
        $send_noti = new FcmNotification($token, $title, $body, "daily", $type_id, $student->student->id);
        $send_noti->sendNotification();

    }
}
