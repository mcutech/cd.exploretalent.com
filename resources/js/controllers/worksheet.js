'use strict';

module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/worksheet.js')(core, user, projectId, roleId);

	$('#projects-list').on('change', handler.refreshFilterRoles);
	$('#filter-button').on('click', handler.refresh);
	$('#reschedule-button').on('click', handler.reschedule);
	$('#add-note-button').on('click', handler.addNote);
	$(document).on('click', '.reschedule-button', handler.setScheduleId);
	$(document).on('click', '.add-note-button', handler.setScheduleId);
	$(document).on('click', '.accept-button', handler.updateScheduleStatus);
	$(document).on('click', '.decline-button', handler.updateScheduleStatus);
	$(document).on('click', '.callback-button', handler.updateScheduleCDStatus);
	$(document).on('click', '.hired-button', handler.updateScheduleCDStatus);
}
