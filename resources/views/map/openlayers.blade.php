
@extends('layouts.adminlte-topnav')
@section('title','Peta Google')
@section('css_tambahan')
  <link rel="stylesheet" href="https://openlayers.org/en/v4.0.1/css/ol.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('vendor/jstree/themes/default/style.min.css')}}" />
    <style>
      .rotate-north {
        top: 65px;
        left: .5em;
      }
      .ol-touch .rotate-north {
        top: 80px;
      }
    </style>
    <style>
      .tooltip {
        position: relative;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 4px;
        color: white;
        padding: 4px 8px;
        opacity: 0.7;
        white-space: nowrap;
      }
      .tooltip-measure {
        opacity: 1;
        font-weight: bold;
      }
      .tooltip-static {
        background-color: #ffcc33;
        color: black;
        border: 1px solid white;
      }
      .tooltip-measure:before,
      .tooltip-static:before {
        border-top: 6px solid rgba(0, 0, 0, 0.5);
        border-right: 6px solid transparent;
        border-left: 6px solid transparent;
        content: "";
        position: absolute;
        bottom: -6px;
        margin-left: -7px;
        left: 50%;
      }
      .tooltip-static:before {
        border-top-color: #ffcc33;
      }    </style>
  </head>


  
  <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
  <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
  <script src="https://openlayers.org/en/v4.0.1/build/ol.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-kEXeuhgPWY__PZ9mzePYwJuMwOzLyC0&libraries=places" async defer></script>

  

@endsection
@section('content')
  <div class="row">
    <div class="col-md-9">
      <div id="map" class="map"></div>  
    </div>
    <div class="col-md-3">
      <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Menu Utama</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="popup" class="ol-popup">
                  <div id="popup-content"></div>
              </div>
              <div class="box-group" id="accordion">
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Layer Utama
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                        <div id="layertree" class="tree"></div>
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Legenda
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                      <div id="legenda"></div>
                      <div id="legendDiv"></div>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Draw
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                      <button id="drawButton">Draw</button>
                      <form class="form-inline">
                        <label>Geometry type &nbsp;</label>
                        <select id="type">
                          <option value="Point">Point</option>
                          <option value="LineString">LineString</option>
                          <option value="Polygon">Polygon</option>
                          <option value="Circle">Circle</option>
                        </select>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
      </div>
      
    </div>
  </div>
    
    
    
@endsection

@section('js_tambahan')
<script type="text/javascript" src="{{ asset('vendor/jstree/jstree.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('searchOLControl.js') }}"></script>
<script type="text/javascript" src="{{ asset('draw.js') }}"></script>
<script type="text/javascript" src="{{ asset('openlayers.js') }}"></script>



@endsection