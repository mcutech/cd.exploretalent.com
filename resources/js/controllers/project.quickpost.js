module.exports = function(core, user){
	var handler = require('../event-handlers/project.quickpost.js')(core, user);
	$(document).on('keyup', '.form-control', function(e){
		if ($.trim($(this).val()) == '') {
			$(this).val('').focus();
		}
	});
	$(document).on('click', '#btn-send-to-booking', handler.addToBooking);

};
