module.exports = function(core, user){
	var handler = require('../event-handlers/project.quickpost.js')(core, user);
	$(document).on('click', '#btn-send-to-booking', handler.addToBooking);
};
