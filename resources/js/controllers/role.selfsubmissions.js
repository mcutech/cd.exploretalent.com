module.exports = function(core, user, projectId, roleId) {
	$('.self-submissions-link').addClass('active');
	var handler = require('../event-handlers/role.selfsubmissions.js')(core, user, projectId, roleId);

	$(document).on('click', '.rating-button', handler.rateSchedule);
	$('#remove-all-likeitlist').on('click', handler.removeAllLikeItList);
	$('#talent-filter-button').on('click', handler.updateFilter);
}
