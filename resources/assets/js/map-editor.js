var map;
var markers = [];
var polyline;
var id = "points";
var drawingmode = false;

function start(){
    document.getElementById("li_start").classList.add('disabled');
    document.getElementById("li_stop").classList.remove('disabled');
    document.getElementById("li_simpan").classList.remove('disabled');
    
    drawingmode = true;
}
 
function stop(){
    drawingmode = false;
    document.getElementById("li_start").classList.remove('disabled');
    document.getElementById("li_stop").classList.add('disabled');
    document.getElementById("li_simpan").classList.add('disabled');
}
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
    var host = 'http://localhost/';
    var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: drawingmode,
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
    for (var i = 0; i < markers.length; i++) {
        var latlng = markers[i].getPosition();
        txt.value += latlng.toUrlValue() + ",\n";
        
    }
}

function setMarkers() {
    var txt = document.getElementById(id);
    var lines = txt.value.split(/\n/);
    console.log(lines);
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
        //center: new google.maps.LatLng(-6.3252738,106.0764884),
        //zoom: 13,
        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        scaleControl: false,
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        fullscreenControl: false


    });
    google.maps.event.addListener(map, 'click', function(event) {
        if(drawingmode){
            addMarker(event.latLng);
            displayMarkers();
        }
        
    });
}
function load() {
    initialize('map_canvas');
    var latlng = new google.maps.LatLng(-6.3252738,106.0764884);
    map.setCenter(latlng);
    map.setZoom(13);
}

function xhr_get(url) {

  return $.ajax({
    url: url,
    type: 'get',
    dataType: 'json'
  })
  .pipe(function(data) {
    return data.responseCode != 200 ?
      $.Deferred().reject( data ) :
      data;
  })
  .fail(function(data) {
    if ( data.responseCode )
      console.log( data.responseCode );
  });
}