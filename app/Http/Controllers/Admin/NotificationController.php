<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Classes\FcmNotification;
use App\Models\Notification;
use DataTables;
use Validator;

class NotificationController extends Controller
{
    protected $viewPath = 'admin.notification';
    private $route = 'admin.notifications';

    public function __construct(Notification $model)
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
                ->addColumn('employee', function($row){
                    $employee = $row->employee->name_en;
                    return $employee;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('from_date') && $request->get('to_date')) {
                        $instance->whereBetween('created_at', [$request->get('from_date'), $request->get('to_date')]);
                    }

                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('title', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['checkbox','employee'])
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

    public function store(Request $request)
    {

        if (!$request->title) {
            return redirect()->back()->with('message', 'العنوان مطلوب')->with('status', 'error');
        }

        if (!$request->body) {
            return redirect()->back()->with('message', 'المحتوى مطلوب')->with('status', 'error');
        }
        
        $token = [];
        foreach (Employee::where('id', $request->employee_id)->get() as $key => $emp) {
            if ($emp->token != null) {
                $token[] = $emp->fc_token;
            }
        }
        $send_noti = new FcmNotification($token, $request->title, htmlspecialchars(trim(strip_tags($request->body))), "other", 0, $request->employee_id);
        $send_noti->sendNotification(); 
        return redirect(route($this->route . '.index'))->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
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
