module.exports = function(core, user, projectId, roleId) {
	$('.like-it-list-link').addClass('active');
	var handler = require('../event-handlers/role.likeitlist.js')(core, user, projectId, roleId);

	$('#remove-all-likeitlist').on('click', handler.removeAllLikeItList);
	$('#roles-list').on('change', handler.changeRole);
	$(document).on('click', '.rating-button', handler.rateSchedule);
	$(document).on('click', '.unrate-button', handler.unrateSchedule);
	$(document).on('click', '#send-sms-slidetoggle', function() {
		$("#sms-message-textarea").slideToggle('fast');
	});

	$(document).on('click', '.add-casting-note', handler.getDetailsForAddNoteModal);
	$('.add-note-for-talent').on('click', handler.addNoteForTalent);

	$(document).on('click', '.edit-note-link', handler.getDetailsForEditNoteModal);
	$('.edit-note-for-talent').on('click', handler.editNoteForTalent);
	$(document).on('click', '.fav-btn', handler.addToFav);

	$("#acc-toggle").click(function(){
	   $("#date-location").toggleClass('hide');
	});

	$('#send-invites-button').on('click', handler.sendInvites);
}
