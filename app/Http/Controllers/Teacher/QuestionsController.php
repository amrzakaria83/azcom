<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Answer;
use DataTables;
use Validator;

class QuestionsController extends Controller
{
    protected $viewPath = 'teacher.question';
    private $route = 'teacher.questions';

    public function __construct(Question $model)
    {
        $this->objectModel = $model;
    }

    public function index(Request $request)
    {
        $data = $this->objectModel::get();

        if ($request->ajax()) {
            $data = $this->objectModel::query();
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
        return view($this->viewPath .'.show', compact('data'));
    }

    public function create()
    {
        return view($this->viewPath .'.create');
    }

    public function store(QuestionRequest $request)
    {

        $data = $request->validated();
        $data['employee_id'] = auth()->id();

        $result = $this->objectModel::create($data);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $result->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        foreach ($request->kt_docs_repeater_basic as $key => $property) {

            if (isset($property['answer_correct'])) {
                $is_correct = 'correct';
            } else {
                $is_correct = 'incorrect';
            }

            if ($property['answer_name']) {
                $answerData = Answer::create([
                    'question_id' => $result->id,
                    'name' => $property['answer_name'],
                    'is_correct' => $is_correct
                ]);
            }

            if (isset($property['answer_photo'])) {
                $answerData->addMedia($property['answer_photo'])->toMediaCollection('photo');
            }

        }
        
        return redirect(route($this->route . '.index'))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = $this->objectModel::with('answers')->find($id);
        return view($this->viewPath .'.edit', compact('data'));
    }

    public function update(QuestionRequest $request)
    {

        $data = $request->validated();

        $result = $this->objectModel::whereId($request->id)->with('answers')->first();

        $result->update($data);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $result->addMediaFromRequest('photo')->toMediaCollection('photo');
        }
        
        Answer::where('question_id',$request->id)->delete();

        foreach ($request->kt_docs_repeater_basic as $key => $property) {

            if (isset($property['answer_correct'])) {
                $is_correct = 'correct';
            } else {
                $is_correct = 'incorrect';
            }

             

            if ($property['answer_name']) {
                $answerData = Answer::create([
                    'question_id' => $request->id,
                    'name' => $property['answer_name'],
                    'is_correct' => $is_correct
                ]);
            }

            if (isset($property['answer_photo'])) {
                $answerData->addMedia($property['answer_photo'])->toMediaCollection('photo');
            }

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
