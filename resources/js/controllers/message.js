module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/message.js')(core, user, projectId, roleId);

	$('#projects-list').on('change', handler.refreshRoles);
	$('#roles-list').on('change', handler.refreshConversations);
	$(document).on('click', '.conversation-item', handler.refreshMessages);
	$('#send-btn').on('click', handler.sendMessage)

    $('.talent-item-container').slimScroll({
        height: '100%'
    });
    $('.messages-container').slimScroll({
        height: '100%'
    });

    var windowHeight = window.innerHeight - 157;
    document.getElementById("messages-panel").style.height  = windowHeight + "px";

    $('.casting-invitation-menu').on('click', function(){
        $('.casting-invitation-functions').removeClass('hidden');
    });
    $('.personal-message-menu').on('click', function(){
        $('.casting-invitation-functions').addClass('hidden');
    });
};
