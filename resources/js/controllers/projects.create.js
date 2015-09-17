module.exports = function(core, user) {

	var handler = require('../event-handlers/projects.create.js')(core, user);

	$('#create-project-btn').on('click', handler.createNewProject);

    $("#self-submission-option").on('click', function(){
        $("#self-submissions-option-content").show();
        $("#open-call-option-content").hide();
    });
    $("#open-call-option").on('click', function(){
        $("#open-call-option-content").show();
        $("#self-submissions-option-content").hide();
    });

    $("#self-submission-option").click();

	$('#bs-datepicker-submissiondeadline').datepicker({});
	$('#bs-datepicker-audition').datepicker();
	$('#bs-datepicker-shootdate').datepicker();
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
			
};