@extends('admin.layout.master')

@section('css')
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
                <a  href="{{route('admin.emp_bill_sales.index')}}" class="text-muted text-hover-primary"></a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('employee.edit')}}   
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form action="{{route('admin.emp_bill_sales.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!-- <input type="hidden" name="id" value="{{$datahead->id}}" /> -->
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <h1>{{$datahead->getcust->name_en}}-{{ date('Y-m-d', strtotime($datahead->valued_time))}} - ({{ round($datahead->approv_sellprice ? $datahead->approv_sellprice : $datahead->totalsellprice) }})</h1>
                        <div class="row mb-6">
                        <span>@if(!empty($datahead->status_order))({{$datahead->status_order}})@endif</span>
                        <span>@if(!empty($datahead->method_for_payment))({{$datahead->method_for_payment}})@endif</span>
                        <span>@if(!empty($datahead->note))({{$datahead->note}})@endif</span>
                        <span>@if(!empty($datahead->note1))({{$datahead->note1}})@endif</span>
                        <span>@if(!empty($datahead->note2))({{$datahead->note2}})@endif</span>
                        <span>@if(!empty($datahead->note3))({{$datahead->note3}})@endif</span>
                        </div>
                        <table class="table align-middle table-rounded table-striped table-row-dashed fs-6" id="kt_datatable_table">
                            <!--begin::Table head-->
                            <thead class="bg-light-dark pe-3">
                                <!--begin::Table row-->
                                <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                                    {{-- <th class="w-10px p-3">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table .form-check-input" value="1" />
                                        </div>
                                    </th> --}}
                                    <th class="min-w-125px text-center">{{trans('lang.name')}} {{trans('lang.products')}}</th>
                                    <th class="min-w-125px text-center">{{trans('lang.approved')}} {{trans('lang.quantity')}}</th>
                                    <th class="min-w-125px text-center">{{trans('lang.approved')}} {{trans('lang.discount_rate')}}</th>
                                    <th class="min-w-125px text-center">{{trans('lang.approved')}} {{trans('lang.pharmacist')}}</th>
                                    <th class="min-w-125px text-center">{{trans('lang.quantity')}}</th>
                                    <th class="min-w-125px text-center">{{trans('lang.sell_price')}} {{trans('lang.public')}} {{trans('lang.unit')}}</th>
                                    <th class="min-w-125px text-center">{{trans('lang.type_type')}}</th>
                                    <th class="min-w-125px text-center">{{trans('employee.employee')}}</th>
                                    <th class="min-w-125px text-center">%</th>
                                    {{-- <th class="min-w-125px text-center">{{trans('employee.action')}}</th> --}}
                                    <!-- <th class="min-w-125px text-start">{{trans('employee.is_active')}}</th> -->
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">
                                @if(isset($datadet))
                                @foreach ( $datadet as $cont)
                                    <tr>
                                        {{-- <td class="text-center"></td> --}}
                                        <td class="text-center">{{$cont->getprod->name_en}}<br>
                                            {{-- {{round(\App\Models\Emp_bill_sale::where('sale_id', $cont->id)->sum('percent'))}}%<br> --}}
                                            {{-- @foreach ($empsale= App\Models\Emp_bill_sale::where('sale_id', $cont->id)->pluck('percent') as $percent)
                                                <div class="badge badge-light-info fw-bold">{{ round($percent) }}%</div>
                                            @endforeach

                                            @if ($empsale->isEmpty())
                                                <div class="badge badge-light-danger fw-bold">No</div>
                                            @endif --}}
                                        </td>
                                        <td class="text-center text-primary">
                                            @if ($cont->approv_quantity != null) 
                                                ({{ round($cont->approv_quantity) }})
                                            @else 
                                                not detected 
                                            @endif
                                        </td>
                                        <td class="text-center text-info">
                                            @if ($cont->approv_percent != null) 
                                                {{ round($cont->approv_percent) }}%
                                            @else 
                                                not detected 
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($cont->approv_sellpriceproduct != null) 
                                                {{ round($cont->approv_sellpriceproduct) }}
                                            @else 
                                                not detected 
                                            @endif
                                        </td>
                                        
                                        <td class="text-center">{{round($cont->quantityproduc)}}</td>
                                        <td class="text-center">{{round($cont->sellpriceproduct)}}</td>
                                        <td class="text-center">{{$datahead->getsaletype->name_en}}</td>
                                        <td class="text-center">
                                        <span class="text-info">
                                            <button type="button" class="btn btn-sm  btn-success btn-active-dark me-2" data-bs-toggle="modal" data-item-id="{{ $cont->id }}" data-bs-target="#kt_modal">
                                                {{trans('lang.addnew')}}
                                            </button> 
                                        </span>

                                        </td>
                                        <td class="text-center">
                                            {{round(\App\Models\Emp_bill_sale::where('sale_id', $cont->id)->sum('percent'))}}%
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>

                    {{-- <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('employee.save')}}</button>
                    </div> --}}
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->

            <div class="">
                <div class="modal fade" tabindex="-1" id="kt_modal" >
                    <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" >{{trans('lang.addnew')}} {{trans('lang.name')}}-{{trans('lang.employee')}}</h3>
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.emp_bill_sales.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                            @csrf
                                            <div class="row mb-6">
                                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}</label>
                                                <div class="col-lg-8 fv-row">
                                                <input type="hidden" name="id" id="dataId" value="" />
                                                    <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" id=""  name="empsaled_id" data-kt-repeater="select2" data-control="select2" >
                                                        <option  disabled selected>Select an option</option>
                                                            @foreach (\app\Models\Employee::where('is_active' , '1')->get() as $asd)
                                                                <option value="{{$asd->id}}">{{$asd->name_en}}</option>
                                                                @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-lg-2 col-form-label required fw-semibold fs-2">%</label>
                                                <div class="col-lg-4 fv-row">
                                                <input type="number" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" name="percent" max="100" style="background-color:rgb(126, 126, 238)" />

                                                </div>
                                            </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="submit" class="btn btn-success">Add</button>
                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')

<script>
    $(document).ready(function() {

        $('#kt_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var itemId = button.data('item-id'); // Use data attribute name
            var modal = $(this);
            modal.find('#dataId').val(itemId);
        });

    });
    </script>
@endsection