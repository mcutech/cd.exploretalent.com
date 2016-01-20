module.exports = function(core, user, projectId, roleId) {
	$('.matches-link').addClass('active');

	var handler = require('../event-handlers/role.match.js')(core, user, projectId, roleId);
	$('#talent-filter-button').on('click', function() { handler.refreshMatches() });
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

	$("#markets-list").select2({
		allowClear: true,
		placeholder: "Search market"
	});

	$("#markets-list").on('change', handler.addToMarket);
	$(document).on('click', '.market-item', handler.removeFromMarket);

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.loadNextMatches();
		}
	});
}
