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
                <a  href="{{route('admin.list_contacs.index')}}" class="text-muted text-hover-primary">{{trans('lang.list_contacs')}}</a>
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
                <form action="{{route('admin.list_contacs.storelistdeta')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" id="dataId" value="{{$datalist->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <h1>
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.name')}}</label>
                            <span class="text-info">{{$datalist->getemp->name_en}}</span>-
                            <span>{{$datalist->name_en}}</span>
                            </h1>
                            <div class="separator border-danger my-10"></div>
                            <h1>{{trans('lang.contact')}}</h1>
                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="kt_docs_repeater_basic">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="form-label required">{{trans('lang.name')}}-{{trans('lang.contact')}}:</label>
                                                        <select  data-placeholder="Select an option" required class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  name="contact_id" data-kt-repeater="select2" data-control="select2" >
                                                            <option  disabled selected>Select an option</option>
                                                                @foreach (\App\Models\Contact::where('status' , 0)->get() as $contac)
                                                                    <option value="{{$contac->id}}">{{$contac->name_en}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label required">{{trans('lang.tareget')}} {{trans('lang.visit')}}</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 text-center" required placeholder="Number" name="taregetvisit"/>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="ki-duotone ki-plus fs-3"></i>
                                            Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                                <div class="separator border-danger my-10"></div>
                                <h1>{{trans('lang.center')}}</h1>

                                <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic1">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="kt_docs_repeater_basic1">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="form-label required">{{trans('lang.name')}}-{{trans('lang.center')}}:</label>
                                                        <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  name="center_id" data-kt-repeater1="select2" data-control="select2" >
                                                            <option  disabled selected>Select an option</option>
                                                                @foreach (\App\Models\Center::where('status' , 0)->get() as $contac)
                                                                    <option value="{{$contac->id}}">{{$contac->name_en}}</option>
                                                                    @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label required">{{trans('lang.tareget')}} {{trans('lang.visit')}}</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 text-center" placeholder="Number" name="taregetvisit"/>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="ki-duotone ki-plus fs-3"></i>
                                            Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            
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

<script src="{{asset('dash/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>

<script>
$('#kt_docs_repeater_basic').repeater({
    initEmpty: false,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        $(this).slideDown();
        $(this).find('[data-kt-repeater="select2"]').select2();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    },
    ready: function(){
        // Init select2
        $('[data-kt-repeater="select2"]').select2();
    }
});
</script>

<script>
$('#kt_docs_repeater_basic1').repeater({
    initEmpty: false,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        $(this).slideDown();
        $(this).find('[data-kt-repeater1="select2"]').select2();

    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    },
    ready: function(){
        // Init select2
        $('[data-kt-repeater1="select2"]').select2();
    }
    
});
</script>

@endsection