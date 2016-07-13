'use strict';
var _ = require('lodash');

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.refresh();
	console.log(self.user);
}

handler.prototype.refresh = function(){
	self.core.service.databind('#talent-email', self.user);
}

handler.prototype.saveChanges = function() {
	console.log(self.user);

	var data = {
		query : [
			['where', 'bam_cd_user_id', self.user.bam_cd_user_id]
		]
	}

	self.core.resource.cd_user_subscription.get(data)
	.then(function(res) {
		console.log(res)
		if(res.total==0){
			var data = {
				bam_cd_user_id : self.user.user_id,
				sms : $('#emailchck').is(':checked') ? 0 : 1,
				email : $('#smschck').is(':checked') ? 0 : 1
			}
			self.core.resource.cd_user_subscription.post(data)
			.then(function(res) {
				window.location = '/';
			});
		} else {
			var data = {
				subscriptionId: res.data[0].id,
				sms : $('#emailchck').is(':checked') ? 0 : 1,
				email : $('#smschck').is(':checked') ? 0 : 1
			}
			self.core.resource.cd_user_subscription.patch(data)
			.then(function(res) {
				console.log(res);
				window.location = '/';
			});
		}
	});
}

module.exports = function(core, user) {
	return new handler(core, user);
};
