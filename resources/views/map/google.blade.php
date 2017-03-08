<link rel="stylesheet" href="{{ asset('css/map.css') }}"/>
@extends('layouts.adminlte')
@section('css_tambahan')

@endsection
@section('content')
<div class="box">
    <div class="box-header with-border">
          <h3 class="box-title">Map</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div id="mapgoogle"></div>
        </div>
      </div>

    </div>
    <div class="box-footer">
      Footer
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/map/map.js') }}"></script>
<script type="text/javascript">
var map;
var markers = [];
var mapMinZoom = 12,mapMaxZoom = 18;
var infoWindow;
var host = 'https://'+window.location;

function initialize() {
    map = new google.maps.Map(document.getElementById('mapgoogle'), {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(-6.3252738,106.0764884),
        zoom: 13,
        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        scaleControl: false,
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        fullscreenControl: false
    });
    initGeolocation(map);
    initTraffic(map);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyGT-CSg1nb0YBLihgn8vk9zfbbkk-f1c&callback=initialize" async defer></script>
@endsection
@section('js_tambahan')

@endsection
