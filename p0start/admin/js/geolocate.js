(function($) {

    'use strict';
    	
	var geocoder;
	//var map;
	function initialize() {
	  geocoder = new google.maps.Geocoder();
/*
	  var latlng = new google.maps.LatLng(-34.397, 150.644);

	  var mapOptions = {
	    zoom: 8,
	    center: latlng
	  };
	  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
*/
	}
	
	function codeAddress() {
	  var address = document.getElementById('inputZipCode').value;
	  geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      map.setCenter(results[0].geometry.location);

	    } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
}(this));