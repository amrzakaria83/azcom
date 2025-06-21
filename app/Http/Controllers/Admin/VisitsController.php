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
use App\Models\Product;
use App\Models\Comment_visit;
use App\Models\List_contac;
use App\Models\Sales_funel;
use App\Models\Specialty;

use App\Models\Visit;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Helper;

class VisitsController extends Controller
{

    public function index(Request $request)
    {
        $data = Visit::get();

        if ($request->ajax()) {
            $data = Visit::query();
            $data = $data->orderBy('id', 'DESC');
            $helper = new Helper;
            $ids = $helper->emp_ids();
            if (auth()->user()->role_id != 1) {
                $data = $data->whereIn('empvisit_id', $ids);
            }
            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="'.route('admin.visits.showlocation', $row->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->getemp->name_en.'</a></div>';
                    if($row->status_visit_list === 0){
                        $name_en .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-info text-hover-primary mb-1">'.trans('lang.nutrilist').trans('lang.contact').'</a></div>';
                    } elseif($row->status_visit_list === 1){
                        $name_en .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.trans('lang.nutrilist').trans('lang.center').'</a></div>';

                    } elseif($row->status_visit_list === 2){
                        $name_en .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-success text-hover-primary mb-1">'.trans('lang.contact').'&'.trans('lang.center').'</a></div>';

                    } elseif($row->status_visit_list === 3){
                        $name_en .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1"> out list </a></div>';

                    } elseif($row->status_visit_list === 4){
                        $name_en .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-primary mb-1"> cancelled </a></div>';

                    }
                    $status_completed = $row->status_completed ?? 0; // 0 = completed - 1 = not completed
                    if ($status_completed === 1){
                        $name_en .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-danger text-hover-primary mb-1">'.trans('lang.uncompleted').'</a></div>';
                    }
                    return $name_en;
                })
                ->addColumn('contact_id', function($row){
                    if ($row->contact_id != null){
                        
                        $color = optional(Type_contact::find($row->typecont_id))->favcolor;
                        $contact_id = '<a href="'.route('admin.contacts.show', $row->getcontact->id).'"><span style="color: '. $color.'!important;">'.$row->getcontact->name_en.'</span><br>';
                        $contact_id .= '<span style="color: '. $color.'!important;">'.trans('lang.contact').'</span></a><br>';
                        $contact_id .= '<span >'.$row->gettype->name_en.'</span><br>';
                       
                       

                    } elseif($row->center_id != null){
                        $contact_id = '<span >'.$row->getcenter->name_en.'</span><br>';
                        $contact_id .= '<span >'.trans('lang.center').'</span><br>';
                        $contact_id .= '<span >'.$row->gettype->name_en.'</span><br>';

                    }

                    return $contact_id;
                })
                ->addColumn('from_time', function($row){

                    $from_time = date('Y-m-d h:i', strtotime($row->from_time)).'<br>';
                    $from_time .= date('Y-m-d h:i', strtotime($row->end_time));
                    $from_time .= '<div class="d-flex flex-column">
                        <a href="'.route('admin.visits.editcomment', $row->id).'" class="btn btn-sm btn-info btn-active-dark me-2" 
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        '.trans('employee.add_new') .trans('lang.comment').'
                                </a></div>';

                    return $from_time;
                })
                ->addColumn('end_time', function($row){

                    if($row->from_time && $row->end_time){
                        $currentTime = Carbon::parse($row->end_time);
                        $timestamp = Carbon::parse($row->from_time);
                        $timeDifference = $currentTime->diff($timestamp);
                        $years = $timeDifference->y;
                        $months = $timeDifference->m;
                        $days = $timeDifference->d;
                        $hours = $timeDifference->h;
                        $minutes = $timeDifference->i;
                        $timeString = '';
                        if ($years > 0) {
                            $timeString .= $years .trans('lang.year').'-';
                        }
                        if ($months > 0) {
                            $timeString .= $months .trans('lang.month').'-';
                        }
                        if ($days > 0) {
                            $timeString .= $days .trans('lang.day').'-';
                        }
                        if ($hours > 0) {
                            $timeString .= $hours .trans('lang.hour').'-';
                        }
                        
                        $timeString .= $minutes . trans('lang.minute');
                        $end_time = '<span class="text-dark">'.$timeString.'</span>';
                    }
                    $comment = Comment_visit::where('visit_id',$row->id)->count();
                    if ($comment > 0){
                        $end_time .='<div class="d-flex flex-column">
                        <a href="'.route('admin.visits.showcomment', $row->id).'" class="btn btn-sm btn-warning btn-active-dark me-2" 
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    '.trans('lang.view') .trans('lang.comment').'('.$comment.')
                                </a></div>';
                    }
                    return $end_time;
                })
                ->addColumn('product_id', function($row){
                    // $product_id = '';
                    // $products = json_decode($row->product_id);
                    // if ($products != null){
                    //     foreach($products as $prod){
                    //         $prod = Product::find($prod);
                    //         $product_id .= '<div class="badge badge-light-info fw-bold">'.$prod->name_en.'</div><br>';
                    //     }
                    // }
                     if ($row->firstprodstep_id != null){
                            $product_id = '<div class="badge badge-light-info fw-bold d-flex flex-column">'.$row->getfirstprod->name_en.'';
                            if($row->first_type === 0){
                                $product_id .= '<div class="badge badge-light-danger fw-bold">Detalis</div>';
                            } elseif ($row->first_type === 1) {
                                $product_id .= '<div class="badge badge-light-info fw-bold">Reminder</div></div>';
                            } else {$product_id .= '<div class="badge badge-light-warning fw-bold">No entry</div></div>';}
                    }
                    if ($row->secondprodstep_id != null){
                        $product_id .= '<br><div class="badge badge-light-info fw-bold d-flex flex-column">'.$row->getsecondprod->name_en.'';
                        if($row->second_type === 0){
                            $product_id .= '<div class="badge badge-light-danger fw-bold">Detalis</div>';
                        } elseif ($row->second_type === 1){
                            $product_id .= '<div class="badge badge-light-info fw-bold">Reminder</div></div>';
                        }else {$product_id .= '<div class="badge badge-light-warning fw-bold">No entry</div></div>';}
                    }
                    if ($row->thirdprodstep_id != null){
                        $product_id .= '<br><div class="badge badge-light-info fw-bold d-flex flex-column">'.$row->getthirdprod->name_en.'';
                        if($row->third_type === 0){
                            $product_id .= '<div class="badge badge-light-danger fw-bold">Detalis</div>';
                        } elseif ($row->third_type === 1){
                            $product_id .= '<div class="badge badge-light-info fw-bold">Reminder</div></div>';
                        }else {$product_id .= '<div class="badge badge-light-warning fw-bold">No entry</div></div>';}
                    }
                    
                    return $product_id;
                })
                ->addColumn('description', function($row){

                    $description = '<div class="badge badge-light-info fw-bold">'.$row->description.'</div>';
                    
                    return $description;
                })
                ->addColumn('status_visit', function($row){
                    $visit = $row->status_visit;
                    if ($visit === 0){
                        $status_visit = '<div class="badge badge-light-success fw-bold">'.trans('lang.single').'</div>';

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
                    if ($row->contact_id != null){
                        $spa = json_decode($row->getcontact->speciality_id);
                        if (!empty($spa)) {
                            $spa = Specialty::whereIn('id', $spa)->get();
                            // $spa .= implode('<span>-', $spa->pluck('name_en')->toArray());
                            foreach ($spa as $spality) {
                                $note .= '<span >'.$spality->name_en.'</span><br>';
                            }
                        }
                    }
                    
                    return $note;
                })
                ->addColumn('type', function($row){
                    if($row->type == 'dash') {
                        $type = '<div class="badge badge-light-info fw-bold">'.trans('Visit.administrator').'</div>';
                    } else {
                        $type = '<div class="badge badge-light-primary fw-bold">'.trans('Visit.teacher').' </div>';
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
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.visits.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.visits.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('from_time') || $request->get('to_date'))) {
                        $instance->whereDate('from_time', '>=', $request->get('from_time'));
                        $instance->whereDate('from_time', '<=', $request->get('to_date'));
                    }

                    if ($request->get('status_visit_list') != Null)
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('status_visit_list', $request->get('status_visit_list'));
                    });
                    }
                    if ($request->get('status_visit') != Null)
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('status_visit', $request->get('status_visit'));
                    });
                    }
                    if ($request->get('status_completed') != Null)
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('status_completed', $request->get('status_completed'));
                    });
                    }
                    if ($request->get('firstprodstep_id') != Null)
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('firstprodstep_id', $request->get('firstprodstep_id'));
                    });
                    }
                    if (!empty($request->get('empvisit_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('empvisit_id', $request->get('empvisit_id'));
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
                    if ($request->get('typevist_id')) {
                        $instance->where('typevist_id', $request->get('typevist_id'));
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
                ->rawColumns(['name_en','contact_id','from_time','status_visit','product_id','description','note','type','end_time','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.visit.index');
    }

    public function show($id)
    {
        $data = Visit::find($id);
        return view('admin.visit.show', compact('data'));
    }

    public function create()
    {
        $dataemp = Employee::where('is_active' , '1')->get();
        $datacont = Contact::where('status' , 0)->get();
        $datacenter = Center::where('status' , 0)->get();
        $datatypv = Type_visit::where('status' , 0)->get();
        $dataprod = Product::where('status' , 0)->get();

        return view('admin.visit.create', compact('dataemp','datacont','datacenter','datatypv','dataprod'));
    }

    public function store(Request $request)
    {
        $rule = [
            // 'empvisit_id' => 'required',
            'typevist_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $row = Visit::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'empvisit_id' => Auth::guard('admin')->user()->id,
            'typevist_id' => $request->typevist_id,
            'center_id' => $request->center_id,
            'contact_id' => $request->contact_id,
            'status_visit' => $request->status_visit,//0 = single visit - 1 = double visit - 2 = triple visit
            'firstprodstep_id' => $request->firstprodstep_id,
            'first_type' => $request->first_type,//0 = details - 1 = reminder
            'secondprodstep_id' => $request->secondprodstep_id,
            'second_type' => $request->second_type,//0 = details - 1 = reminder
            'thirdprodstep_id' => $request->thirdprodstep_id,
            'third_type' => $request->third_type,//0 = details - 1 = reminder
            'visit_emp_ass' => $request->status_visit != 0 ? json_encode($request->visit_emp_ass) : null,//json_encode($request->visit_emp_ass)
            'note' => $request->note,
            'status_return' => $request->status_return ?? 4,// 0 = done - 1 = canceld - 3 = delayed - 4 = planned
            'description' => $request->description,
            'from_time' => $request->from_time,
            'checkin_location' => $request->checkin_location,
            'checkout_location' => $request->checkout_location,
            'end_time' => $request->end_time,
            'status' => 0 ,
            'status_completed' => $request->status_completed ?? 0, //0 = completed - 1 = not completed

        ]);
                    $Visit = Visit::find($row->id);

                    $listcont = List_contac::where('status' , 0)
                    ->where('emplist_id', $row->empvisit_id)
                    ->where('contact_id',$request->contact_id)
                    ->first(); // Assuming you want the first result
                    // $listcenter = List_contac::where('status' , 0)
                    // ->where('emplist_id', $row->empvisit_id)
                    // ->where('center_id',$request->center_id)
                    // ->first(); // Assuming you want the first result
                    if($listcont != null){
                    // 0 = listed contact - 1 = listed center - 2 = both - 3 = out list

                   // Check if $row->contact_id is in the $conlist array
                    if ($Visit->contact_id === $listcont->contact_id)  {
                        $Visit = Visit::where('id', $Visit->id)->update([
                            'status_visit_list' => 0 ,
                        ]);
                        
                        } else{
                            $Visit = Visit::where('id', $Visit->id)->update([
                                'status_visit_list' => 3 ,
                            ]);
                        }
                    } else{
                        $Visit = Visit::where('id', $Visit->id)->update([
                            'status_visit_list' => 3 ,
                        ]);
                    }
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
        $dataprod = Product::where('status' , 0)->get();

        $data = Visit::find($id);
        return view('admin.visit.edit', compact('data','dataemp','datacont','datacenter','datatypv','dataprod'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $rule = [

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $Visit = Visit::find($request->id);
        $data = Visit::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            // 'empvisit_id' => $request->empvisit_id,
            // 'typevist_id' => $request->typevist_id,
            // 'center_id' => $request->center_id,
            // 'contact_id' => $request->contact_id,
            // 'status_visit' => $request->status_visit,//0 = single visit - 1 = double visit - 2 = triple visit
            // 'firstprodstep_id' => $request->firstprodstep_id,
            // 'first_type' => $request->first_type,//0 = details - 1 = reminder
            // 'secondprodstep_id' => $request->secondprodstep_id,
            // 'second_type' => $request->second_type,//0 = details - 1 = reminder
            // 'thirdprodstep_id' => $request->thirdprodstep_id,
            // 'third_type' => $request->third_type,//0 = details - 1 = reminder
            // 'visit_emp_ass' => $request->status_visit != 0 ? json_encode($request->visit_emp_ass) : null,//json_encode($request->visit_emp_ass)
            // 'note' => $request->note,
            // 'status_return' => $request->status_return ?? 4,// 0 = done - 1 = canceld - 3 = delayed - 4 = planned
            // 'description' => $request->description,
            // 'from_time' => $request->from_time,
            // 'checkin_location' => $request->checkin_location,
            // 'checkout_location' => $request->checkout_location,
            // 'end_time' => $request->end_time,
            'status' => $request->status ,
        ]);
                    $Visit = Visit::find($request->id);
                    
                    $listcont = List_contac::where('status' , 0)
                    ->where('emplist_id', $request->empvisit_id)
                    ->where('contact_id',$request->contact_id)
                    ->first(); // Assuming you want the first result
                    // $listcenter = List_contac::where('status' , 0)
                    // ->where('emplist_id', $row->empvisit_id)
                    // ->where('center_id',$request->center_id)
                    // ->first(); // Assuming you want the first result
                    if($listcont != null){
                    // 0 = listed contact - 1 = listed center - 2 = both - 3 = out list
                        if($request->status == 0 ) {
                            // Check if $row->contact_id is in the $conlist array
                            if ($Visit->contact_id === $listcont->contact_id) {
                                $Visit = Visit::where('id', $Visit->id)->update([
                                    'status_visit_list' => 0 ,
                                ]);
                                
                                } else{
                                    $Visit = Visit::where('id', $Visit->id)->update([
                                        'status_visit_list' => 3 ,
                                    ]);
                                }
                            } else{
                                $Visit = Visit::where('id', $Visit->id)->update([
                                    'status_visit_list' => 4 ,
                                ]);
                            }
                        }
                        if($request->status == 1){
                            $Visit = Visit::where('id', $Visit->id)->update([
                                'status_visit_list' => 4 ,
                            ]);
                        }

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $Visit->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $Visit->syncRoles([]);
        // $Visit->assignRole($role->name);

        return redirect('admin/visits')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {

        try{
            Visit::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function editcomment($id)
    {
        $dataemp = Employee::where('is_active' , '1')->get();
        $datacont = Contact::where('status' , 0)->get();
        $datacenter = Center::where('status' , 0)->get();
        $datatypv = Type_visit::where('status' , 0)->get();
        $dataprod = Product::where('status' , 0)->get();
        $data = Visit::find($id);

        return view('admin.visit.editcomment', compact('data','dataemp','datacont','datacenter','datatypv','dataprod'));
    }

    public function storecomment(Request $request)
    {
        $rule = [

            'visit_id' => 'required'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        if (count($request['kt_docs_repeater_basic']) > 0) {
            foreach ($request['kt_docs_repeater_basic'] as $key => $value) {

            if ($value != null) {
                Comment_visit::create([
                    'emp_id' => Auth::guard('admin')->user()->id,
                    'visit_id' => $request->visit_id,
                    'title' => $value['title'], // Use the individual ID directly
                    'comment' => $value['comment'], // Use the individual ID directly
                    'status' => 0,
                ]);
            }}
        }
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('attach');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/visits')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function showcomment($id)
    {
        $data = Visit::find($id);

        $datacomment = Comment_visit::where('visit_id',$id)->get();

        return view('admin.visit.showcomment', compact('data','datacomment'));
    }
    public function reportlist()
    {

        return view('admin.visit.indexlist');
    }

    public function indexlist($list,$from_time,$to_date,$status_visit)
    {
        // $from_time = date('Y-m-d ', strtotime($from_time));
        // $to_date = date('Y-m-d ', strtotime($to_date));

        $datalistser = List_contac::where('status', 0)->find($list);
        $datalist = List_contac::where('status', 0)
        ->whereNotNull('contact_id')
        ->where('parentlist_id', $datalistser->id)->get();
        
        $datafirst = List_contac::where('status', 0)->where('id', $list)->first();
        $listcenter = '';
        $listcontact = '';
        $datacontact = '';
        $totaltareget = 0;
        $totalcontacts = 0;
        $totalamdatacontact = 0;
        $totalpmdatacontact = 0;
        $totalsingle = 0;
        $totaldouble = 0;
        $totalcontact = [];
        $totalcenter = [];
    
        if ($datalist->count() > 0) {
            foreach ($datalist as $data) {
                        $namecontact = Contact::find($data->contact_id);
                        $datacontact = Visit::where('status', 0)
                        ->where('empvisit_id', $datafirst->emplist_id)
                        ->where('contact_id', $data->contact_id)
                        ->whereBetween('from_time', [$from_time, $to_date])
                        ->get();
                        if($data->sales_funel_id){
                            $salfunnel = Sales_funel::find($data->sales_funel_id);
                        } else{
                            $salfunnel ='';
                        }
                        $amdatacontact = $datacontact->where('typevist_id' , 1)->count();
                        $pmdatacontact = $datacontact->where('typevist_id' , 2)->count();
                        $single = $datacontact->where('status_visit' , 0)->count(); //  0 = single visit - 1 = double visit - 2 = triple visit
                        $double = $datacontact->where('status_visit' , 1)->count(); //  0 = single visit - 1 = double visit - 2 = triple visit
                        $target = $data->taregetvisit ?? 0;
                        $contacts = $datacontact->count();
                        $totalcontact[] = [$contacts,$datacontact,$namecontact,$target,$salfunnel,$amdatacontact,$pmdatacontact];
                        $totaltareget += $target; // Now this works because $totaltareget is an integer
                        $totalcontacts += $contacts; // Now this works because $totaltareget is an integer
                        $totalamdatacontact += $amdatacontact; // Now this works because $totaltareget is an integer
                        $totalpmdatacontact += $pmdatacontact; // Now this works because $totaltareget is an integer
                        $totalsingle += $single; // Now this works because $totaltareget is an integer
                        $totaldouble += $double; // Now this works because $totaltareget is an integer
                    }
        }
        $searched = [$from_time, $to_date,$list];
        return view('admin.visit.indexlist',compact('totalcontact','datafirst','searched',
        'totaltareget','totalcontacts','totalamdatacontact','totalpmdatacontact','totalsingle','totaldouble'));
    }
    public function reportprod()
    {

        return view('admin.visit.indexprod');
    }
    public function reportprodlist($from_time,$to_date,$empvisit_id)
    {

        $dataproduct = Product::where('status', 0)->get();
        // $data = Visit::get();
        if($empvisit_id != 'null' ){
            $data = Visit::whereDate('from_time', '>=', $from_time)->whereDate('from_time', '<=', $to_date)->where('empvisit_id', $empvisit_id)->get();

            $emp = Employee::find($empvisit_id)->name_en;
            // dd($emp);
            
        } else {
            $data = Visit::whereDate('from_time', '>=', $from_time)->whereDate('from_time', '<=', $to_date)->get();
            $emp = 'All';
        }
        $countprod = [];
        foreach($dataproduct as $prod){
            $namprod = $prod->name_en;
            $proddataf_t = $data->where('firstprodstep_id' , $prod->id)->count();
            $proddataf_d = $data->where('firstprodstep_id' , $prod->id)->whereNotNull('first_type')->where('first_type' , 0)->count();//0 = details - 1 = reminder
            $proddataf_r = $data->where('firstprodstep_id' , $prod->id)->where('first_type' , 1)->count();//0 = details - 1 = reminder
            $proddataf_n = $data->where('firstprodstep_id' , $prod->id)->whereNull('first_type')->count();

            $proddatas_t = $data->where('secondprodstep_id' , $prod->id)->count();
            $proddatas_d = $data->where('secondprodstep_id' , $prod->id)->whereNotNull('second_type')->where('second_type' , 0)->count();//0 = details - 1 = reminder
            $proddatas_r = $data->where('secondprodstep_id' , $prod->id)->where('second_type' , 1)->count();//0 = details - 1 = reminder
            $proddatas_n = $data->where('secondprodstep_id' , $prod->id)->whereNull('second_type')->count();

            $proddatat_t = $data->where('thirdprodstep_id' , $prod->id)->count();
            $proddatat_d = $data->where('thirdprodstep_id' , $prod->id)->whereNotNull('third_type')->where('third_type' , 0)->count();//0 = details - 1 = reminder
            $proddatat_r = $data->where('thirdprodstep_id' , $prod->id)->where('third_type' , 1)->count();//0 = details - 1 = reminder
            $proddatat_n = $data->where('thirdprodstep_id' , $prod->id)->whereNull('third_type')->count();


            $countprod[] = [
            $namprod,
            $proddataf_t,$proddataf_d,$proddataf_r,$proddataf_n,
            $proddatas_t,$proddatas_d,$proddatas_r,$proddatas_n,
            $proddatat_t,$proddatat_d,$proddatat_r,$proddatat_n,
            $from_time,$to_date,$emp
                ];
        }
        // dd($countprod);



        // $proddataf = $data->pluck('firstprodstep_id');
        // $proddataf_n_t = $data->whereNotNull('first_type')->pluck('firstprodstep_id');//0 = details - 1 = reminder
        // $proddatas = $data->pluck('firstprodstep_id');
        // $proddatas_n_t = $data->whereNotNull('second_type')->pluck('secondprodstep_id');//0 = details - 1 = reminder
        // $proddatat = $data->pluck('thirdprodstep_id');
        // $proddatat_n_t = $data->whereNotNull('third_type')->pluck('secondprodstep_id');//0 = details - 1 = reminder

        return view('admin.visit.indexprod', compact('countprod'));
    }
    public function showlocation($id)
    {
        $data = Visit::find($id);
        $centellocation = Center::where('id', $data->center_id)->get(['lat','lng']);
        return view('admin.visit.showlocation', compact('data','centellocation'));
    }
    public function reportvistemp()
    {
        return view('admin.visit.reportvistemp');
    }
    public function indexvistemp($from_time,$to_date,$status_visit)
    {
        $data = Employee::where('is_active' , '1')->get();

            $helper = new Helper;
            $ids = $helper->emp_ids();
            if (auth()->user()->role_id != 1) {
                $data = $data->whereIn('id', $ids);
            }
            $totalemp = []; // Initialize the array

        foreach ($data as $dataemp) {
            $nameemp = $dataemp->name_en;
            $dataemp = Visit::where('status', 0)
            ->where('empvisit_id', $dataemp->id)
            ->whereBetween('from_time', [$from_time, $to_date])
            ->get();
            if ($dataemp->count() > 0) {
                $totalvisit = 0;
                $totalamvisit = 0;
                $totalpmvisit = 0;
                $totalsingle = 0;
                $totaldouble = 0;
                $totalvisit = $dataemp->count();
                $totalamvisit = $dataemp->where('typevist_id' , 1 )->count();// 1 = am visits - 2 = pm visits
                $totalpmvisit = $dataemp->where('typevist_id' , 2 )->count();// 1 = am visits - 2 = pm visits
                $totalsingle = $dataemp->where('status_visit' , 0 )->count();//  0 = single visit - 1 = double visit - 2 = triple visit
                $totaldouble = $dataemp->where('status_visit' , 1 )->count();//  0 = single visit - 1 = double visit - 2 = triple visit
                $totalcompleted = $dataemp->where('status_completed' , 0 )->count();// 0 = completed - 1 = not completed
                $totaluncompleted = $dataemp->where('status_completed' , 1 )->count();// 0 = completed - 1 = not completed
                $totalemp[] = [$totalvisit,$totalamvisit,$totalpmvisit,$totalsingle,$totaldouble,$nameemp,$totalcompleted,$totaluncompleted];

            }
            
        }
      
        $searched = [$from_time, $to_date];
        return view('admin.visit.reportvistemp',compact('totalemp','searched'));
    }

}
