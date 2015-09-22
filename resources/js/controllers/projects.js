module.exports = function(core, user) {
	var handler = require('../event-handlers/projects.js')(core, user);

	$(document).on('click', '.delete-role', handler.deleteRole);
}
