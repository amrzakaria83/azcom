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
                <a  href="{{route('admin.event_atts.index')}}" class="text-muted text-hover-primary">{{trans('lang.type_type')}} {{trans('lang.visit')}}</a>
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

        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.event_atts.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" id="empatt_id"  name="empatt_id" data-kt-repeater="select2" data-control="select2" >
                                        <option  disabled selected>Select an option</option>
                                            @foreach (\app\Models\Employee::where('is_active' , '1')->get() as $asd)
                                                <option value="{{$asd->id}}">{{$asd->name_en}}</option>
                                                @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label  fw-semibold fs-6">{{trans('lang.event')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" id="event_id"  name="event_id" data-kt-repeater="select2" data-control="select2" >
                                        <option  disabled selected>Select an option</option>
                                            @foreach (\App\Models\Event::where('status' , 0)->get() as $asd)
                                                <option value="{{$asd->id}}">{{$asd->name_en}}</option>
                                                @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.valued_date')}}</label>
                                    <div class="col-sm-3">
                                            <label class="required fw-semibold fs-6 mb-2">{{trans('lang.start_from')}}</label>
                                                <div class="position-relative d-flex align-items-center">
                                                    <input id="kt_datepicker_3" name="from_time"  placeholder=""  class="form-control form-control-solid text-center" />
                                                </div>
                                        </div>
                                    <div class="col-sm-3">
                                        <label class="required fw-semibold fs-6 mb-2">{{trans('lang.end_to')}}</label>
                                            <div class="position-relative d-flex align-items-center">
                                                <input id="kt_datepicker_4" name="end_time"  placeholder=""  class="form-control form-control-solid text-center" />
                                            </div>
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
        $("#kt_datepicker_3").flatpickr({
                        defaultDate: new Date(new Date()),  // Set day to 1 and then increase by 2 years
                        enableTime: true,
                        allowInput: true,
                        dateFormat: "Y-m-d H:i",
                        });
        $("#kt_datepicker_4").flatpickr({
                        defaultDate: new Date(new Date()).fp_incr(1),  // Set day to 1 and then increase by 2 years
                        enableTime: true,
                        allowInput: true,
                        dateFormat: "Y-m-d H:i",
                        });

</script>
@endsection