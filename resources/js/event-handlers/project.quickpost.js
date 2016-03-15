'use strict';

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.refresh();
}

handler.prototype.refresh = function(){
	self.core.resource.quickpost.get()
		.then(function(result){
			console.log(result);
		});

}

handler.prototype.addToBooking = function(){
	var form = self.core.service.form.serializeObject('#booking-form');

	if(form.name && form.body){
		self.core.resource.quickpost.post(form)
			.then(function(result){
				$('#success-div').removeClass('hide');
				$("input[name='name']").val('');
				$("textarea[name='body']").val('');
				self.refresh();
			});
	}


}
module.exports = function(core, user){
	return new handler(core, user);
}

