'use strict';

module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/worksheet.js')(core, user, projectId, roleId);

	$('#projects-list').on('change', handler.refreshFilterRoles);
	$('#filter-button').on('click', handler.refresh);
	$(document).on('click', '.accept-button', handler.updateScheduleStatus);
	$(document).on('click', '.decline-button', handler.updateScheduleStatus);
	$(document).on('click', '.reschedule-button', handler.updateScheduleStatus);
}
