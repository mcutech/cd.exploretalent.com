module.exports = function(core, user, projectId, roleId) {
	$('.matches-link').addClass('active');

	var handler = require('../event-handlers/role.match.js')(core, user, projectId, roleId);
	$('#talent-filter-button').on('click', handler.updateFilter);
	$(document).on('click', '.rating-button', handler.rateSchedule);


}
