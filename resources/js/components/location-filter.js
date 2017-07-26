module.exports = function(core, user) {

  var markers = [];
  var circles = [];
  var google = null;

  var location = {
    LAT: 37.09024,
    LNG: -95.712891
  }

  var lngLat = [];

  var addMarker = function (location, map, options) {
      var marker = new google.Marker($.extend({map: map, position: location}, options));
      // listen to dragend event
      marker.addListener('dragend', function(event) {
        location.LAT = event.latLng.lat();
        location.LNG = event.latLng.lng();
      });
      markers.push(marker);                            
  }

  var addCircle = function(center, radius, map) {    
    var circle = new google.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        map: map,
        center: center,
        radius: radius
      });
      circles.push(circle);
  }

  var radius = function() {
    var miles = $('#place-miles-in').val();
    return miles * 1609.344;
  }
  

  var clearMarkers = function() {
    _.each(markers, function(marker) {
      marker.setMap(null);
    });
    _.each(circles, function(circle) {
      circle.setMap(null);
    });
    markers = [];
    circles = [];
  }

  var init = function (mapOptions) {

    var el = $('#location-filter-map');
    var el2 = $('#lng-lat');      

    var opt = {
      center: new google.LatLng(location.LAT, location.LNG),
      zoom: 7,
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

    //addMarker(
    //    opt.center,
    //    map,
    //    {
    //      icon: icon,
    //      title: '',
    //      draggable: true,
    //      animation: google.Animation.DROP
    //    });
    addCircle(opt.center, 8046.72, map);

    // create the search box and link it to the UI element
    var input = $('#location-search-box').get(0);
    var searchBox = new google.places.SearchBox(input);

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

      lngLat = [];   
      el2.val("[]");         

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
        //addMarker(place.geometry.location, map, {
        //  icon: icon,
        //  title: place.name,
        //  draggable: true,
        //  animation: google.Animation.DROP
        //});
        
        lngLat.push({lng: place.geometry.location.lng(), lat: place.geometry.location.lat()});              

        addCircle(place.geometry.location, radius(), map);

        if (place.geometry.viewport) {
          // Only geocodes have viewport
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }

      });            

      el2.val(JSON.stringify(lngLat));
      
      map.fitBounds(bounds);
      map.setZoom(8);      

    });

    //setTimeout(function() {
    //    el.parents('#add-location-filter-div').hide();
    //}, 100);

  }

  var mapsApi = require('google-maps-api')(core.config.gapi.key, ['places']);
  mapsApi().then(function(mapApi) {
    google = mapApi;    
    init({});
  });
}
