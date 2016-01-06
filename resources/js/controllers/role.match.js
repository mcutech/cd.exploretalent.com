module.exports = function(core, user, projectId, roleId) {
	$('.matches-link').addClass('active');

	var handler = require('../event-handlers/role.match.js')(core, user, projectId, roleId);
	$('#talent-filter-button').on('click', handler.refreshMatches);
	$('#rate-all-button').on('click', handler.rateAll);
	$('#remove-all-likeitlist').on('click', handler.removeAllLikeItList);
	$('#roles-list').on('change', handler.changeRole);
	$(document).on('click', '.rating-button', handler.rateSchedule);

	$(document).on('click', '.add-casting-note', handler.getDetailsForAddNoteModal);
	$('.add-note-for-talent').on('click', handler.addNoteForTalent);

	$(document).on('click', '.edit-note-link', handler.getDetailsForEditNoteModal);
	$('.edit-note-for-talent').on('click', handler.editNoteForTalent);
	$(document).on('click', '.fav-btn', handler.addToFav);

	$('#view-like-it-list-btn').removeClass('hide');

	//
	$("#jquery-select2-example").select2({
		allowClear: true,
		placeholder: "Search market"
	});

	$("#jquery-select2-example").on('change', handler.addToMarket);
	$(document).on('click', '.check-markets', handler.removeFromMarket);

	$(document).on('click', '#view-resume-photos', function(){
		$('#talent-resume-modal').modal('toggle');
	});
}
