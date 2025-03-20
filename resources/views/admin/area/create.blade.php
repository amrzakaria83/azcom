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
            <h1>{{trans('lang.area')}}-{{trans('lang.addnew')}}</h1>
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.areas.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">

                    <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('lang.country')}}</label>
                            <div class="col-lg-10 fv-row">
                                <div class="form-floating border rounded">
                                    <select class="form-select form-select-transparent" @required(true) placeholder="..." id="kt_docs_select2_country" name="country_id">
                                        <option></option>
                                        <option value="EGY" data-kt-select2-country="dash/assets/media/flags/egypt.svg">{{trans('lang.egypt')}}</option>
                                        <option value="UAE" data-kt-select2-country="dash/assets/media/flags/united-arab-emirates.svg">{{trans('lang.uae')}}</option>
                                    </select>
                                    <label for="kt_docs_select2_country">Select a country</label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row mb-6" style="visibility: hidden;" id="egypt"> -->
                        <div class="row mb-6" id="egypt">
                            <label for="governateSelect" class="col-lg-2 col-form-label fw-semibold fs-3 text-info" >
                                <span class="required">{{trans('lang.governorate')}}</span>
                            </label>
                            <div class="col-lg-4 fv-row">
                                <select class="form-select" autofocus id="governateSelect" name="governateSelect" ></select>
                            </div>
                        
                            <label for="citySelect" class="col-lg-2 col-form-label fw-semibold fs-3 text-info" >
                                <span class="required">{{trans('lang.city')}}</span>
                            </label>
                            <div class="col-lg-4 fv-row">
                                <select class="form-select" autofocus id="citySelect" name="citySelect" ></select>
                            </div>
                        </div>

                        <div class="row mb-6" id="uae">
                            <label for="emeratSelect" class="col-lg-2 col-form-label fw-semibold fs-3 text-info" >
                                <span class="required">{{trans('lang.emirate')}}</span>
                            </label>
                            <div class="col-lg-6 fv-row">
                                <select class="form-select" autofocus id="emeratSelect" name="emeratSelect" ></select>
                            </div>
                        
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
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

<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic,#kt_docs_tinymce_basic2,#kt_docs_tinymce_basic3,#kt_docs_tinymce_basic4"};

    tinymce.init(options);

</script>

<script>
// Format options
var optionFormat = function(item) {
    if ( !item.id ) {
        return item.text;
    }

    var span = document.createElement('span');
    var imgUrl = item.element.getAttribute('data-kt-select2-country');
    var template = '';

    template += '<img src="' + imgUrl + '" class="rounded-circle h-20px me-2" alt="image"/>';
    template += item.text;

    span.innerHTML = template;

    return $(span);
}

// Init Select2 --- more info: https://select2.org/
$('#kt_docs_select2_country').select2({
    templateSelection: optionFormat,
    templateResult: optionFormat
});
    </script>


<script>
    $('#kt_docs_select2_country').change(function() {
        // var governorateId = $(this).val();
        var countryId = $(this).val();
        console.log(countryId);
        if(countryId === "EGY"){
            $('#egypt').show();
            $('#uae').hide();
            $('#citySelect').prop('disabled', false);

            $('#governateSelect').prop('disabled', false);
            $('#citySelect').empty();

            $.ajax({
            url: "{{route('admin.areas.getGovernorate')}}",
            type: 'GET',
            data: { 
                // countryId: governorate 
            },
            success: function(response) {
                var governateSelect = $('#governateSelect');
            governateSelect.empty();
            governateSelect.append('<option value="">select</option>');
            $.each(response, function(key, governorate) {
                governateSelect.append('<option value="' + governorate.id + '">' + governorate.governorate_name_en + '</option>');
            });
            }}
            );
            }

        $('#governateSelect').change(function() {
            var governorateId = $(this).val();

            $('#citySelect').prop('disabled', false);
            $.ajax({
            url: "{{route('admin.areas.getCitiesByGovernorate')}}",
            type: 'GET',
            data: { 
                governorate_id: governorateId ,
            },
            success: function(response) {
                var citySelect = $('#citySelect');
            citySelect.empty();
            $.each(response, function(key, city) {
                citySelect.append('<option value="' + city.id + '">' + city.city_name_en + '</option>');
            });
            }}
            );
            })
            if(countryId === "UAE"){
                $('#egypt').hide();
                $('#uae').show();

                $('#emeratSelect').prop('disabled', false);
                $('#citySelect').prop('disabled', true);

            $.ajax({
            url: "{{route('admin.areas.getemrate')}}",
            type: 'GET',
            data: { 
                // countryId: governorate 
            },
            success: function(response) {
                var emeratSelect = $('#emeratSelect');
            emeratSelect.empty();
            $.each(response, function(key, governorate) {
                emeratSelect.append('<option value="' + governorate.id + '">' + governorate.name_en + '</option>');
            });
            }}
            );
            }

        });
        
</script>



@endsection