<!DOCTYPE html>
<html>
  <head>
    <title>Measure</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.0.1/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.0.1/build/ol.js"></script>
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
  <body>
    <div id="map" class="map"></div>
    <form class="form-inline">
      <label>Measurement type &nbsp;</label>
        <select id="type">
          <option value="length">Length (LineString)</option>
          <option value="area">Area (Polygon)</option>
        </select>
        <label class="checkbox">
          <input type="checkbox" id="geodesic">
          use geodesic measures
        </label>
    </form>
    <script type="text/javascript" src="{{ url('measure.js')}}"></script>
  </body>
</html>