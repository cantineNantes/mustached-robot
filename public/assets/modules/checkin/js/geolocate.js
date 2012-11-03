$(document).ready(function() {

	// Check browser compatibility
	if(navigator.geolocation) {
	    var latCoworking =  parseFloat($('#geolocationLoader').data('latitude'));
	    var longCoworking = parseFloat($('#geolocationLoader').data('longitude'));	    
		navigator.geolocation.getCurrentPosition(myPosition, errorPosition, {enableHighAccuracy:true});
	} else {
		showError('compatible');
	}

	/**
	 * Display the checkin form if the current user is close to the coworking space
	 * @param  position Position as given by the geolocation API
	 */
	function myPosition(position) {
		var distance = distanceFromCoworking(latCoworking, longCoworking, position.coords.latitude, position.coords.longitude);
		var accuracy = parseFloat($('#geolocationLoader').data('accuracy'));

		if(distance < accuracy)
		{
			$('#geolocationLoader').hide();	
			$('#checkinForm').show();
		}
		else {
			showError('toofar');
		}
	}


	/**
	 * Handle the error message given by the geolocation API and display a message to the end user
	 * @param  error Error given by the geolocation API
	 */
	function errorPosition(error) {	
		switch(error.code) {
		    case error.TIMEOUT:
		    	showError('timeout');
		    	info = $('#locationError').data('timeout');
		    	break;
		    case error.PERMISSION_DENIED:
		    	showError('permission');
		    	break;
		    case error.POSITION_UNAVAILABLE:
		    	showError('unavailable');
		    	break;
		    case error.UNKNOWN_ERROR:
		    	showError('unknown');
		    	break;
	   }		   
	}

	/**
	 * Display an error message to the user
	 * @param {string} error String containing the error code of the error (this code must match a data attribute in the "#locationError" div)
	 */	
	function showError(error) {
		$('#geolocationLoader').hide();	
		$('#locationError').show();
		$('#locationError p').html($('#locationError').data(error));
	}

	/**
	 * Calculate the distance between two points
	 * @param  {float} Latitude of point 1
	 * @param  {float} Longitude of point 1
	 * @param  {float} Latitude of point 2
	 * @param  {float} Longitude of point 2
	 * @return {float} distance The distance between the two points (in km)
	 */
	var distanceFromCoworking = function(lat1,lon1, lat2, lon2){
		var R = 6371; // km
		var dLat = (lat2-lat1).toRad();
		var dLon = (lon2-lon1).toRad();
		var lat1 = lat1.toRad();
		var lat2 = lat2.toRad();

		var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
		        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		var d = R * c;
		return d;
	}

	/** Converts numeric degrees to radians */
	if (typeof(Number.prototype.toRad) === "undefined") {
	  Number.prototype.toRad = function() {
	    return this * Math.PI / 180;
	  }
	}

});




