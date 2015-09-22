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

	self.core.resource.project.get(data) .then(function(result) {
		self.project = result;
		self.core.service.databind('#roles-list', self.project);
		// get current role object
		self.project.role = _.find(self.project.bam_roles, function (role) {
			return role.role_id == self.roleId;
		});

		$('#roles-list').val(self.project.role.role_id);
		self.core.service.databind('#talent-filter-form', self.project);

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

			self.updateFilter();
		});
}

handler.prototype.refreshMatches = function() {
	var data = {
		withs	: [
			'user',
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_media2'
		],
		wheres : [
			[ 'leftJoin', 'laret_users', 'laret_users.bam_talentnum', '=', 'talentci.talentnum' ],
			[ 'select', '*', 'laret_favorite_talents.id AS favorite', 's1.id AS schedule_id1', 's2.id AS schedule_id2', 's1.rating AS rating1', 's2.rating AS rating2' ],
			[ 'leftJoin', 'laret_favorite_talents', 'laret_favorite_talents.bam_talentnum', '=', 'talentci.talentnum' ],
			[ 'leftJoin', 'laret_schedules AS s1', 's1.invitee_id', '=', 'laret_users.id' ],
			[ 'leftJoin', 'laret_schedules AS s2', 's2.inviter_id', '=', 'laret_users.id' ],
			[ 'where', [
					[ 'where', 'laret_favorite_talents.bam_cd_user_id', '=', self.user.bam_cd_user_id ],
					[ 'orWhere', [
							[ 'whereNull', 'laret_favorite_talents.bam_cd_user_id']
						]
					]
				]
			]
		]
	}

	if (self.filter) {
		data.wheres = data.wheres.concat(self.filter);
	}

	self.core.resource.talent.get(data)
		.then(function(result) {
			console.log(result);
			self.project.role.matches = result;
			self.core.service.databind('#role-match', self.project);
		});
}

handler.prototype.updateFilter = function() {
	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var filter = [];

	if (form.zip) {
		filter.push([ 'where', 'talentci.zip', '=', form.zip ]);
	}

	if (parseInt(form.age_min)) {
		filter.push([ 'where', 'talentinfo1.dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
	}

	if (parseInt(form.age_max)) {
		filter.push([ 'where', 'talentinfo1.dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ]);
	}


	if (form.sex) {
		if (form.sex instanceof Array) {
			// do nothing, if its an array then items is => 2, only 2 items so select all
		}
		else {
			filter.push([ 'where', 'talentinfo1.sex', '=', form.sex ]);
		}
	}

	if (form.has_photo) {
		if (form.has_photo instanceof Array) {
			// do nothing, if its an array then items is => 2, only 2 items so select all
		}
		else {
			if (parseInt(form.has_photo)) {
				filter.push([ 'where', 'talent_media2.media_path', '<>', null ]);
			}
			else {
				filter.push([ 'where', 'talent_media2.media_path', '=', null ]);
			}
		}
	}

	if (parseInt(form.height_min)) {
		filter.push([ 'where', 'talentinfo1.heightinches', '>=', form.height_min ]);
	}

	if (parseInt(form.height_max)) {
		filter.push([ 'where', 'talentinfo1.heightinches', '<=', form.height_max ]);
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

			filter.push([ 'where', subfilter ]);
		}
		else {
			filter.push([ 'where', 'talentinfo1.build', '=', form.build ]);
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

			filter.push([ 'where', subfilter ]);
		}
		else {
			filter.push([ 'where', 'talentinfo2.ethnicity', '=', form.ethnicity ]);
		}
	}

	if (form.join_status) {
		if (form.join_status instanceof Array) {
			// do nothing, if its an array then items is => 2, only 2 items so select all
		}
		else {
			if (form.join_status == 5) {
				filter.push([ 'where', 'talentci.join_status', '=', 5 ]);
			}
			else {
				filter.push([ 'where', 'talentci.join_status', '<>', 5 ]);
			}
		}
	}

	self.filter = filter;
	self.refreshMatches();
}

handler.prototype.rateSchedule = function(e) {
	var $btn = $(e.target);
	var $parent = $btn.parent();
	var scheduleId = $parent.attr('data-id').replace('schedule-', '');
	var rating = $btn.text();

	if (parseInt(scheduleId)) {
		console.log({ jobId : self.roleId, scheduleId : scheduleId, rating : rating });
		self.core.resource.schedule.patch({ jobId : self.roleId, scheduleId : scheduleId, rating : rating })
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
			});
	}
	else {
		var userId = $parent.attr('data-id').replace('user-', '');
		self.core.resource.schedule.post({ jobId : self.roleId, invitee_id : userId, inviter_id : self.user.id, rating : rating })
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
			});
	}

	self.refreshLikeItList();
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

handler.prototype.rateAll = function() {
	var data = {
		withs	: [
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_media2'
		],
		wheres : self.filter
	}

	self.core.service.rest.post(self.core.config.api.base + '/cd/talentci/import/' + self.roleId, data)
		.then(function(result) {
			self.refreshLikeItList();
		});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
