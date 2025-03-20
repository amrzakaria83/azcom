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
        <input type="hidden" id="checkin_location" name="checkin_location" value="{{$data->checkin_location}}" />
        <input type="hidden" id="checkout_location" name="checkout_location" value="{{$data->checkout_location}}" />
        <input type="hidden" id="centellocation" name="centellocation" value="{{$centellocation}}" />
        <input type="hidden" id="lat" name="lat" value="{{$data->lat ?? ''}}" />
        <input type="hidden" id="lng" name="lng" value="{{$data->lng ?? ''}}" />
        
        <div class="card-body p-9">
            
            <div id="distance"></div>
            <div id="map" style="height: 500px; width: 100%;"></div>
                
                
            </div>

    </div>
</div>

@endsection

@section('script')
<script
    src=""
    defer
></script>

<script>
    async function initMap() {
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");
        const { spherical } = await google.maps.importLibrary("geometry");

        const centellocation = JSON.parse('{!! $centellocation !!}');
        const checkinLocation = "{{$data->checkin_location}}";
        const checkoutLocation = "{{$data->checkout_location}}";

        const map = new Map(document.getElementById("map"), {
            zoom: 13.3,
            center: { lat: {{$data->lat ?? 30.036256869979837}}, lng: {{$data->lng ?? 31.229324340820312}} },
            mapId: "",
        });

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

        const markers = [];

        if (checkinLocation) {
            const [lat, lng] = checkinLocation.split(',');
            const marker = addMarker({ lat: parseFloat(lat), lng: parseFloat(lng) }, "{{trans('lang.check_in')}}", "#00FF00");
            markers.push(marker);
        }

        if (checkoutLocation) {
            const [lat, lng] = checkoutLocation.split(',');
            const marker = addMarker({ lat: parseFloat(lat), lng: parseFloat(lng) }, "{{trans('lang.check_out')}}", "#FF0000");
            markers.push(marker);
        }

        if (centellocation && centellocation.length > 0) {
            centellocation.forEach((loc) => {
                const marker = addMarker({ lat: parseFloat(loc.lat), lng: parseFloat(loc.lng) }, "{{trans('lang.visit')}} {{trans('lang.center')}}");
                markers.push(marker);
            });
        }

        if (markers.length > 0) {
            const bounds = new google.maps.LatLngBounds();
            markers.forEach((marker) => {
                bounds.extend(marker.position);
            });
            map.fitBounds(bounds);
        }

        function calculateDistances(markers) {
            const distances = [];
            for (let i = 0; i < markers.length; i++) {
                for (let j = i + 1; j < markers.length; j++) {
                    const distance = spherical.computeDistanceBetween(
                        markers[i].position,
                        markers[j].position
                    );
                    distances.push({
                        from: markers[i].title,
                        to: markers[j].title,
                        distance: (distance / 1000).toFixed(2) + " km",
                    });
                }
            }
            return distances;
        }

        if (markers.length > 1) {
            const distances = calculateDistances(markers);
            displayDistancesTable(distances);
        }

        function displayDistancesTable(distances) {
            if (distances && distances.length > 0) {
                let tableHtml = `
                    <table class="table align-middle table-rounded table-striped table-row-dashed fs-6 text-center">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>Distance</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                distances.forEach(distance => {
                    tableHtml += `
                        <tr>
                            <td>${distance.from}</td>
                            <td>${distance.to}</td>
                            <td>${distance.distance}</td>
                        </tr>
                    `;
                });

                tableHtml += `
                        </tbody>
                    </table>
                `;

                const tableContainer = document.getElementById('distance');
                tableContainer.innerHTML = tableHtml;
            } else {
                const tableContainer = document.getElementById('distance');
                tableContainer.innerHTML = "";
            }
        }

        map.addListener("click", (mapsMouseEvent) => {
            const clickedLocation = mapsMouseEvent.latLng.toJSON();
            $('#lat').val(clickedLocation.lat);
            $('#lng').val(clickedLocation.lng);
            addMarker(clickedLocation, "الموقع المحدد");
        });
    }

    window.initMap = initMap;
</script>


@endsection