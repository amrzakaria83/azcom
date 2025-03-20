<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Relative_contact;
use App\Models\Contact;
use App\Models\Social_styl;
use App\Models\Contract_dr;
use App\Models\Specialty;
use App\Models\Brand_gift;
use App\Models\Contact_rate;
use App\Models\Rating;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Relative_contactsController extends Controller
{

    public function index(Request $request)
    {
        $data = Relative_contact::get();

        if ($request->ajax()) {
            $data = Relative_contact::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-info-800 text-hover-danger mb-1">'.$row->getcontact->name_en.'</a></div>';
                    if($row->relative_status == 0 ){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.not_knowen').'</a></div>';
                    }elseif($row->relative_status == 1){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.wife').'</a></div>';
                    }elseif($row->relative_status == 2){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.husband').'</a></div>';
                    }elseif($row->relative_status == 3){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.daughter').'</a></div>';
                    }elseif($row->relative_status == 4){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.son').'</a></div>';
                    }elseif($row->relative_status == 5){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.father').'</a></div>';
                    }elseif($row->relative_status == 6){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.mather').'</a></div>';
                    }elseif($row->relative_status == 7){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.grandson').'</a></div>';
                    }elseif($row->relative_status == 8){
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.grandfather').'</a></div>';
                    }else {
                        $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-danger mb-1">'.trans('lang.not_knowen').'</a></div>';
                    }
                    $name .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
                    if($row->birth_date){
                        $currentTime = Carbon::now();
                        $timestamp = Carbon::parse($row->birth_date);
                        $timeDifference = $currentTime->diff($timestamp);
                        $years = $timeDifference->y;
                        $months = $timeDifference->m;
                        $days = $timeDifference->d;
                        $timeString = '';
                        if ($years > 0) {
                            $timeString .= $years .trans('lang.year').'-';
                        }
                        if ($months > 0) {
                            $timeString .= $months .trans('lang.month').'-';
                        }
                        $timeString .= $days . trans('lang.day');
                        $name .= '<br><span>'.trans('employee.age').':'.$timeString.'</span>';
                    }
                    if($row->status == 0) {
                        $name .= '<br><div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-contact-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
                        //     '.trans('lang.work_hours').'
                        //     </button></div> ';
                    } 
                     else {
                        $name .= '<br><div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    $name .= '<div class="ms-2">
                                <a href="'.route('admin.relativ_contacts.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.relativ_contacts.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    
                    return $name;
                })
                ->addColumn('info', function($row){

                    $info = '';
                    if($row->birth_date != null ){
                        $info .= '<br><div class="badge badge-light-info fw-bold">'.trans('employee.birth_date').':'.$row->birth_date.'</div>';
                    }
                    $info .= '<br><div class="badge badge-light-success fw-bold">'.$row->phone.'</div>';
                    if($row->phone2 != null ){
                        $info .= '<br><div class="badge badge-light-success fw-bold">'.$row->phone2.'</div>';
                    }
                    if($row->email != null ){
                        $info .= '<br><div class="badge badge-light-info fw-bold">'.$row->email.'</div>';
                    }
                    if($row->website != null ){
                        $info .= '<br><div class="badge badge-light-info fw-bold">'.$row->website.'</div>';
                    }
                    
                    return $info;
                })
                ->addColumn('description', function($row){

                    $description = '';
                    $description .= '<span>'.$row->description.'</span><br>';
                    $description .= '<span>'.$row->note.'</span><br>';

                    return $description;
                })
                
                ->addColumn('is_active', function($row){
                    $is_active = '';
                    if($row->gender == 0 ){
                        $is_active .= '<br><div class="badge badge-light-info fw-bold"><i class="bi bi-gender-male"></i>Male</div>';
                    }elseif($row->gender == 1){
                        $is_active .= '<br><div class="badge badge-light-info fw-bold"><i class="bi bi-gender-female"></i>Female</div>';
                    }else {
                        $is_active .= '<br><div class="badge badge-light-info fw-bold">Other</div>';
                    }
                    if($row->marital_status == 0 ){
                        $is_active .= '<br><div class="badge badge-light-info fw-bold">'.trans('lang.single').'</div>';
                    }elseif($row->marital_status == 1){
                        $is_active .= '<br><div class="badge badge-light-info fw-bold">'.trans('lang.married').'</div>';
                    }elseif($row->marital_status == 2){
                        $is_active .= '<br><div class="badge badge-light-info fw-bold">'.trans('lang.divorced').'</div>';
                    }else{
                        $is_active .= '<br><div class="badge badge-light-info fw-bold">'.trans('lang.single').'</div>';
                    }
                    return $is_active;
                })
                // ->addColumn('actions', function($row){
                //     $actions = '<div class="ms-2">
                //                 <a href="'.route('admin.relativ_contacts.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                //                     <i class="bi bi-eye-fill fs-1x"></i>
                //                 </a>
                //                 <a href="'.route('admin.relativ_contacts.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                //                     <i class="bi bi-pencil-square fs-1x"></i>
                //                 </a>
                //             </div>';
                //     return $actions;
                // })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('description', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','info','description','is_active','checkbox'])
                ->make(true);
        }
        return view('admin.relativ_contact.index');
    }

    public function show($id)
    {
        $data = Relative_contact::find($id);
        return view('admin.relativ_contact.show', compact('data'));
    }

    public function create()
    {
        $datacont = Contact::where('status' , 0)->get();
        
        return view('admin.relativ_contact.create', compact('datacont') );
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

        $row = Relative_contact::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'contact_id' => $request->contact_id,
            'relative_status' => $request->relative_status, // 0 = not_knowen - 1 = wife - 2 = husband - 3 = daughter  - 4 = son - 5 = father - 6 = mather - 7 = grandson - 8 = grandfather
            'name_en' => $request->name_en,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,// 0 = male - 1 = female - 2 = other 
            'marital_status' => $request->marital_status,// 0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'socialmedia' => $request->socialmedia, // other facebook
            'note' => $request->note,
            'description' => $description,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('contact');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/relativ_contacts')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Relative_contact::find($id);
        $datacont = Contact::where('status' , 0)->get();

        return view('admin.relativ_contact.edit', compact('data','datacont'));
    }

    public function update(Request $request)
    {

        $rule = [
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Relative_contact::find($request->id);
        $data = Relative_contact::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'contact_id' => $request->contact_id,
            'relative_status' => $request->relative_status, // 0 = not_knowen - 1 = wife - 2 = husband - 3 = daughter  - 4 = son - 5 = father - 6 = mather - 7 = grandson - 8 = grandfather
            'name_en' => $request->name_en,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,// 0 = male - 1 = female - 2 = other 
            'marital_status' => $request->marital_status,// 0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'socialmedia' => $request->socialmedia, // other facebook
            'note' => $request->note,
            'description' => $description,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('contact');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/relativ_contacts')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Relative_contact::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    
}
