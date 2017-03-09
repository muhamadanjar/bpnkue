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

    //Define custom WMS layer for census output areas in WGS84
    var censusLayer =new google.maps.ImageMapType({
      getTileUrl:function (coord, zoom) {
        // Compose URL for overlay tile

        var s = Math.pow(2, zoom);
        var twidth = 256;
        var theight = 256;

        //latlng bounds of the 4 corners of the google tile
        //Note the coord passed in represents the top left hand (NW) corner of the tile.
        var gBl = map.getProjection().fromPointToLatLng(new google.maps.Point(coord.x * twidth / s, (coord.y + 1) * theight / s)); // bottom left / SW
        var gTr = map.getProjection().fromPointToLatLng(new google.maps.Point((coord.x + 1) * twidth / s, coord.y * theight / s)); // top right / NE

        // Bounding box coords for tile in WMS pre-1.3 format (x,y)
        var bbox = gBl.lng() + "," + gBl.lat() + "," + gTr.lng() + "," + gTr.lat();

        //base WMS URL
        var url = "http://localhost/geoserver/jjpan/wms?";

        url += "&service=WMS";           //WMS service
        url += "&version=1.1.0";         //WMS version
        url += "&request=GetMap";        //WMS operation
        url += "&layers=jjpan:jaringan_jalan_fungsi"; //WMS layers to draw
        url += "&styles=";               //use default style
        url += "&format=image/png";      //image format
        url += "&TRANSPARENT=TRUE";      //only draw areas where we have data
        url += "&srs=EPSG:4326";         //projection WGS84
        url += "&bbox=" + bbox;          //set bounding box for tile
        url += "&width=256";             //tile size used by google
        url += "&height=256";
        //url += "&tiled=true";

        return url;                 //return WMS URL for the tile
      }, //getTileURL

      tileSize: new google.maps.Size(256, 256),
      opacity: 0.85,
      isPng: true
    });
    // add WMS layer to map
    // google maps will end up calling the getTileURL for each tile in the map view
    map.overlayMapTypes.push(censusLayer);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyGT-CSg1nb0YBLihgn8vk9zfbbkk-f1c&callback=initialize" async defer></script>
@endsection
@section('js_tambahan')

@endsection
