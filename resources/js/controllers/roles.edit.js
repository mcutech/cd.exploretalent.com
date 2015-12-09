module.exports = function(core, user, projectId, roleId) {

	var handler = require('../event-handlers/roles.edit.js')(core, user, projectId, roleId);

	$('#update-role-btn').on('click', handler.updateRole);

	$('#cancel-role-btn').on('click', handler.cancelRole);
	
	var age_range_sliders_options = {
		'range': true,
		'min': 0,
		'max': 100,
		'values': [ 0, 100 ]
	};

	$('.ui-slider-age-range').slider(age_range_sliders_options);

	$('.ui-slider-age-range').on('slide', function(event, ui) {
		$( "#age-range-min" ).text(' ' + ui.values[ 0 ] );
		$( "#age-range-max" ).text( ui.values[ 1 ] );
	});

	var height_range_sliders_options = {
		'range': true,
		'min': 22,
		'max': 96,
		'values': [ 22, 96 ]
	};

	$('.ui-slider-height-range').slider(height_range_sliders_options);

	$('.ui-slider-height-range').on('slide', function(event, ui) {
		var inches1 = ui.values[0];
		var inches2 = ui.values[1];

		if(inches1 == '22' || inches1 == '23') {
			var feet1 = '2';
			inches1 = '0';

			if(inches2 == '22' || inches2 == '23') {
				var feet2 = '2';
				inches2 = '0';
			}
			else {
				var feet2 = Math.floor(inches2 / 12);
				inches2 %= 12;
			}
		}

		else {
			var feet1 = Math.floor(inches1 / 12);
			var feet2 = Math.floor(inches2 / 12);

			inches1 %= 12;
			inches2 %= 12;
		}

		if(ui.values[0] == '22' || ui.values[0] == '23') {
			feet1 = '< 2';
		}

		if(ui.values[1] == '22' || ui.values[1] == '23') {
			feet2 = '< 2';
		}

		$( '#height-min-span' ).html(feet1 + "' " + inches1 + '"');
		$( '#height-max-span' ).html(feet2 + "' " + inches2 + '"');

		if(ui.values[0] == '23') {
			ui.values[0] == '22';
		}
		if(ui.values[1] == '23') {
			ui.values[1] == '22';
		}

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