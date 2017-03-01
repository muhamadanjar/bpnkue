var map;
var markers = [];
var polyline;
var id = "points";

function showPolyline() {
    if (polyline) {
        polyline.setMap(null);
    }
    var path = [];
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
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
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
    var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            draggable: true,
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
            showPolyline();
            displayMarkers();
        });
    google.maps.event.addListener(marker, 'rightclick', function(event) {
            removeMarker(marker);
            showPolyline();
            displayMarkers();
        });
    google.maps.event.addListener(marker, 'dblclick', function(event) {
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
    for (var i = 0; i < markers.length; i++) {
        var latlng = markers[i].getPosition();
        txt.value += latlng.toUrlValue() + ",\n";
    }
}

function setMarkers() {
    var txt = document.getElementById(id);
    var lines = txt.value.split(/\n/);
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

function initialize(canvasName) {
    map = new google.maps.Map(document.getElementById(canvasName), {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 12,
        
    });
    google.maps.event.addListener(map, 'click', function(event) {
        addMarker(event.latLng);
        displayMarkers();
    });
}
function load() {
    initialize('map_canvas');
    var latlng = new google.maps.LatLng(-6.3252738,106.0764884);
    map.setCenter(latlng);
    
}