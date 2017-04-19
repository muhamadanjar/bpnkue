      window.app = {};
      var app = window.app;
      
      app.searchOLControl = function(opt_options) {

        var options = opt_options || {};
        var this_ = this;
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
        
        var input2 = document.getElementById('navbar-search-input');

        var searchBox = new google.maps.places.SearchBox(input);
        /*map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });*/
        var markersSearch = [];
        var infowindow = new google.maps.InfoWindow();
        var marker = new ol.Feature(); 
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
              return;
          }
          markersSearch.forEach(function(marker) {
              marker.setGeometry(null);
          });
          markersSearch = [];
          //var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            console.log(place.geometry.location.lat(),place.geometry.location.lng());
            

            var iconStyle = new ol.style.Style({
              image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                anchor: [0.5, 0.5],
                src: place.icon,
                scale:0.3,
              })),
              
            });

            marker = new ol.Feature({
              geometry: new ol.geom.Point([place.geometry.location.lng(),place.geometry.location.lat()]),
              name: place.name,
            });
            marker.setStyle(iconStyle);
            markersSearch.push(marker);
            var vectorSearchSource = new ol.source.Vector({
              features: [marker]
            });
            var vectorSearchLayer = new ol.layer.Vector({
              source: vectorSearchSource
            });
            map.addLayer(vectorSearchLayer);

                  /*google.maps.event.addListener(marker, 'click', function() {
                    console.log(place);
                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                      'Place ID: ' + place.place_id + '<br>' +
                      place.formatted_address + '</div>');
                    infowindow.open(map, this);
                  });*/

            /*if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
            } else {
                    bounds.extend(place.geometry.location);
            }*/
          });
          //map.fitBounds(bounds);
        });


        
        var handleRotateNorth = function() {
          this_.getMap().getView().setRotation(0);
        };

        

        var goSearchUI = document.createElement('div');
        goSearchUI.id = 'goSearchUI';
        goSearchUI.title = 'Search the map';
        goSearchUI.className = 'rotate-north ol-unselectable ol-control';
        goSearchUI.appendChild(input);

        ol.control.Control.call(this, {
          element: goSearchUI,
          target: options.target
        });

      };
      ol.inherits(app.searchOLControl, ol.control.Control);