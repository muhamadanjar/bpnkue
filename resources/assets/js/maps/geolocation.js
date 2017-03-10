//Geolocation
var markerGeolocation;
var animationInterval;
var watchpositionstatus=false;
var positionTimer;
var secondChild;

function initGeolocation(map) {
    var controlDiv = document.createElement('div');

    var firstChild = document.createElement('button');
    firstChild.style.backgroundColor = '#fff';
    firstChild.style.border = 'none';
    firstChild.style.outline = 'none';
    firstChild.style.width = '28px';
    firstChild.style.height = '28px';
    firstChild.style.borderRadius = '2px';
    firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
    firstChild.style.cursor = 'pointer';
    firstChild.style.marginRight = '10px';
    firstChild.style.marginLeft = '10px';
    firstChild.style.padding = '0';
    firstChild.title = 'Your Location';
    controlDiv.appendChild(firstChild);

    secondChild = document.createElement('div');
    secondChild.style.margin = '5px';
    secondChild.style.width = '18px';
    secondChild.style.height = '18px';
    secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-2x.png)';
    secondChild.style.backgroundSize = '180px 18px';
    secondChild.style.backgroundPosition = '0 0';
    secondChild.style.backgroundRepeat = 'no-repeat';
    firstChild.appendChild(secondChild);

    google.maps.event.addListener(map, 'center_changed', function () {
        secondChild.style['background-position'] = '0 0';
    });

    firstChild.addEventListener('click', function () {
        var imgX = '0';
        animationInterval = setInterval(function () {
                imgX = imgX === '-18' ? '0' : '-18';
                secondChild.style['background-position'] = imgX+'px 0';
            }, 500);

        /*if(navigator.geolocation) {
            //console.log("Navi",navigator.geolocation.getCurrentPosition());
            navigator.geolocation.getCurrentPosition(function(position) {
                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                map.setCenter(latlng);
                clearInterval(animationInterval);
                secondChild.style['background-position'] = '-144px 0';
            });
        } else {
            clearInterval(animationInterval);
            secondChild.style['background-position'] = '0 0';
        }*/
        geolocation();

    });

    controlDiv.index = 1;
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(controlDiv);
}
function geolocation(){
  stopWatch();
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(displayAndWatch, locError, {
      enableHighAccuracy : true,
      timeout : 60000,
      maximumAge : 0
    });
  } else {
    clearInterval(animationInterval);
    secondChild.style['background-position'] = '0 0';
    alert("Your phone does not support the Geolocation API");
  }

}
function addMarkerGeolocation(latlng) {
    markerGeolocation = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: true,
        //icon: host+'images/maps/you-are-here-2.png'
    });
}
function locError(error) {
	// the current position could not be located
	alert("The current position could not be found!");
}
function displayAndWatch(position) {
    // set current position
    setUserLocation(position);
    // watch position
    watchCurrentPosition();
}
function setUserLocation(pos) {
    // marker for userLocation
    var latlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);

    map.setCenter(latlng);
    clearInterval(animationInterval);

    secondChild.style['background-position'] = '-144px 0';
    markerGeolocation = new google.maps.Marker({
      map : map,
      position : new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude),
      title : "You are here",
      icon : "http://localhost/images/maps/you-are-here-2.png",
	  });
    // scroll to userLocation
    //map.panTo(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
}
function watchCurrentPosition() {
    //watchpositionstatus = true;
    positionTimer = navigator.geolocation.watchPosition(function(position) {
        setMarkerPosition(markerGeolocation, position);
        map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
    });
}
function setMarkerPosition(marker, position) {
     marker.setPosition(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
     console.log(position);
}
function stopWatch(){
  console.log("Stop watchPosition");
  navigator.geolocation.clearWatch(positionTimer);
}
