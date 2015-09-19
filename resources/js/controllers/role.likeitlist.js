module.exports = function(core, user, projectId, roleId) {
	$('.like-it-list-link').addClass('active');
	var handler = require('../event-handlers/role.likeitlist.js')(core, user, projectId, roleId);

	$(document).on('click', '.rating-button', handler.rateSchedule);
	$('#remove-all-likeitlist').on('click', handler.removeAllLikeItList);
	$(document).on('click', '.unrate-button', handler.unrateSchedule);
}
