<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Cashier;
use App\Models\Store;
use App\Models\Way_sell;
use App\Models\Account_tree;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CashiersController extends Controller
{

    public function index(Request $request)
    {
        $data = Cashier::get();

        if ($request->ajax()) {
            $data = Cashier::query();
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_ar', function($row){
                    $name_ar = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_ar.'</a><div>';
                    $name_ar .= '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$row->name_en.'</a><div>';

                    return $name_ar;
                })
                 ->addColumn('value', function($row){
                    $value = $row->value ;

                     return $value;
                 })
                 ->addColumn('acctree_id', function($row){
                    $acctree_id = $row->getacctree->name_ar ;
 
                     return $acctree_id;
                 }) 
                ->addColumn('description', function($row){
                   $description = $row->description ;

                    return $description;
                }) 
                ->addColumn('status', function($row){
                    if($row->status == 0 ) {
                        $status = '<div class="badge badge-light-success fw-bold">مقعل</div>';
                    } else {
                        $status = '<div class="badge badge-light-danger fw-bold">غير مفعل</div>';
                    }
                    
                    return $status;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.cashiers.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.cashiers.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name_ar', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_ar','acctree_id','value', 'description','status','checkbox','actions'])
                ->make(true);
        }
        return view('admin.cashier.index');
    }

    public function show($id)
    {
        $data = Cashier::find($id);
        return view('admin.cashier.show', compact('data'));
    }

    public function create()
    {
        $data = Account_tree::where('status' , 0)->get();
        return view('admin.cashier.create', compact('data'));
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
        $row = Cashier::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'acctree_id' => $request->acctree_id,
            // 'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'value' => 0,
            'description' => $request->description,
            'status' => $request->status ?? 0,

        ]);
        return redirect('admin/cashiers')->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Cashier::find($id);
        $data1 = Account_tree::where('status' , 0)->get();
        return view('admin.cashier.edit', compact('data','data1'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $data = Cashier::find($request->id);
        $data->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            // 'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description' => $request->description,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/cashiers')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Cashier::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function createsession()
    {
        $datacashiar = Cashier::where('status' , 0)->get();
        $datastore = Store::where('status' , 0)->get();
        $datawaysell = Way_sell::where('status' , 0)->get();
        return view('admin.cashier.createsession', compact('datacashiar','datastore','datawaysell'));
    }
    public function storesession(Request $request)
    {
        $rule = [
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        $request->session()->put('cashier_sell', $request->cashiersell);
        $request->session()->put('store_sell', $request->storesell);
        $request->session()->put('store_purchase', $request->storepurshase);
        $request->session()->put('way_sell', $request->waysell);
        return redirect('admin/')->with('message', 'Added successfully')->with('status', 'success');
    }
}
