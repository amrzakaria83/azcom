<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Sale_emp_aschived;
use App\Models\Emp_sale;
use App\Models\Product;
use App\Models\Sale_type;
use App\Models\Employee;
use App\Models\Bill_sale_header;
use App\Models\Bill_sale_detail;
use App\Models\Temp_sale_rec;
use App\Models\Cut_sale;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Area;
use App\Classes\FcmNotification;
use App\Models\Notification;
use DataTables;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Bill_sale_headersController extends Controller
{

    public function index(Request $request)
    {
        $data = Bill_sale_header::get();
        // 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection 
        // - 7 = some paied - 8 = total paied

        if ($request->ajax()) {
            $data = Bill_sale_header::query();
            $data = $data->where('status_requ', 0);
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $reqstatus = $row->status_requ;
                    if ($reqstatus !== 0){
                        $name_en = '<div class="d-flex flex-column">
                        <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" 
                        class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
                    } else {
                        $name_en = '<div class="d-flex flex-column">
                        <a href="javascript:;" 
                        class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
                    }
                    
                    $name_en .= '<span class="fs-6">'.$row->getcust->phone.'</span>';
                    $name_en .= '<span class="fs-6">'.$row->getcust->address.'</span>';
                    $name_en .= '<span class="fs-6">'.$row->getcust->note.'</span>';

                        
                    return $name_en;
                })
                ->addColumn('status_requ', function($row){
                    $status_requ = '';
                    $reqstatus = $row->status_requ;
                    
                    if($reqstatus === 0 ){
                        $status_requ .='<a href="'.route('admin.bill_sales.editsalehead', $row->id).'" class="" data-kt-menu-trigger="click" data-kt-menu-placement="">';
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.request').'</span>';
                        $status_requ .='</a>';
                    } elseif($reqstatus === 1){
                        $status_requ .='<span class="text-success fs-3">'.trans('lang.approved').'</span>';

                    } elseif($reqstatus === 2){
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject_some').'</span>';

                    } elseif($reqstatus === 3){
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject').'</span>';

                    } elseif($reqstatus === 4){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.under_delevery').'</span>';

                    } elseif($reqstatus === 5){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.under_collection').'</span>';

                    } elseif($reqstatus === 6){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.some_paied').'</span>';

                    } elseif($reqstatus === 6){
                        $status_requ .='<span class="text-success fs-3">'.trans('lang.total_paied').'</span>';

                    } else {
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.other').'</span>';

                    }
                    
                    return $status_requ;
                })
                ->addColumn('note', function($row){
                    $note = '';
                    if($row->note != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note.'</span>';
                    }
                    if($row->note1 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note1.'</span>';
                    }
                    if($row->note2 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note2.'</span>';
                    }
                    if($row->note3 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note3.'</span>';
                    }
                    return $note;
                })
                ->addColumn('status_order', function($row){
                    $status_order = '';
                    if($row->status_order != null){

                        $status_order .='<br><span class="text-info fs-3">'.$row->status_order.'</span>';
                    }
                    if($row->method_for_payment != null){

                        $status_order .='<br><span class="text-info fs-3">'.$row->method_for_payment.'</span>';
                    }

                    return $status_order;
                })
                ->addColumn('description', function($row){

                    $description = '<span class="text-info fs-3">'.date('Y-m-d', strtotime($row->valued_time)).'</span><br>';
                    $description .= '<span class="fs-6">'.date('Y-m-d', strtotime($row->created_at)).'</span>';
                    
                    return $description;
                })
                ->addColumn('totalsellprice', function($row){

                    $totalsellprice = '<span class="text-success fs-3">'.round($row->totalsellprice).'</span><br>';
                    
                    return $totalsellprice;
                })
                ->addColumn('countprod', function($row){
                    $prodcoun = Bill_sale_detail::where('bill_sale_header_id' , $row->id)->count();
                    if($prodcoun != null){
                        $countprod = '<span class="text-success fs-3">'.$prodcoun.'</span><br>';
                    } else{
                        $countprod = '<span class="text-success fs-3">0</span><br>';
                    }
                    
                    
                    return $countprod;
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
                        $is_active .='<br><a href="'.route('admin.bill_sales.inactivesale', $row->id).'" class="btn btn-sm btn-icon btn-danger btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                  <i class="bi bi bi-x-circle-fill fs-1x"></i>
                                              </a>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                        $is_active .='<br><a href="'.route('admin.bill_sales.activesale', $row->id).'" class="btn btn-sm btn-icon btn-success btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="bi bi bi-check-circle-fill fs-1x"></i>
                            </a>';
                    }
                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    if($row->status == 0 ) {
                        $actions = '<div class="ms-2">
                                    <a href="'.route('admin.bill_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-eye-fill fs-1x"></i>
                                    </a>
                                    <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-pencil-square fs-1x"></i>
                                    </a>
                                </div>';
                        } else {
                            $actions = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                        }
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('from_time') || $request->get('to_date'))) {
                        $instance->whereDate('valued_time', '>=', $request->get('from_time'));
                        $instance->whereDate('valued_time', '<=', $request->get('to_date'));
                    }
                    if (!empty($request->get('cut_sale_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('cut_sale_id', $request->get('cut_sale_id'));
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
                ->rawColumns(['name_en','description','note','status_order','status_requ','status','countprod','totalsellprice','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.bill_sale.index');
    }

    public function show($id)
    {
        $data = Bill_sale_header::find($id);
        return view('admin.bill_sale.show', compact('data'));
    }

    public function create()
    {
        
        return view('admin.bill_sale.create');
    }

    public function store(Request $request)
    {
       
        $rule = [
            'sale_type_id' => 'required|numeric'

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        
        $rowheader = Bill_sale_header::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'cut_sale_id' => $request->cut_sale_id,
            'sale_type_id' => $request->sale_type_id,
            'valued_time' => $request->valued_time,
            'note' => $request->note,
            'method_for_payment' => $request->method_for_payment,
            'status_order' => $request->status_order,
            'note1' => $request->note1,
            'note2' => $request->note2,
            'note3' => $request->note3,
            'status_requ' =>  0,// 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied 
            'status' =>  0,
                ]);
            $itemsreq = json_decode($request->tempsaleparent); 
            
            $itemsreqtotoalprice = collect($itemsreq)->sum('totalsellprice');

            
        foreach ( $itemsreq as $item) {
            $azrow = Bill_sale_detail::create([
                'emp_id' => Auth::guard('admin')->user()->id,
                'product_id' => $item->product_id,
                'bill_sale_header_id' => $rowheader->id,
                'quantityproduc' => $item->quantityproduc,
                'sellpriceproduct' => $item->sellpriceproduct,
                'percent' => $item->percent,
                'sellpriceph' => $item->sellpriceph,
                'status_requ' => 0,
                    ]);
            $tempitem = Temp_sale_rec::find($item->id);
            $tempitem->update([
                'status_order_req' => 3,  //0 = request - 1 = approved - 2 = cancel - 3 = nextstep
            ]);
        }
        $rowheader->update([
            'totalsellprice' => $itemsreqtotoalprice,  
        ]);
        
        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }
    public function storemodel(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        $row = Emp_sale::create([
            'emp_id' => Auth::guard('admin')->user()->id,
            'prod_id' => $request->prod_id,
            'empsaled_id' => $request->empsaled_id,
            'sale_type_id' => $request->sale_type_id,
            'percent' => $request->percent,//>decimal('percent', 10, 3)
            'quantity' => $request->quantity,//>decimal('quantity', 10, 3)
            'total_quantity' => $request->total_quantity,//>decimal('quantity', 10, 3)
            'unit_sellprice' => $request->unit_sellprice,//>decimal('unit_sellprice', 10, 3)
            'value_at' => $request->value_at,// date
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);
        return redirect()->back()->with('message', 'Added successfully')->with('status', 'success');
    }
    public function edit($id)
    {
        $data = Emp_sale::find($id);
        return view('admin.bill_sale.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $rule = [
            'prod_id' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        } 
        $data = Emp_sale::find($request->id);
        $data->update([
            'emp_id' => Auth::guard('admin')->user()->id,
            'prod_id' => $request->prod_id,
            'empsaled_id' => $request->empsaled_id,
            'sale_type_id' => $request->sale_type_id,
            'percent' => $request->percent,//>decimal('percent', 10, 3)
            'quantity' => $request->quantity,//>decimal('quantity', 10, 3)
            'total_quantity' => $request->total_quantity,//>decimal('quantity', 10, 3)
            'unit_sellprice' => $request->unit_sellprice,//>decimal('unit_sellprice', 10, 3)
            'value_at' => $request->value_at,// date
            'note' => $request->note,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/bill_sales')->with('message', 'Modified successfully')->with('status', 'success');
    }

    public function destroy(Request $request)
    {   

        try{
            Emp_sale::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
    public function getprod(Request $request)
    {
        $data3 = Product::find($request->input('prod_id'));
        return response()->json($data3);
    }
    public function getsale_type(Request $request)
    {
        $data3 = Sale_emp_aschived::where('status', 0)
        ->where('sale_type_id', $request->input('sale_type_id'))
        ->where('empsaled_id', $request->input('empsaled_id'))
        ->where('prod_id', $request->input('prod_id'))
        ->first();
        return response()->json($data3);
    }

    public function editsalehead($id)
    {
        $datahead = Bill_sale_header::find($id);
        $data = Bill_sale_detail::where('bill_sale_header_id',$datahead->id)->get();
        return view('admin.bill_sale.edit', compact('data','datahead'));
    }
    public function storepermonesale(Request $request)
    {
        
        $rule = [

        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) { 
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }
        foreach ($request->approv_quantity as $id => $quantity) {
            $sellPrice = $request->approv_sellpriceproduct[$id] ?? null;
            $approv_percent = $request->approv_percent[$id] ?? null;
        
            // Validate inputs
            if (is_numeric($quantity) && is_numeric($sellPrice)) {
                $bill_sale_detail = Bill_sale_detail::find($id);
                if ($bill_sale_detail) {
                    $bill_sale_detail->update([
                        'approv_quantity' => $quantity,
                        'approv_percent' => $approv_percent,
                        'approv_sellpriceproduct' => $sellPrice,
                    ]);
                }
            }
        };
        $totalSum = 0; // Initialize the total sum variable

        $rowheader = Bill_sale_header::find($request->headid);
        $appdetail = Bill_sale_detail::where('bill_sale_header_id',$rowheader->id)->get();
        foreach ($appdetail as $prodvalue) {
            // $prodvaluetotal = $prodvalue->approv_quantity * $prodvalue->approv_sellpriceproduct;
            $prodvaluetotal = ($prodvalue->approv_quantity ?? 0) * ($prodvalue->approv_sellpriceproduct ?? 0);
            $totalSum += $prodvaluetotal; // Accumulate the total

        }
        $rowheader->update([
        'status_requ' => 1,// 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied 
        'approv_sellprice' => $totalSum,
        ]);

        
        return redirect('admin/bill_sales')->with('message', 'Added successfully')->with('status', 'success');
    }
    public function indexall(Request $request)
    {
        $data = Bill_sale_header::get();
        // 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 
        //4 = under deliverd - 5 = deliverd - 6 = Under collection  - 7 = some paied - 8 = total paied

        if ($request->ajax()) {
            $data = Bill_sale_header::query();
            // $data = $data->where('status_requ', 0);
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $reqstatus = $row->status_requ;
                    if ($reqstatus !== 0){
                        $name_en = '<div class="d-flex flex-column">
                        <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" 
                        class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
                    } else {
                        $name_en = '<div class="d-flex flex-column">
                        <a href="javascript:;" 
                        class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
                    }
                    
                    $name_en .= '<a href="' . route('admin.emp_bill_sales.edit', $row->id) . '" class="text-gray-800 text-hover-primary mb-1"><span class="fs-6">' . e($row->getcust->phone) . '</span></a><br>';
                    $name_en .= '<a href="' . route('admin.emp_bill_sales.edit', $row->id) . '" class="text-gray-800 text-hover-primary mb-1"><span class="fs-6">' . e($row->getcust->address) . '</span></a>';
                    // $name_en .= '<span class="fs-6">'.$row->getcust->address.'</span>';
                    // $name_en .= '<span class="fs-6">'.$row->getcust->note.'</span>';

                    return $name_en;
                })
                ->addColumn('status_requ', function($row){
                    $status_requ = '';
                    $reqstatus = $row->status_requ;
                    if($reqstatus === 0 ){
                        $status_requ .='<a href="'.route('admin.bill_sales.editsalehead', $row->id).'" class="" data-kt-menu-trigger="click" data-kt-menu-placement="">';
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.request').'</span>';
                         $status_requ .= '</a>';
                    } elseif($reqstatus === 1){
                        $status_requ .='<span class="text-success fs-3">'.trans('lang.approved').'</span>';

                    } elseif($reqstatus === 2){
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject_some').'</span>';

                    } elseif($reqstatus === 3){
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject').'</span>';

                    } elseif($reqstatus === 4){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.under_delevery').'</span>';

                    } elseif($reqstatus === 5){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.delivered').'</span>';

                    } elseif($reqstatus === 6){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.some_paied').'</span>';

                    } elseif($reqstatus === 6){
                        $status_requ .='<span class="text-success fs-3">'.trans('lang.total_paied').'</span>';

                    } else {
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.other').'</span>';

                    }
                    

                    return $status_requ;
                })
                ->addColumn('note', function($row){
                    $note = '';
                    if($row->note != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note.'</span>';
                    }
                    if($row->note1 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note1.'</span>';
                    }
                    if($row->note2 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note2.'</span>';
                    }
                    if($row->note3 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note3.'</span>';
                    }
                    return $note;
                })
                ->addColumn('status_order', function($row){
                    $status_order = '';
                    if($row->status_order != null){

                        $status_order .='<br><span class="text-info fs-3">'.$row->status_order.'</span>';
                    }
                    if($row->method_for_payment != null){

                        $status_order .='<br><span class="text-danger fs-3">'.$row->method_for_payment.'</span>';
                    }

                    return $status_order;
                })
                ->addColumn('area_id', function($row){
                    // Check if the relationship exists and is not null
                    if ($row->getcust && $row->getcust->getarea) {
                        $area = $row->getcust->getarea->name_en;
                        if (!empty($area)) {
                            $area_id = '<span class="text-success fs-3">' . $area . '</span><br>';
                            if ($row->getcust->getarea->country_id === "EGY"){
                                $area_id .= '<span class="text-info">'.$row->getcust->getarea->getcity->city_name_en.'</span><br>';
                                $gov = $row->getcust->getarea->getcity->governorate_id;
                                $namgov = Governorate::find($gov);
                                $area_id .= '<span>'.trans('lang.governorate').':'.$namgov->governorate_name_en.'</span><br>';
                                $area_id .= '<span>'.trans('lang.egypt').'</span>';
                            } elseif ($row->getcust->getarea->country_id === "UAE"){
                                $area_id .= '<span class="text-info">'.$row->getcust->getarea->getcity->name_en.'</span><br>';
                                $area_id .= '<span>'.trans('lang.uae').'</span>';
                            }
                        } else {
                            $area_id = '<span class="text-danger fs-3">Not recognized</span>';
                        }
                    } else {
                        $area_id = '<span class="text-danger fs-3">Not recognized</span>';
                    }
                    
                    return $area_id;
                })
                ->addColumn('description', function($row){

                    $description = '<span class="text-info fs-3">'.date('Y-m-d', strtotime($row->valued_time)).'</span><br>';
                    $description .= '<span class="fs-6">'.date('Y-m-d', strtotime($row->created_at)).'</span>';
                    
                    return $description;
                })
                ->addColumn('totalsellprice', function($row){

                    $totalsellprice = '<span class="text-info fs-3">'.round($row->totalsellprice).'</span><br>';
                    
                    return $totalsellprice;
                })
                ->addColumn('approv_sellprice', function($row){

                    $approv = $row->approv_sellprice;
                    if (!empty($approv)) {
                    $approv_sellprice = '<span class="text-success fs-3">'.round($approv).'</span>';
                    } else {
                        $approv_sellprice = '<span class="text-danger fs-3">Not recognized</span>';
                    }
                    return $approv_sellprice;
                })
                ->addColumn('countprod', function($row){
                    $prodcoun = Bill_sale_detail::where('bill_sale_header_id' , $row->id)->count();
                    if($prodcoun != null){
                        $countprod = '<span class="text-success fs-3">'.$prodcoun.'</span><br>';
                    } else{
                        $countprod = '<span class="text-success fs-3">0</span><br>';
                    }
                    
                    
                    return $countprod;
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
                    // $is_active .= $row->note;

                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.bill_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('from_time') || $request->get('to_date'))) {
                        $instance->whereDate('valued_time', '>=', $request->get('from_time'));
                        $instance->whereDate('valued_time', '<=', $request->get('to_date'));
                    }
                    if (!empty($request->get('cut_sale_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('cut_sale_id', $request->get('cut_sale_id'));
                    });
                    }
                    if (!empty($request->get('area_id'))) {
                        $instance->whereHas('getcust', function ($query) use ($request) {
                            $query->whereIn('area_id', $request->get('area_id'));
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
                ->rawColumns(['name_en','description','note','status_order','status_requ','area_id','status','countprod','totalsellprice','approv_sellprice','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.bill_sale.indexall');
    }

    public function getprodname($id)
    {
        $data = [];
        
            $search = $id ;
            $data = Product::where('status' , 0)->select("name_en","id","percent",'sell_price')
            ->where('id', $search)
            ->first(); // Use `first()` instead of `get()` since we're expecting a single record
        
        return response()->json($data);
    }
    public function activesale($idsale)
    {
       
        $data = Bill_sale_header::find($idsale);
        $data->update([
            'manger_update_id' => Auth::guard('admin')->user()->id,
            'status' => 0,
        ]);

        return redirect('admin/bill_sales')->with('message', 'Modified successfully')->with('status', 'success');
    }
    public function inactivesale($idsale)
    {
       
        $data = Bill_sale_header::find($idsale);
        $data->update([
            'manger_update_id' => Auth::guard('admin')->user()->id,
            'status' => 1,
            'status_requ' => 3,
        ]);

        return redirect('admin/bill_sales')->with('message', 'Modified successfully')->with('status', 'success');
    }
    public function indexdelivered(Request $request)
    {
        $data = Bill_sale_header::get();
        // 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection 
        // - 7 = some paied - 8 = total paied

        if ($request->ajax()) {
            $data = Bill_sale_header::query();
            $data = $data->where('status_requ', 1);// 1 = approved - 5 = deliverd
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name_en', function($row){
                    $reqstatus = $row->status_requ;
                    if ($reqstatus !== 0){
                        $name_en = '<div class="d-flex flex-column">
                        <a href="javascript:;" 
                        class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
                    } else {
                        $name_en = '<div class="d-flex flex-column">
                        <a href="javascript:;" 
                        class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
                    }
                    
                    $name_en .= '<span class="fs-6">'.$row->getcust->phone.'</span>';
                    $name_en .= '<span class="fs-6">'.$row->getcust->address.'</span>';
                    $name_en .= '<span class="fs-6">'.$row->getcust->note.'</span>';

                        
                    return $name_en;
                })
                ->addColumn('status_requ', function($row){
                    $status_requ = '';
                    $reqstatus = $row->status_requ;
                    
                    if($reqstatus === 0 ){
                        $status_requ .='<a href="'.route('admin.bill_sales.editsalehead', $row->id).'" class="" data-kt-menu-trigger="click" data-kt-menu-placement="">';
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.request').'</span>';
                        $status_requ .='</a>';
                    } elseif($reqstatus === 1){
                        $status_requ .='<span class="text-success fs-3">'.trans('lang.approved').'</span>';

                    } elseif($reqstatus === 2){
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject_some').'</span>';

                    } elseif($reqstatus === 3){
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject').'</span>';

                    } elseif($reqstatus === 4){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.under_delevery').'</span>';

                    } elseif($reqstatus === 5){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.under_collection').'</span>';

                    } elseif($reqstatus === 6){
                        $status_requ .='<span class="text-info fs-3">'.trans('lang.some_paied').'</span>';

                    } elseif($reqstatus === 6){
                        $status_requ .='<span class="text-success fs-3">'.trans('lang.total_paied').'</span>';

                    } else {
                        $status_requ .='<span class="text-danger fs-3">'.trans('lang.other').'</span>';

                    }
                    
                    return $status_requ;
                })
                ->addColumn('note', function($row){
                    $note = '';
                    if($row->note != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note.'</span>';
                    }
                    if($row->note1 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note1.'</span>';
                    }
                    if($row->note2 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note2.'</span>';
                    }
                    if($row->note3 != null){

                        $note .='<br><span class="text-gray-600 fs-3">'.$row->note3.'</span>';
                    }
                    return $note;
                })
                ->addColumn('status_order', function($row){
                    $status_order = '';
                    if($row->status_order != null){

                        $status_order .='<br><span class="text-info fs-3">'.$row->status_order.'</span>';
                    }
                    if($row->method_for_payment != null){

                        $status_order .='<br><span class="text-info fs-3">'.$row->method_for_payment.'</span>';
                    }

                    return $status_order;
                })
                ->addColumn('description', function($row){

                    $description = '<span class="text-info fs-3">'.date('Y-m-d', strtotime($row->valued_time)).'</span><br>';
                    $description .= '<span class="fs-6">'.date('Y-m-d', strtotime($row->created_at)).'</span>';
                    
                    return $description;
                })
                ->addColumn('totalsellprice', function($row){

                    $totalsellprice = '<span class="text-success fs-3">'.round($row->approv_sellprice).'</span><br>';
                    $totalsellprice .= '<span class="text-info fs-6">('.round($row->totalsellprice).')</span>';
                    
                    return $totalsellprice;
                })
                ->addColumn('countprod', function($row){
                    $prodcoun = Bill_sale_detail::where('bill_sale_header_id' , $row->id)->count();
                    if($prodcoun != null){
                        $countprod = '<span class="text-success fs-3">'.$prodcoun.'</span><br>';
                    } else{
                        $countprod = '<span class="text-success fs-3">0</span><br>';
                    }
                    
                    
                    return $countprod;
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
                    $is_active ='<a href="'.route('admin.bill_sales.deliveredesale', $row->id).'" class="btn btn-lg btn-success btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="bi bi bi-check-circle-fill fs-1x"></i>
                                '.trans('lang.delivered').'
                            </a>';

                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    if($row->status == 0 ) {
                        $actions = '<div class="ms-2">
                                    <a href="'.route('admin.bill_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-eye-fill fs-1x"></i>
                                    </a>
                                    <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-pencil-square fs-1x"></i>
                                    </a>
                                </div>';
                        } else {
                            $actions = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                        }
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('from_time') || $request->get('to_date'))) {
                        $instance->whereDate('valued_time', '>=', $request->get('from_time'));
                        $instance->whereDate('valued_time', '<=', $request->get('to_date'));
                    }
                    if (!empty($request->get('cut_sale_id')))
                    {
                    $instance->where(function ($query) use ($request) {
                        $query->where('cut_sale_id', $request->get('cut_sale_id'));
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
                ->rawColumns(['name_en','description','note','status_order','status_requ','status','countprod','totalsellprice','is_active','checkbox','actions'])
                ->make(true);
        }
        return view('admin.bill_sale.indexdelivered');
    }
    public function deliveredesale($idsale)
    {
       
        $data = Bill_sale_header::find($idsale);
        $data->update([
            'manger_update_id' => Auth::guard('admin')->user()->id,
            'status_requ' => 5,// 0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied
        ]);
            
            $token = [];
            foreach (Employee::where('id', $data->emp_id)->get() as $key => $emp) {
                if ($emp->token != null) {
                    $token[] = $emp->fc_token;
                }
            }
            $title = trans('lang.deliverd') . ' ' . trans('lang.bill_of_sale');
            $body = trans('lang.customer') . ': <span>' . $data->getcust->name_en . '-</span><br>';
            $body .= trans('lang.value') . ': <span>' . ($data->approv_sellprice ?? '' ). '</span><br>';

            $send_noti = new FcmNotification($token, $title, htmlspecialchars(trim(strip_tags($body))),
             "other", 0, $data->emp_id);
            $send_noti->sendNotification(); 
            
        return redirect()->back()->with('message', 'Modified successfully')->with('status', 'success');
    }
    public function reportsaleeg(Request $request)

    {
        
        $fromdata = $request->get('from_time') 
        ? Carbon::parse($request->get('from_time'))->startOfDay()
        : Carbon::now()->subMonth()->firstOfMonth()->startOfDay();
        
        $todata = $request->get('to_date') 
        ? Carbon::parse($request->get('to_date'))->endOfDay()  // Changed to endOfDay()
        : Carbon::now()->endOfDay();

        $results = Bill_sale_header::whereIn('status_requ', [1,5,6,7,8])//1 = approved  5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied
        ->whereDate('valued_time', '>=', $fromdata)
        ->whereDate('valued_time', '<=', $todata)  // Changed to <=
        ->get()
        ->map(function($item) {
            try {
                $gov = $item->getcust->getarea->getcity->getgovernorate;
                // $city = optional(optional(optional($item->getcust)->getarea)->getcity);
                return [
                    'gov_id' => $gov->id,
                    'gov_name' => $gov->governorate_name_en,
                    'amount' => $item->approv_sellprice,
                    'cut_sale_id' => $item->cut_sale_id, // Include the cut_sale_id for counting
                    'bill_id' => $item->id // Include the bill ID for counting


                ];
            } catch (\Exception $e) {
                return null;
            }
        })
        ->filter()
        ->groupBy('gov_id')
        ->map(function($group) {

             // Get unique cut_sale_id count
        $uniqueCutSales = $group->pluck('cut_sale_id')->unique()->count();
            return [
                'id' => $group->first()['gov_id'],
                'governorate_name_en' => $group->first()['gov_name'],
                'total_sales' => $group->sum('amount'),
                'unique_customers' => $uniqueCutSales, // Add count of unique cut_sale_id
                'total_bills' => $group->count() // Count of all bill records for this governorate


            ];
        });
        $sortedResults = $results->sortByDesc('total_sales');
        $totalResults = $results->sum('total_sales');
        $totalcusts = $results->sum('unique_customers');
        // dd($sortedResults );
        return view('admin.bill_sale.reportsaleeg',compact('results','totalResults','totalcusts','sortedResults','fromdata','todata'));
    }
    public function indexallgov(Request $request, $govid)
    {
        try {
            if ($request->ajax()) {
                // Validate governorate exists
                if (!Governorate::where('id', $govid)->exists()) {
                    return response()->json(['data' => []]);
                }

                // Main query with proper relationship loading
                $query = Bill_sale_header::with([
                    'getcust.getarea.getcity.governorate',
                    'getcust.getarea.country'
                ])
                ->whereHas('getcust.getarea.getcity', function($q) use ($govid) {
                    $q->where('governorate_id', $govid);
                })
                ->orderBy('id', 'DESC');

                // Apply date filters if provided
                if ($request->filled('from_time')) {
                    $query->whereDate('valued_time', '>=', $request->from_time);
                }
                if ($request->filled('to_date')) {
                    $query->whereDate('valued_time', '<=', $request->to_date);
                }

                return Datatables::of($query)
                    ->addColumn('checkbox', function($row) {
                        return '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                            </div>';
                    })
                    ->addColumn('name_en', function($row) {
                        $customer = $row->getcust;
                        if (!$customer) {
                            return '<span class="text-danger">Customer not found</span>';
                        }

                        $link = $row->status_requ !== 0 
                            ? route('admin.emp_bill_sales.edit', $row->id)
                            : 'javascript:;';

                        return '<div class="d-flex flex-column">
                            <a href="'.$link.'" class="text-gray-800 text-hover-primary mb-1">'
                            .e($customer->name_en ?? 'N/A').'</a>
                            <span class="fs-6">'.e($customer->phone ?? '').'</span>
                            <span class="fs-6">'.e($customer->address ?? '').'</span>
                        </div>';
                    })
                    ->addColumn('status_requ', function($row) {
                        $statusTexts = [
                            0 => trans('lang.request'),
                            1 => trans('lang.approved'),
                            2 => trans('lang.reject_some'),
                            3 => trans('lang.reject'),
                            4 => trans('lang.under_delevery'),
                            5 => trans('lang.delivered'),
                            6 => trans('lang.some_paied'),
                            7 => trans('lang.total_paied')
                        ];

                        $statusClasses = [
                            0 => 'text-info',
                            1 => 'text-success',
                            2 => 'text-danger',
                            3 => 'text-danger',
                            4 => 'text-info',
                            5 => 'text-info',
                            6 => 'text-info',
                            7 => 'text-success'
                        ];

                        $status = $row->status_requ;
                        if ($status === 0) {
                            return '<a href="'.route('admin.bill_sales.editsalehead', $row->id).'" 
                                    class="'.$statusClasses[$status].' fs-3">'.$statusTexts[$status].'</a>';
                        }
                        
                        return '<span class="'.$statusClasses[$status].' fs-3">'.$statusTexts[$status].'</span>';
                    })
                    ->addColumn('note', function($row) {
                        $notes = [];
                        for ($i = 1; $i <= 3; $i++) {
                            $noteField = 'note'.$i;
                            if (!empty($row->$noteField)) {
                                $notes[] = '<span class="text-gray-600 fs-3">'.e($row->$noteField).'</span>';
                            }
                        }
                        return implode('<br>', $notes);
                    })
                    ->addColumn('status_order', function($row) {
                        $content = '';
                        if ($row->status_order) {
                            $content .= '<span class="text-info fs-3">'.e($row->status_order).'</span><br>';
                        }
                        if ($row->method_for_payment) {
                            $content .= '<span class="text-danger fs-3">'.e($row->method_for_payment).'</span>';
                        }
                        return $content;
                    })
                    ->addColumn('area_id', function($row) {
                        try {
                            $area = $row->getcust->getarea ?? null;
                            $city = $area->getcity ?? null;
                            $governorate = $city->governorate ?? null;
                            $country = $area->country ?? null;

                            if (!$area) {
                                return '<span class="text-danger">Area not found</span>';
                            }

                            $content = '<span class="text-success fs-3">'.e($area->name_en ?? 'N/A').'</span><br>';

                            if ($city) {
                                $content .= '<span class="text-info">'.e($city->city_name_en ?? '').'</span><br>';
                                
                                if ($governorate) {
                                    $content .= '<span>'.trans('lang.governorate').': '
                                              . e($governorate->governorate_name_en ?? '').'</span><br>';
                                }
                            }

                            if ($country) {
                                $content .= '<span>'.trans('lang.'.$country->code).'</span>';
                            }

                            return $content;

                        } catch (\Exception $e) {
                            Log::error('Area ID column error: '.$e->getMessage());
                            return '<span class="text-danger">Error loading location data</span>';
                        }
                    })
                    ->addColumn('description', function($row) {
                        return '<span class="text-info fs-3">'.date('Y-m-d', strtotime($row->valued_time)).'</span><br>
                                <span class="fs-6">'.date('Y-m-d', strtotime($row->created_at)).'</span>';
                    })
                    ->addColumn('totalsellprice', function($row) {
                        return '<span class="text-info fs-3">'.number_format(round($row->totalsellprice)).'</span>';
                    })
                    ->addColumn('approv_sellprice', function($row) {
                        return empty($row->approv_sellprice)
                            ? '<span class="text-danger fs-3">'.trans('lang.not_recognized').'</span>'
                            : '<span class="text-success fs-3">'.number_format(round($row->approv_sellprice)).'</span>';
                    })
                    ->addColumn('countprod', function($row) {
                        $count = $row->details()->count();
                        return '<span class="text-success fs-3">'.$count.'</span>';
                    })
                    ->addColumn('status', function($row) {
                        return $row->status == 0
                            ? '<div class="badge badge-light-success fw-bold">'.trans('lang.active').'</div>'
                            : '<div class="badge badge-light-danger fw-bold">'.trans('lang.inactive').'</div>';
                    })
                    ->addColumn('is_active', function($row) {
                        return $row->status == 0
                            ? '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>'
                            : '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
                    })
                    ->addColumn('actions', function($row) {
                        return '<div class="ms-2">
                                <a href="'.route('admin.bill_sales.show', $row->id).'" 
                                   class="btn btn-sm btn-icon btn-warning btn-active-dark me-2">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" 
                                   class="btn btn-sm btn-icon btn-info btn-active-dark me-2">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    })
                    ->rawColumns([
                        'checkbox', 'name_en', 'status_requ', 'note', 
                        'status_order', 'area_id', 'description', 
                        'totalsellprice', 'approv_sellprice', 'countprod', 
                        'status', 'is_active', 'actions'
                    ])
                    ->make(true);
            }

            return view('admin.bill_sale.indexallgov', compact('govid'));

        } catch (\Exception $e) {
            Log::error('Bill Sales Controller Error: '.$e->getMessage()."\n".$e->getTraceAsString());
            
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Server Error',
                    'message' => 'An error occurred while processing your request'
                ], 500);
            }
            
            return back()->withError('An error occurred');
        }
    }
    // public function indexallgov(Request $request,$govid)
    // {
       
    //     if ($request->ajax()) {
    //     $datacity = City::where('governorate_id',$govid)->pluck('id');
    //     $dataarea = Area::whereIn('egy_or_uea_id', $datacity)->pluck('id');
    //     $datacust = Cut_sale::whereIN('id', $dataarea)->pluck('id');
            
    //         $data = Bill_sale_header::query()
    //         ->whereIn('cut_sale_id', $datacust)
    //         ->orderBy('id', 'DESC');

    //         return Datatables::of($data)
    //             ->addColumn('checkbox', function($row){
    //                 $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
    //                                 <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
    //                             </div>';
    //                 return $checkbox;
    //             })
    //             ->addColumn('name_en', function($row){
    //                 $reqstatus = $row->status_requ;
    //                 if ($reqstatus !== 0){
    //                     $name_en = '<div class="d-flex flex-column">
    //                     <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" 
    //                     class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
    //                 } else {
    //                     $name_en = '<div class="d-flex flex-column">
    //                     <a href="javascript:;" 
    //                     class="text-gray-800 text-hover-primary mb-1">'.$row->getcust->name_en.'</a><div>';
    //                 }
                    
    //                 $name_en .= '<a href="' . route('admin.emp_bill_sales.edit', $row->id) . '" class="text-gray-800 text-hover-primary mb-1"><span class="fs-6">' . e($row->getcust->phone) . '</span></a><br>';
    //                 $name_en .= '<a href="' . route('admin.emp_bill_sales.edit', $row->id) . '" class="text-gray-800 text-hover-primary mb-1"><span class="fs-6">' . e($row->getcust->address) . '</span></a>';
    //                 // $name_en .= '<span class="fs-6">'.$row->getcust->address.'</span>';
    //                 // $name_en .= '<span class="fs-6">'.$row->getcust->note.'</span>';

    //                 return $name_en;
    //             })
    //             ->addColumn('status_requ', function($row){
    //                 $status_requ = '';
    //                 $reqstatus = $row->status_requ;
    //                 if($reqstatus === 0 ){
    //                     $status_requ .='<a href="'.route('admin.bill_sales.editsalehead', $row->id).'" class="" data-kt-menu-trigger="click" data-kt-menu-placement="">';
    //                     $status_requ .='<span class="text-info fs-3">'.trans('lang.request').'</span>';
    //                      $status_requ .= '</a>';
    //                 } elseif($reqstatus === 1){
    //                     $status_requ .='<span class="text-success fs-3">'.trans('lang.approved').'</span>';

    //                 } elseif($reqstatus === 2){
    //                     $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject_some').'</span>';

    //                 } elseif($reqstatus === 3){
    //                     $status_requ .='<span class="text-danger fs-3">'.trans('lang.reject').'</span>';

    //                 } elseif($reqstatus === 4){
    //                     $status_requ .='<span class="text-info fs-3">'.trans('lang.under_delevery').'</span>';

    //                 } elseif($reqstatus === 5){
    //                     $status_requ .='<span class="text-info fs-3">'.trans('lang.delivered').'</span>';

    //                 } elseif($reqstatus === 6){
    //                     $status_requ .='<span class="text-info fs-3">'.trans('lang.some_paied').'</span>';

    //                 } elseif($reqstatus === 6){
    //                     $status_requ .='<span class="text-success fs-3">'.trans('lang.total_paied').'</span>';

    //                 } else {
    //                     $status_requ .='<span class="text-danger fs-3">'.trans('lang.other').'</span>';

    //                 }
                    

    //                 return $status_requ;
    //             })
    //             ->addColumn('note', function($row){
    //                 $note = '';
    //                 if($row->note != null){

    //                     $note .='<br><span class="text-gray-600 fs-3">'.$row->note.'</span>';
    //                 }
    //                 if($row->note1 != null){

    //                     $note .='<br><span class="text-gray-600 fs-3">'.$row->note1.'</span>';
    //                 }
    //                 if($row->note2 != null){

    //                     $note .='<br><span class="text-gray-600 fs-3">'.$row->note2.'</span>';
    //                 }
    //                 if($row->note3 != null){

    //                     $note .='<br><span class="text-gray-600 fs-3">'.$row->note3.'</span>';
    //                 }
    //                 return $note;
    //             })
    //             ->addColumn('status_order', function($row){
    //                 $status_order = '';
    //                 if($row->status_order != null){

    //                     $status_order .='<br><span class="text-info fs-3">'.$row->status_order.'</span>';
    //                 }
    //                 if($row->method_for_payment != null){

    //                     $status_order .='<br><span class="text-danger fs-3">'.$row->method_for_payment.'</span>';
    //                 }

    //                 return $status_order;
    //             })
    //             ->addColumn('area_id', function($row){
    //                 // Check if the relationship exists and is not null
    //                 if ($row->getcust && $row->getcust->getarea) {
    //                     $area = $row->getcust->getarea->name_en;
    //                     if (!empty($area)) {
    //                         $area_id = '<span class="text-success fs-3">' . $area . '</span><br>';
    //                         if ($row->getcust->getarea->country_id === "EGY"){
    //                             $area_id .= '<span class="text-info">'.$row->getcust->getarea->getcity->city_name_en.'</span><br>';
    //                             $gov = $row->getcust->getarea->getcity->governorate_id;
    //                             $namgov = Governorate::find($gov);
    //                             $area_id .= '<span>'.trans('lang.governorate').':'.$namgov->governorate_name_en.'</span><br>';
    //                             $area_id .= '<span>'.trans('lang.egypt').'</span>';
    //                         } elseif ($row->getcust->getarea->country_id === "UAE"){
    //                             $area_id .= '<span class="text-info">'.$row->getcust->getarea->getcity->name_en.'</span><br>';
    //                             $area_id .= '<span>'.trans('lang.uae').'</span>';
    //                         }
    //                     } else {
    //                         $area_id = '<span class="text-danger fs-3">Not recognized</span>';
    //                     }
    //                 } else {
    //                     $area_id = '<span class="text-danger fs-3">Not recognized</span>';
    //                 }
                    
    //                 return $area_id;
    //             })
    //             ->addColumn('description', function($row){

    //                 $description = '<span class="text-info fs-3">'.date('Y-m-d', strtotime($row->valued_time)).'</span><br>';
    //                 $description .= '<span class="fs-6">'.date('Y-m-d', strtotime($row->created_at)).'</span>';
                    
    //                 return $description;
    //             })
    //             ->addColumn('totalsellprice', function($row){

    //                 $totalsellprice = '<span class="text-info fs-3">'.round($row->totalsellprice).'</span><br>';
                    
    //                 return $totalsellprice;
    //             })
    //             ->addColumn('approv_sellprice', function($row){

    //                 $approv = $row->approv_sellprice;
    //                 if (!empty($approv)) {
    //                 $approv_sellprice = '<span class="text-success fs-3">'.round($approv).'</span>';
    //                 } else {
    //                     $approv_sellprice = '<span class="text-danger fs-3">Not recognized</span>';
    //                 }
    //                 return $approv_sellprice;
    //             })
    //             ->addColumn('countprod', function($row){
    //                 $prodcoun = Bill_sale_detail::where('bill_sale_header_id' , $row->id)->count();
    //                 if($prodcoun != null){
    //                     $countprod = '<span class="text-success fs-3">'.$prodcoun.'</span><br>';
    //                 } else{
    //                     $countprod = '<span class="text-success fs-3">0</span><br>';
    //                 }
                    
                    
    //                 return $countprod;
    //             })
    //             ->addColumn('status', function($row){
    //                 if($row->status == 0 ) {
    //                     $status = '<div class="badge badge-light-success fw-bold">مقعل</div>';
    //                 } else {
    //                     $status = '<div class="badge badge-light-danger fw-bold">غير مفعل</div>';
    //                 }
                    
    //                 return $status;
    //             })
    //             ->addColumn('is_active', function($row){

    //                 if($row->status == 0) {
    //                     $is_active = '<div class="badge badge-light-success fw-bold">'.trans('employee.active').'</div>';
    //                     // $is_active .= '<div><button type="button" class="btn btn-success btn-sm col-6" data-bs-toggle="modal" data-bs-target="#kt_modal_1b" data-center-id="'. $row->id .'" data-centername="'. $row->name_en .'">
    //                     //     '.trans('lang.work_hours').'
    //                     //     </button></div> ';
    //                 } else {
    //                     $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('employee.notactive').'</div>';
    //                 }
    //                 // $is_active .= $row->note;

    //                 return $is_active;
    //             })
    //             ->addColumn('actions', function($row){
    //                 $actions = '<div class="ms-2">
    //                             <a href="'.route('admin.bill_sales.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    //                                 <i class="bi bi-eye-fill fs-1x"></i>
    //                             </a>
    //                             <a href="'.route('admin.emp_bill_sales.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    //                                 <i class="bi bi-pencil-square fs-1x"></i>
    //                             </a>
    //                         </div>';
    //                 return $actions;
    //             })
    //             // ->filter(function ($instance) use ($request) {
    //             //     if (!empty($request->get('from_time') || $request->get('to_date'))) {
    //             //         $instance->whereDate('valued_time', '>=', $request->get('from_time'));
    //             //         $instance->whereDate('valued_time', '<=', $request->get('to_date'));
    //             //     }
    //             //     if (!empty($request->get('cut_sale_id')))
    //             //     {
    //             //     $instance->where(function ($query) use ($request) {
    //             //         $query->where('cut_sale_id', $request->get('cut_sale_id'));
    //             //     });
    //             //     }
    //             //     if (!empty($request->get('area_id'))) {
    //             //         $instance->whereHas('getcust', function ($query) use ($request) {
    //             //             $query->whereIn('area_id', $request->get('area_id'));
    //             //         });
    //             //     }
    //             //     if ($request->get('status') == '0' || $request->get('status') == '1') {
    //             //         $instance->where('status', $request->get('status'));
    //             //     }
    //             //     if (!empty($request->get('search'))) {
    //             //             $instance->where(function($w) use($request){
    //             //             $search = $request->get('search');
    //             //             $w->orWhere('name_en', 'LIKE', "%$search%")
    //             //             ->orWhere('phone', 'LIKE', "%$search%")
    //             //             ->orWhere('email', 'LIKE', "%$search%");
    //             //         });
    //             //     }
    //             // })
    //             ->rawColumns(['name_en','description','note','status_order','status_requ','area_id','status','countprod','totalsellprice','approv_sellprice','is_active','checkbox','actions'])
    //             ->make(true);
    //     }
    //     return view('admin.bill_sale.indexallgov');
    // }
    public function reportsalecity(Request $request)

    {
        
        $fromdata = $request->get('from_time') 
        ? Carbon::parse($request->get('from_time'))->startOfDay()
        : Carbon::now()->subMonth()->firstOfMonth()->startOfDay();
        
        $todata = $request->get('to_date') 
        ? Carbon::parse($request->get('to_date'))->endOfDay()  // Changed to endOfDay()
        : Carbon::now()->endOfDay();

        
       
        $results = Bill_sale_header::whereIn('status_requ', [1,5,6,7,8])//1 = approved  5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied
        ->whereDate('valued_time', '>=', $fromdata)
        ->whereDate('valued_time', '<=', $todata)  // Changed to <=
        ->get()
        ->map(function($item) {
            try {
                $gov = $item->getcust->getarea->getcity;
                // $city = optional(optional(optional($item->getcust)->getarea)->getcity);
                return [
                    'gov_id' => $gov->id,
                    'city' => $gov, // Include the City model object
                    'gov_name' => $gov->city_name_en,
                    'amount' => $item->approv_sellprice,
                    'cut_sale_id' => $item->cut_sale_id, // Include the cut_sale_id for counting
                    'bill_id' => $item->id // Include the bill ID for counting


                ];
            } catch (\Exception $e) {
                return null;
            }
        })
        ->filter()
        ->groupBy('gov_id')
        ->map(function($group) {

             // Get unique cut_sale_id count
        $uniqueCutSales = $group->pluck('cut_sale_id')->unique()->count();
            return [
                'id' => $group->first()['gov_id'],
                'city_name_en' => $group->first()['gov_name'],
                'total_sales' => $group->sum('amount'),
                'unique_customers' => $uniqueCutSales, // Add count of unique cut_sale_id
                'total_bills' => $group->count() // Count of all bill records for this governorate


            ];
        });
        $sortedResults = $results->sortByDesc('total_sales');
        $totalResults = $results->sum('total_sales');
        $totalcusts = $results->sum('unique_customers');
        // dd($totalResults );
        return view('admin.bill_sale.reportsalecity',compact('results','totalResults','totalcusts','sortedResults','fromdata','todata'));
    }
    public function reportsalearea(Request $request)

    {
        
        $fromdata = $request->get('from_time') 
        ? Carbon::parse($request->get('from_time'))->startOfDay()
        : Carbon::now()->subMonth()->firstOfMonth()->startOfDay();
        
        $todata = $request->get('to_date') 
        ? Carbon::parse($request->get('to_date'))->endOfDay()  // Changed to endOfDay()
        : Carbon::now()->endOfDay();

        $results = Bill_sale_header::whereIn('status_requ', [1,5,6,7,8])//1 = approved  5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied
        ->whereDate('valued_time', '>=', $fromdata)
        ->whereDate('valued_time', '<=', $todata)  // Changed to <=
        ->get()
        ->map(function($item) {
            try {
                $gov = $item->getcust->getarea;
                // $city = optional(optional(optional($item->getcust)->getarea)->getcity);
                return [
                    'gov_id' => $gov->id,
                    'city' => $gov, // Include the City model object
                    'gov_name' => $gov->name_en,
                    'amount' => $item->approv_sellprice,
                    'cut_sale_id' => $item->cut_sale_id, // Include the cut_sale_id for counting
                    'bill_id' => $item->id // Include the bill ID for counting


                ];
            } catch (\Exception $e) {
                return null;
            }
        })
        ->filter()
        ->groupBy('gov_id')
        ->map(function($group) {

             // Get unique cut_sale_id count
        $uniqueCutSales = $group->pluck('cut_sale_id')->unique()->count();
            return [
                'id' => $group->first()['gov_id'],
                'name_en' => $group->first()['gov_name'],
                'total_sales' => $group->sum('amount'),
                'unique_customers' => $uniqueCutSales, // Add count of unique cut_sale_id
                'total_bills' => $group->count() // Count of all bill records for this governorate


            ];
        });
        $sortedResults = $results->sortByDesc('total_sales');
        $totalResults = $results->sum('total_sales');
        $totalcusts = $results->sum('unique_customers');
        // dd($totalResults );
        return view('admin.bill_sale.reportsalearea',compact('results','totalResults','totalcusts','sortedResults','fromdata','todata'));
    }

    // public function reportsaleprodarea(Request $request)

    // {
        
    //     $fromdata = $request->get('from_time') 
    //     ? Carbon::parse($request->get('from_time'))->startOfDay()
    //     : Carbon::now()->subMonth()->firstOfMonth()->startOfDay();
        
    //     $todata = $request->get('to_date') 
    //     ? Carbon::parse($request->get('to_date'))->endOfDay()  // Changed to endOfDay()
    //     : Carbon::now()->endOfDay();

    //     $results = Bill_sale_detail::whereIn('status_requ', [0,1,5,6,7,8])//1 = approved  5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied
    //     // ->whereDate('getheader.valued_time', '>=', $fromdata)
    //     // ->whereDate('getheader.valued_time', '<=', $todata)  // Changed to <=
    //     ->get()
    //     ->map(function($item) {
    //         try {
    //             $gov = $item->getheader->getcust->getarea;
    //             // $city = optional(optional(optional($item->getcust)->getarea)->getcity);
    //             return [
    //                 'gov_id' => $gov->id,
    //                 'city' => $gov, // Include the City model object
    //                 'gov_name' => $gov->name_en,
    //                 'amount' => $item->approv_quantity,
    //                 'cut_sale_id' => $item->getheader->cut_sale_id, // Include the cut_sale_id for counting
    //                 'bill_id' => $item->id // Include the bill ID for counting


    //             ];
    //         } catch (\Exception $e) {
    //             return null;
    //         }
    //     })
    //     ->filter()
    //     ->groupBy('gov_id')
    //     ->map(function($group) {

    //          // Get unique cut_sale_id count
    //     $uniqueCutSales = $group->pluck('cut_sale_id')->unique()->count();
    //         return [
    //             'id' => $group->first()['gov_id'],
    //             'name_en' => $group->first()['gov_name'],
    //             'total_sales' => $group->sum('amount'),
    //             'unique_customers' => $uniqueCutSales, // Add count of unique cut_sale_id
    //             'total_bills' => $group->count() // Count of all bill records for this governorate


    //         ];
    //     });
    //     $sortedResults = $results->sortByDesc('total_sales');
    //     $totalResults = $results->sum('total_sales');
    //     $totalcusts = $results->sum('unique_customers');
    //     // dd($results );
    //     return view('admin.bill_sale.reportsaleprodarea',compact('results','totalResults','totalcusts','sortedResults','fromdata','todata'));
    // }
    public function reportsaleprodarea(Request $request)
    {
        $fromdata = $request->get('from_time') 
            ? Carbon::parse($request->get('from_time'))->startOfDay()
            : Carbon::now()->subMonth()->firstOfMonth()->startOfDay();
            
        $todata = $request->get('to_date') 
            ? Carbon::parse($request->get('to_date'))->endOfDay()
            : Carbon::now()->endOfDay();

        $results = Bill_sale_detail::with(['getprod', 'getheader.getcust.getarea'])
            ->whereIn('status_requ', [0,1,5,6,7,8])//0= requsted- 1 = approved  5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied
            // Uncomment this when you want to filter by date
            ->whereHas('getheader', function($q) use ($fromdata, $todata) {
                $q->whereDate('valued_time', '>=', $fromdata)
                ->whereDate('valued_time', '<=', $todata);
            })
            ->get()
            ->map(function($item) {
                try {
                    $product = $item->getprod;
                    $gov = $item->getheader->getcust->getarea;
                    
                    return [
                        'product_id' => $product->id,
                        'product_name' => $product->name_en,
                        'gov_id' => $gov->id,
                        'gov_name' => $gov->name_en,
                        'amount' => $item->approv_quantity,
                        'cut_sale_id' => $item->getheader->cut_sale_id,
                        'bill_id' => $item->id
                    ];
                } catch (\Exception $e) {
                    return null;
                }
            })
            ->filter()
            ->groupBy('product_id') // First group by product_id
            ->map(function($productGroup) {
                // Then group each product's records by gov_id
                $groupedByGov = $productGroup->groupBy('gov_id');
                
                $productName = $productGroup->first()['product_name'];
                
                return [
                    'product_id' => $productGroup->first()['product_id'],
                    'product_name' => $productName,
                    'total_product_sales' => $productGroup->sum('amount'),
                    'governorates' => $groupedByGov->map(function($govGroup) use ($productName) {
                        $uniqueCutSales = $govGroup->pluck('cut_sale_id')->unique()->count();
                        
                        return [
                            'gov_id' => $govGroup->first()['gov_id'],
                            'gov_name' => $govGroup->first()['gov_name'],
                            'total_sales' => $govGroup->sum('amount'),
                            'unique_customers' => $uniqueCutSales,
                            'total_bills' => $govGroup->count(),
                            'product_name' => $productName
                        ];
                    })
                ];
            });

        // Calculate totals
        $totalResults = $results->sum('total_product_sales');
        $totalcusts = $results->sum(function($product) {
            return $product['governorates']->sum('unique_customers');
        });
        // dd($results);
        return view('admin.bill_sale.reportsaleprodarea', compact('results', 'totalResults', 'totalcusts', 'fromdata', 'todata'));
    }
    public function reportsaleprodgov(Request $request)
    {
        $fromdata = $request->get('from_time') 
            ? Carbon::parse($request->get('from_time'))->startOfDay()
            : Carbon::now()->subMonth()->firstOfMonth()->startOfDay();
            
        $todata = $request->get('to_date') 
            ? Carbon::parse($request->get('to_date'))->endOfDay()
            : Carbon::now()->endOfDay();

        $results = Bill_sale_detail::with(['getprod', 'getheader.getcust.getarea'])
            ->whereIn('status_requ', [0,1,5,6,7,8])//0= requsted- 1 = approved  5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied
            // Uncomment this when you want to filter by date
            ->whereHas('getheader', function($q) use ($fromdata, $todata) {
                $q->whereDate('valued_time', '>=', $fromdata)
                ->whereDate('valued_time', '<=', $todata);
            })
            ->get()
            ->map(function($item) {
                try {
                    $product = $item->getprod;
                    $gov = $item->getheader->getcust->getarea->getcity->getgovernorate;
                    // $gov = $item->getcust->getarea->getcity->getgovernorate;
                    return [
                        'product_id' => $product->id,
                        'product_name' => $product->name_en,
                        'gov_id' => $gov->id,
                        'gov_name' => $gov->governorate_name_en,
                        'amount' => $item->approv_quantity,
                        'cut_sale_id' => $item->getheader->cut_sale_id,
                        'bill_id' => $item->id
                    ];
                } catch (\Exception $e) {
                    return null;
                }
            })
            ->filter()
            ->groupBy('product_id') // First group by product_id
            ->map(function($productGroup) {
                // Then group each product's records by gov_id
                $groupedByGov = $productGroup->groupBy('gov_id');
                
                $productName = $productGroup->first()['product_name'];
                
                return [
                    'product_id' => $productGroup->first()['product_id'],
                    'product_name' => $productName,
                    'total_product_sales' => $productGroup->sum('amount'),
                    'governorates' => $groupedByGov->map(function($govGroup) use ($productName) {
                        $uniqueCutSales = $govGroup->pluck('cut_sale_id')->unique()->count();
                        
                        return [
                            'gov_id' => $govGroup->first()['gov_id'],
                            'gov_name' => $govGroup->first()['gov_name'],
                            'total_sales' => $govGroup->sum('amount'),
                            'unique_customers' => $uniqueCutSales,
                            'total_bills' => $govGroup->count(),
                            'product_name' => $productName
                        ];
                    })
                ];
            });

        // Calculate totals
        $totalResults = $results->sum('total_product_sales');
        $totalcusts = $results->sum(function($product) {
            return $product['governorates']->sum('unique_customers');
        });
        // dd($results);
        return view('admin.bill_sale.reportsaleprodgov', compact('results', 'totalResults', 'totalcusts', 'fromdata', 'todata'));
    }
}
