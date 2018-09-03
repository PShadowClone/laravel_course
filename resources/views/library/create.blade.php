@extends('base_layout._layout')
@section('style')
    <style>
        #map {
            width: 100%;
            height: 300px;
        }
    </style>
@endsection
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-book"></i> Library</div>
                <div class="panel-body">
                    <form action="">
                        <div class="form-group">
                            <a name="click" id="click" class="btn btn-primary">Click</a>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lat" id="lat">
                            <input type="text" name="lng" id="lng">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-map"></i> Map</div>
                <div class="panel-body">
                    <div id="map"></div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>


        $('#click').click(function () {
            var id = '1'
            var age = '14'
            var list = [id]
            $.ajax({
                url: '{{route('ajax.library.check')}}',
                method: 'POST',
                data: {body: list, _token: '{{csrf_token()}}'}
            }).success(function (response) {
                console.log(response)
            }).error(function (error) {
            })
        })
        var map;

        function initMap() {
            var uluru = {lat: -25.344, lng: 131.036};
            map = new google.maps.Map(document.getElementById('map'), {
                center: uluru,
                zoom: 4
            });
            var marker = new google.maps.Marker(
                {
                    position: uluru,
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.BOUNCE,
                });
            map.addListener('click', function (event) {
                var location = event.latLng;
                if (marker === false) {
                    marker = new google.maps.Marker(
                        {
                            position: uluru,
                            map: map,
                            draggable: true
                        });
                }
                placeMarkerAndPanTo(event.latLng, map, marker);
            });
        }

        function placeMarkerAndPanTo(latLng, map, marker) {
            marker.setPosition(latLng)
            $('#lat').val(latLng.lat())
            $('#lng').val(latLng.lng())
            map.panTo(latLng);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjUQGBi_lAuytorrCymHze_dlovqo_9yY&callback=initMap&language={{app()->getLocale()}}"
            async defer></script>
@endsection
