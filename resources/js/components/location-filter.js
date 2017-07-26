module.exports = function(core, user) {

  var isInit = false;
  var markers = [];
  var circles = [];
  var google = null;
  var DISTANCE_UNIT = 'm';  

  var location = {
    LAT: 39.154557,
    LNG: -101.008301
  }

  var lngLat = [];    
  var placesLngLat = [];


  var el = $('#location-filter-map');
  var el2 = $('#lng-lat');               


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

  var updateStatus = function() {
    if (placesLngLat.length > 0) {
      lngLat = [];
      _.each(placesLngLat, function(place, index) {
        
        updateCircleRadius(circles[index]);

        var range = calculateRange(
                      place.lng, 
                      place.lat, 
                      $('#place-miles-in').val());                            
        if (lngLat.length == 0) {
          lngLat.push(range);                    
        } else {
          // calculated longitude
          lngLat[0].lng.max = _.max([lngLat[0].lng.max, range.lng.max]);
          lngLat[0].lng.min = _.min([lngLat[0].lng.min, range.lng.min]);
          // calculated latitude
          lngLat[0].lat.max = _.max([lngLat[0].lat.max, range.lat.max]);
          lngLat[0].lat.min = _.min([lngLat[0].lat.min, range.lat.min]);
        }
      });
      el2.val(JSON.stringify(lngLat));
    }
  }

  var updateCircleRadius = function(circle) {    
    var miles = $('#place-miles-in').val();
    circle.setRadius(miles * 1609.344);
  };

  var bpotGetDueCoords = function (lat, lng, bearing, distance) {

      if (DISTANCE_UNIT == 'm') r = 3963.1676;
      else r = 6378.1;
      
      // new latitude in degrees      
      var newLat = GeoPoint.radiansToDegrees(Math.asin(Math.sin(GeoPoint.degreesToRadians(lat))*Math.cos(distance/r)+Math.cos(GeoPoint.degreesToRadians(lat))*Math.sin(distance/r)*Math.cos(GeoPoint.degreesToRadians(bearing))));      

      // new longitude in degrees
      var newLng = GeoPoint.radiansToDegrees(GeoPoint.degreesToRadians(lng)+Math.atan2(Math.sin(GeoPoint.degreesToRadians(bearing))*Math.sin(distance/r) * Math.cos(GeoPoint.degreesToRadians(lat)), Math.cos(distance / r) - Math.sin(GeoPoint.degreesToRadians(lat)) * Math.sin(GeoPoint.degreesToRadians(newLat))));          
      
      return {
        lng: newLng,
        lat: newLat
      };
      
    };
 
  var calculateRange = function(lng, lat, distance) {
    var path_top_right = bpotGetDueCoords(lat, lng, 45, distance);
    var path_bottom_right = bpotGetDueCoords(lat, lng, 135, distance);
    var path_bottom_left = bpotGetDueCoords(lat, lng, 225, distance);
    var path_top_left = bpotGetDueCoords(lat, lng, 315, distance);   

    // longitude
    var longitude = {
      max: _.max([path_top_right.lng, path_bottom_right.lng, path_bottom_left.lng, path_top_left.lng]),
      min: _.min([path_top_right.lng, path_bottom_right.lng, path_bottom_left.lng, path_top_left.lng])
    }; 
    
    // latitude
    var latitude = {
      max: _.max([path_top_right.lat, path_bottom_right.lat, path_bottom_left.lat, path_top_left.lat]),
      min: _.min([path_top_right.lat, path_bottom_right.lat, path_bottom_left.lat, path_top_left.lat])
    };                 
    
    return {
      lng: longitude,
      lat: latitude
    }
  }  

  var init = function (mapOptions) {    

    var opt = {
      center: new google.LatLng(location.LAT, location.LNG),
      zoom: 6,
      mapTypeId: google.MapTypeId.ROADMAP,      
      navigationControl: false      
    };    

    var map = new google.Map(el.get(0), $.extend(opt, mapOptions));
    var icon = {
      url: 'https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png',
      size: new google.Size(71, 71),
      origin: new google.Point(0, 0),
      anchor: new google.Point(17, 34),
      scaledSize: new google.Size(25, 25)
    };    
    
    addCircle(opt.center, 8046.72, map);    

    placesLngLat.push({lng: location.LNG, lat: location.LAT});

    el2.val(JSON.stringify(lngLat));

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
      placesLngLat = [];  

      // Clear old markers
      clearMarkers();            

      // For each place, get the icon, name, and location
      var bounds = new google.LatLngBounds();

      _.each(places, function(place) {
        if (!place.geometry) {
          console.log('Returned place contained no geometry');
          return;
        }

        var range = calculateRange(
                      place.geometry.location.lng(), 
                      place.geometry.location.lat(), 
                      $('#place-miles-in').val());                            
        if (lngLat.length == 0) {
          lngLat.push(range);                    
        } else {
          // calculated longitude
          lngLat[0].lng.max = _.max([lngLat[0].lng.max, range.lng.max]);
          lngLat[0].lng.min = _.min([lngLat[0].lng.min, range.lng.min]);
          // calculated latitude
          lngLat[0].lat.max = _.max([lngLat[0].lat.max, range.lat.max]);
          lngLat[0].lat.min = _.min([lngLat[0].lat.min, range.lat.min]);
        }

        placesLngLat.push({lng: place.geometry.location.lng(), lat: place.geometry.location.lat()});
        

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

  }
  var GeoPoint = require('geopoint');
  var mapsApi  = require('google-maps-api')(core.config.gapi.key, ['places']);
  mapsApi().then(function(mapApi) {
    google = mapApi;   
    
    if ($('#address-search').val() == 1) {
      init({});
      isInit = true;
    };  
    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {		
      $('#address-search').val($(this).siblings('input[type="hidden"').val());				
      if ($('#address-search').val() == 1 && !isInit) {
        init({});
        isInit = true;
      }            
    });
    
    $('#place-miles').slider('value', $('#place-miles-in').val());	

    $('#place-miles').on('slide', function(e, ui) {
      $('#place-miles-in').val(ui.value);
      if (circles.length > 0) {
        updateStatus();
      }
    });

  });
}
