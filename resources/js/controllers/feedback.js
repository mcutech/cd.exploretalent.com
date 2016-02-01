module.exports = function(core, user) {
	var handler = require('../event-handlers/feedback.js')(core, user);

	$(document).on('click', '#add-feedback-btn', handler.addNewFeedback);

	// reset modal contents on close
	$("#add-feedback-modal").on("hidden.bs.modal", function(){
	    $("#feedback-message").val("");
	    $("#upload-file-name").val("");
	});

	// $(document).on('click', '#attach-file-btn', function(e){
	// 	e.preventDefault();
	// 	$('#upload-file-name').click();
	// });
}
