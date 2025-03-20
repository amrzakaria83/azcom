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
                <a  href="{{route('admin.sale_emp_aschiveds.index')}}" class="text-muted text-hover-primary">{{trans('lang.sales')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('lang.editview')}}
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
                <form action="{{route('admin.sale_emp_aschiveds.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                    @if(isset($dataprod))
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.employee')}}</label>
                                <div class="col-lg-8 fv-row">
                                        <span class="fs-2 text-info">{{$data->getemp->name_en}}</span>
                                    </div>
                                </div>
                            @endif
                        @if(isset($dataprod))
                            <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.products')}}</label>
                                <div class="col-lg-8 fv-row">
                                        <span class="fs-2 text-danger">{{$data->getprod->name_en}}</span>
                                    </div>
                                </div>
                            @endif
                            @if(isset($dataprod))
                            <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.sales')}} {{trans('lang.share')}} {{trans('lang.name')}}</label>
                                <div class="col-lg-8 fv-row">
                                        <span class="fs-2 text-success">{{$data->getsaletype->name_en}}</span>
                                    </div>
                                </div>
                            @endif
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.value')}}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="percent" name="percent" placeholder="value" value="{{$data->percent}} %" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-dark" />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="note" name="note" placeholder="note" value="{{$data->note}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-dark" />
                                </div>
                            </div>

                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                    <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                                        <option value="0" @if($data->status == '0') selected @endif >{{trans('employee.active')}}</option>
                                        <option value="1" @if($data->status == '1') selected @endif >{{trans('employee.notactive')}}</option>                                   
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save</button>
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
        $("#kt_datepicker_3").flatpickr({
                        enableTime: false,
                        allowInput: true,
                        dateFormat: "Y-m-d",
                        });
        $("#kt_datepicker_4").flatpickr({
                        enableTime: false,
                        allowInput: true,
                        dateFormat: "Y-m-d",
                        });

</script>

<script>
    $('#dynamic_work').on('change', function() {
        if (this.value === 1) {

            }    })

    </script>
@endsection