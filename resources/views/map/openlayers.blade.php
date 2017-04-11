
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
  </head>


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
                        Collapsible Group Success
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                      
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
<script type="text/javascript" src="{{ asset('openlayers.js') }}"></script>

<script type="text/javascript">
  $('#legenda').jstree({
      'core' : {
        'data' : [
        {
          "text" : "Root node",
          "state" : { "opened" : true },
          "children" : [
            {
              "text" : "Child node 1",
              "state" : { "selected" : true },
              "icon" : "jstree-file"
            },
            { "text" : "Child node 2", "state" : { "disabled" : true } }
          ]
        }
      ]

      }
});
</script>
<!--<script>
  var wmsSource = new ol.source.TileWMS({
    url: 'https://ahocevar.com/geoserver/wms',
    params: {'LAYERS': 'ne:ne'},
    serverType: 'geoserver',
    crossOrigin: 'anonymous'
  });

  var wmsLayer = new ol.layer.Tile({
    source: wmsSource
  });
  var view = new ol.View({
      center: ol.proj.fromLonLat([37.40570, 8.81566]),
      zoom: 4
  });
      var map = new ol.Map({
        layers: [
          new ol.layer.Tile({
            source: new ol.source.OSM()
          }), 
          new ol.layer.Group({
            layers: [
              new ol.layer.Tile({
                source: new ol.source.TileJSON({
                  url: 'https://api.tiles.mapbox.com/v3/mapbox.20110804-hoa-foodinsecurity-3month.json?secure',
                  crossOrigin: 'anonymous'
                })
              }),
              new ol.layer.Tile({
                source: new ol.source.TileJSON({
                  url: 'https://api.tiles.mapbox.com/v3/mapbox.world-borders-light.json?secure',
                  crossOrigin: 'anonymous'
                })
              })

            ]
          }),
          wmsLayer
        ],
        target: 'map',
        view: view,
      });

      function bindInputs(layerid, layer) {
        var visibilityInput = $(layerid + ' input.visible');
        visibilityInput.on('change', function() {
          layer.setVisible(this.checked);
        });
        visibilityInput.prop('checked', layer.getVisible());

        var opacityInput = $(layerid + ' input.opacity');
        opacityInput.on('input change', function() {
          layer.setOpacity(parseFloat(this.value));
        });
        opacityInput.val(String(layer.getOpacity()));
      }

      map.getLayers().forEach(function(layer, i) {
        bindInputs('#layer' + i, layer);
        if (layer instanceof ol.layer.Group) {
          layer.getLayers().forEach(function(sublayer, j) {
            bindInputs('#layer' + i + j, sublayer);
          });
        }
      });

      /*$('#layertree li > span').click(function() {
        $(this).siblings('fieldset').toggle();
      }).siblings('fieldset').hide();*/
</script>

<script type="text/javascript">
  
  

  map.on('singleclick', function(evt) {
        document.getElementById('info').innerHTML = '';
        var viewResolution = /** @type {number} */ (view.getResolution());
        var url = wmsSource.getGetFeatureInfoUrl(
            evt.coordinate, viewResolution, 'EPSG:3857',
            {'INFO_FORMAT': 'text/html'});
        if (url) {
          document.getElementById('info').innerHTML =
              '<iframe seamless src="' + url + '"></iframe>';
        }
  });

  map.on('pointermove', function(evt) {
        if (evt.dragging) {
          return;
        }
        var pixel = map.getEventPixel(evt.originalEvent);
        var hit = map.forEachLayerAtPixel(pixel, function() {
          return true;
        });
        map.getTargetElement().style.cursor = hit ? 'pointer' : '';
  });
</script>-->
@endsection