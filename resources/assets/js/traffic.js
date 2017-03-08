var trafficLayerToggle = false;
function initTraffic(map) {
  var trafficLayer = new google.maps.TrafficLayer();
  if (trafficLayerToggle) {
      trafficLayer.setMap(map);
  }
}

function changeTraffic() {
  if (trafficLayerToggle == true) {
    trafficLayerToggle = false
  }else {
    trafficLayerToggle = true;
  }
}
