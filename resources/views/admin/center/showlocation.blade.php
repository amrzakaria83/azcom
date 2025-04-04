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
                <a  href="{{route('admin.typecontacts.index')}}" class="text-muted text-hover-primary">{{trans('lang.administrators')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('employee.profile')}} 
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">
    
        
        <div class="card-body p-9">
        <h1>{{trans('lang.total')}} {{trans('lang.center')}}: {{ $centerslocation->count() }}</h1>            
            <div id="map" style="height: 600px; width: 100%;"></div>
                
                
            </div>

    </div>
</div>

@endsection

@section('script')
<!-- Include Google Maps API -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsoJSU4k6RgH8tO2gM1WLZBjOFwUF4TcY&callback=initMap&v=weekly&language=ar&loading=async"
    defer
></script>


<script>
    // Define initMap globally
    async function initMap() {
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

        // Get centers data from PHP controller
        const centerslocation = {!! json_encode($centerslocation) !!};

        // Default map center (fallback if no centers are available)
        const defaultCenter = { lat: 30.036256869979837, lng: 31.229324340820312 };

        // Initialize the map
        const map = new Map(document.getElementById("map"), {
            zoom: 13.3,
            center: centerslocation.length > 0 ? { lat: parseFloat(centerslocation[0].lat), lng: parseFloat(centerslocation[0].lng) } : defaultCenter,
            mapId: "AIzaSyBKwgDNdZdAvEvCTZU-QvTV3E8-edf_W_4",
        });

        // Function to add a marker
        function addMarker(location, content, color = "#0000FF") {
            const pin = new PinElement({
                background: color,
                borderColor: "#000000",
                glyphColor: "#FFFFFF",
            });

            const marker = new AdvancedMarkerElement({
                map,
                position: location,
                title: content,
                content: pin.element,
            });

            const markerInfoWindow = new google.maps.InfoWindow({
                content: content,
            });

            marker.addEventListener("gmp-click", () => {
                markerInfoWindow.open(map, marker);
            });

            return marker;
        }

        // Add markers for all centers
        const markers = [];
        if (centerslocation && centerslocation.length > 0) {
            centerslocation.forEach((loc) => {
                const marker = addMarker(
                    { lat: parseFloat(loc.lat), lng: parseFloat(loc.lng) },
                    `Center: ${loc.name_en}` // Display center name in the marker title
                );
                markers.push(marker);
            });
        }

        // Fit map to bounds of all markers
        if (markers.length > 0) {
            const bounds = new google.maps.LatLngBounds();
            markers.forEach((marker) => {
                bounds.extend(marker.position);
            });
            map.fitBounds(bounds);
        }
    }

    // Ensure initMap is globally available
    window.initMap = initMap;
</script>

@endsection