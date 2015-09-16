module.exports = function(core, user) {


	var handler = require('../event-handlers/talents.js')(core, user);

	var range_sliders_age = {
		'range': true,
		'min': 0,
		'max': 100,
		'values': [ 0, 100 ],
		slide: function( event, ui ) {
	      $( "#text-age-min" ).html( ui.values[ 0 ] );
	      $( "#text-age-max" ).html( ui.values[ 1 ] );
	    }
	};

	$('.ui-slider-range-age').slider(range_sliders_age);

	var range_sliders_height = {
		'range': true,
		'min': 24,
		'max': 96,
		'values': [ 24, 96 ],
		slide: function( event, ui ) {
			var val1 = (Math.floor(ui.values[0]/12)) + "'" + (((ui.values[0]/12)-(Math.floor(ui.values[0]/12)))*12).toFixed() + "'";
			var val2 = (Math.floor(ui.values[1]/12)) + "'" + (((ui.values[1]/12)-(Math.floor(ui.values[1]/12)))*12).toFixed() + "'";
		    $( "#text-height-min" ).html( val1 );
		    $( "#text-height-max" ).html( val2 );
		    $( "#val-height-min" ).html( ui.values[0] );
		    $( "#val-height-max" ).html( ui.values[1] );
		    console.log(val1);
	    }
	};

	$('.ui-slider-range-height').slider(range_sliders_height);

	$('#search-talents').on('click', handler.ApplyData);
}