'use strict';

function handler(core, user) {
	self = this;
	self.core = core;
	self.user = user

	var data = {
		query : [
			[ 'with', 'bam_roles' ]
		]
	};
	self.core.resource.project.get(data)
		.then(function(res) {
			self.core.service.databind('#projects-list', res);
			self.projects = res;
			self.refresh();
		});

}

handler.prototype.refresh = function() {
	var status = $('#status-list').val();

	var data = {
		query : [
			[ 'with', 'bam_role.bam_casting' ]
		]
	};

	if (status) {
		data.query.push([ 'where', 'status', '=', status ]);
	}

	self.core.resource.campaign.get(data)
		.then(function(res) {
			self.core.service.databind('#campaigns-list', res);
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
}
