module.exports = function(core, user, projectId, roleId) {
	$('.like-it-list-link').addClass('active');
	var handler = require('../event-handlers/role.likeitlist.js')(core, user, projectId, roleId);

	$(document).on('click', '#remove-all-likeitlist', handler.removeAllLikeItList);
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

	$('#utility-buttons-div').removeClass('hide');
	$('#check-and-remove-all-div').removeClass('hide');

	$('#remove-all-checked-likeitlist').attr('disabled', 'disabled');

	$(document).on('click', '#check-all-likeitlist', function() {

		var likeitlistcheckbox = $('input[name="likeitlist-checkbox"]');
		likeitlistcheckbox.attr('checked', 'checked');

		$(this).attr('disabled', 'disabled');
		$('#remove-all-checked-likeitlist').removeAttr('disabled');
	});

	// if at least 1 checkbox is checked, remove disabled attribute from Remove all Checked btn
	$(document).on('click', 'input[name="likeitlist-checkbox"]', function() {
		$('#remove-all-checked-likeitlist').attr('disabled', !$('input[name="likeitlist-checkbox"]').is(':checked'));
	});

	$(document).on('click', '#remove-all-checked-likeitlist', handler.unrateCheckedSchedules);

}
