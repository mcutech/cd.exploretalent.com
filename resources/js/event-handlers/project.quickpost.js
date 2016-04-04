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
		form.user_id = self.user.id;
		form.lazy_project_status_id = 1;
		self.core.resource.quickpost.post(form)
			.then(function(result){
				$('#success-div').removeClass('hide');
				$("input[name='name']").val('');
				$("textarea[name='body']").val('');
				self.refresh();
			});
	}


}

handler.prototype.sendCasting = function(e){

	e.preventDefault();

	var form = self.core.service.form.serializeObject("#quick-post");
	form.lazy_project_status_id = 1;
	self.core.resource.quickpost.post(form)
		.then(function(result){
		
		$('#success-div').removeClass('hide');
 		$("input[name='name']").val('');
		$("textarea[name='body']").val('');		
		setTimeout(function() { 
			$('#quick-post').modal('hide');
			$('#success-div').addClass('hide');
	 	}, 1000);	
		
		self.refresh();
	});

}



module.exports = function(core, user){
	return new handler(core, user);
}

