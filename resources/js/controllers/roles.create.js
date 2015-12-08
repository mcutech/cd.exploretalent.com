module.exports = function(core, user, projectId) {

	var handler = require('../event-handlers/roles.create.js')(core, user, projectId);

	$('#save-role-btn').on('click', handler.saveNewRole);
	$('#save-and-add-role-btn').on('click', handler.saveNewRole);

	$('#cancel-role-btn').on('click', handler.cancelRole);
	
	var age_range_sliders_options = {
		'range': true,
		'min': 0,
		'max': 100,
		'values': [ 0, 100 ]
	};

	$('.ui-slider-age-range').slider(age_range_sliders_options);

	$('.ui-slider-age-range').on('slide', function(event, ui) {
		$( "#age-range-min" ).text( ui.values[ 0 ] );
		$( "#age-range-max" ).text( ui.values[ 1 ] );
	});

	var height_range_sliders_options = {
		'range': true,
		'min': 24,
		'max': 96,
		'values': [ 24, 96 ]
	};

	$('.ui-slider-height-range').slider(height_range_sliders_options);

	$('.ui-slider-height-range').on('slide', function(event, ui) {
		var inches1 = ui.values[0];
		var inches2 = ui.values[1];
		var feet1 = Math.floor(inches1 / 12);
		var feet2 = Math.floor(inches2 / 12);

		inches1 %= 12;
		inches2 %= 12;

		$( '#height-span' ).html(feet1 + ' ft ' + inches1 + ' in' + ' to ' + feet2 + ' ft ' + inches2 + ' in');
		$('#heightinches').val(ui.values[0] + "," + ui.values[1]);
	});

	// for checkbox values convert to 1 (if checked) and 0 (if not checked)
	$("input[type='checkbox']").change(function(){
	    this.value = (Number(this.checked));
	});

	function dontAllowLetters(element) {
		element.keydown(function (e) {
		    // Allow: backspace, delete, tab, escape, and enter
		    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
		         // Allow: Ctrl+A, Command+A
		        (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
		         // Allow: home, end, left, right, down, up
		        (e.keyCode >= 35 && e.keyCode <= 40)) {
		             // let it happen, don't do anything
		             return;
		    }
		    // Ensure that it is a number and stop the keypress
		    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		        e.preventDefault();
		    }
		});
	}

	dontAllowLetters($("#role-number-text"));
			
};