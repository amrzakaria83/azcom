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
                <a  href="{{route('admin.employees.index')}}" class="text-muted text-hover-primary">{{trans('lang.administrators')}}</a>
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
                <form action="{{route('admin.employees.storehierarchy')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                    <input type="hidden" name="id" value="{{$data->id}}" />

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-3">{{trans('employee.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <h1>{{$data->name_en}}</h1>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.type_type')}} {{trans('employee.hierarchy')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0" id="type_hierarchy"  name="type_hierarchy">
                                    <option selected disabled>Select an option</option>
                                    <option value="0">{{trans('lang.main')}}</option>
                                    <option value="1">{{trans('lang.sub')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.above_hierarchy')}}</label>
                                <div class="col-lg-8 fv-row">
                                    <select  data-placeholder="Select an option" class="input-text form-control  form-select  mb-3 mb-lg-0" name="above_hierarchy" id="above_hierarchy" data-allow-clear="true"   data-control="select2" >
                                    <option selected disabled>Select an option</option>
                                        @if(@isset($dataemp))
                                                @foreach ($dataemp as $item)
                                                    <option value="{{$item->id}}">{{$item->name_en}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required text-info fw-semibold fs-6">{{trans('lang.have')}} {{trans('lang.area')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" id="status_area" name="status_area">
                                <option selected disabled>Select an option</option>
                                <option value="0">{{trans('employee.active')}}</option>
                                <option value="1">{{trans('employee.notactive')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.area')}}</label>
                                <div class="col-lg-8 fv-row">
                                    <select  data-placeholder="Select an option" class="input-text form-control  form-select  mb-3 mb-lg-0" name="area[]" id="area" data-allow-clear="true"  multiple="multiple" data-control="select2" >
                                            <option  >Select an option</option>
                                            @if(isset($dataarea))
                                                @foreach ($dataarea as $item)
                                                    @if ($item->country_id === "EGY")
                                                        <option value="{{$item->id}}">{{$item->name_en}}-
                                                        <span class="text-info fs-3">{{$item->getcity->getgovernorate->governorate_name_en}}</span>    
                                                        <span class="text-info fs-3">{{$item->getcity->city_name_en}}</span>
                                                        -<span class="text-info fs-3">{{trans('lang.egypt')}}</span>

                                                        </option>
                                                        @elseif ($item->country_id === "UAE")
                                                        <option value="{{$item->id}}">{{$item->name_en}}
                                                            -<span class="text-info fs-3">{{$item->getcity->name_en}}</span>
                                                            -<span class="text-info fs-3">{{trans('lang.uae')}}</span>

                                                        </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </select>
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
    $('#above_hierarchy').prop('disabled', true);
    $('#area').prop('disabled', true);
    });

</script>
<script>
    $('#type_hierarchy').change(function() {
        var selectedopt = $(this).val();

        if(selectedopt == 0){
            $('#above_hierarchy').prop('disabled', true);

        }
        if(selectedopt == 1){
            $('#above_hierarchy').prop('disabled', false);

        }
        
    })


</script>
<script>
    $('#status_area').change(function() {
        var selectedarea = $(this).val();
        if(selectedarea == 0){
            $('#area').prop('disabled', false);
        }
        if(selectedarea == 1){
            $('#area').prop('disabled', true);
        }

    })


</script>

@endsection