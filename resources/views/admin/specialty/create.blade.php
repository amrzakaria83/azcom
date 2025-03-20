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
                <a  href="{{route('admin.centers.index')}}" class="text-muted text-hover-primary">{{trans('lang.administrators')}}</a>
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
        <h1>
            <span>{{trans('lang.specialties')}}-{{trans('employee.add_new')}}</span>
        </h1><br>
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.specialtys.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-3 text-info">
                                <span class="required">{{trans('lang.type_type')}}</span>
                            </label>
                            <div class="col-sm-3 d-flex align-items-center text-center">
                                <select class="form-select text-center" autofocus required aria-label="Select example" id="type_specialty"  name="type_specialty" >
                                    <option value="0">{{trans('lang.main')}}</option>
                                    <option value="1">{{trans('lang.sub')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6" id="parent">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info" >{{trans('lang.specialties')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option"  class=" input-text form-control  form-select  mb-3 mb-lg-0" data-control="select2"  name="parent_id">
                                    <option  >Select an option</option>
                                    @if(isset($data))
                                        @foreach ($data as $item)
                                                <option value="{{$item->id}}">{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="">{{trans('lang.note')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid" />
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
    $(document).ready(function() {
    $('#parent').hide();
    });
    </script>

<script>
        $('#type_specialty').change(function() {
                var type_specialty = $(this).val();
                if(type_specialty === '1')
            {
                $('#parent').show();
            }else {$('#parent').hide();}
        });


    </script>
@endsection