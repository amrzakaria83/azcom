<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Event_content;
use App\Models\Event_type;
use App\Models\Product;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class EventsController extends Controller
{

    public function index(Request $request)
    {
        $data = Event::get();

        if ($request->ajax()) {
            $data = Event::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a>';
                    $name_en .= '<span>'.$row->email.'</span></div>';
                    $content = Event_content::where('status', 0)->where('event_id' ,$row->id)->count();
                    if(!empty($content)){
                        $name_en .= '<div class="ms-2">
                                <a href="'.route('admin.event_contents.create', $row->id).'" class="btn btn-sm  btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    '.trans('lang.addnew').' '.trans('lang.information').' '.$content.'
                                </a></div>';
                    }else{
                        $name_en .= '<div class="ms-2">
                        <a href="'.route('admin.event_contents.create', $row->id).'" class="btn btn-sm  btn-success btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            '.trans('lang.addnew').' '.trans('lang.information').'
                        </a></div>';
                    }
                    
                    return $name_en;
                })
                ->addColumn('type_id', function($row){

                    $type_id = '<span>'.$row->geteventtype->name_en.'</span>';
                    $content = Event_content::where('status', 0)->where('event_id' ,$row->id)->count();
                    if(!empty($content)){
                        $type_id .= '<div class="d-flex flex-column">
                        <a href="'.route('admin.events.showcontent', $row->id).'" class="btn btn-sm btn-warning btn-active-dark me-2" 
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    '.trans('lang.view') .trans('lang.information').' '.$content.'
                                </a></div>';
                    } else{
                        $type_id .= '';
                    }

                    // $type_id .='<div class="d-flex flex-column">
                    //     <a href="'.route('admin.events.showcontent', $row->id).'" class="btn btn-sm btn-warning btn-active-dark me-2" 
                    //     data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    //                 '.trans('lang.view') .trans('lang.information').' 
                    //             </a></div>';
                    
                    return $type_id;
                })
                ->addColumn('from_time', function($row){
                    // $from_time = $row->from_time ;
                    $from_time = date('Y-m-d H:i', strtotime($row->from_time));
                    return $from_time;
                })
                ->addColumn('to_time', function($row){
                    // $to_time = $row->to_time ;
                    $to_time = date('Y-m-d H:i', strtotime($row->to_time));

                    return $to_time;
                })
                ->addColumn('prod_id', function($row) {
                    $prod_ids = json_decode($row->prod_id, true); // Decode JSON into an array
                
                    if (!empty($prod_ids)) {
                        // Eager load products to optimize database queries
                        $products = Product::whereIn('id', $prod_ids)->get();
                
                        // Format product names
                        $prod_names = [];
                        foreach ($prod_ids as $prodId) {
                            $product = $products->find($prodId);
                            if ($product) {
                                $prod_names[] = '<span class="text-info fs-3">' . $product->name_en . '</span>';
                            }
                        }
                
                        return implode(', ', $prod_names);
                    }
                
                    return '';
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
                    $actions = '<div class="ms-2">
                                
                                <a href="'.route('admin.events.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.events.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a> 

                            </div>';
                            
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name_en', 'LIKE', "%$search%")
                            ->orWhere('type_id', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','type_id','from_time','to_time','prod_id','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.event.index');
    }

    public function show($id)
    {
        $data = Event::find($id);
        return view('admin.event.show', compact('data'));
    }

    public function create()
    {
        $datatype = Event_type::where('status', 0)->get();
        return view('admin.event.create', compact('datatype'));
    }

    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = Event::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'type_id' => $request->type_id,
            'name_en' => $request->name_en,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'prod_id' => json_encode($request->prod_id),
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/events')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Event::find($id);
        $datatype = Event_type::where('status', 0)->get();
        $datacontent = Event_content::where('status', 0)
        ->where('event_id' ,$data->id)
        ->get();

        return view('admin.event.edit', compact('data','datatype','datacontent'));
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
        
        $center = Event::find($request->id);
        $data = Event::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'type_id' => $request->type_id,
            'name_en' => $request->name_en,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'prod_id' => json_encode($request->prod_id),
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/events')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Event::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function storeventtype(Request $request)
    {
        $rule = [
            'name_en' => 'required',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Event_type::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }
    public function showcontent($id)
    {
        $data = Event::find($id);
        $datacomment = Event_content::where('event_id',$id)->get();
        return view('admin.event.showcontent', compact('data','datacomment'));
    }
}
