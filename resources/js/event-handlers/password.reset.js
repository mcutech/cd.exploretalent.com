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
			return core.service.rest.post(core.config.api.base.replace('/v1', '') + '/oauth/access_token', {
				username       : self.user.bam_cd_user.email1,
				password       : pass1,
				client_id      : '74d89ce4c4838cf495ddf6710796ae4d5420dc91',
				client_secret  : '61c9b2b17db77a27841bbeeabff923448b0f6388',
				grant_type     : 'password'
			});
		})
		.then(function(result){
			localStorage.setItem('access_token', result.access_token);
			core.service.rest.settings.header = { Authorization : 'Bearer ' + result.access_token };

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
