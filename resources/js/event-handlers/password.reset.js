'use strict';
var _ = require('lodash');

function handler(core, user) {
	self = this;
	self.core = core;
	self.user = user;

	console.log(user);
}

handler.prototype.resetPassword = function() {

	var pass1 = $('#enter-password').val(),
		pass2 = $('#confirm-password').val();

	if(!pass1 || !pass2 || pass1 != pass2) {
		$('#invalid-pass').fadeIn().delay(5000).fadeOut();
	}
	else {
		var data = {
			cdUserId	: self.user.bam_cd_user.user_id ,
			pass		: pass1,
		};

		core.resource.cd_user.patch(data)
		.then(function(result) {
			$('#success-pass').fadeIn().delay(5000).fadeOut();

			setTimeout(function() {
				window.location = '/projects';
			}, 3000);
		});
	}
}

module.exports = function(core, user) {
	return new handler(core, user);
}
