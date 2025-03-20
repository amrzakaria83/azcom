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
                <a  href="{{route('admin.vacationemps.index')}}" class="text-muted text-hover-primary">{{trans('lang.vacation')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('lang.addnew')}}
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
                <form action="{{route('admin.vacationemps.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{auth('admin')->user()->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <h1>
                            {{auth('admin')->user()->name_en}}
                            </h1>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-semibold fs-6">{{trans('lang.vacation')}}<br><span class="text-success" id="timeDifference"></span></label>
                                    <div class="col-sm-3">
                                            <label class="required fw-semibold fs-6 mb-2">{{trans('lang.start_from')}}</label>
                                                <div class="position-relative d-flex align-items-center">
                                                    <input id="kt_datepicker_3" name="vactionfrom"  placeholder=""  class="form-control form-control-solid text-center" />
                                                </div>
                                        </div>
                                    <div class="col-sm-3">
                                        <label class="required fw-semibold fs-6 mb-2">{{trans('lang.end_to')}}</label>
                                            <div class="position-relative d-flex align-items-center">
                                                <input id="kt_datepicker_4" name="vactionto"  placeholder=""  class="form-control form-control-solid text-center" />
                                            </div>
                                    </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                    <span class="required"> 
                                        <span>{{trans('lang.vacation_type')}}</span>
                                </label>
                                <div class="col-sm-3 d-flex align-items-center text-center">
                                    <select class="form-select text-center" autofocus required aria-label="Select example" id="vacationrequesttype" name="vacationrequesttype" >
                                            <option value="0">{{trans('lang.general_leave')}}</option>
                                            <option value="1">{{trans('lang.sick_leave')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                    <span class="required"> 
                                        <span>{{trans('lang.vacation_payment')}}</span>
                                </label>
                                <div class="col-sm-3 d-flex align-items-center text-center">
                                    <select class="form-select text-center" autofocus required aria-label="Select example" id="vacationrequest" name="vacationrequest" >
                                            <option value="0">{{trans('lang.no_salary')}}</option>
                                            <option value="1">{{trans('lang.half_salary')}}</option>
                                            <option value="2">{{trans('lang.full_salary')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">Notes</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="noterequest" name="noterequest" placeholder="Notes" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-dark" />
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
                        defaultDate: new Date(new Date()),  // Set day to 1 and then increase by 2 years
                        enableTime: false,
                        allowInput: true,
                        dateFormat: "Y-m-d",
                        });
        $("#kt_datepicker_4").flatpickr({
                        defaultDate: new Date(new Date()).fp_incr(1),  // Set day to 1 and then increase by 2 years
                        enableTime: false,
                        allowInput: true,
                        dateFormat: "Y-m-d",
                        });

</script>




@endsection