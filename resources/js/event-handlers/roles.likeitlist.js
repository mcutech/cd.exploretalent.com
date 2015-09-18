'use strict';

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;
	self.project = null;

	self.refreshProjectDetails();
}

handler.prototype.refreshProjectDetails = function() {
	var data = {
		projectId : self.projectId,
		withs : [ 'bam_roles.schedules' ]
	};

	self.core.resource.project.get(data)
		.then(function(result) {
			self.project = result;
			self.core.service.databind('#roles-list', self.project);
			return self.refreshLikeItList();
		})
}

handler.prototype.refreshLikeItList = function() {
	var data = {
		projectId : self.projectId,
		jobId : self.roleId,
		withs : [
			'schedules.invitee.bam_talentci.bam_talentinfo1',
			'schedules.invitee.bam_talentci.bam_talentinfo2',
			'schedules.invitee.bam_talentci.bam_talent_media2',
			'schedules.inviter.bam_talentci.bam_talentinfo1',
			'schedules.inviter.bam_talentci.bam_talentinfo2',
			'schedules.inviter.bam_talentci.bam_talent_media2',
			'schedules.schedule_notes.user.bam_cd_user'
		]
	};

	return self.core.resource.job.get(data)
		.then(function(result) {
			self.project.role = result;
			self.core.service.databind('.page-header', self.project);
			$('#roles-list').val(self.project.role.role_id);
			self.core.service.databind('#like-it-list', { data : self.project.role.getLikeItList() });
		});
}

handler.prototype.rateSchedule = function(e) {
	var $btn = $(e.target);
	var rating = $btn.text();
	var $parent = $btn.parent();
	var id = $parent.data('id');

	self.core.resource.schedule.patch({ jobId : self.roleId, scheduleId : id, rating : rating })
		.then(function() {
			$parent.find('.rating-button').removeClass('active');
			$btn.addClass('active');
		});
}

handler.prototype.removeAllLikeItList = function() {
	if (confirm('Are you sure you want to remove all Like It List entries?')) {
		var promises = [];
		_.each(self.project.role.schedules, function(schedule) {
			promises.push(self.core.resource.schedule.patch({ jobId : schedule.bam_role_id, scheduleId : schedule.id, rating : 0 }));
		});

		$.when.apply($, promises).then(function() {
			alert('Like It List entries removed');
			self.refreshLikeItList();
		});
	}
}

handler.prototype.unrateSchedule = function(e) {
	if (confirm('Are you sure you want to remove this entry?')) {
		var id;
		if ($(e.target).is('a'))
			id = $(e.target).attr('data-id');
		else {
			id = $(e.target).parents('a').attr('data-id');
		}

		self.core.resource.schedule.patch({ jobId : self.project.role.role_id, scheduleId : id, rating : 0 })
			.then(function() {
				alert('Entry removed.');
				self.refreshLikeItList();
			});
	}
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
