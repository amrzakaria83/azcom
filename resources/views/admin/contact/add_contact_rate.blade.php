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
                <a  href="{{route('admin.contacts.index')}}" class="text-muted text-hover-primary">{{trans('lang.contact')}}</a>
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
            <span>{{trans('lang.ratings')}}-{{trans('lang.contact')}}-{{trans('lang.addnew')}}</span>
        </h1><br>
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.contacts.storecontact_rate')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('lang.contact')}}-{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" required  name="contact_id" data-control="select2" >
                                    <option value="" disabled selected>Select an option</option>
                                    @if(isset($datacont))
                                        @foreach ($datacont as $item)
                                                <option value="{{$item->id}}">{{$item->name_en}}</option>
                                            @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    
                        @if(isset($datarate))
                                        @foreach ($datarate as $item)
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{$item->name_en}}</label>
                            <div class="col-lg-4 fv-row">
                                <input type="number" name="r{{$item->id}}[{{$item->id}}]" min="{{$item->lowestdegree}}" max="{{$item->largestdegree}}" placeholder="{{trans('lang.rate')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center" />
                            </div>
                            <div class="col-lg-3 fv-row">
                                <span>{{trans('lang.largestdegree')}}:</span><span class="text-info">{{$item->largestdegree}}</span><br>
                                <span>{{trans('lang.lowestdegree')}}:</span><span class="text-danger">{{$item->lowestdegree}}</span>
                            </div>
                        </div>
                            @endforeach
                        @endif


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

<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic,#kt_docs_tinymce_basic2,#kt_docs_tinymce_basic3,#kt_docs_tinymce_basic4"};

    tinymce.init(options);

</script>
@endsection