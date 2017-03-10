function CenterControl(controlDiv, map, center) {
    var control = this;
    control.center_ = center;
    controlDiv.style.clear = 'both';
    var goCenterUI = document.createElement('div');
    goCenterUI.id = 'goCenterUI';
    goCenterUI.title = 'Click to recenter the map';
    controlDiv.appendChild(goCenterUI);

    // Set CSS for the control interior
    var goCenterText = document.createElement('div');
    goCenterText.id = 'goCenterText';
    goCenterText.innerHTML = 'Center Map';
    goCenterUI.appendChild(goCenterText);

    // Set CSS for the setCenter control border
    var setCenterUI = document.createElement('div');
    setCenterUI.id = 'setCenterUI';
    setCenterUI.title = 'Click to change the center of the map';
    controlDiv.appendChild(setCenterUI);

    // Set CSS for the control interior
    var setCenterText = document.createElement('div');
    setCenterText.id = 'setCenterText';
    setCenterText.innerHTML = 'Set Center';
    setCenterUI.appendChild(setCenterText);

    // Set up the click event listener for 'Center Map': Set the center of
    // the map
    // to the current center of the control.
    goCenterUI.addEventListener('click', function() {
      var currentCenter = control.getCenter();
      map.setCenter(currentCenter);
    });

        // Set up the click event listener for 'Set Center': Set the center of
        // the control to the current center of the map.
    setCenterUI.addEventListener('click', function() {
      var newCenter = map.getCenter();
      control.setCenter(newCenter);
    });
}

CenterControl.prototype.center_ = null;
CenterControl.prototype.getCenter = function() {
  return this.center_;
};
CenterControl.prototype.setCenter = function(center) {
  this.center_ = center;
};

function initCenter(map,position) {
  //TOP_CENTER indicates that the control should be placed along the top center of the map.
  //TOP_LEFT indicates that the control should be placed along the top left of the map, with any sub-elements of the control "flowing" towards the top center.
  //TOP_RIGHT indicates that the control should be placed along the top right of the map, with any sub-elements of the control "flowing" towards the top center.
  //LEFT_TOP indicates that the control should be placed along the top left of the map, but below any TOP_LEFT elements.
  //RIGHT_TOP indicates that the control should be placed along the top right of the map, but below any TOP_RIGHT elements.
  //LEFT_CENTER indicates that the control should be placed along the left side of the map, centered between the TOP_LEFT and BOTTOM_LEFT positions.
  //RIGHT_CENTER indicates that the control should be placed along the right side of the map, centered between the TOP_RIGHT and BOTTOM_RIGHT positions.
  //LEFT_BOTTOM indicates that the control should be placed along the bottom left of the map, but above any BOTTOM_LEFT elements.
  //RIGHT_BOTTOM indicates that the control should be placed along the bottom right of the map, but above any BOTTOM_RIGHT elements.
  //BOTTOM_CENTER indicates that the control should be placed along the bottom center of the map.
  //BOTTOM_LEFT indicates that the control should be placed along the bottom left of the map, with any sub-elements of the control "flowing" towards the bottom center.
  //BOTTOM_RIGHT indicates that the control should be placed along the bottom right of the map, with any sub-elements of the control "flowing" towards the bottom center.

  var centerControlDiv = document.createElement('div');
  var centerControl = new CenterControl(centerControlDiv, map, chicago);
  centerControlDiv.index = 1;
  centerControlDiv.style['padding-top'] = '10px';
  map.controls[google.maps.ControlPosition[position]].push(centerControlDiv);

}
