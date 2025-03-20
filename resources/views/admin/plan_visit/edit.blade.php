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
                <a  href="{{route('admin.type_visits.index')}}" class="text-muted text-hover-primary">{{trans('lang.type_type')}} {{trans('lang.visit')}}</a>
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
                <form action="{{route('admin.plan_visits.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                    <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                                <div class="col-lg-8 d-flex align-items-center">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                                        <option value="0" @if($data->status == '0') selected @endif>{{trans('employee.active')}}</option>
                                        <option value="1" @if($data->status == '1') selected @endif>{{trans('employee.notactive')}}</option>                                    
                                    </select>
                                </div>
                            </div>

                    <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.employee')}}</label>
                                <div class="col-lg-3 fv-row">
                                    <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" disabled required id="emphplan_id" name="emphplan_id" data-control="select2" >
                                        <option  disabled selected>Select an option</option>
                                        @if(isset($dataemp))
                                            @foreach ($dataemp as $item)
                                                    <option value="{{$item->id}}" @if($data->emphplan_id == $item->id) selected disabled @endif>{{$item->name_en}}</option>
                                                @endforeach
                                        @endif
                                    </select>
                                </div>
                            <!-- </div>

                            <div class="row mb-6"> -->
                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.type_type')}}-{{trans('lang.visit')}}</label>
                                <div class="col-lg-3 fv-row">
                                    <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" disabled required id="typevist_id" name="typevist_id" data-control="select2" >
                                        <option  disabled >Select an option</option>
                                        @if(isset($datatypv))
                                            @foreach ($datatypv as $item)
                                                    <option value="{{$item->id}}" @if($data->typevist_id == $item->id) selected @else disabled @endif>{{$item->name_en}}</option>
                                                @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.contact')}}</label>
                                <div class="col-lg-3 fv-row">
                                    <select  data-placeholder="Select an option" disabled class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  id="contact_id" name="contact_id" data-control="select2" >
                                        <option  disabled >Select an option</option>

                                        @if(isset($datacont))
                                                @foreach ($datacont as $item)
                                                        <option value="{{$item->id}}" @if($data->contact_id == $item->id) selected @else disabled @endif>{{$item->name_en}}</option>
                                                    @endforeach
                                            @endif
                                    </select>
                                </div>
                            <!-- </div>

                            <div class="row mb-6"> -->
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.center')}}</label>
                                <div class="col-lg-3 fv-row">
                                    <select  data-placeholder="Select an option" disabled class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  id="center_id" name="center_id" data-control="select2" >
                                    <option  disabled >Select an option</option>

                                        @if(isset($datacenter))
                                            @foreach ($datacenter as $item)
                                                    <option value="{{$item->id}}" @if($data->center_id == $item->id) selected @else disabled @endif>{{$item->name_en}}</option>
                                                @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.start_from')}}</label>
                                <div class="col-lg-3 fv-row">
                                <input type="datetime-local" id="from_time" disabled name="from_time" class="form-control mb-3 mb-lg-0" value="{{$data->from_time}}" min="<?php echo date('Y-m-d\TH:i'); ?>">
                                </div>
                            <!-- </div>

                            <div class="row mb-6"> -->
                                <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}} {{trans('lang.visit')}}</label>
                                <div class="col-lg-3 d-flex align-items-center">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" id="status_visit" name="status_visit">
                                        <option value="0" @if($data->status_visit == '0') selected @endif>{{trans('lang.single')}} {{trans('lang.visit')}}</option>
                                        <option value="1" @if($data->status_visit == '1') selected @endif>{{trans('lang.double')}} {{trans('lang.visit')}}</option>                                    
                                        <option value="2" @if($data->status_visit == '2') selected @endif>{{trans('lang.triple')}} {{trans('lang.visit')}}</option>                                    
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label  fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.employee')}}</label>
                                <div class="col-lg-8 fv-row">
                                    <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center" multiple="multiple" id="visit_emp_ass" name="visit_emp_ass[]" data-control="select2" >
                                        <option  disabled >Select an option</option>
                                        @if(isset($dataemp))
                                            @foreach ($dataemp as $item)
                                                    <option value="{{$item->id}} ">{{$item->name_en}}</option>
                                                @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="note" name="note" placeholder="Note" value="{{$data->note}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-dark" />
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
    $('#visit_emp_ass').prop('disabled', true);
    $('#status_visit').on('change', function() {
            var status_visit = $('#status_visit option:selected').val();
            if (status_visit != 0){
                $('#visit_emp_ass').prop('disabled', false);

            }else {
                $('#visit_emp_ass').prop('disabled', true);

            }
        });
    
    });
    </script>
@endsection