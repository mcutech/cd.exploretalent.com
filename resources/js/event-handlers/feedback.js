function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.getAllFeedbacks();

	console.log(self.user);
}

handler.prototype.getAllFeedbacks = function(){

	self.core.resource.feedback.get()
		.then(function(res) {
			console.log(res);
			_.each(res.data, function(n, i){
				res.data[i].date = self.core.service.date;
			});
			self.core.service.databind('#all-feedbacks-div', res);
		});

};

handler.prototype.addNewFeedback = function() {

	if (self.core.service.form.validate('#add-feedback-modal')) {
		var msg = $('#feedback-message').val();
		var attachedFile = $('#upload-file-name')[0].files[0];

		if(attachedFile) {
			// create reader
	        var reader = new FileReader();
	        reader.readAsText(attachedFile);
	        reader.onload = function(e) {
	            // browser completed reading file - display it
	            // console.log(e.target.result);
	        };
		}

		var data = new FormData();
		if(attachedFile) {
			data.append('file', attachedFile);
		}
		data.append('app_id', 9);
		data.append('body', msg);

		$.ajax({
			url: self.core.config.api.base + '/feedbacks',
			type: 'POST',
			data: data,
			headers : {
			  Authorization : localStorage.getItem('access_token')
			},
			cache: false,
			dataType: 'json',
			processData: false, // Don't process the files
			contentType: false, // Set content type to false as jQuery will tell the server its a query string request,
			crossDomain: true,
			xhrFields: {
				withCredentials : true,
				onprogress: function(progress) {
					var percentage = Math.floor((progress.total / progress.total) * 100);
					// console.log('PROGRESS: ' + percentage);
				}
			}
		})
		.then(function(res) {
			$('#add-feedback-modal').modal('toggle'); // close modal
			self.getAllFeedbacks();
		});
	}
}


module.exports = function(core, user){
	return new handler(core, user);
}
