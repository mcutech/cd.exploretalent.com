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

	var data = {
		projectId : self.projectId,
		withs : [ 'bam_roles.schedules' ]
	};

	self.core.resource.project.get(data)
		.then(function(result) {
			data = {
				projectId : self.projectId,
				jobId : self.roleId,
				withs : [
					'schedules.invitee.bam_talentci.bam_talentinfo1',
					'schedules.invitee.bam_talentci.bam_talentinfo2',
					'schedules.invitee.bam_talentci.bam_talent_media2',
					'schedules.inviter.bam_talentci.bam_talentinfo1',
					'schedules.inviter.bam_talentci.bam_talentinfo2',
					'schedules.inviter.bam_talentci.bam_talent_media2'
				]
			};

			project = result;
			return self.core.resource.job.get(data);
		})
		.then(function(result) {
			console.log(result);
			project.role = result;
			self.core.service.databind('.page-header', project);
			self.core.service.databind('#roles-list', project);
			$('#roles-list').val(project.role.role_id);
			self.core.service.databind('#like-it-list', { data : project.role.getLikeItList() });
		});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
