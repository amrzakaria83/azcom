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
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{route('admin.centers.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body  p-9">
                        <h1>
                            <span>{{trans('lang.center')}}-{{trans('employee.add_new')}}</span>
                            </h1>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('lang.type_type')}} {{trans('lang.center')}} </label>
                            <div class="col-lg-6 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control  form-select  mb-3 mb-lg-0"  name="type_id">
                                    <option disabled selected >Select an option</option>
                                    @if(isset($data))
                                    @foreach ($data as $item)
                                            <option value="{{$item->id}}">{{$item->name_en}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button type="button" class="btn btn-success btn-lg col-3" data-bs-toggle="modal" data-bs-target="#kt_modal_1b">
                                {{trans('lang.type_type')}} {{trans('lang.center')}}-{{trans('lang.addnew')}}
                            </button> 
                        </div>
                        
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('lang.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('lang.name')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold required fs-3 text-info">{{trans('lang.area')}} {{trans('lang.center')}} </label>
                            <div class="col-lg-8 fv-row">
                                <select  data-placeholder="Select an option" class=" input-text form-control form-select  mb-3 mb-lg-0"  name="area_id" data-control="select2" >
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
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.phone')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="phone" placeholder="{{trans('employee.phone')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.phone')}}2</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="phone2" placeholder="{{trans('employee.phone')}}2" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.landline')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="landline" placeholder="{{trans('lang.landline')}}" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.landline')}}2</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="landline2" placeholder="{{trans('lang.landline')}}2" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('employee.email')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('employee.email')}}" value=""  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.website')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="website" placeholder="{{trans('lang.website')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-3 text-info">{{trans('employee.address')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="address" placeholder="{{trans('employee.address')}}" value="" required class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
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
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('lang.location_on_map')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="map_location" placeholder="{{trans('lang.location_on_map')}}" value="" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
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

                        <div id="map" style="height: 300px;"></div>
                        

                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('employee.save')}}</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->

            <div class="">
                <div class="modal fade" tabindex="-1" id="kt_modal_1b">
                    <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" >{{trans('lang.type_type')}}-{{trans('lang.addnew')}}</h3>
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.centers.storetype')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                                            @csrf
                                            
                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label required  fw-semibold fs-6">{{trans('employee.name')}}</label>
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="name_en" required placeholder="{{trans('employee.name')}}" value="" class="form-control form-control-lg form-control-solid" />
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">{{trans('lang.note')}}</label>
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="note" placeholder="{{trans('lang.note')}}" value="" class="form-control form-control-lg form-control-solid" />
                                                </div>
                                            </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


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
@endsection