module.exports = function(core, user, projectId, roleId) {
	$('.self-submissions-link').addClass('active');
	var handler = require('../event-handlers/role.selfsubmission.js')(core, user, projectId, roleId);

	$(document).on('click', '.rating-button', handler.rateSchedule);
	$('#roles-list').on('change', handler.changeRole);
	$('#rate-all-button').on('click', handler.rateAll);
	$('#remove-all-likeitlist').on('click', handler.removeAllLikeItList);
	$('#talent-filter-button').on('click', handler.updateFilter);

	$(document).on('click', '.add-casting-note', handler.getDetailsForAddNoteModal);
	$('.add-note-for-talent').on('click', handler.addNoteForTalent);

	$(document).on('click', '.edit-note-link', handler.getDetailsForEditNoteModal);
	$('.edit-note-for-talent').on('click', handler.editNoteForTalent);
	$(document).on('click', '.fav-btn', handler.addToFav);

	$('#view-like-it-list-btn').removeClass('hide');
}
