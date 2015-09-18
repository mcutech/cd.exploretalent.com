module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/roles.likeitlist.js')(core, user, projectId, roleId);

	$(document).on('click', '.rating-button', handler.rateSchedule);
	$('#remove-all-likeitlist').on('click', handler.removeAllLikeItList);
	$(document).on('click', '.unrate-button', handler.unrateSchedule);
}
