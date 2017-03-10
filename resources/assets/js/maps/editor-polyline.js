var markers = [],polylineStore = [];
var polyline,datapostgis ='';
var id = "points";
var drawingmode = false;
var path = [];
var mapMinZoom = 12;
var mapMaxZoom = 18;
var google;

function initEditPolyline(map) {
  var aksieditor = document.getElementById('aksi-editor');
  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(aksieditor);
  google.maps.event.addListener(map, 'click', function(event) {
      if(drawingmode){
          addMarker(event.latLng);
          displayMarkers();
      }
  });
  var txt = document.getElementById(id);
  if (txt.value !== null) {
      setMarkers();
  }


}

function start(){
    document.getElementById("li_start").classList.add('disabled');
    document.getElementById("li_stop").classList.remove('disabled');
    document.getElementById("li_clear").classList.remove('disabled');
    document.getElementById("li_simpan").classList.remove('disabled');

    drawingmode = true;
}

function stop(){
    drawingmode = false;
    document.getElementById("li_start").classList.remove('disabled');
    document.getElementById("li_stop").classList.add('disabled');
    document.getElementById("li_clear").classList.add('disabled');
    document.getElementById("li_simpan").classList.add('disabled');
}

function showPolyline() {
    if (polyline) {
        polyline.setMap(null);
    }
    path = [];
    for (var i = 0; i < markers.length; i++) {
        var latlng = markers[i].getPosition();
        path.push(latlng);
        markers[i].setTitle("#" + i + ": " + latlng.toUrlValue());
    }
    polyline = new google.maps.Polyline({
        map: map,
        path: path,
        strokeColor: "#0000FF",
        strokeOpacity: 0.5,
        strokeWeight: 8,
    });
}

function clearMarkers() {
    var txt = document.getElementById(id);
    txt.value = '';
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
    polylineStore = [];
    showPolyline();
}

function getMarkerIndex(marker) {
    for (var i = 0; i < markers.length; i++) {
        if (marker == markers[i]) {
            return i;
        }
    }
    return -1;
}

function addMarker(latlng, i) {
    var host = 'http://localhost/';
    var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: true,
        icon: host+'images/maps/waterpark.png'
    });

    /*
    google.maps.event.addListener(marker, 'click', function() {
            var infoWindow = new google.maps.InfoWindow({
                    content: marker.getPosition().toUrlValue(),
                });
            infoWindow.open(map, marker);
        });
    */

    google.maps.event.addListener(marker, 'dragend', function(event) {
        if(drawingmode){

            showPolyline();
            displayMarkers();
        }
    });
    google.maps.event.addListener(marker, 'rightclick', function(event) {
        if(drawingmode){
            removeMarker(marker);
            showPolyline();
            displayMarkers();
        }
    });
    google.maps.event.addListener(marker, 'dblclick', function(event) {
        if(drawingmode){
        var i = getMarkerIndex(marker);
        if (i > 0 && i == markers.length - 1) {
            i--;
        }
        if (i < markers.length - 1) {
            var lat0 = markers[i].getPosition().lat();
            var lng0 = markers[i].getPosition().lng();
            var lat1 = markers[i+1].getPosition().lat();
            var lng1 = markers[i+1].getPosition().lng();
            var latlng = new google.maps.LatLng((lat0+lat1)/2, (lng0+lng1)/2);
            addMarker(latlng, i+1);
        }
        }
    });
    if (i == null || i >= markers.length) {
        markers.push(marker);
    } else {
        markers.splice(i, 0, marker);
    }
    showPolyline();
}

function removeMarker(marker) {
    var i = getMarkerIndex(marker);
    marker.setMap(null);
    markers.splice(i, 1);
    showPolyline();
}

function displayMarkers() {
    var txt = document.getElementById(id);
    txt.value = "";
    polylineStore = [];
    datapostgis = "";
    var countjson = markers.length;
		var last_index = countjson - 1;
    for (var i = 0; i < markers.length; i++) {
        var latlng = markers[i].getPosition();
        txt.value += latlng.toUrlValue() + ",\n";
        /*console.log(markers[i]);
        var comma = (i == last_index) ? "" : ",\n" ;
        datapostgis += markers[i].lng+" "+markers[i].lat+""+comma;*/
        polylineStore.push(latlng.toJSON());
        //console.log(polylineStore);
    }
}

function setMarkers() {
    var txt = document.getElementById(id);
    var lines = txt.value.split(/\n/);
    //console.log(lines);
    clearMarkers();
    for (var i in lines) {
        var ps = lines[i].split(/,/);

        if (ps.length >= 2) {
            var latlng = new google.maps.LatLng(ps[0], ps[1]);
            addMarker(latlng);
        }
    }
    displayMarkers();
    if (markers.length > 0) {
        map.setCenter(markers[0].getPosition());
    }
}
