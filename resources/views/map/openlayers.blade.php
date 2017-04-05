<link rel="stylesheet" href="https://openlayers.org/en/v4.0.1/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
<script src="https://openlayers.org/en/v4.0.1/build/ol.js"></script>
<div id="map" class="map"></div>
<form class="form">
      <label>Page size </label>
      <select id="format">
        <option value="a0">A0 (slow)</option>
        <option value="a1">A1</option>
        <option value="a2">A2</option>
        <option value="a3">A3</option>
        <option value="a4" selected>A4</option>
        <option value="a5">A5 (fast)</option>
      </select>
      <label>Resolution </label>
      <select id="resolution">
        <option value="72">72 dpi (fast)</option>
        <option value="150">150 dpi</option>
        <option value="300">300 dpi (slow)</option>
      </select>
</form>
<button id="export-pdf">Export PDF</button>
<script>
	var urlesri = 'http://localhost:6080/ArcGIS/rest/services/' +
          'PANDEGLANG/Peta_Administrasi/MapServer';
    var map = new ol.Map({
        layers: [
          	new ol.layer.Tile({
		        source: new ol.source.OSM()
		    }),
		    
          	new ol.layer.Tile({
	            source: new ol.source.XYZ({
	              
	              	url: 'http://localhost:6080/ArcGIS/rest/services/' +
                  'PANDEGLANG/Peta_Administrasi/MapServer/tile/{z}/{y}/{x}'
	            })
	        })
        ],
        target: 'map',
        view: new ol.View({
        	projection: 'EPSG:4326',
          	center: [106.0764884,-6.3252738],
          	zoom: 12
        })
    });
</script>

<script type="text/javascript">
	var dims = {
        a0: [1189, 841],
        a1: [841, 594],
        a2: [594, 420],
        a3: [420, 297],
        a4: [297, 210],
        a5: [210, 148]
      };

    var loading = 0;
    var loaded = 0;
	var exportButton = document.getElementById('export-pdf');

    exportButton.addEventListener('click', function() {

        exportButton.disabled = true;
        document.body.style.cursor = 'progress';

        var format = document.getElementById('format').value;
        var resolution = document.getElementById('resolution').value;
        var dim = dims[format];
        var width = Math.round(dim[0] * resolution / 25.4);
        var height = Math.round(dim[1] * resolution / 25.4);
        var size = /** @type {ol.Size} */ (map.getSize());
        var extent = map.getView().calculateExtent(size);

        var source = raster.getSource();

        var tileLoadStart = function() {
          ++loading;
        };

        var tileLoadEnd = function() {
          ++loaded;
          if (loading === loaded) {
            var canvas = this;
            window.setTimeout(function() {
              loading = 0;
              loaded = 0;
              var data = canvas.toDataURL('image/png');
              var pdf = new jsPDF('landscape', undefined, format);
              pdf.addImage(data, 'JPEG', 0, 0, dim[0], dim[1]);
              pdf.save('map.pdf');
              source.un('tileloadstart', tileLoadStart);
              source.un('tileloadend', tileLoadEnd, canvas);
              source.un('tileloaderror', tileLoadEnd, canvas);
              map.setSize(size);
              map.getView().fit(extent);
              map.renderSync();
              exportButton.disabled = false;
              document.body.style.cursor = 'auto';
            }, 100);
          }
        };

        map.once('postcompose', function(event) {
          source.on('tileloadstart', tileLoadStart);
          source.on('tileloadend', tileLoadEnd, event.context.canvas);
          source.on('tileloaderror', tileLoadEnd, event.context.canvas);
        });

        map.setSize([width, height]);
        map.getView().fit(extent);
        map.renderSync();

    }, false);
</script>