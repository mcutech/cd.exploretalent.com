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

			_.each(res.data, function(n, i){
				res.data[i].date = self.core.service.date;
			});
			self.core.service.databind('#all-feedbacks-div', res);
		});

};

handler.prototype.addNewFeedback = function() {

	var msg = $('#feedback-message').val();

	var data = {
		app_id : 9,
		body : msg
	}
	self.core.resource.feedback.post(data)
		.then(function(res) {
			self.getAllFeedbacks();
		});
}


module.exports = function(core, user){
	return new handler(core, user);
}
