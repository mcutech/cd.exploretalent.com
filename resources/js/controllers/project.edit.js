module.exports = function(core, user, projectId) {

	var handler = require('../event-handlers/project.edit.js')(core, user, projectId);

	$('#update-project-btn').on('click', handler.updateProject);

	$('#bs-datepicker-submissiondeadline').datepicker({
		dateFormat: 'yy-mm-dd',
		minDate: +1,
	});

	$("#self-submission-option").on('click', function(){
        $("#self-submissions-option-content").show();
        $('#project-type-title').text('Self Submission Details');
        $("#open-call-option-content").hide();
    });
    $("#open-call-option").on('click', function(){
        $("#open-call-option-content").show();
        $('#project-type-title').text('Open Call Details');
        $("#self-submissions-option-content").hide();
    });

	$('#bs-datepicker-submissiondeadline').datepicker('option', 'defaultDate', +1);

	$('#bs-datepicker-submissiondeadline').mask('9999-99-99');

	$('#bs-datepicker-audition').datepicker({
		dateFormat: 'yy-mm-dd'
	});
	$('#bs-datepicker-audition').mask('9999-99-99');

	$('#bs-datepicker-shootdate').datepicker({
		dateFormat: 'yy-mm-dd'
	});
	$('#bs-datepicker-shootdate').mask('9999-99-99');

	$('#bs-datepicker-open-call').datepicker({
		dateFormat: 'DD, MM dth'
	});
	$('#bs-timepicker-open-call-from').timepicker();
	$('#bs-timepicker-open-call-to').timepicker();

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

	dontAllowLetters($("#project-rate"));
	dontAllowLetters($("#zip-code"));

	$('#find-markets-btn').on('click', handler.autoSelectMarkets);

	$('#toggle-manual-markets-div').on('click', handler.toggleManualMarketsDiv);

	$('#toggle-all-markets-checked').on('click', handler.toggleAllMarketsChecked);

	$(document).on('click', '.calendar-btn', function() {
		$(this).siblings('input.calendar-input').datepicker().focus();
	});

	$(document).on('click', '#nationwide-market-checkbox', function() {

		$(this).toggleClass('checked');

		if($(this).hasClass('checked')) {
			$('.hide-if-nationwide').addClass('hide');
		}
		else {
			$('.hide-if-nationwide').removeClass('hide');
			$('#zip-code').val('');
		}

	});

};
