<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Contact;
use App\Models\Center;
use App\Models\Type_visit;
use App\Models\Type_contact;


use App\Models\Plan_visit;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Helper;

class Plan_visitsController extends Controller
{

    public function index(Request $request)
    {
        $data = Plan_visit::get();
        

        if ($request->ajax()) {
            $data = Plan_visit::query();
            
            $data = $data->orderBy('id', 'DESC');

            $helper = new Helper;
            $ids = $helper->emp_ids();
            if (auth()->user()->role_id != 1) {
                $data = $data->whereIn('emphplan_id', $ids);
            }

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getemp->name_en.'</a></div>';

                    return $name_en;
                })
                ->addColumn('contact_id', function($row){
                    if ($row->contact_id != null){
                        $color = Type_contact::find($row->getcontact->typecont_id)->favcolor;
                        $contact_id = '<span style="color: '. $color.'!important;">'.$row->getcontact->name_en.'</span><br>';
                        $contact_id .= '<span style="color: '. $color.'!important;">'.trans('lang.contact').'</span><br>';
                        $contact_id .= '<span >'.$row->gettype->name_en.'</span><br>';
                    } elseif($row->center_id != null){
                        $contact_id = '<span >'.$row->getcenter->name_en.'</span><br>';
                        $contact_id .= '<span >'.trans('lang.center').'</span><br>';
                        $contact_id .= '<span >'.$row->gettype->name_en.'</span><br>';

                    }
                    return $contact_id;
                })
                ->addColumn('from_time', function($row){

                    $from_time = date('Y-m-d h:i', strtotime($row->from_time));
                    
                    return $from_time;
                })
                ->addColumn('status_visit', function($row){
                    $visit = $row->status_visit;
                    if ($visit === 0){
                        $status_visit = '<div class="badge badge-light-success fw-bold">'.trans('lang.single').'</div>';
                        if($row->emphplan_id != Auth::guard('admin')->user()->id) {
                            $status_visit .= '<br><a href="'.route('admin.plan_visits.makeduoble', $row->id).'" class="" data-kt-menu-trigger="click" data-kt-menu-placement="">
                            '.trans('lang.change_to_double'). ' 
                            </a>';
                        }
                    } elseif($visit === 1){
                        $status_visit = '<div class="badge badge-light-info fw-bold">'.trans('lang.double').'</div>';
                        $empass = json_decode($row->visit_emp_ass);
                        if ($empass != null){
                            foreach($empass as $emp){
                                $na = Employee::find($emp);
                                $status_visit .= '<br><div class="badge badge-light-info fw-bold">'.$na->name_en.'</div>';
                            }
                        }

                    } elseif($visit === 2){
                        $status_visit = '<div class="badge badge-light-danger fw-bold">'.trans('lang.triple').'</div>';
                        $empass = json_decode($row->visit_emp_ass);
                        if ($empass != null){
                            foreach($empass as $emp){
                                $na = Employee::find($emp);
                                $status_visit .= '<br><div class="badge badge-light-danger fw-bold">'.$na->name_en.'</div>';
                            }
                        }
                    }

                    return $status_visit;
                })
                ->addColumn('note', function($row){

                    $note = $row->note;
                    
                    return $note;
                })
                ->addColumn('type', function($row){
                    if($row->type == 'dash') {
                        $type = '<div class="badge badge-light-info fw-bold">'.trans('plan_visit.administrator').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-primary fw-bold">'.trans('plan_visit.teacher').' </div>';
                    }
                    
                    return $type;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                
                    $edit = $row->from_time;
                    if ($row->from_time > Carbon::now()){
                        $actions = '<div class="ms-2">
                                <a href="'.route('admin.plan_visits.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.plan_visits.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';

                    }else{
                        $actions ='';
                    }

                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('from_time') || $request->get('to_date'))) {
                        $instance->whereDate('from_time', '>=', $request->get('from_time'));
                        $instance->whereDate('from_time', '<=', $request->get('to_date'));
                    }
                    if ($request->get('status_visit') != Null)
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('status_visit', $request->get('status_visit'));
                    });
                    }
                    if (!empty($request->get('emphplan_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('emphplan_id', $request->get('emphplan_id'));
                    });
                    }
                    if (!empty($request->get('contact_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('contact_id', $request->get('contact_id'));
                    });
                    }
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    if ($request->get('type')) {
                        $instance->where('type', $request->get('type'));
                    }
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name_en', 'LIKE', "%$search%")
                            ->orWhere('note', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','contact_id','from_time','status_visit','note','type','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.plan_visit.index');
    }

    public function show($id)
    {
        $data = Plan_visit::find($id);
        return view('admin.plan_visit.show', compact('data'));
    }

    public function create()
    {
        $dataemp = Employee::where('is_active' , '1')->get();
        $datacont = Contact::where('status' , 0)->get();
        $datacenter = Center::where('status' , 0)->get();
        $datatypv = Type_visit::where('status' , 0)->get();

        return view('admin.plan_visit.create', compact('dataemp','datacont','datacenter','datatypv'));
    }

    public function store(Request $request)
    {
        $rule = [
            'typevist_id' => 'required|numeric',
            'center_id' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Plan_visit::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'emphplan_id' => Auth::guard('admin')->user()->id,
            'center_id' => $request->center_id,
            'contact_id' => $request->contact_id,
            'typevist_id' => $request->typevist_id,
            'from_time' => $request->from_time,
            'status_visit' => $request->status_visit,//0 = single visit - 1 = double visit - 2 = triple visit
            'visit_emp_ass' => $request->status_visit != 0 ? json_encode($request->visit_emp_ass) : null,//json_encode($request->visit_emp_ass)
            'note' => $request->note,
            'status_return' => $request->status_return ?? 4,// 0 = done - 1 = canceld - 3 = delayed - 4 = planned
            'status' => 0 ,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $dataemp = Employee::where('is_active' , '1')->get();
        $datacont = Contact::where('status' , 0)->get();
        $datacenter = Center::where('status' , 0)->get();
        $datatypv = Type_visit::where('status' , 0)->get();
        $data = Plan_visit::find($id);
        return view('admin.plan_visit.edit', compact('data','dataemp','datacont','datacenter','datatypv'));
    }

    public function update(Request $request)
    {
        $rule = [
            'typevist_id' => 'required|numeric',
             'center_id' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $plan_visit = Plan_visit::find($request->id);
        $data = Plan_visit::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'center_id' => $request->center_id,
            'contact_id' => $request->contact_id,
            'typevist_id' => $request->typevist_id,
            'from_time' => $request->from_time,
            'status_visit' => $request->status_visit,//0 = single visit - 1 = double visit - 2 = triple visit
            'visit_emp_ass' => $request->status_visit != 0 ? json_encode($request->visit_emp_ass) : null,//json_encode($request->visit_emp_ass)
            'note' => $request->note,
            'status_return' => $request->status_return ?? 4,// 0 = done - 1 = canceld - 3 = delayed - 4 = planned
            'status' => $request->status ,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $plan_visit->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $plan_visit->syncRoles([]);
        // $plan_visit->assignRole($role->name);

        return redirect('admin/plan_visits')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Plan_visit::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function makeduoble($idvisit)
    {
        $plan_visit = Plan_visit::find($idvisit);
        $row = Plan_visit::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'emphplan_id' => Auth::guard('admin')->user()->id,
            'center_id' => $plan_visit->center_id,
            'contact_id' => $plan_visit->contact_id,
            'typevist_id' => $plan_visit->typevist_id,
            'from_time' => $plan_visit->from_time,
            'status_visit' => 1 ,//0 = single visit - 1 = double visit - 2 = triple visit
            'visit_emp_ass' => json_encode([$plan_visit->emphplan_id]) ?? null,
            'note' => $plan_visit->note,
            'status_return' => $plan_visit->status_return ?? 4,// 0 = done - 1 = canceld - 3 = delayed - 4 = planned
            'status' => 0 ,
        ]);
        $plan_visit->update([
            'status_visit' => 1,//0 = single visit - 1 = double visit - 2 = triple visit
            'visit_emp_ass' => json_encode([$row->emphplan_id]) ?? null,//json_encode($row->visit_emp_ass)
            
        ]);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }
}
