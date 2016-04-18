'use strict';

function handler(core, user) {
	self = this;
	self.core = core;
	self.user = user;

	self.refresh();
}

handler.prototype.refresh = function() {
	console.log(self.user.bam_cd_user);
	return self.core.service.databind('#settings', self.user.bam_cd_user);
}


handler.prototype.updatePassword = function(e) {
	
	e.preventDefault();

	var form = self.core.service.form.serializeObject('#password-form');

	form.cdUserId = self.user.bam_cd_user_id;
	form.pass = form.new_password;

	if(form.new_password == form.conf_new_password){

		delete form.new_password;
		delete form.conf_new_password;

		self.core.resource.cd_user.patch(form)
				.then(function(res) {
					//saved successfully
					$('#update-password-success').removeClass('hide');
					
					$("input[name='new_password']").val('');
					$("input[name='conf_new_password']").val('');
			 					
					setTimeout(function() { 
						$('#settings-modal').modal('hide');
						$('#update-password-success').addClass('hide');
				 	}, 1000);								
				},function(err){
				//there's an error when trying to update password	
				});
	}else{
		$('#update-password-fail').removeClass('hide');
	}	

}

handler.prototype.updateUser = function(e) {
	e.preventDefault();
	if (self.core.service.form.validate('#settings-form')) {
		var form = self.core.service.form.serializeObject('#settings-form');
		console.log(form);
		form.cdUserId = self.user.bam_cd_user_id;

		self.core.resource.cd_user.patch(form)
			.then(function(res) {
				$('#update-settings-success').fadeIn().delay(5000).fadeOut();
			}, function(err) {
				$('#update-settings-fail').fadeIn().delay(5000).fadeOut();
			});
		

	}
}

module.exports = function(core, user) {
	return new handler(core, user);
}
