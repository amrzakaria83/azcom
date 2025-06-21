<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Event_att;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Event_attsController extends Controller
{

    public function index(Request $request)
    {
        $data = Event_att::get();

        if ($request->ajax()) {
            $data = Event_att::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
                    return $name;
                })
                ->addColumn('phone', function($row){

                    $phone = $row->phone;
                    
                    return $phone;
                })
                ->addColumn('type', function($row){
                    if($row->type == 'dash') {
                        $type = '<div class="badge badge-light-info fw-bold">'.trans('event_att.administrator').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-primary fw-bold">'.trans('event_att.teacher').' </div>';
                    }
                    
                    return $type;
                })
                ->addColumn('is_active', function($row){
                    if($row->is_active == 1) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('event_att.active').'</div>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('event_att.notactive').'</div>';
                    }
                    
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.event_atts.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.event_atts.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    if ($request->get('type')) {
                        $instance->where('type', $request->get('type'));
                    }
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','phone','type','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.event_att.index');
    }

    public function show($id)
    {
        $data = Event_att::find($id);
        return view('admin.event_att.show', compact('data'));
    }

    public function create()
    {
        return view('admin.event_att.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'event_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Event_att::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'empatt_id' => Auth::guard('admin')->user()->id,
            'event_id' => $request->event_id,
            'note' => $request->note,
            'status' => 0 ,
            'lat_checkin' => $request->lat_checkin ?? null,
            'lng_checkin' => $request->lng_checkin ?? null,
            'lat_checkout' => $request->lat_checkout ?? null,
            'lng_checkout' => $request->lng_checkout ?? null,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/event_atts')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Event_att::find($id);
        return view('admin.event_att.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $event_att = Event_att::find($request->id);
        $data = Event_att::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'empatt_id' => Auth::guard('admin')->user()->id,
            'event_id' => $request->event_id,
            'note' => $request->note,
            'status' => 0 ,
            'lat_checkin' => $request->lat_checkin ?? null,
            'lng_checkin' => $request->lng_checkin ?? null,
            'lat_checkout' => $request->lat_checkout ?? null,
            'lng_checkout' => $request->lng_checkout ?? null,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $event_att->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $event_att->syncRoles([]);
        // $event_att->assignRole($role->name);

        return redirect('admin/event_atts')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Event_att::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function store_in(Request $request)
    {
        $rule = [
            'event_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Event_att::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'empatt_id' => Auth::guard('admin')->user()->id,
            'event_id' => $request->event_id,
            'from_time' => Carbon::now(),
            'note' => $request->note,
            'status' => 0 ,
            'lat_checkin' => $request->lat_checkin ?? null,
            'lng_checkin' => $request->lng_checkin ?? null,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/event_atts')->with('message', 'Added successfully')->with('status', 'success');
    }
    public function store_out(Request $request)
    {
        $rule = [
            'event_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $event_att = Event_att::where('event_id',$request->id);// still need update
        $event_att->update([
            'end_time' => Carbon::now(),
            'note' => $request->note,
            'lat_checkout' => $request->lat_checkout ?? null,
            'lng_checkout' => $request->lng_checkout ?? null,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/event_atts')->with('message', 'Added successfully')->with('status', 'success');
    }
}
