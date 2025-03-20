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
                <a  href="{{route('admin.events.index')}}" class="text-muted text-hover-primary">{{trans('lang.events')}}</a>
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
                <form action="{{route('admin.event_contents.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="event_id" value="{{$data->id}}" />
                    <h1>{{$data->name_en}}
                          <span class="fs-4">{{trans('lang.start_from')}}</span><span class="fs-4 text-info">{{$data->from_time}}</span>
                          <span class="fs-4">{{trans('lang.end_to')}}</span><span class="fs-4 text-danger">{{$data->to_time}}</span>
                        </h1>
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info"> {{trans('lang.type_type')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="type_event_content" id="type_event_content">
                                    <option > Select an option </option>
                                    <option value="0" >{{trans('lang.schedule')}}</option>
                                    <option value="1" >{{trans('lang.logistics')}}</option>
                                    <option value="2" >{{trans('lang.point_discussion')}}</option>
                                    <option value="3" >{{trans('lang.recommended_activities')}}</option>
                                    <option value="4" >{{trans('lang.other')}}</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('employee.name')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.start_from')}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="datetime-local" class="form-control mb-3 mb-lg-0" id="from_time" name="from_time" min="{{$data->from_time}}" max="{{$data->to_time}}">
                            </div>
                        {{-- </div>
                        <div class="row mb-6"> --}}
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.end_to')}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="datetime-local" class="form-control mb-3 mb-lg-0" id="to_time" name="to_time" min="{{$data->from_time}}" max="{{$data->to_time}}">
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
                                    <option value="0" @if($data->status == '0') selected @endif >{{trans('employee.active')}}</option>
                                    <option value="1" @if($data->status == '1') selected @endif >{{trans('employee.notactive')}}</option>
                                    
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
$(document).ready(function() {
        $('#from_time').prop('disabled', true);
        $('#to_time').prop('disabled', true);
    });
    </script>
<script>
    $('#type_event_content').on('change', function () {
        if (this.value === "0") {
                $('#from_time').prop('disabled', false);
                $('#to_time').prop('disabled', false);
            } else {
                $('#from_time').prop('disabled', true);
                $('#to_time').prop('disabled', true);
            }

        });
    </script>
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