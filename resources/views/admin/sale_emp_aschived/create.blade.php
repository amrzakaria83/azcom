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
                <form action="{{route('admin.sale_emp_aschiveds.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        
                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.employee')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" required  name="empsaled_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                    @if(isset($dataemp))
                                        @foreach ($dataemp as $item)
                                                <option value="{{$item->id}}">{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}-{{trans('lang.products')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" required  name="prod_id" data-control="select2" >
                                    <option  disabled selected>Select an option</option>
                                    @if(isset($dataprod))
                                        @foreach ($dataprod as $item)
                                                <option value="{{$item->id}}">{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        @if(isset($datasale_type))
                                        @foreach ($datasale_type as $item)
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{$item->name_en}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="text" name="t{{$item->id}}[{{$item->id}}]" placeholder="{{trans('lang.sales')}} {{trans('lang.share')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                            <div class="col-lg-3 fv-row align-middle-item">
                                <span class="align-middle">{{trans('lang.sales')}} {{trans('lang.share')}}:</span><span class="text-info">{{$item->percent}} %</span>
                            </div>
                        </div>
                            @endforeach
                        @endif

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="note" name="note" placeholder="Note" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-dark" />
                            </div>
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">Status</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="status" name="status" >
                                    <option value="0">{{trans('lang.active')}}</option>
                                    <option value="1">{{trans('lang.inactive')}}</option>
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


@endsection