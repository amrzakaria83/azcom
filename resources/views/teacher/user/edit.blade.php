@extends('teacher.layout.master')

@section('css')
@endsection

@section('style')
    
@endsection

@section('breadcrumb')
<div class="d-flex align-items-center" id="kt_header_nav">
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <a  href="{{url('/teacher')}}">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                {{trans('lang.dashboard')}}
            </h1>
        </a>
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted px-2">
                <a  href="{{route('teacher.users.index')}}" class="text-muted text-hover-primary">{{trans('lang.accounts')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('account.edit')}}  
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
                <form action="{{route('teacher.users.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('account.name')}}</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name" placeholder="{{trans('account.name')}}" value="{{$data->name}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                    </div>
                                </div>
                                
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                        <span class="required">{{trans('account.phone')}}</span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="tel" name="phone" placeholder="{{trans('account.phone')}}" value="{{$data->phone}}" class="form-control form-control-lg form-control-solid" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                        {{trans('account.password')}}
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Min 6 characters"></i>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="password" name="password" placeholder="{{trans('account.password')}}" value="" class="form-control form-control-lg form-control-solid" />
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('account.is_active')}}</label>
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <input class="form-check-input w-45px h-30px" type="checkbox" name="is_active" value="1" id="allowmarketing" @if($data->is_active == 1) checked="checked" @endif />
                                            <label class="form-check-label" for="allowmarketing"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">

                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('account.save')}}</button>
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