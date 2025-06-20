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
                <a  href="{{route('admin.areas.index')}}" class="text-muted text-hover-primary">{{trans('lang.area')}}</a>
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
                <form action="{{route('admin.areas.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <div class="row mb-8">
                            <div class="col-xl-2">
                                <div class="fs-6 fw-semibold">
                                    {{trans('lang.name')}} 

                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="fw-bold fs-5">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="{{$data->name_en}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-8">
                            <div class="col-xl-2">
                                <div class="fs-6 fw-semibold">{{trans('lang.country')}} </div>
                            </div>
                        @if(isset($data->country_id))
                            @if($data->country_id === "EGY")
                            <div class="col-lg-9">
                                <div class="fw-bold fs-5">{{trans('lang.egypt')}}</div>
                                <div class="fw-bold fs-5">{{trans('lang.governorate')}}:{{$data->getcity->getgovernorate->governorate_name_en}}</div>
                                <div class="fw-bold fs-5">{{trans('lang.city')}}:{{$data->getcity->city_name_en}}</div>
                            </div>
                            @else 
                            <div class="col-lg-9">
                                <div class="fw-bold fs-5">{{trans('lang.uae')}}</div>
                                <div class="fw-bold fs-5">{{trans('lang.emirate')}}:{{$data->getcity->name_en}}</div>
                            </div>
                            @endif

                        @endif
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="{{$data->note}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
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
@endsection