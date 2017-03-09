var Maps = (function() {

    var filterList = {};

    return {
        loadGoogle: function() {

            var myLatlng = new google.maps.LatLng(-27, 133);
            var myOptions = {
                zoom: 4,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

            var customParams = [
                "FORMAT=image/png8",
                "LAYERS=ALA:ibra7_regions"
            ];

            //Add query string params to custom params
            var pairs = location.search.substring(1).split('&');
            for (var i = 0; i < pairs.length; i++) {
                customParams.push(pairs[i]);
            }
            loadWMS(map, "http://spatial.ala.org.au/geoserver/wms?", customParams);
        }

    } // return: public methods
})();

// Jquery Document.onLoad equivalent
$(document).ready(function() {
    Maps.loadGoogle();
}); // end JQuery document ready
