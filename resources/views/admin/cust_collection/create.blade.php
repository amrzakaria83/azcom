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
                <a  href="{{route('admin.cut_sales.index')}}" class="text-muted text-hover-primary">{{trans('lang.customer')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('lang.cust_collection')}}  
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
                <form action="{{route('admin.cust_collections.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.customer')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class="input-text form-control form-select mb-3 mb-lg-0 text-center" id="cut_sale" name="cut_sale" data-control="select2" >
                                        <option  disabled selected>Select an option</option>
                                        @foreach (\App\Models\Cut_sale::where('status' , 0)->get() as $asd)
                                            <option value="{{$asd->id}}" data-custval="{{$asd->value}}" >{{$asd->name_en}}</option>
                                            @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.value')}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="number" name="value" placeholder="{{trans('lang.value')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                        

                        <div class="row mb-6" style="visibility: hidden;">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.balance')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="hidden" id="cust_id" name="cust_id" value="" />
                                <input type="hidden" id="balance_befor" name="balance_befor" value="" />

                                <br><span id="balance_befor_value" class="fs-2"></span>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                                    <option value="0">{{trans('employee.active')}}</option>
                                    <option value="1">{{trans('employee.notactive')}}</option>                                    
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('employee.save')}}</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>

@endsection

@section('script')
<script>
    $('#cut_sale').on('change', function() {
        // Get the selected value of the cust_id dropdown
        var cut_sale_value = $(this).val();

        // Get the selected option element
        var selectedOption = $(this).find('option:selected');
    
        // Get the data-custval attribute value from the selected option
        var custpaValue = selectedOption.data('custval');
        // Disable the cust_id dropdown
        
        // Set the value of cut_sale_id to the selected value of cust_id
        $('#balance_befor').val(custpaValue);
        $('#cust_id').val(cut_sale_value);

        $('#balance_befor_value').text(custpaValue);
        $(this).prop('disabled', true);
    });

    </script>
@endsection