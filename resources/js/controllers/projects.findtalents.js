module.exports = function(core, user, projectId) {
	var handler = require('../event-handlers/projects.findtalents.js')(core, user, projectId);

	$('#roles-list').on('change', handler.refreshRole);
};
