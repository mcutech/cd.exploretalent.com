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
	$('#send-invites-button').on('click', handler.sendInvites);
}
