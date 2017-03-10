var trafficLayerToggle = false;
function initTraffic(map) {
  var trafficLayer = new google.maps.TrafficLayer();
  if (trafficLayerToggle) {
      trafficLayer.setMap(map);
  }
}
function TrafficControl(controlDiv,map) {
  var control = this;
  control.center_ = center;
  controlDiv.style.clear = 'both';
  var TrafficUI = document.createElement('div');
  TrafficUI.id = 'TrafficUI';
  TrafficUI.title = 'Traffic Layer';
  controlDiv.appendChild(TrafficUI);

  var input = document.createElement('input');
  input.id = 'pac-input';
  input.type = 'checkbox';
  TrafficUI.appendChild(input);
}
function changeTraffic() {
  if (trafficLayerToggle == true) {
    trafficLayerToggle = false
  }else {
    trafficLayerToggle = true;
  }
}
