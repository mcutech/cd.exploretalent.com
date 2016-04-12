'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	self.getProjectInfo();
}

handler.prototype.getProjectInfo = function(e) {
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

			self.core.service.databind('#project-details', self.project);
			self.core.service.databind('.find-talents-wrapper', self.project)
		});
}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};
