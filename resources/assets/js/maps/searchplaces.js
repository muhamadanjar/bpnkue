function initAutocomplete(map) {
  var centerControlDiv = document.createElement('div');
  var centerControl = new SearchControl(centerControlDiv, map);
  centerControlDiv.index = 1;
  centerControlDiv.style['padding-top'] = '10px';
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);
}

function SearchControl(controlDiv,map) {
  var control = this;

  controlDiv.style.clear = 'both';
  var goSearchUI = document.createElement('div');
  goSearchUI.id = 'goSearchUI';
  goSearchUI.title = 'Search the map';
  controlDiv.appendChild(goSearchUI);

  var input = document.createElement('input');
  input.id = 'pac-input';
  input.class = 'controls form-control';
  input.type = 'text';
  input.placeholder = 'Search Box';
  input.style['background-color'] = '#fff';
  input.style['font-family'] = 'Roboto';
  input.style['font-size'] = '15px';
  input.style['font-weight'] = '300';
  input.style['margin-left'] = '12px';
  input.style['text-overflow'] = 'ellipsis';
  input.style['padding'] = '0 11px 0 13px';
  //input.style['width'] = '400px';


  goSearchUI.appendChild(input);
  var searchBox = new google.maps.places.SearchBox(input);

  map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
  });
  var markersSearch = [];
  var infowindow = new google.maps.InfoWindow();
  var marker; 
  
  searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();
      if (places.length == 0) {
        return;
      }
      markersSearch.forEach(function(marker) {
        marker.setMap(null);
      });
      markersSearch = [];
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            marker = new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            });
            markersSearch.push(marker);

            google.maps.event.addListener(marker, 'click', function() {
              infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                'Place ID: ' + place.place_id + '<br>' +
                place.formatted_address + '</div>');
              infowindow.open(map, this);
            });

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
      });
      map.fitBounds(bounds);
  });

}
