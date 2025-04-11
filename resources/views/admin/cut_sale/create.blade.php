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
                <a  href="{{route('admin.cut_sales.index')}}" class="text-muted text-hover-primary">{{trans('lang.customer')}}</a>
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
        <!-- <h1>
            <span>{{trans('lang.cut_sales')}}-{{trans('employee.add_new')}}</span>
        </h1><br> -->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.cut_sales.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">
                        <div class="card-header d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('employee.save')}}</button>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info"> {{trans('lang.type_type')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" id="type_type" name="type_type">
                                <option value="0">{{trans('lang.center')}}</option>
                                <option value="1">{{trans('employee.add_new')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6" id="centers">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.center')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0" id="center_id" name="center_id">
                                <option value="">Select an option</option>
                                    @foreach ($data as $asd)
                                        <option value="{{$asd->id}}" >{{$asd->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6" id="areas">
                            <label class="col-lg-2 col-form-label fw-semibold required fs-3 text-info">{{trans('lang.area')}} {{trans('lang.center')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control form-select  mb-3 mb-lg-0" id="area_id" name="area_id" data-control="select2" >
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

                        <div class="row mb-6" id="name_ens">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="" id="name_en" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6" id="phones">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.phone')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="phone" placeholder="{{trans('lang.phone')}}" value="" id="phone" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.payment_method')}}</label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0 text-center"  id="payment_method_id" name="payment_method_id"  >
                                    <option  disabled >Select an option</option>
                                        @foreach (\App\Models\Cust_payment_method::where('status',0)->get() as $item)
                                            <option value="{{$item->id}}">{{$item->name_en}}</option>
                                        @endforeach
                                        <option value="add">{{trans('lang.add')}} {{trans('lang.payment_method')}}</option>
                                </select> 
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.numb')}} {{trans('lang.tax')}} </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="tax_id" placeholder="{{trans('lang.tax')}}" value="" id="tax" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6" id="addresss">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.address')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address" placeholder="{{trans('lang.address')}}" value="" id="address" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        
                        <div class="row mb-6" id="emails">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.email')}} </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('employee.email')}}" value="" id="email" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6" id="notes">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" id="note" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('lang.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                            <select   data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="status">
                                    <option value="0">{{trans('employee.active')}}</option>
                                    <option value="1">{{trans('employee.notactive')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">lat</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="lat" id="lat" placeholder="lat" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">lng</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="lng" id="lng" placeholder="lng" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">

                        <div id="map" style="height: 300px;"></div>
                        </div>

                    </div>

                    
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>

            <div class="modal fade" id="kt_modal_filterunite" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_filter_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">اضافة وحدة</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body  mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form action="{{route('admin.cust_payment_methods.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                    @csrf
                                    <div class="d-flex flex-column  me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{trans('lang.name')}}</label>
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-dark" />
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-center text-dark" />
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <span class="required">{{trans('lang.status')}}</span>
                                            </label>
                                            <div class="col-sm-8 d-flex align-items-center text-center">
                                                <select class="form-select text-center" autofocus required aria-label="Select example" id="status" name="status" >
                                                    <option value="0">{{trans('employee.active')}}</option>
                                                    <option value="1">{{trans('employee.notactive')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                                        <button type="submit" class="btn btn-primary" id="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>

            <!--end::Content-->
        </div>
    </div>

@endsection

@section('script')

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsoJSU4k6RgH8tO2gM1WLZBjOFwUF4TcY&callback=initMap&v=weekly&language=ar"
defer
></script>
    <script>
        function initMap() {
            // const myLatlng = { lat: 26.0879164, lng: 43.9878523 };
            const myLatlng = { lat: 30.061655884503978, lng: 31.216855560916457 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13.3,
                center: myLatlng,
            });
  
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "حدد المكان على الخريطة",
                position: myLatlng,
            });

            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                // JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                JSON.stringify('تم تحديد الموقع', null, 2),
                );
                $('#lat').val(mapsMouseEvent.latLng.toJSON().lat);
                $('#lng').val(mapsMouseEvent.latLng.toJSON().lng);
                infoWindow.open(map);
            });
        }

        window.initMap = initMap;
    </script>


<script>
    $(document).ready(function(){
        $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').prop('disabled', true);
        $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng,#name_ens,#areas,#phones,#addresss,#emails,#notes').hide();
        $('#type_type').change(function() {
            var type_type = $(this).val();
            if(type_type === "1"){
                $('#name_ens,#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng,#areas,#phones,#addresss,#emails,#notes').show();
                $('#center_id').hide();
                $('#centers').hide();
                $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').prop('disabled', false);
            } else {
                $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').prop('disabled', true);
                $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng,#name_ens,#areas,#phones,#addresss,#emails,#notes').hide();
                $('#centers').show();
                $('#center_id').show();

            }
        })

    });
    </script>
<script>
$('#payment_method_id').on('change', function() {
            if (this.value == "add") {
                $('#kt_modal_filterunite').modal('show');
            } 
                });
    </script>
@endsection