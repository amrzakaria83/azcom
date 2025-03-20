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
                {{-- <a  href="{{route('admin.cashiers.index')}}" class="text-muted text-hover-primary">المهام</a> --}}
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
                <form action="{{route('admin.cashiers.storesession')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">
                        <h1>اعدادت </h1>
                        
                        <div class="row mb-6"> 
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">خزينة البيع</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="cashiersell" name="cashiersell" >
                                    <option>برجاء اختيار خزينة البيع</option>
                                    @foreach ($datacashiar as $asd)
                                    <option value="{{ $asd->id }}" @if($asd->id == session()->get('cashier_sell')) selected @endif>{{ $asd->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6"> 
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">مخزن البيع</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="storesell" name="storesell" >
                                    <option>برجاء اختيار مخزن البيع</option>
                                    @foreach ($datastore as $asd)
                                    <option value="{{ $asd->id }}" @if($asd->id == session()->get('store_sell')) selected @endif >{{ $asd->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6"> 
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">مخزن الشراء</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="storepurshase" name="storepurshase" >
                                    <option>برجاء اختيار مخزن الشراء</option>
                                    @foreach ($datastore as $asd)
                                    <option value="{{ $asd->id }}" @if($asd->id == session()->get('store_purchase')) selected @endif>{{ $asd->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6"> 
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">طريق البيع الرئيسية</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="waysell" name="waysell" >
                                    <option>برجاء اختيار طرق البيع</option>
                                    @foreach ($datawaysell as $asd)
                                    <option value="{{ $asd->id }}" @if($asd->id == session()->get('way_sell')) selected @endif >{{ $asd->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ</button>
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