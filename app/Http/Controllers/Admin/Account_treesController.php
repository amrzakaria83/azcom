<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Account_tree;

use DataTables;
use Validator;

use Auth;
class Account_treesController extends Controller
{

    public function index(Request $request)
    {
        $data = Account_tree::get();

        if ($request->ajax()) {
            $data = Account_tree::query();
            $data = $data->orderBy('id', 'DESC');
 
            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_ar', function($row){
                    $name_ar = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_ar.'</a></div>';
                    $name_ar .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a></div>';
                    return $name_ar;
                })
                ->addColumn('value', function($row){

                    $value = '<div class="badge badge-light-danger fw-bold">'.$row->value.'</div>';
                    
                    return $value;
                })
                ->addColumn('parent_id', function($row){

                    if($row->type === 0) {
                        $parent_name = Account_tree::where('id' , $row->parent_id)->first();
                        $parent_id = '<a href="'.route('admin.account_trees.edit', $parent_name->id).'<div class="badge badge-light-info fw-bold">'.$parent_name->name_ar.'</a></div>';
                        if($parent_name->type === 0){
                            $parent_name2 = Account_tree::where('id' , $parent_name->parent_id)->first();
                            $parent_id .= '<br><a href="'.route('admin.account_trees.edit', $parent_name2->id).'<div class="badge badge-light-info fw-bold">'.$parent_name2->name_ar.'</a></div>';
                        }
                    } else {
                        $parent_id = '<a href="'.route('admin.account_trees.edit', $row->id).'<div class="badge badge-light-success fw-bold">'.$row->name_ar.'</a></div>';
                    }
                    return $parent_id;
                })
                ->addColumn('type', function($row){
                    if($row->type == 1) {
                        $type = '<div class="badge badge-light-success fw-bold">رئيسي</div>';
                    } else {
                        $type = '<div class="badge badge-light-danger fw-bold">فرعي</div>';
                    }
                    return $type;
                })
                ->addColumn('type_account', function($row){
                    if($row->type_account == 0) {
                        $type_account = '<div class="badge badge-light-danger fw-bold">مدين</div>';
                    } else {
                        $type_account = '<div class="badge badge-light-success fw-bold">دائن</div>';
                    }
                    
                    return $type_account;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.account_trees.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            $w->orWhere('name_ar', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_ar','type','value' ,'type_account', 'checkbox','parent_id','actions'])
                ->make(true);
        }
        return view('admin.account_tree.index');
    }

    public function show($id)
    {
        $data = Account_tree::find($id);
        return view('admin.account_tree.show', compact('data'));
    }

    public function create()
    {
        $data = Account_tree::where('status' , 0)->get();
        return view('admin.account_tree.create',compact('data' ));
    }

    public function store(Request $request)
    {
        $rule = [
            'name_ar' => 'required|string',
            'parent_id' => 'required|numeric|exists:account_trees,id|different:id',

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        $row = Account_tree::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'type' => $request->type,
            'type_account' => $request->type_account,
            // 'parent_id' => $request->parent_id,
            'parent_id' => $request->type == 1 ? null : $request->parent_id,
            'value' => $request->value ?? 0,
            'targete' => $request->targete ?? 0,
            'parent_targete' => $request->parent_targete ?? 0,
            'parent_value' => $request->parent_value ?? 0,
            'status' => $request->status,
            'note' => $request->note,

        ]);


        return redirect('admin/account_trees')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Account_tree::find($id);
        return view('admin.account_tree.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_ar' => 'required|string',
            'parent_id' => 'required|numeric|exists:account_trees,id|different:id',

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        $data = Account_tree::find($request->id);
        $data->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'type' => $request->type,
            'type_account' => $request->type_account,
            // 'parent_id' => $request->parent_id,
            'parent_id' => $request->type == 1 ? null : $request->parent_id,
            'value' => $request->value ?? 0,
            'targete' => $request->targete ?? 0,
            'parent_targete' => $request->parent_targete ?? 0,
            'parent_value' => $request->parent_value ?? 0,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $data->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        return redirect('admin/employees')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {
        try{
            Account_tree::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);
    }

    public function indexaccount()
    {
   
        $data = Account_tree::where('status', 0)->orderBy('id', 'desc')->get();

        // Build a collection for efficient lookup
        $accountCollection = $data->keyBy('id');
        
        // Calculate parent values
        $data->each(function ($account) use ($accountCollection) {
            $asdvalu = $account->parent_value ?? 0;
            $asdtra = $account->parent_targete ?? 0;
            // dd($asdvalu);
            if ($account->parent_id) {
                $parent = $accountCollection->get($account->parent_id);
                if ($parent) {
                    $parent->parent_value = ($parent->parent_value ?? 0) + $account->value + $asdvalu;
                    $parent->parent_targete = ($parent->parent_targete ?? 0) + $account->targete + $asdtra;
                }
            }
        });

        return view('admin.account_tree.indexaccount', compact('data'));
    }
    public function normalaccounttree()
    {
   
        $data = Account_tree::where('status', 0)->orderBy('id', 'desc')->get();

        // Build a collection for efficient lookup
        $accountCollection = $data->keyBy('id');
        
        // Calculate parent values
        $data->each(function ($account) use ($accountCollection) {
            $asdvalu = $account->parent_value ?? 0;
            // dd($asdvalu);
            if ($account->parent_id) {
                $parent = $accountCollection->get($account->parent_id);
                if ($parent) {
                    $parent->parent_value = ($parent->parent_value ?? 0) + $account->value + $asdvalu;
                }
            }
        });

        return view('admin.account_tree.normalaccounttree', compact('data'));
    }
}
