'use strict';

module.exports = function(core, user, projectId) {
	var handler = require('../event-handlers/project.worksheet.js')(core, user, projectId);
	$('#projects-list').on('change', handler.projectChanged);
	$('#roles-list').on('change', handler.refreshList);
}
