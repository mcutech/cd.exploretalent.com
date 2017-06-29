module.exports = function(core, user) {

  var markers = [];
  var google = null;

  var location = {
    LAT: 37.09024,
    LNG: -95.712891
  }

  var addMarker = function (location, map, options) {
      var marker = new google.Marker($.extend({map: map, position: location}, options));
      // listen to dragend event
      marker.addListener('dragend', function(event) {
        location.LAT = event.latLng.lat();
        location.LNG = event.latLng.lng();
      });
      markers.push(marker);
  }

  var clearMarkers = function() {
    _.each(markers, function(marker) {
      marker.setMap(null);
    });
    markers = [];
  }

  var init = function (mapOptions) {

    var el = $('#location-filter-map');

    var opt = {
      center: new google.LatLng(location.LAT, location.LNG),
      zoom: 3,
      mapTypeId: google.MapTypeId.ROADMAP,
      //mapTypeControl: false,
      //scrollwheel: false,
      //scaleControl: false,
      navigationControl: false,
      //draggable: false
    };

    var map = new google.Map(el.get(0), $.extend(opt, mapOptions));
    var icon = {
      url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
      size: new google.Size(71, 71),
      origin: new google.Point(0, 0),
      anchor: new google.Point(17, 34),
      scaledSize: new google.Size(25, 25)
    };

    addMarker(
        opt.center,
        map,
        {
          icon: icon,
          title: '',
          draggable: true,
          animation: google.Animation.DROP
        });

    // create the search box and link it to the UI element
    var input = $('#location-search-box').get(0);
    var searchBox = new google.places.SearchBox(input);
    //map.controls[google.ControlPosition.TOP_CENTER].push(input);
    console.log(google.ControlPosition);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // Clear old markers
      clearMarkers();

      // For each place, get the icon, name, and location
      var bounds = new google.LatLngBounds();

      _.each(places, function(place) {
        if (!place.geometry) {
          console.log('Returned place contained no geometry');
          return;
        }

        //icon.url = place.icon;

        // Create marker for each place
        addMarker(place.geometry.location, map, {
          icon: icon,
          title: place.name,
          draggable: true,
          animation: google.Animation.DROP
        });

        if (place.geometry.viewport) {
          // Only geocodes have viewport
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }

      });

      map.fitBounds(bounds);
      map.setZoom(8);

    });

    setTimeout(function() {
        el.parents('#add-location-filter-div').hide();
    }, 100);

  }

  var mapsApi = require('google-maps-api')(core.config.gapi.key, ['places']);
  mapsApi().then(function(mapApi) {
    google = mapApi;
    init({});
  });
}
