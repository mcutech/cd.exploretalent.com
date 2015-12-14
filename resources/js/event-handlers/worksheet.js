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
	var projectId = $('#projects-list').val();
	var data = {
		query : [
			[ 'with', 'bam_role.bam_casting' ]
		]
	};

	var project = _.find(self.projects.data, function(p) {
		return p.casting_id == projectId;
	});

	if (project) {
		var roleIds = _.map(project.bam_roles, function(r) {
			return r.role_id;
		});

		if (!roleIds.length)
			roleIds = [ 0 ];

		data.query.push([ 'whereIn', 'bam_role_id', roleIds ]);
	}

	self.core.resource.campaign.get(data)
		.then(function(res) {
			self.core.service.databind('#campaigns-list', res);
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
}
