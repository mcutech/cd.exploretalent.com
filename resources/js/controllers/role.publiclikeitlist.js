 module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.publiclikeitlist.js')(core, user, projectId, roleId);

	$(document).on('click', '.view-all-modal', handler.viewAllModal);
};
