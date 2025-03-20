<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Absence;
use App\Models\ClassroomTeacher;
use DataTables;
use Validator;

class ClassroomsController extends Controller
{
    protected $viewPath = 'teacher.classroom';
    private $route = 'teacher.classrooms';

    public function __construct(Classroom $model)
    {
        $this->objectModel = $model;
    }

    public function index(Request $request)
    {
        $data = $this->objectModel::get();

        if ($request->ajax()) {
            $data = $this->objectModel::query();
            $data = $data->whereHas('teachers', function($query) {
                $query->where('employee_id', auth()->id());
            });
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('level', function($row){
                    $level = '<div class="ms-2">
                                '.$row->level->name.'
                            </div>';
                    return $level;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
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
                ->rawColumns(['level','checkbox','actions'])
                ->make(true);
        }

        return view($this->viewPath .'.index');
    }

    public function show($id)
    {
        $data = $this->objectModel::find($id);

        $absences = Absence::where('classroom_id', $id)->get();

        $abs = [];
        foreach ($absences as $key => $absence) {
            
            $abs[] =   array(
                "id"=> $absence->id,
                "title"=> $absence->student->name,
                "start"=> $absence->date
            );

        }

        $absence = json_encode($abs);
        return view($this->viewPath .'.show', ['data' => $data, 'absence' => $absence]);
    }

    public function create()
    {
        return view($this->viewPath .'.create');
    }

    public function store(ClassroomRequest $request)
    {

        $data = $request->validated();
        $result = $this->objectModel::create($data); 

        if ($result) {
            ClassroomTeacher::create([
                'classroom_id' => $result->id,
                'employee_id' => auth()->id(),
            ]);
        }
        
        return redirect(route($this->route . '.index'))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::find($id);
        return view($this->viewPath .'.edit', compact('data'));
    }

    public function update(ClassroomRequest $request)
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
}
