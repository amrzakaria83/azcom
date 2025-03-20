<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\List_contac;
use App\Models\Center;
use App\Models\Contact;
use App\Models\Employee;
use App\Models\Funnel_track;

use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use Helper;

class List_contacsController extends Controller
{

    public function index(Request $request)
    {
        $data = List_contac::get();

        if ($request->ajax()) {
            $data = List_contac::query();
            $data = $data->whereNull('parentlist_id');
            $data = $data->orderBy('id', 'DESC');
            
            $helper = new Helper;
            $ids = $helper->emp_ids();
            if (auth()->user()->role_id != 1) {
                $data = $data->whereIn('emplist_id', $ids);
            }

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    $name = '<div class="d-flex flex-column"><a href="'.route('admin.list_contacs.indexview', $row->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
                    // $name .= '<div class="ms-2">
                    //             <a href="'.route('admin.list_contacs.indexview', $row->id).'" class="btn btn-lg btn-primary btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    //                 '.trans('lang.contact').trans('lang.view').'
                    //             </a>
                    //         </div>';
                    return $name;
                })
                ->addColumn('nameview', function($row){
                    $nameview = '<div class="ms-2">
                                <a href="'.route('admin.list_contacs.indexview', $row->id).'" class="btn btn-lg btn-primary btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    '.trans('lang.contact').trans('lang.view').'
                                </a>
                            </div>';
                    return $nameview;
                })
                ->addColumn('description', function($row){

                    $description = '<span class="text-success fs-1">'.$row->getemp->name_en.'</span>';
                    $datacont = List_contac::where('parentlist_id' , $row->id)
                        ->whereNotNull('contact_id')
                        ->count();
                    $description .= '<br><span class="text-danger fs-1">'.trans('lang.contact').'('.$datacont.')</span>';

                    return $description;
                })
                ->addColumn('note', function($row){

                    $note = $row->note;
                    $note .= '<div class="ms-2">
                                <a href="'.route('admin.list_contacs.addcontlist', $row->id).'" class="btn btn-lg btn-success btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    '.trans('lang.contact').trans('lang.addnew').'
                                <i class="bi bi-plus-square fs-1x"></i>
                                </a>
                                
                            </div>';
                    return $note;
                })
                ->addColumn('is_active', function($row){
                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-product-id="'. $row->id .'" data-assistantname="'. $row->name_en .'">
                        //     '.trans('lang.work_hours').'
                        //     </button></div> ';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.list_contacs.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.list_contacs.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            $w->orWhere('name', 'LIKE', "%$search%")
                            ->orWhere('description', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name','description','note','is_active','nameview','checkbox','actions'])
                ->make(true);
        }
        return view('admin.list_contac.index');
    }

    public function show($id)
    {
        $data = List_contac::find($id);
        return view('admin.list_contac.show', compact('data'));
    }

    public function create()
    {
        
        $dataemp = Employee::where('is_active' , '1')->get();
        return view('admin.list_contac.create', compact('dataemp'));
    }

    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'emplist_id' => 'required|numeric',
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 

        $row = List_contac::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'emplist_id' => $request->emplist_id,
            'name_en' => $request->name_en,
            'contact_id' => $request->contact_id,
            'center_id' => $request->center_id,
            'parentlist_id' => $request->parentlist_id ?? null,
            'taregetvisit' => $request->taregetvisit,
            'sales_funel_id' => $request->sales_funel_id,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/list_contacs')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = List_contac::find($id);
        $dataemp = Employee::where('is_active' , '1')->get();
        return view('admin.list_contac.edittitel', compact('data','dataemp'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'emplist_id' => 'required|numeric'

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = List_contac::find($request->id);
        $data = List_contac::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'emplist_id' => $request->emplist_id,
            'name_en' => $request->name_en,
            'contact_id' => $request->contact_id,
            'center_id' => $request->center_id,
            'parentlist_id' => $request->parentlist_id ?? null,
            'taregetvisit' => $request->taregetvisit,
            'sales_funel_id' => $request->sales_funel_id,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/list_contacs')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            List_contac::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

    public function removecenter(Request $request )
    {
        $data = List_contac::find($request->id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        // Decode the JSON center_id into an array
        $centerIds = json_decode($data->center_id, true);
    
        // Check if the $centerId exists in the array
        if (($key = array_search($request->center, $centerIds)) !== false) {
            // Remove the centerId from the array
            unset($centerIds[$key]);
        }
    
        // Re-encode the array back to JSON
        $data->center_id = json_encode(array_values($centerIds));
    
        // Save the updated data
        $data->save();
    
        return redirect()->back();

    }
    public function removecontact(Request $request )
    {
        $data = List_contac::find($request->id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        // Decode the JSON center_id into an array
        $centerIds = json_decode($data->contact_id, true);
    
        // Check if the $centerId exists in the array
        if (($key = array_search($request->contact, $centerIds)) !== false) {
            // Remove the centerId from the array
            unset($centerIds[$key]);
        }
    
        // Re-encode the array back to JSON
        $data->contact_id = json_encode(array_values($centerIds));
    
        // Save the updated data
        $data->save();
    
        return redirect()->back();
     
    }
    public function addcontact(Request $request )
    {
        $data = List_contac::find($request->id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
                // Decode the existing contacts
                $existingContacts = json_decode($data->contact_id, true);

                // Ensure $existingContacts is an array
                if (!is_array($existingContacts)) {
                    $existingContacts = [];
                }
                // Add the new contact to the array
                $existingContacts[] = $request->contact_id;

                // Remove duplicates using array_unique
                $uniqueContacts = array_unique($existingContacts);

                // Encode the updated array
                $data->contact_id = json_encode($uniqueContacts);

                // Save the updated data
                $data->save();
        return redirect()->back();
    }
    public function addcenter(Request $request )
    {
        $data = List_contac::find($request->id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
                // Decode the existing contacts
                $existingContacts = json_decode($data->center_id, true);

                // Ensure $existingContacts is an array
                if (!is_array($existingContacts)) {
                    $existingContacts = [];
                }
                // Add the new contact to the array
                $existingContacts[] = $request->center_id;

                // Remove duplicates using array_unique
                $uniqueContacts = array_unique($existingContacts);

                // Encode the updated array
                $data->center_id = json_encode($uniqueContacts);

                // Save the updated data
                $data->save();
        return redirect()->back();
    }
    public function addcontlist($id)
    {

        $datalist = List_contac::find($id);
        // dd($datalist);
        $data = List_contac::where('parentlist_id' , $id)->get();

        return view('admin.list_contac.edit', compact('data','datalist'));
    }
    public function storelistdeta(Request $request)
    {
        // dd($request->all());
        $rule = [
            
        ];
        $datalist = List_contac::find($request->id);
        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        if (count($request['kt_docs_repeater_basic']) > 0) {
            foreach ($request['kt_docs_repeater_basic'] as $key => $value) {

            if ($value != null && $value['taregetvisit'] != null ) {
                $exisestcont = List_contac::where('emplist_id',$datalist->emplist_id)
                ->where('parentlist_id',$request->id)
                ->where('contact_id',$value['contact_id'])->first();

                if($exisestcont){
                    $exisestcont->status = 0;
                    $exisestcont->taregetvisit =$value['taregetvisit'];
                    $exisestcont->save();
                }else{
                    List_contac::create([
                        'emp_id' => Auth::guard('admin')->user()->id,
                        'parentlist_id' => $request->id,
                        'emplist_id' => $datalist->emplist_id,
                        'contact_id' => $value['contact_id'],
                        'taregetvisit' => $value['taregetvisit'],
                        'status' =>  0,
                            ]);
                }
                
            }}
        }
        if (count($request['kt_docs_repeater_basic1']) > 0) {
            foreach ($request['kt_docs_repeater_basic1'] as $key => $value) {

            if ($value != null && $value['taregetvisit'] != null ) {
                $exisestcenter = List_contac::where('emplist_id',$datalist->emplist_id)
                ->where('parentlist_id',$request->id)
                ->where('center_id',$value['center_id'])->first();

                if($exisestcenter){
                    $exisestcenter->status = 0;
                    $exisestcenter->taregetvisit =$value['taregetvisit'];
                    $exisestcenter->save();
                }else{
                    List_contac::create([
                        'emp_id' => Auth::guard('admin')->user()->id,
                        'parentlist_id' => $request->id,
                        'emplist_id' => $datalist->emplist_id,
                        'center_id' => $value['center_id'],
                        'taregetvisit' => $value['taregetvisit'],
                        'status' =>  0,
                            ]);

                }
                
            }}
        }

        // if($request->hasFile('photo') && $request->file('photo')->isValid()){
        //     $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        // }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/list_contacs')->with('message', 'Added successfully')->with('status', 'success');
    }
    public function indexview($id)
    {
        $datalist = List_contac::find($id);

        $data = List_contac::where('parentlist_id' , $id)->get();
        $datacont = List_contac::where('parentlist_id' , $id)
        ->whereNotNull('contact_id')
        ->get();

        return view('admin.list_contac.indexview', compact('data','datalist','datacont'));
    }
    public function createfunnel(Request $request)
    {
        $rule = [
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = List_contac::find($request->id);
        $track = List_contac::where('id', $request->id)->first();
        $data = List_contac::where('id', $request->id)->update([
            'sales_funel_id' => $request->sales_funel_id,
            
        ]);
        $funeltrack = Funnel_track::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'list_id' => $track->id,
            'status_funnel_befor' => null ,
            'status_funnel_after' => $request->sales_funel_id,
            'update_time' => carbon::now(),
            'note' => null ,
            'status' =>  0,

        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect()->back()->with('message', 'Modified successfully')->with('status', 'success');
    }
    public function updatefunnel(Request $request)
    {
        $rule = [
            
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        
        $center = List_contac::find($request->id);
        $track = List_contac::where('id', $request->id)->first();
        $funeltrack = Funnel_track::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'list_id' => $track->id,
            'status_funnel_befor' => $track->sales_funel_id ,
            'status_funnel_after' => $request->sales_funel_id,
            'update_time' => carbon::now(),
            'note' => null ,
            'status' =>  0,
        ]);

        $data = List_contac::where('id', $request->id)->update([
            'sales_funel_id' => $request->sales_funel_id,
            
        ]);
        

        // if($request->hasFile('photo') && $request->file('photo')->isValid()){
        //     $employee->addMediaFromRequest('photo')->toMediaCollection('profile');
        // }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect()->back()->with('message', 'Modified successfully')->with('status', 'success');
    }
}
