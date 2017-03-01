<a href="#" onclick="startEdit()">Start editing</a>
<a href="#" onclick="stopEdit()">Stop editing</a>
<label>
  <input type="checkbox" id="ghosts" onchange="toggleGhosts();"/>
  Show ghosts
</label>
<div id="map" style="height:500px"></div>
<pre id="console"></pre>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAyGT-CSg1nb0YBLihgn8vk9zfbbkk-f1c&libraries=drawing" async defer></script>
<script type="text/javascript">
var map, polyline;

// create map and polyline
function initialize(){
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: new google.maps.LatLng(40.77333,-73.9723),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  polyline = new google.maps.Polyline({
    map: map,
    strokeColor: '#ff0000',
    strokeOpacity: 0.6,
    strokeWeight: 4,
    path: [  
      new google.maps.LatLng(40.77153,-73.97722),
      new google.maps.LatLng(40.76891,-73.97286),
      new google.maps.LatLng(40.77273,-73.96859),
      new google.maps.LatLng(40.77803,-73.96657)
    ]
  });

  addListeners();
  
  // start editing the polyline
  polyline.edit();
};

function log(message){
  document.getElementById("console").innerHTML = message;
}

// start edit mode with given "ghost" option
function startEdit(){
  var options = {
    ghosts: document.getElementById("ghosts").checked
  }
  
  polyline.edit(true, options);
}

// stop edit mode
function stopEdit(){
  polyline.edit(false);
}

// toggle ghosts in edit mode 
function toggleGhosts(){
  stopEdit();
  startEdit();
}

function addListeners(){
  // when editing started
  google.maps.event.addListener(polyline, 'edit_start', function(){
    log("[edit_start]");
  });
  
  // when editing in finished
  google.maps.event.addListener(polyline, 'edit_end', function(path){
    var coords = [];
    
    path.forEach(function(position){ 
      coords.push(position.toUrlValue(5));
    });
    
    log("[edit_end]   path: " + coords.join(" | "));
  });
  
  // when a single point has been moved
  google.maps.event.addListener(polyline, 'edit_at', function(index, point){
    log("[edit_at]    index: " +  index +  " point: " + point);
  });
  
  // when a new point has been added
  google.maps.event.addListener(polyline, 'insert_at', function(index, point){
    log("[insert_at]  index: " +  index +  " point: " + point);
  });
  
  // when a point was deleted
  google.maps.event.addListener(polyline, 'remove_at', function(index, point){
    log("[remove_at]  index: " +  index +  " point: " + point);
  });
}
</script>