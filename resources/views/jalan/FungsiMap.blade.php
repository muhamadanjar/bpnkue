<link rel="stylesheet" type="text/css" href="{{asset('css/map.css')}}">

@extends('layouts.adminlte')
@section('title','Edit Peta Jalan Fungsi')
@section('map_inc')

@endsection
@section('content')

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Fungsi Map</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="row">
		        <!-- left column -->
		        <div class="col-md-12">
		        	<div id="map_canvas"></div>
		        </div>
		        <div class="col-md-4">

		          <div class="btn-group" id="aksi-editor">
		            	<button type="button" class="btn btn-default">Action</button>
                  <button data-toggle="dropdown" class="btn btn-default btn-flat dropdown-toggle" type="button">
                    <i class="caret"></i>&nbsp;
					        </button>
      						<ul class="dropdown-menu icons-right dropdown-menu-right">
      							<li id="li_start"><a href="#" onclick="start()">Mulai Edit</a></li>
                    <li id="li_stop" class="disabled" onclick="stop()"><a href="#">Berhenti Edit</a></li>
                    <!--<li><a href="#" onclick="javascript:setMarkers()">Set Marker</a></li>-->
      		          <li class="divider"></li>
      		          <li id="li_clear"><a href="#" onclick="clearMarkers()">Hilangkan</a></li>
                    <li id="li_simpan" class="disabled"><a href="#" id="save">Simpan</a></li>
    					    </ul>
				      </div>
              <textarea name="points" id="points" class="form-control disabled" style="display:none" readonly="readonly">{{ $shape_line }}</textarea>
              <input type="hidden" name="id" id="id" value="{{ $jalan->id }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">


            </div>
		      </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
    </div>
@endsection
@section('js_tambahan')
<script type="text/javascript" src="{{ asset('/js/map/editor-polyline.js') }}"></script>
<script type="text/javascript">
var map;
function initialize() {
    map = new google.maps.Map(document.getElementById('map_canvas'), {
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
    initEditPolyline(map);
}
</script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAyGT-CSg1nb0YBLihgn8vk9zfbbkk-f1c&callback=initialize" async defer></script>
<script type="text/javascript">
  (function($, window, document){

    //load();

    $('#save').click(function(e){
      var shape_line = $('#points');
      //console.log(datapostgis);
      datapostgis = "";
      var txt = document.getElementById(id);

      var lines = txt.value.split(/\n/);

      for (var i in lines) {
          var ps = lines[i].split(/,/);

          if (ps.length >= 2) {
            console.log("PS",lines[i]);
            var countjson = ps.length;
            var last_index = countjson - 1;
            comma = (i == 0) ? "":",\n";
            datapostgis += comma+ps[1]+" "+ps[0];

          }
      }
      console.log("Postgis",datapostgis);
      var formData = {
          id: $('#id').val(),
          shape_line: JSON.stringify(polylineStore),
          postgis: datapostgis,
          //'_token': $('input[name=_token]').val(),
      };
      xhr_post('/admin/jalan/fungsi/mappost',formData)

    });

  }(jQuery, window, document));
</script>

@endsection
