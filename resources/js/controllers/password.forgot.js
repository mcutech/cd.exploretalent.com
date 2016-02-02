module.exports = function(core, user) {
	var handler = require('../event-handlers/password.forgot.js')(core, user);

	$(document).on('click', '#send-email-btn', handler.sendLinkToEmail);
}
