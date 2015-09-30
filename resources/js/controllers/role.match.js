module.exports = function(core, user, projectId, roleId) {
	$('.matches-link').addClass('active');

	var handler = require('../event-handlers/role.match.js')(core, user, projectId, roleId);
	$('#talent-filter-button').on('click', handler.updateFilter);
	$('#rate-all-button').on('click', handler.rateAll);
	$('#remove-all-likeitlist').on('click', handler.removeAllLikeItList);
	$('#roles-list').on('change', handler.changeRole);
	$(document).on('click', '.rating-button', handler.rateSchedule);
	$(document).on('click', '#talent-photo', handler.refreshTalentPhotos);
}
