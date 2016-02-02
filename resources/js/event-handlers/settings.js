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

handler.prototype.updateUser = function(e) {
	e.preventDefault();
	if (self.core.service.form.validate('#settings-form')) {
		var form = self.core.service.form.serializeObject('#settings-form');
		console.log(form);
		form.cdUserId = self.user.bam_cd_user_id;

		var pass1 = $('#pass').val(),
			pass2 = $('#pass2').val();

		/*if(pass1 != pass2) {
			$('#pass2').focus();
			alert('Both passwords must have the same value.');
		}
		else if (pass1.length < 5 || pass2.length < 5) {
			$('#pass').focus();
			alert('Both passwords must be at least 5 characters long.');
		}
		else if (pass1.length < 1){
			console.log('test');
		}*/
		console.log(pass1.length);
		if(pass1.length > 0){
			if(pass1 != pass2) {
				$('#pass2').focus();
				alert('Both passwords must have the same value.');
			}
			else if (pass1.length < 5 || pass2.length < 5) {
				$('#pass').focus();
				alert('Both passwords must be at least 5 characters long.');
			}
			else {
				//success
				self.core.resource.cd_user.patch(form)
				.then(function(res) {
					$('#update-settings-success').fadeIn().delay(5000).fadeOut();
				}, function(res1) {
					alert("The email has already been taken.")
				});
			}
		} 
		else {
			console.log(form.pass);
			if(!form.pass){
				delete form.pass;
			}
			console.log(form);
			self.core.resource.cd_user.patch(form)
				.then(function(res) {
					$('#update-settings-success').fadeIn().delay(5000).fadeOut();
				}, function(res1) {
					alert("The email has already been taken.")
				});
		}

	}
}

module.exports = function(core, user) {
	return new handler(core, user);
}
