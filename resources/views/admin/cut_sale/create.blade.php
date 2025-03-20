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
                        <div class="row mb-6">
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

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="" id="name_en" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.phone')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="phone" placeholder="{{trans('lang.phone')}}" value="" id="phone" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.numb')}} {{trans('lang.tax')}} </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="tax_id" placeholder="{{trans('lang.tax')}}" value="" id="tax" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.address')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address" placeholder="{{trans('lang.address')}}" value="" id="address" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
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
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.email')}} </label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('employee.email')}}" value="" id="email" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>

                        <div class="row mb-6">
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
        $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').hide();
        $('#type_type').change(function() {
            var type_type = $(this).val();
            if(type_type === "1"){
                $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').show();
                $('#center_id').hide();
                $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').prop('disabled', false);
            } else {
                $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').prop('disabled', true);
                $('#name_en,#phone,#address,#email,#note,#area_id,#lat,#lng').hide();
                $('#center_id').show();

            }
        })

    });
    </script>

@endsection