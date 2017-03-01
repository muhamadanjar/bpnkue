<link rel="stylesheet" type="text/css" href="{{asset('css/map.css')}}">
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAyGT-CSg1nb0YBLihgn8vk9zfbbkk-f1c&libraries=drawing&callback=load" async defer></script>
<script type="text/javascript" src="{{ asset('/map-editor.js') }}"></script>

@extends('layouts.adminlte')
@section('content')

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

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
		        <div class="col-md-8">
		        	<div id="map_canvas"></div>
		        </div>
		        <div class="col-md-4">
		            <div class="btn-group">
		            	<button type="button" class="btn btn-default">Action</button>
					    <button data-toggle="dropdown" class="btn btn-default btn-flat dropdown-toggle" type="button">
					    <i class="caret"></i>&nbsp;
					    </button>
						<ul class="dropdown-menu icons-right dropdown-menu-right">
							<li><a href="#" onclick="javascript:setMarkers()">Set Marker</a></li>
		                    <li class="divider"></li>
		                    <li><a href="#" onclick="clearMarkers()">Clear Markers</a></li>
					    </ul>
				    </div>
		            <textarea id="points" class="form-control"></textarea>
		        </div>
		    </div>

          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
    </div>



    

@stop





