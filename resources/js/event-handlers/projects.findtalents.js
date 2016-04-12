'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	self.getProjectInfo();
}

handler.prototype.getProjectInfo = function() {
	var data = {
		projectId : self.projectId,
		query : [
			[ 'with', 'bam_roles' ]
		]
	}

	self.core.resource.project.get(data)
		.then(function(res) {
			self.project = res;

			var markets = _.map(self.project.market.split('>'), function(m) {
				return { name : m };
			});

			self.project.markets = { data : markets };
			self.core.service.databind('#project-details', res)
			self.core.service.databind('#project-roles', { data : res.bam_roles })
		});
}

handler.prototype.selectRole = function() {
	var roleId = $('#select-role').val();

	var data = {
		projectId : self.projectId,
		roleId : roleId,
		query : [
			[ 'with', 'bam_casting' ],
		]
	}


	self.core.resource.job.get(data)
		.then(function(res) {
			console.log(res);
			self.core.service.databind('#talent-filter-form', res)
		});


}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};
