module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/message.js')(core, user, projectId, roleId);

	$('#projects-list').on('change', handler.refreshRoles);
	$('#roles-list').on('change', handler.refreshConversations);
	$(document).on('click', '.conversation-item', handler.refreshMessages);
	$('#send-btn').on('click', handler.sendMessage)
};
