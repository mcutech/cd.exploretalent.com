module.exports = function(core, user) {
	var handler = require('../event-handlers/feedback.js')(core, user);

	$(document).on('click', '#add-feedback-btn', handler.addNewFeedback);
}
