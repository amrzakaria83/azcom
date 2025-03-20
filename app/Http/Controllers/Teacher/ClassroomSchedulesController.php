<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
Use Carbon\Carbon;
use DataTables;
use Validator;

class ClassroomSchedulesController extends Controller
{
    protected $viewPath = 'teacher.classroomschedule';
    private $route = 'teacher.classroomschedules';

    public function __construct(Schedule $model)
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
                ->addColumn('from', function($row){
                    $from = Carbon::parse($row->from)->format("h:i a") ;
                    return $from;
                })
                ->addColumn('to', function($row){
                    $to = Carbon::parse($row->to)->format("h:i a");
                    return $to;
                })
                ->addColumn('activity', function($row){
                    $activity = '<div class="d-flex flex-column">'.$row->name.'</div>';
                    return $activity;
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
                ->rawColumns(['activity','checkbox'])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }


    public function store(ScheduleRequest $request)
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
