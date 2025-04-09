<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Type_contact;
use App\Models\Social_styl;
use App\Models\Contract_dr;
use App\Models\Specialty;
use App\Models\Brand_gift;
use App\Models\Place_w;
use App\Models\Contact_rate;
use App\Models\Rating;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ContactsController extends Controller
{

    public function index(Request $request)
    {
        $data = Contact::get();

        if ($request->ajax()) {
            $data = Contact::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $color = optional(Type_contact::find($row->typecont_id))->favcolor;
                    $name = '<div class="d-flex flex-column" ><a href='.route('admin.contacts.show', $row->id).'" class="text-gray-800 text-hover-primary mb-0" style="color: '. $color.'!important;">'.$row->name_en.'</a></div>';
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
                        $name .= '<span>'.trans('employee.age').':'.$timeString.'</span>';
                    }
                    if($row->status == 0) {
                        $name .= '<br><div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                       
                    } else {
                        $name .= '<br><div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    
                    return $name;
                })
                ->addColumn('phone', function($row){

                    $phone = '<span>'.$row->phone.'</span><br>';
                    if($row->phone2 != null ){
                    $phone .= '<span>'.$row->phone2.'</span><br>';
                    }
                    if($row->landline != null ){
                    $phone .= '<span>'.$row->landline.'</span>';
                    }
                    return $phone;
                })
                ->addColumn('info', function($row){
                    $speciality = json_decode($row->speciality_id);

                    $info = '';

                    if (!empty($speciality)) {
                        $azsp = Specialty::whereIn('id', $speciality)->get();
                        $info .= implode('<span>-', $azsp->pluck('name_en')->toArray());
                    } 
                    
                    
                    
                    return $info;
                })
                ->addColumn('description', function($row){

                    $description = '';
                    $description .= '<span>'.$row->description.'</span><br>';
                    $description .= '<span>'.$row->note.'</span><br>';
                    $preferd_gift_brand = json_decode($row->preferd_gift_brand);

                    if (!empty($preferd_gift_brand)) {
                        $azsp = Brand_gift::whereIn('id', $preferd_gift_brand)->get();
                        $description .= implode('<span>-', $azsp->pluck('name_en')->toArray());
                    }
                    
                    return $description;
                })
                ->addColumn('note', function($row){

                    $note = '';
                    if($row->university_degree != null ){
                        $note .= '<br><div class="badge badge-light-success fw-bold">'.trans('lang.university_degree').':'.$row->university_degree.'</div>';
                    }if($row->scientific_degree != null ){
                        $note .= '<br><div class="badge badge-light-success fw-bold">'.trans('lang.scientific_degree').':'.$row->scientific_degree.'</div>';
                    }if($row->preferd_readding != null ){
                        $note .= '<br><div class="badge badge-light-success fw-bold">'.trans('lang.preferd_readding').':'.$row->preferd_readding.'</div>';
                    }if($row->preferd_gift != null ){
                        $note .= '<br><div class="badge badge-light-success fw-bold">'.trans('lang.preferd_gift').':'.$row->preferd_gift.'</div>';
                    }if($row->preferd_service != null ){
                        $note .= '<br><div class="badge badge-light-success fw-bold">'.trans('lang.preferd_service').':'.$row->preferd_service.'</div>';
                    }
                    
                    return $note;
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
                    if($row->email != null ){
                        $is_active .= '<br><div class="badge badge-light-info fw-bold">'.$row->email.'</div>';
                    }
                    if($row->website != null ){
                        $is_active .= '<br><div class="badge badge-light-info fw-bold">'.$row->website.'</div>';
                    }
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.contacts.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.contacts.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    // if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                    //     $instance->where('is_active', $request->get('is_active'));
                    // }
                    if (!empty($request->get('marital_status')) ) {
                        $instance->where('marital_status', $request->get('marital_status'));
                    }
                    if ($request->get('contact_id') != Null)
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('id', $request->get('contact_id'));
                    });
                    }
                    if ($request->get('phone') != Null)
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('id', $request->get('phone'));
                    });
                    }
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name_en', 'LIKE', "%$search%")
                            ->orWhere('marital_status', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','phone','info','description','note','is_active','actions','checkbox'])
                ->make(true);
        }
        return view('admin.contact.index');
    }

    public function show($id)
    {
        $dataplace = Place_w::where('status' , 0)->where('contact_id', $id)->get();
        $dataconrate = Contact_rate::where('status' , 0)->where('contact_id', $id)->get();
        $datasoc = Social_styl::where('status' , 0)->get();
        $datacont = Contract_dr::where('status' , 0)->get();
        $dataspe = Specialty::where('status' , 0)->get();
        $databragif = Brand_gift::where('status' , 0)->get();
        $datatype = Type_contact::where('status' , 0)->get();
        $data = Contact::find($id);

        return view('admin.contact.show', compact('data','dataspe','datasoc','datacont','databragif','datatype','dataconrate','dataplace'));
    }

    public function create()
    {
        $datasoc = Social_styl::where('status' , 0)->get();
        $datacont = Contract_dr::where('status' , 0)->get();
        $dataspe = Specialty::where('status' , 0)->get();
        $databragif = Brand_gift::where('status' , 0)->get();
        $datatype = Type_contact::where('status' , 0)->get();

        return view('admin.contact.create', compact('dataspe','datasoc','datacont','databragif','datatype') );
    }

    public function store(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));
        $rule = [
            'name_en' => 'required|string',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $row = Contact::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'social_id' => $request->social_id,
            'contractdr_id' => $request->contractdr_id,
            'typecont_id' => $request->typecont_id,
            'name_en' => $request->name_en,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'landline' => $request->landline,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,// 0 = male - 1 = female - 2 = other 
            'marital_status' => $request->marital_status,// 0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'socialmedia' => $request->socialmedia, // other facebook
            'note' => $request->note,
            'speciality_id' => json_encode($request->speciality_id), // json_encode($request->speciality_id)
            'preferd_gift_brand' => json_encode($request->preferd_gift_brand), // json_encode($request->preferd_gift_brand)
            'university_degree' => $request->university_degree,
            'scientific_degree' => $request->scientific_degree,
            'preferd_readding' => $request->preferd_readding,
            'preferd_gift' => $request->preferd_gift,
            'preferd_service' => $request->preferd_service,
            'description' => $description, 
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('contact');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/contacts')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $datasoc = Social_styl::where('status' , 0)->get();
        $datacont = Contract_dr::where('status' , 0)->get();
        $dataspe = Specialty::where('status' , 0)->get();
        $databragif = Brand_gift::where('status' , 0)->get();
        $datatype = Type_contact::where('status' , 0)->get();
        $data = Contact::find($id);

        return view('admin.contact.edit', compact('data','dataspe','datasoc','datacont','databragif','datatype'));
    }

    public function update(Request $request)
    {
        $description = Str::replace(['<p>', '</p>'], '', $request->input('description'));

        $rule = [
            'name_en' => 'required|string'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = Contact::find($request->id);
        $data = Contact::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'social_id' => $request->social_id,
            'contractdr_id' => $request->contractdr_id,
            'typecont_id' => $request->typecont_id,
            'name_en' => $request->name_en,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'landline' => $request->landline,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,// 0 = male - 1 = female - 2 = other 
            'marital_status' => $request->marital_status,// 0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1
            'email' => $request->email,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'socialmedia' => $request->socialmedia, // other facebook
            'note' => $request->note,
            'speciality_id' => json_encode($request->speciality_id), // json
            'preferd_gift_brand' => json_encode($request->preferd_gift_brand), // json
            'university_degree' => $request->university_degree,
            'scientific_degree' => $request->scientific_degree,
            'preferd_readding' => $request->preferd_readding,
            'preferd_gift' => $request->preferd_gift,
            'preferd_service' => $request->preferd_service,
            'description' => $description,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $center->addMediaFromRequest('photo')->toMediaCollection('contact');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/contacts')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Contact::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function add_contact_rate()
    {
        $datacont = Contact::where('status' , 0)->get();
        $datarate = Rating::where('status' , 0)->get();
        
        return view('admin.contact.add_contact_rate', compact('datacont','datarate') );
    }
    public function storecontact_rate(Request $request)
    {
        $rule = [
            'contact_id'  => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $inputs = $request->all();

        $aa = array_filter($inputs, function ($value, $key) {
            return str_starts_with($key, 'r');
        }, ARRAY_FILTER_USE_BOTH);

        $az = [];
        foreach($aa as $az ){
            $values = array_values($az);
            if (!empty($az)) {

                foreach($az as $yy =>  $key){
                    $existcontact = Contact_rate::where('contact_id', $request->contact_id)->where('rate_id', $yy)->where('status', 0)->get();
                    if (!empty($existcontact)){
                        foreach($existcontact as $exi){
                            $exi->update([
                                'status' => 1,
                            ]);
                        }
                    }
                        $row = Contact_rate::create([
                                'emp_id' => Auth::guard('admin')->user()->id,
                                'contact_id' => $request->contact_id,
                                'rate_id' => $yy,
                                'value' => $key,
                                'status' => $request->status ?? 0,
                        ]);
                    }
                
            // foreach($az as $yy =>  $key){
            //     $existcontact = Contact_rate::where('contact_id', $request->contact_id)->where('rate_id', $yy)->where('status', 0)->first();
            //     if (!empty($existcontact)){
            //         $existcontact->update([
            //             'status' => 1,
            //         ]);
            //     }
            //         $row = Contact_rate::create([
            //                 'emp_id' => Auth::guard('admin')->user()->id,
            //                 'contact_id' => $request->contact_id,
            //                 'rate_id' => $yy,
            //                 'value' => $key,
            //                 'status' => $request->status ?? 0,
            //         ]);
            //     }
                }
            }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/contacts')->with('message', 'Added successfully')->with('status', 'success');
    }
    public function indextotal(Request $request)
    {

        $contact_ids = Contact_rate::where('status', 0)
        ->select('contact_id', Contact_rate::raw('SUM(value) as total_value'))
        ->groupBy('contact_id')
        ->pluck('total_value', 'contact_id');
        // dd( $contact_ids);
        return view('admin.contact.indextotal', compact('contact_ids'));
    }
    public function indextotalserch($contact_id)
    {
        // dd($request->all());
        $contact_id_value = Contact_rate::where('status', 0)
        ->where('contact_id', $contact_id)
        ->sum('value');
        
        return view('admin.contact.indextotal', compact('contact_id_value','contact_id'));
    }
    // public function indextotal(Request $request)
    // {
    //     // $data = Contact_rate::where('status', 0)
    //     //     ->select('contact_id', Contact_rate::raw('SUM(value) as total_value'))
    //     //     ->groupBy('contact_id')
    //     //     ->pluck('total_value', 'contact_id');
    //     //     dd($data);
        
    //     if ($request->ajax()) {
            
    //         // $data = Contact_rate::where('status', 0)
    //         // ->select('contact_id', Contact_rate::raw('SUM(value) as total_value'))
    //         // ->groupBy('contact_id')
    //         // ->pluck('total_value', 'contact_id');

    //         $dataTable = Datatables::of(Contact::whereHas('rates', function ($query) {
    //             $query->where('status', 0);
    //         })->select('contacts.id', DB::raw('SUM(contact_rates.value) as total_value'))
    //             ->groupBy('contacts.id'));
    //             $dataTable = $dataTable
               

    //         // return Datatables::of($dataTable)
    //             ->addColumn('checkbox', function($row){
    //                 $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
    //                                 <input class="form-check-input" type="checkbox" value="" />
    //                             </div>';
    //                 return $checkbox;
    //             })
    //             ->addColumn('contact_id', function($row){
    //                 $contact_id = ' ';
    //                 if($row->contact_id != null ){
    //                     $namcont = Contact::find($row->contact_id)->name_en;
    //                     $contact_id .= '<span>'.$namcont.'</span><br>';
    //                     }
                    
    //                 return $contact_id;
    //             })
    //             ->addColumn('phone', function($row){

    //                 $phone = '';
    //                 if($row->total_value != null ){
    //                 $phone .= '<span>'.$row->total_value.'</span><br>';
    //                 }
                    
    //                 return $phone;
    //             })
                
    //             ->addColumn('actions', function($row){
    //                 $actions = '<div class="ms-2">
    //                             <a href="'.route('admin.contacts.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    //                                 <i class="bi bi-eye-fill fs-1x"></i>
    //                             </a>
    //                             <a href="'.route('admin.contacts.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    //                                 <i class="bi bi-pencil-square fs-1x"></i>
    //                             </a>
    //                         </div>';
    //                 return $actions;
    //             })
    //             ->filter(function ($instance) use ($request) {
                   
    //                 if (!empty($request->get('search'))) {
    //                         $instance->where(function($w) use($request){
    //                         $search = $request->get('search');
    //                         $w->orWhere('name_en', 'LIKE', "%$search%")
    //                         ->orWhere('marital_status', 'LIKE', "%$search%")
    //                         ->orWhere('phone', 'LIKE', "%$search%");
    //                     });
    //                 }
    //             })
    //             ->rawColumns(['contact_id','phone','info','description','note','is_active','actions','checkbox'])
    //             ->make(true);
    //             return $dataTable;
    //     }
    //     return view('admin.contact.indexaz');
    // }


}
