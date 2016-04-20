'use strict';

module.exports = function(core, user, projectId) {
	var handler = require('../event-handlers/project.worksheet.js')(core, user, projectId);
	$('#status-list').on('change', handler.refresh);
	$('#projects-list').on('change', handler.getProject);
}
