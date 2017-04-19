<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<title>ESRI MAP 4.3 - Create a 2D map</title>
<style>
  html, body, #viewDiv {
    padding: 0;
    margin: 0;
    height: 100%;
    width: 100%;
  }
  
  .esri-popup .esri-popup-header .esri-title {
      font-size: 18px;
      font-weight: bolder;
    }
    
    .esri-popup .esri-popup-body .esri-popup-content {
      font-size: 14px;
    }
</style>
<link rel="stylesheet" href="https://js.arcgis.com/4.3/esri/css/main.css">
<script src="https://js.arcgis.com/4.3/"></script>
<script>
require([
  "esri/Map",
  "esri/views/MapView",
  "esri/layers/TileLayer",
  "esri/layers/FeatureLayer",
  "esri/tasks/IdentifyTask",
  "esri/tasks/support/IdentifyParameters",
  "dojo/_base/array",
  "dojo/on",
  "dojo/dom",
  "dojo/domReady!"
], function(Map, MapView,TileLayer,FeatureLayer,IdentifyTask,IdentifyParameters,arrayUtils, on, dom){
  var identifyTask, params;
  var layer_Admin = "http://silver-pc:6080/arcgis/rest/services/PANDEGLANG/Peta_Administrasi/MapServer";
  var map = new Map({
    basemap: "streets"
  });
  AddTileLayer();
  var view = new MapView({
    container: "viewDiv",  // Reference to the scene div created in step 5
    map: map,  // Reference to the map object created before the scene
    zoom: 4,  // Sets the zoom level based on level of detail (LOD)
    center: [106.0764884,-6.3252738]  // Sets the center point of view in lon/lat
  });

  view.then(function() {
        // executeIdentifyTask() is called each time the view is clicked
        on(view, "click", executeIdentifyTask);

        // Create identify task for the specified map service
        identifyTask = new IdentifyTask(layer_Admin);

        // Set the parameters for the Identify
        params = new IdentifyParameters();
        params.tolerance = 3;
        params.layerIds = [0, 1, 2 ,3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
        params.layerOption = "top";
        params.width = view.width;
        params.height = view.height;
  });

  function AddTileLayer() {
    var layer = new TileLayer({
      url: layer_Admin
    });
    map.add(layer);
  }

  // Executes each time the view is clicked
  function executeIdentifyTask(event) {
        // Set the geometry to the location of the view click
        params.geometry = event.mapPoint;
        params.mapExtent = view.extent;
        dom.byId("viewDiv").style.cursor = "wait";

        // This function returns a promise that resolves to an array of features
        // A custom popupTemplate is set for each feature based on the layer it
        // originates from
        identifyTask.execute(params).then(function(response) {

          var results = response.results;

          return arrayUtils.map(results, function(result) {

            var feature = result.feature;
            var layerName = result.layerName;
            var table = "<table>";
            console.log(feature);
            feature.attributes.layerName = layerName;
            for(var attr in feature.attributes){
              table += "<tr><td>"+attr+"</td><td>"+feature.attributes[attr]+"</td></tr>";
            }
            table += "</table>";
            feature.popupTemplate = { // autocasts as new PopupTemplate()
                title: layerName,
                content: table
            };
            
            return feature;
          });
        }).then(showPopup); // Send the array of features to showPopup()

        // Shows the results of the Identify in a popup once the promise is resolved
        function showPopup(response) {
          if (response.length > 0) {
            view.popup.open({
              features: response,
              location: event.mapPoint
            });
          }
          dom.byId("viewDiv").style.cursor = "auto";
        }
  }

  
});
</script>
</head>
<body>
  <div id="viewDiv"></div>
</body>
</html>