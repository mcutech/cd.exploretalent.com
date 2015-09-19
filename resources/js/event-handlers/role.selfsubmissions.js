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

			return self.refreshSelfSubmissions();
		});
}

handler.prototype.refreshSelfSubmissions = function() {
	var data = {
		jobId : self.roleId,
		withs : [
			'invitee.bam_talentci.bam_talentinfo1',
			'invitee.bam_talentci.bam_talentinfo2',
			'invitee.bam_talentci.bam_talent_media2',
			'schedule_notes.user.bam_cd_user'
		],
		wheres : [
			[ 'where', 'rating', '=', 0 ]
		]
	};

	if (self.filter) {
		data.wheres = data.wheres.concat(self.filter);
	}

	return self.core.resource.schedule.get(data)
		.then(function(result) {
			self.project.role.selfsubmissions = result;
			self.core.service.databind('#self-submissions', self.project);
		});
}

handler.prototype.updateFilter = function() {
	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var filter = [];

	if (form.zip) {
		filter.push([ 'whereHas', 'invitee.bam_talentci', [
				[ 'where', 'talentci.zip', '=', form.zip ]
			]
		]);
	}

	if (form.sex) {
		if (form.sex instanceof Array) {
			// do nothing, if its an array then items is => 2, only 2 items so select all
		}
		else {
			filter.push([ 'whereHas', 'invitee.bam_talentci.bam_talentinfo1', [
					[ 'where', 'talentinfo1.sex', '=', form.sex ]
				]
			]);
		}
	}

	if (form.build) {
		if (form.build instanceof Array) {
			var subfilter = [];
			_.each(form.build, function(build, index) {
				if (index > 0) {
					subfilter.push([ 'orWhere', 'talentinfo1.build', '=', build ]);
				}
				else {
					subfilter.push([ 'where', 'talentinfo1.build', '=', build ]);
				}
			});

			filter.push([ 'whereHas', 'invitee.bam_talentci.bam_talentinfo1', [
					[ 'where', subfilter ]
				]
			]);
		}
		else {
			filter.push([ 'whereHas', 'invitee.bam_talentci.bam_talentinfo1', [
					[ 'where', 'talentinfo1.build', '=', form.build ]
				]
			]);
		}
	}

	if (form.ethnicity) {
		if (form.ethnicity instanceof Array) {
			var subfilter = [];
			_.each(form.ethnicity, function(ethnicity, index) {
				if (index > 0) {
					subfilter.push([ 'orWhere', 'talentinfo2.ethnicity', '=', ethnicity ]);
				}
				else {
					subfilter.push([ 'where', 'talentinfo2.ethnicity', '=', ethnicity ]);
				}
			});

			filter.push([ 'whereHas', 'invitee.bam_talentci.bam_talentinfo2', [
					[ 'where', subfilter ]
				]
			]);
		}
		else {
			filter.push([ 'whereHas', 'invitee.bam_talentci.bam_talentinfo2', [
					[ 'where', 'talentinfo2.ethnicity', '=', form.ethnicity ]
				]
			]);
		}
	}

	if (form.join_status) {
		if (form.join_status instanceof Array) {
			// do nothing, if its an array then items is => 2, only 2 items so select all
		}
		else {
			if (form.join_status == 5) {
				filter.push([ 'whereHas', 'invitee.bam_talentci', [
						[ 'where', 'talentci.join_status', '=', 5 ]
					]
				]);
			}
			else {
				filter.push([ 'whereHas', 'invitee.bam_talentci', [
						[ 'where', 'talentci.join_status', '<>', 5 ]
					]
				]);
			}
		}
	}

	self.filter = filter;
	self.refreshSelfSubmissions();
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
			self.refreshLikeItList();
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

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}