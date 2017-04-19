var features;
var typeSelect;
function addInteraction() {
    draw = new ol.interaction.Draw({
        features: features,
        type: /** @type {ol.geom.GeometryType} */ (typeSelect.value)
    });
    map.addInteraction(draw);
}
function InitDraw(argument) {
	features = new ol.Collection();
	var featureOverlay = new ol.layer.Vector({
	        source: new ol.source.Vector({features: features}),
	        style: new ol.style.Style({
	          fill: new ol.style.Fill({
	            color: 'rgba(255, 255, 255, 0.2)'
	          }),
	          stroke: new ol.style.Stroke({
	            color: '#ffcc33',
	            width: 2
	          }),
	          image: new ol.style.Circle({
	            radius: 7,
	            fill: new ol.style.Fill({
	              color: '#ffcc33'
	            })
	          })
	        })
	});
	featureOverlay.setMap(map);

	var modify = new ol.interaction.Modify({
	        features: features,
	        // the SHIFT key must be pressed to delete vertices, so
	        // that new vertices can be drawn at the same position
	        // of existing vertices
	        deleteCondition: function(event) {
	          return ol.events.condition.shiftKeyOnly(event) &&
	              ol.events.condition.singleClick(event);
	        }
	});
	map.addInteraction(modify);
	var draw; // global so we can remove it later
	typeSelect = document.getElementById('type');

	typeSelect.onchange = function() {
	    map.removeInteraction(draw);
	    addInteraction();
	};
	addInteraction();
}
