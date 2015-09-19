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
		withs : [ 'bam_roles' ]
	};

	self.core.resource.project.get(data)
		.then(function(result) {
			self.project = result;
			self.core.service.databind('#roles-list', self.project);
			// get current role object
			self.project.role = _.find(self.project.bam_roles, function (role) {
				return role.role_id == self.roleId;
			});
			$('#roles-list').val(self.project.role.role_id);

			return self.refreshLikeItList();
		})
}

handler.prototype.refreshLikeItList = function() {
	var data = {
		jobId : self.roleId,
		withs : [
			'invitee.bam_talentci.bam_talentinfo1',
			'invitee.bam_talentci.bam_talentinfo2',
			'invitee.bam_talentci.bam_talent_media2',
			'inviter.bam_talentci.bam_talentinfo1',
			'inviter.bam_talentci.bam_talentinfo2',
			'inviter.bam_talentci.bam_talent_media2',
			'schedule_notes.user.bam_cd_user'
		],
		wheres : [
			[ 'where', 'rating', '<>', 0 ]
		]
	};

	return self.core.resource.schedule.get(data)
		.then(function(result) {
			self.project.role.likeitlist = result;
			self.core.service.databind('.page-header', self.project);
			self.core.service.databind('#submissions-sub-menu', self.project);
			self.core.service.databind('#like-it-list', self.project);
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
		_.each(self.project.role.likeitlist.data, function(schedule) {
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
