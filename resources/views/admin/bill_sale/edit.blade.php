@extends('admin.layout.master')

@section('css')
    <style>
        .approv_sellpriceproduct[readonly] {
            background-color: #f3f3f3; /* Light gray background */
            cursor: not-allowed; /* Change cursor to indicate non-editable */
        }
    </style>
@endsection

@section('style')
    
@endsection

@section('breadcrumb')
<div class="d-flex align-items-center" id="kt_header_nav">
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <a  href="{{url('/admin')}}">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                {{trans('lang.dashboard')}}
            </h1>
        </a>
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted px-2">
                <a  href="{{route('admin.cut_sales.index')}}" class="text-muted text-hover-primary">{{trans('lang.cut_sales')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('employee.add_new')}}  
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
            <div class="card-body p-9">
                    <div class="row mb-6">
                        <!--begin::Table-->
                        <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table">
                            <!--begin::Table head-->
                            <thead class="bg-light-dark pe-3">
                                <!--begin::Table row-->
                                <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                    
                                    
                                    <th class="min-w-125px text-start text-center">{{trans('lang.customer')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.valued_date')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.total')}} {{trans('lang.value')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.name')}}</th>
                                    <!-- <th class="min-w-125px text-start text-center">{{trans('lang.tax_id')}}</th> -->
                                    
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold text-center">
                                @if(isset($datahead))
                                    <tr>
                                        <td class="text-center">{{$datahead->getcust->name_en}}</td>
                                        <td class="text-center">{{date('Y-m-d', strtotime($datahead->valued_time))}}</td>
                                        <td class="text-center">{{$datahead->totalsellprice}}</td> 
                                        <td class="text-center">{{$datahead->getemp->name_en}}</td>
                                    </tr>
                                @endif
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <form action="{{route('admin.bill_sales.storepermonesale')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    @if(isset($datahead))
                    <input type="hidden" name="headid" value="{{$datahead->id}}" />
                    @endif
                    <div class="separator separator-content border-dark my-15">
                    
                        <span class="w-250px fw-bold text-info fs-2">{{trans('lang.products')}}</span>
                        
                                <button type="submit" id="kt_account_profile_details_submit" class="btn  btn-success btn-lg" >
                                {{trans('lang.total')}} {{trans('lang.approved')}}
                                </button>
                         
                        </div>
                    <div class="row mb-6">
                        <!--begin::Table-->
                        <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table">
                            <!--begin::Table head-->
                            <thead class="bg-light-dark pe-3">
                                <!--begin::Table row-->
                                <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                    
                                    <th class="min-w-125px text-start text-center"></th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.approved')}} {{trans('lang.quantity')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.approved')}} {{trans('lang.discount_rate')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.approved')}} {{trans('lang.pharmacist')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.products')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.request')}} {{trans('lang.quantity')}}</th>
                                    <th class="min-w-125px text-start text-center">{{trans('lang.request')}} {{trans('lang.sell_price')}}</th>
                                    
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                           
                            <tbody class="text-gray-600 fw-bold text-center">
                                @if(isset($data))
                                    @foreach($data as $order)
                                    <tr>
                                        <td class="text-center">
                                        <input type="hidden" id="order" name="order" value="{{$order}}" />
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="approv_quantity[{{$order->id}}]"  min="0" id="approv_quantity[{{$order->id}}]"
                                                data-row-id="{{$order->id}}" value="{{$order->quantityproduc}}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-danger text-center bg-light-primary approv_quantity"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="approv_percent[{{$order->id}}]"  min="0" id="approv_percent[{{$order->id}}]"
                                                data-row-id="{{$order->id}}" value="{{$order->percent}}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-info text-center bg-light-primary approv_percent"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="approv_sellpriceproduct[{{$order->id}}]"  min="0" id="approv_sellpriceproduct[{{$order->id}}]"
                                                data-row-id="{{$order->id}}" value="{{$order->sellpriceph}}"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-info text-center bg-light-primary approv_sellpriceproduct" readonly />
                                        </td>
                                        <td class="text-center" >{{$order->getprod->name_en}}</td>
                                        <td class="text-center" >{{$order->quantityproduc}}</td>
                                        <td class="text-center" data-row-id="{{$order->id}}">{{$order->sellpriceproduct}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            </form>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>

                



            </div>

    </div>
</div>

@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all elements with the class 'approv_percent'
    const percentInputs = document.querySelectorAll('.approv_percent');

    percentInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Get the row ID from the data-row-id attribute
            const rowId = this.getAttribute('data-row-id');
            console.log(`Row ID: ${rowId}`); // Debug: Log the row ID

            // Get the corresponding sell price from the table cell
            const sellPriceCell = document.querySelector(`td[data-row-id="${rowId}"]`);
            console.log(`Sell Price Cell:`, sellPriceCell); // Debug: Log the sell price cell

            if (!sellPriceCell) {
                console.error(`Sell price cell not found for row ID ${rowId}`);
                return;
            }

            // Parse the sell price, removing non-numeric characters
            const sellPrice = parseFloat(sellPriceCell.textContent.replace(/[^0-9.]/g, ''));
            console.log(`Sell Price: ${sellPrice}`); // Debug: Log the sell price

            // Ensure the sell price is a valid number
            if (isNaN(sellPrice)) {
                console.error(`Invalid sell price for row ID ${rowId}`);
                return;
            }

            // Get the percentage value from the input
            const percentValue = parseFloat(this.value) || 0; // Default to 0 if empty
            console.log(`Percent Value: ${percentValue}`); // Debug: Log the percent value

            // Calculate the new sell price based on the percentage
            const newSellPrice = (100 - percentValue) / 100 * sellPrice;
            console.log(`New Sell Price: ${newSellPrice}`); // Debug: Log the new sell price

            // Find the corresponding 'approv_sellpriceproduct' input field
            const sellPriceInput = document.querySelector(`input[name="approv_sellpriceproduct[${rowId}]"]`);
            console.log(`Sell Price Input:`, sellPriceInput); // Debug: Log the sell price input

            // Update the value of the 'approv_sellpriceproduct' input field
            if (sellPriceInput) {
                sellPriceInput.value = newSellPrice.toFixed(2); // Round to 2 decimal places
            }
        });
    });
});
    </script>
@endsection