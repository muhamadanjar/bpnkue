<link rel="stylesheet" href="{{ asset('css/map.css') }}"/>
@extends('layouts.adminlte')
@section('css_tambahan')

@endsection
@section('content')
<div id="mapgoogle"></div>
<div class="box">
    <div class="box-header with-border">
          <h3 class="box-title">Peta</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          
        </div>
      </div>

    </div>
    <div class="box-footer">
      Footer
      <div id="search-control-ui">
          <p>Enter a query to geocode, or click on the map to reverse geocode.</p>
          <input id="query-input" autofocus>
          <input id="geocode-button" type="button" value="Geocode" />
          <div>
            <p>
              <input type="checkbox" id="new-forward-geocoder-checkbox"
                  title="Use the new forward geocoder for addresses." checked/>
              <label id="new-forward-geocoder-checkbox-label"
                  for="new-forward-geocoder-checkbox"
                  >Use the new forward geocoder</label>
              <a class="learn-more-link" target="_atop"
                  href="https://googlegeodevelopers.blogspot.ch/2016/11/address-geocoding-in-google-maps-apis.html"
                  >(?)</a>
            </p>
          </div>
          <div id="show-hide-options-div">
            <a id="show-options-link">Show options</a>
            <a id="hide-options-link" class="hidden">Hide options</a>
          </div>
          <div id="search-options-div" class="hidden">
            <table>
              <tbody>
                <tr class="headers">
                  <th>
                    Component Filtering
                  </th>
                  <th>
                    <a class="learn-more-link" target="_atop"
                        href="/maps/documentation/geocoding/intro#ComponentFiltering"
                        >(?)</a>
                  </th>
                  <th>
                    Examples
                  </th>
                </tr>
                <tr>
                  <td>
                    Country
                  </td>
                  <td>
                    <select id="restrict-country-select"></select>
                  </td>
                  <td class="examples">
                    &nbsp;
                  </td>
                </tr>
                <tr>
                  <td>
                    <acronym title="matches all the administrative-area levels">
                      Administrative area</acronym>
                  </td>
                  <td>
                    <input id="restrict-administrative-area-input" />
                  </td>
                  <td class="examples">
                    Canarias, Tenerife
                  </td>
                </tr>
                <tr>
                  <td>
                    <acronym title="matches against both locality and sublocality types">
                      Locality</acronym>
                  </td>
                  <td>
                    <input id="restrict-locality-input" />
                  </td>
                  <td class="examples">
                    La Laguna, Tegueste
                  </td>
                </tr>
                <tr>
                  <td>
                    <acronym title="matches postal-code and postal-code-prefix">
                      Postal code</acronym>
                  </td>
                  <td>
                    <input id="restrict-postal-code-input" />
                  </td>
                  <td class="examples">
                    38005, H0H 0H0
                  </td>
                </tr>
                <tr>
                  <td>
                    <acronym title="matches long or short name of a route">
                      Route</acronym>
                  </td>
                  <td>
                    <input id="restrict-route-input" />
                  </td>
                  <td class="examples">
                    Bayshore Freeway
                  </td>
                </tr>
                <tr class="headers">
                  <th>
                    Region Biasing
                  </th>
                  <th>
                    <select id="bias-country-select"></select>
                  </th>
                  <th>
                    <a class="learn-more-link" target="_atop"
                        href="/maps/documentation/geocoding/intro#RegionCodes"
                        >(?)</a>
                  </th>
                </tr>
                <tr class="headers">
                  <th>
                    Viewport Biasing
                  </th>
                  <th>
                    <label id="bias-viewport-checkbox-label"
                        for="bias-viewport-checkbox">on this viewport</label>
                    <input type="checkbox" id="bias-viewport-checkbox"
                        title="Will be highlighted in green."/>
                  </th>
                  <th>
                    <a class="learn-more-link" target="_atop"
                        href="/maps/documentation/geocoding/intro#Viewports"
                        >(?)</a>
                  </th>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
</div>
@endsection
@section('js_tambahan')
<script type="text/javascript" src="{{ asset('js/map/map.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/map/wms.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/map/searchplaces.js') }}"></script>
<script type="text/javascript">
  var map;
  var markers = [];
  var mapMinZoom = 12,mapMaxZoom = 18;
  var infoWindow;
  var host = 'https://'+window.location;

  function initialize() {
    map = new google.maps.Map(document.getElementById('mapgoogle'), {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(-6.3252738,106.0764884),
        zoom: 13,
        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        scaleControl: false,
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        fullscreenControl: true
    });

    //initGeolocation(map);
    //initTraffic(map);

    var customParams = [
        "FORMAT=image/png8",
        "LAYERS=jjpan:jaringan_jalan_fungsi"
    ];
    loadWMS(map, "http://localhost/geoserver/wms?", customParams);

    initAutocomplete(map);

    //map.data.loadGeoJson('http://localhost/geoserver/jjpan/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=jjpan:jaringan_jalan_fungsi&maxFeatures=50&outputFormat=application%2Fjson');
    map.data.loadGeoJson('http://localhost/geoserver/jjpan/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=jjpan:jaringan_jalan_status&maxFeatures=50&outputFormat=application%2Fjson');
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-kEXeuhgPWY__PZ9mzePYwJuMwOzLyC0&callback=initialize&libraries=places" async defer></script>
@endsection
