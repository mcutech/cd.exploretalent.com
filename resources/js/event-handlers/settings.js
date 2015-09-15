'use strict';

function handler(core, user) {
	self = this;
	self.core = core;
	self.user = user;

	self.refresh();
}

handler.prototype.refresh = function() {
	return self.core.service.databind('#settings', self.user.bam_cd_user);
}

handler.prototype.updateUser = function(e) {
	e.preventDefault();
	var form = self.core.service.form.serializeObject('#settings-form');

	form.cdUserId = self.user.bam_cd_user_id;

	self.core.resource.cd_user.patch(form)
		.then(function(res) {
			$('#update-settings-success').fadeIn().delay(5000).fadeOut();
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
}
