<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Contact_rate;
use App\Models\Rating;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Contact_ratesController extends Controller
{

    public function index(Request $request)
    {
        $data = Contact_rate::get();

        if ($request->ajax()) {
            $data = Contact_rate::query();
            $data = $data->orderBy('id', 'DESC');
            // $data = $data->where('status', 0);

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){ 
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getcontact->name_en.'</a></div>';
                    $ratestat = $row->status;
                    if($ratestat === 0){
                        $name .= '<span class="text-success fs-6">Up To Date</span>';
                    } else {
                        $name .= '<span class="text-danger fs-6">Out Of Date</span>';
                    }
                    return $name;
                })

                ->addColumn('note', function($row){

                    $note = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->getrate->name_en.'</a></div>';
                    
                    return $note;
                })
                ->addColumn('value', function($row){

                    $value = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->value.'</a></div>';
                    
                    return $value;
                })
                ->addColumn('created_at', function($row){

                    $created_at = '<span class="text-info fs-3">'.date('Y-m-d', strtotime($row->created_at)).'</span>';
                    
                    return $created_at;
                })
                ->addColumn('largestdegree', function($row){
                    $largid = Rating::find($row->rate_id)->largestdegree;
                    if($largid){

                        $largestdegree = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$largid.'</a></div>';
                    } else {
                        $largestdegree = '';
                    }
                    
                    return $largestdegree;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.ratingcontacts.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.ratingcontacts.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('contact_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('contact_id', $request->get('contact_id'));
                    });
                    }
                    if (!empty($request->get('rate_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('rate_id', $request->get('rate_id'));
                    });
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
                ->rawColumns(['name','note','value','largestdegree','created_at','checkbox','actions'])
                ->make(true);
        }
        return view('admin.ratingcontact.index');
    }

    public function show($id)
    {
        $data = Contact_rate::find($id);
        return view('admin.ratingcontact.show', compact('data'));
    }

    public function create()
    {
        return view('admin.ratingcontact.create' );
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
        
        $row = Contact_rate::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ?? 0,
            
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('gift');
        }

        // $role = Role::find($request->role_id);
        // $row->syncRoles([]);
        // $row->assignRole($role->name);

        return redirect('admin/ratingcontacts')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Contact_rate::find($id);

        return view('admin.ratingcontact.edit', compact('data'));
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
        
        $center = Contact_rate::find($request->id);
        $data = Contact_rate::where('id', $request->id)->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_en' => $request->name_en,
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $employee->addMediaFromRequest('photo')->toMediaCollection('gift');
        }

        // $role = Role::find($request->role_id);
        // $employee->syncRoles([]);
        // $employee->assignRole($role->name);

        return redirect('admin/ratingcontacts')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Contact_rate::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

}
