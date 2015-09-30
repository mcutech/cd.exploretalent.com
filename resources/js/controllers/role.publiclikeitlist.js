 module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.publiclikeitlist.js')(core, user, projectId, roleId);

	$(document).on('click', '.view-all-modal', handler.viewAllModal);
	$(document).on('click', '#talent-photo', handler.refreshTalentPhotos);
	$(document).on('click', '.btn-link', handler.addToFav);
};
