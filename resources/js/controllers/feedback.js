module.exports = function(core, user) {
	var handler = require('../event-handlers/feedback.js')(core, user);

	$(document).on('click', '#add-feedback-btn', handler.addNewFeedback);

	// upload file input design
	$('#upload-file-name').pixelFileInput({ placeholder: '(No File Selected) Click here to select file... '});
	$(".pfi-choose")[0].innerHTML = "<i class=\"fa fa-paperclip\"></i> Choose File";

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