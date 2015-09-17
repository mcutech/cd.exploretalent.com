'use strict';

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;

	self.refreshProjectDetails();
}

handler.prototype.refreshProjectDetails = function() {
	var project = null;
	self.core.resource.project.get({ projectId : self.projectId, withs : [ 'bam_roles' ] })
		.then(function(result) {
			project = result;
			return self.core.resource.job.get({ projectId : self.projectId, jobId : self.roleId })
		})
		.then(function(result) {
			project.role = result;
			self.core.service.databind('.page-header', project);
		});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
