module.exports = function(core, user) {
	var handler = require('../event-handlers/password.reset.js')(core, user);

	$(document).on('click', '#reset-password-btn', handler.resetPassword);
}
