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
                <a  href="#" class="text-muted text-hover-primary">{{trans('lang.settings')}}</a>
            </li>
            {{-- <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li> --}}
            
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
                <form action="{{route('admin.settings.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-dark text-active-primary pb-5 active" data-bs-toggle="tab" href="#setting">
                                    <i class="las la-cog text-primary fs-3"></i>
                                    {{trans('lang.settings')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#media">
                                    <i class="las la-image text-primary fs-3"></i>
                                    {{trans('lang.media')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#mapsec">
                                    <i class="las la-map text-primary fs-3"></i>
                                    {{trans('lang.map')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#social">
                                    <i class="las la-hashtag text-primary fs-3"></i>
                                    {{trans('lang.social')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark text-active-primary pb-5" data-bs-toggle="tab" href="#description">
                                    <i class="las la-comment text-primary fs-3"></i>
                                    {{trans('lang.seo')}}
                                </a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="setting" role="tabpanel">
                                <!--begin::Form-->
                                <form action="{{route('admin.settings.update')}}" method="POST" class="form" >
                                    @csrf
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.project_name_ar')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="name_ar" value="{{$data->name_ar}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.project_name_en')}} </span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="name_en" value="{{$data->name_en}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.email')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" name="email" value="{{$data->email}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.email2')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" name="email2" value="{{$data->email2}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.phone')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="tel" name="phone" value="{{$data->phone}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span> {{trans('lang.phone2')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="tel" name="phone2" value="{{$data->phone2}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.whatsapp')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="tel" name="whatsapp" value="{{$data->whatsapp}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.address')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="address" value="{{$data->address}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.address2')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="address2" value="{{$data->address2}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.location_on_map')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="location" value="{{$data->location}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row py-5">
                                        <div class="col-md-9 offset-md-3">
                                            <div class="d-flex">
                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">{{trans('exam.save')}}</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Action buttons-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <div class="tab-pane fade" id="media" role="tabpanel">
                                <!--begin::Form-->
                                <form action="{{route('admin.settings.update')}}" method="POST" class="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>{{trans('lang.logo')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                @if ($data->getMedia('logo')->count())
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('logo')}})"></div>
                                                @else
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
                                                @endif
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                </label>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                            </div>
            
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span> {{trans('lang.logo_dark')}} </span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                @if ($data->getMedia('logoDark')->count())
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('logoDark')}})"></div>
                                                @else
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
                                                @endif
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <input type="file" name="logodark" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                </label>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                            </div>
            
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>favicon</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                @if ($data->getMedia('fav')->count())
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('fav')}})"></div>
                                                @else
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
                                                @endif
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <input type="file" name="fav" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                </label>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                            </div>
            
                                        </div>
                                    </div>

                                    <div class="row py-5">
                                        <div class="col-md-9 offset-md-3">
                                            <div class="d-flex">
                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">{{trans('exam.save')}}</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                 </div>
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <div class="tab-pane fade" id="social" role="tabpanel">
                                <!--begin::Form-->
                                <form action="{{route('admin.settings.update')}}" method="POST" class="form">
                                    @csrf
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Facebook</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="facebook" value="{{$data->facebook}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Twitter</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="twitter" value="{{$data->twitter}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Youtube</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="youtube" value="{{$data->youtube}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Linkedin</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="linkedin" value="{{$data->linkedin}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Instagram</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="instagram" value="{{$data->instagram}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Snapchat</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="snapchat" value="{{$data->snapchat}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Tiktok</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="tiktok" value="{{$data->tiktok}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row py-5">
                                        <div class="col-md-9 offset-md-3">
                                            <div class="d-flex">
                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">{{trans('exam.save')}}</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                 </div>
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <div class="tab-pane fade" id="mapsec" role="tabpanel">
                                <!--begin::Form-->
                                <form action="{{route('admin.settings.update')}}" method="POST" class="form">
                                    @csrf

                                    <div id="map" style="height: 300px;"></div>
                                    <div class="mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Lat </label>
                                        <div class="col-lg-10 fv-row">
                                            <input type="text" name="lat" id="lat" placeholder="LAT" value="{{$data->lat}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Lng</label>
                                        <div class="col-lg-10 fv-row">
                                            <input type="text" name="lng" id="lng" placeholder="LNG" value="{{$data->lng}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                        </div>
                                    </div>

                                    <div class="row py-5">
                                        <div class="col-md-9 offset-md-3">
                                            <div class="d-flex">
                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">{{trans('exam.save')}}</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                 </div>
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <div class="tab-pane fade" id="description" role="tabpanel">
                                <!--begin::Form-->
                                <form action="{{route('admin.settings.update')}}" method="POST" class="form">
                                    @csrf

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>keywords ar</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="keywords_ar" value="{{$data->keywords_ar}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>description ar</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="description_ar" class="form-control form-control-solid">{{$data->description_ar}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>keywords en</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="keywords_en" value="{{$data->keywords_en}}" class="form-control form-control-solid" />
                                        </div>
                                    </div>

                                    <div class="row fv-row mb-7">
                                        <div class="col-md-3 text-md-end">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>description en</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="description_en" class="form-control form-control-solid">{{$data->description_en}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row py-5">
                                        <div class="col-md-9 offset-md-3">
                                            <div class="d-flex">
                                                <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">{{trans('exam.save')}}</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <!--end::Form-->
                            </div>
                        </div>

                    </div>

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
            const myLatlng = { lat: 30.061655884503978, lng: 31.216855560916457};
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

<script src="{{ URL::asset('dash/assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<script>
    var options = {selector: "#kt_docs_tinymce_basic"};

    tinymce.init(options);

</script>
@endsection