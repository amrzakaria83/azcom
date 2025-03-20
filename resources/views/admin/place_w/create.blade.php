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
                <a  href="{{route('admin.place_ws.index')}}" class="text-muted text-hover-primary">{{trans('lang.vacation')}}</a>
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
        <h1>
            <span>{{trans('lang.contact')}}-{{trans('lang.place')}}-{{trans('lang.addnew')}}</span>
        </h1><br>
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.place_ws.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required text-danger fw-semibold fs-6">{{trans('lang.contact')}}-{{trans('lang.name')}}</label>
                                <div class="col-lg-4 fv-row">
                                    <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" required  name="contact_id" data-control="select2" >
                                        <option disabled selected>Select an option</option>
                                        @if(isset($datacont))
                                            @foreach ($datacont as $item)
                                                    <option value="{{$item->id}}">{{$item->name_en}}</option>
                                                @endforeach
                                        @endif
                                    </select>
                                </div>
                            <!-- </div>

                            <div class="row mb-6"> -->
                                <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.center')}}-{{trans('lang.name')}}</label>
                                <div class="col-lg-4 fv-row">
                                    <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" required  name="center_id" data-control="select2" >
                                        <option disabled selected>Select an option</option>
                                        @if(isset($datacenter))
                                            @foreach ($datacenter as $item)
                                                    <option value="{{$item->id}}">{{$item->name_en}}</option>
                                                @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-semibold fs-6">{{trans('lang.work_hours')}}</label>
                                    <div class="col-sm-5">
                                        <label class="required fw-semibold fs-6 mb-2">{{trans('lang.hour')}}</label>
                                        <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" id="dynamic_work" name="dynamic_work">
                                                <option value="">Select an option</option>
                                                <option value="2">24-{{trans('lang.hour')}}</option>
                                                <option value="0">{{trans('lang.hour')}}-{{trans('lang.work')}}</option>
                                                <option value="1">{{trans('lang.irregular')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <label class="required fw-semibold fs-6 mb-2">{{trans('lang.days')}}</label>
                                            <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" id="on_workrule"   name="on_workrule">
                                                <option value="">Select an option</option>
                                                <option value="2">{{trans('lang.all')}}-{{trans('lang.days')}}</option>
                                                <option value="0">{{trans('lang.days')}}-{{trans('lang.work')}}</option>
                                                <option value="1">{{trans('lang.irregular')}}</option>
                                            </select>
                                    </div>

                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-semibold fs-6">{{trans('lang.work_hours')}}</label>
                                <div class="col-sm-5">
                                    <label class="required fw-semibold fs-6 mb-2">{{trans('lang.start_from')}}</label>
                                        <div class="position-relative d-flex align-items-center">
                                            <input id="kt_datepicker_3" type="time" name="from_time"  placeholder=""  class="form-control form-control-solid text-center" />
                                        </div>
                                </div>
                                <div class="col-sm-5">
                                        <label class="required fw-semibold fs-6 mb-2">{{trans('lang.end_to')}}</label>
                                            <div class="position-relative d-flex align-items-center">
                                                <input id="kt_datepicker_4" type="time" name="to_time"  placeholder=""  class="form-control form-control-solid text-center" />
                                            </div>
                                    </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required  fw-semibold fs-6">{{trans('lang.days')}}-{{trans('lang.work')}}</label>
                                <div class="col-lg-8 fv-row">
                                    <select  data-placeholder="Select an option" class="input-text form-control  form-select  mb-3 mb-lg-0" name="work_days[]" id="work_days" data-allow-clear="true"  multiple="multiple" data-control="select2" >
                                        <option value="0">{{trans('lang.saturday')}}</option>
                                        <option value="1">{{trans('lang.sunday')}}</option>
                                        <option value="2">{{trans('lang.monday')}}</option>
                                        <option value="3">{{trans('lang.tuesday')}}</option>
                                        <option value="4">{{trans('lang.wednesday')}}</option>
                                        <option value="5">{{trans('lang.thursday')}}</option>
                                        <option value="6">{{trans('lang.friday')}}</option>
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
    $('#dynamic_work').on('change', function () {
        if (this.value === "2") {
                $('#kt_datepicker_3').prop('disabled', true);
                $('#kt_datepicker_4').prop('disabled', true);
            } else {
                $('#kt_datepicker_3').prop('disabled', false);
                $('#kt_datepicker_4').prop('disabled', false);
            }

        });
    </script>

<script>
    $('#on_workrule').on('change', function () {
        if (this.value === "2") {
                $('#work_days').prop('disabled', true);
            } else {
                $('#work_days').prop('disabled', false);
            }
        });
    </script>

@endsection