module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/message.js')(core, user, projectId, roleId);

	$(document).on('click', '.conversation', handler.showMessages);
	$(document).on('click', '#send-btn', handler.postMessage);

		$("#message-text").keypress(function (e) {
			// e.preventDefault();
			var code = (e.keyCode ? e.keyCode : e.which);
			if (code == 13 && !e.shiftKey){
				$("#send-btn").trigger('click');
				return true;
			}
		});

};
