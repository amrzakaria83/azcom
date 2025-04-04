<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Bill_sale_header;
use App\Models\Bill_sale_detail;
use App\Models\Emp_bill_sale;
use App\Models\Product;
use App\Models\Sale_type;
use App\Models\Employee;
use App\Models\Cut_sale;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Emp_bill_salesController extends Controller
{

    public function index(Request $request)
    {
        $data = Emp_bill_sale::get();

        if ($request->ajax()) {
            $data = Emp_bill_sale::query();
            $data = $data->where('status', 0);
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $name_en = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->getemp->name_en.'</a><div>';

                    return $name_en;
                })
                ->addColumn('note', function($row){
                    $note = round($row->value) ;

                    return $note;
                })
                ->addColumn('description', function($row){

                    $description = round($row->percent).'%';
                    
                    return $description;
                })
                ->addColumn('sale_type_id', function($row){
                    $sale_type_id = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.$row->getsaletype->name_en.'</a><div>';

                    return $sale_type_id;
                })
                ->addColumn('prod_id', function($row){
                    $bill = $row->getsaledetails->getprod->name_en;
                    
                    $prod_id = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.$bill.'</a><div>';

                    return $prod_id;
                })
                ->addColumn('tquntitty', function($row){
                    $bill = $row->getsaledetails->quantityproduc;
                    
                    $tquntitty = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.round($bill).'</a><div>';

                    return $tquntitty;
                })
                ->addColumn('quntitty', function($row){
                    $bill = ($row->getsaledetails->quantityproduc * $row->percent) / 100;
                    
                    $quntitty = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.round($bill, 3).'</a><div>';

                    return $quntitty;
                })
                ->addColumn('tvalue', function($row){
                    $bill = $row->getsaledetails->quantityproduc * $row->getsaledetails->sellpriceproduct;
                    
                    $tvalue = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.round($bill).'</a><div>';

                    return $tvalue;
                })
                ->addColumn('created_at', function($row){
                    $bill = date('Y-m-d', strtotime($row->getsaledetails->created_at));
                    
                    $created_at = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.$bill.'</a><div>';

                    return $created_at;
                })
                ->addColumn('valued_time', function($row){
                    $bill = date('Y-m-d', strtotime($row->getsaledetails->getheader->valued_time));
                    
                    $valued_time = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.$bill.'</a><div>';

                    return $valued_time;
                })
                ->addColumn('sale_id', function($row){
                    $bill = Bill_sale_detail::find($row->sale_id);
                    $billhe = Bill_sale_header::find($bill->bill_sale_header_id);
                    $custmer = Cut_sale::find($billhe->cut_sale_id);
                    $sale_id = '<div class="d-flex flex-column"><a href="'.route('admin.emp_bill_sales.edit', $row->getsaledetails->getheader->id).'" class="text-gray-800 text-hover-primary mb-1">'.$custmer->name_en.'</a><div>';

                    return $sale_id;
                })
                ->addColumn('status', function($row){
                    if($row->status == 0 ) {
                        $status = '<div class="badge badge-light-success fw-bold">مقعل</div>';
                    } else {
                        $status = '<div class="badge badge-light-danger fw-bold">غير مفعل</div>';
                    }
                    
                    return $status;
                })
                ->addColumn('is_active', function($row){

                    if($row->status == 0) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
                        // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-center-id="'. $row->id .'" data-centername="'. $row->name_en .'">
                        //     '.trans('lang.work_hours').'
                        //     </button></div> ';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    }
                    $is_active .= $row->note;

                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.emp_bill_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    $fromTime = $request->get('from_time');
                    $toDate = $request->get('to_date');

                    if (!empty($fromTime) && !empty($toDate) && strtotime($fromTime) && strtotime($toDate)) {
                        $instance->whereHas('getsaledetails.getheader', function ($query) use ($fromTime, $toDate) {
                            $query->whereDate('valued_time', '>=', $fromTime)
                                ->whereDate('valued_time', '<=', $toDate);
                        });
                    }
                    if (!empty($request->get('empsaled_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('empsaled_id', $request->get('empsaled_id'));
                    });
                    }
                    if (!empty($request->get('sale_type_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('sale_type_id', $request->get('sale_type_id'));
                    });
                    }
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name_en', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name_en','description','note','status','tvalue','quntitty','is_active','sale_type_id','sale_id','checkbox','actions','prod_id','tquntitty','created_at','valued_time'])
                ->make(true);
        }
        return view('admin.emp_bill_sale.index');
    }

    public function show($id)
    {
        $data = Emp_bill_sale::find($id);
        return view('admin.emp_bill_sale.show', compact('data'));
    }

    public function create()
    {
        $dataemp = Employee::where('is_active' , '1')->get();
        $dataprod = Product::where('status' , 0)->get();
        $datasale_type = Sale_type::where('status' , 0)->get();
        return view('admin.emp_bill_sale.create', compact('dataemp','dataprod','datasale_type'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $rule = [
            'empsaled_id' => 'required|numeric',
            'percent' => 'required|numeric'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        $databilldet = Bill_sale_detail::find($request->id);
        $databillhead = Bill_sale_header::find($databilldet->bill_sale_header_id);  
        $valueemp = ($request->percent * (($databilldet->approv_sellpriceproduct ?? 0) * ($databilldet->approv_quantity ?? 0))) / 100;
        $row = Emp_bill_sale::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'sale_id' => $request->id,
            'empsaled_id' => $request->empsaled_id,
            'sale_type_id' => $databillhead->sale_type_id,
            'percent' => $request->percent, //>decimal('percent', 10, 3)
            'value' => $valueemp, //>decimal('value', 10, 3)
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);
        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }

    public function edit($id)
    {
        $datahead = Bill_sale_header::find($id);
        $datadet = Bill_sale_detail::where('bill_sale_header_id', $datahead->id)->get();
        
        return view('admin.emp_bill_sale.edit', compact('datadet','datahead'));
    }

    public function update(Request $request)
    {
        dd($request->all());
        $rule = [
            'prod_id' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $data = Emp_bill_sale::find($request->id);
        $data->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'sale_id' => $request->sale_id,
            'empsaled_id' => $request->empsaled_id,
            'sale_type_id' => $request->sale_type_id,
            'percent' => $request->percent,//>decimal('percent', 10, 3)
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/emp_bill_sales')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Emp_bill_sale::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function indexempsearch(Request $request)
    {
        return view('admin.emp_bill_sale.indexemp');
    }
    public function indexemp(Request $request,$from_time,$to_date,)
    {
        $dataemp = Employee::where('is_active' , '1')->pluck('id');
        $tazd = [];
        foreach($dataemp as $az){
            $azname = Employee::find($az)->name_en;
            // $azd = Emp_bill_sale::where('empsaled_id',$az)->sum('value');
            $azd = Emp_bill_sale::
            where('empsaled_id',$az)
            ->whereDate('created_at', '>=', $from_time)
            ->whereDate('created_at', '<=', $to_date)
            ->get();
            $azdvalu = $azd->sum('value');
            $tazd[] = [$azname, $azdvalu];
        }
 
        return view('admin.emp_bill_sale.indexemp', compact('tazd'));
    }
    public function inactiveempsale($idsale)
    {
       
        $data = Emp_bill_sale::find($idsale);
        $data->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'status' => 1,
        ]);
        $saleteta = Bill_sale_detail::find($data->sale_id);
        $headsale = Bill_sale_header::find($saleteta->bill_sale_header_id);
        
        return redirect()->route('admin.emp_bill_sales.edit', $headsale->id)->with('message', 'Modified successfully')->with('status', 'success');
    }
}
