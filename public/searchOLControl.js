      window.app = {};
      var app = window.app;
      
      app.RotateNorthControl = function(opt_options) {

        var options = opt_options || {};

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
        
        var searchBox = new google.maps.places.SearchBox(input);


        var this_ = this;
        var handleRotateNorth = function() {
          this_.getMap().getView().setRotation(0);
        };

        //button.addEventListener('click', handleRotateNorth, false);
        //button.addEventListener('touchstart', handleRotateNorth, false);

        var element = document.createElement('div');
        element.className = 'rotate-north ol-unselectable ol-control';
        element.appendChild(input);

        ol.control.Control.call(this, {
          element: element,
          target: options.target
        });

      };
      ol.inherits(app.RotateNorthControl, ol.control.Control);