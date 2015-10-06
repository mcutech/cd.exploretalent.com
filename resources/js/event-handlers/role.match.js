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
			self.core.service.databind('#talent-filter-form', self.project);
			return self.refreshLikeItList();
		});
}

handler.prototype.refreshLikeItList = function() {
	return self.project.role.getLikeItList()
		.then(function(result) {
			self.project.role.likeitlist = result;
			self.core.service.databind('.page-header', self.project);
			self.core.service.databind('#submissions-sub-menu', self.project);
			self.updateFilter();
		});
}


handler.prototype.refreshMatches = function() {
	var qs = self.core.service.query_string();
	var data = {
		withs	: [
			'user',
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_media2'
		],
		wheres : [
		],
		page : qs.page || 0
	}

	if (self.filter) {
		data.wheres = data.wheres.concat(self.filter);
	}

	self.core.resource.talent.get(data)
		.then(function(result) {
			self.project.role.matches = result;

			// get talent user ids to get schedule
			var talents = _.map(self.project.role.matches.data, function(n) {
				if (n.user) {
					return n.user.id;
				}
			});

			if (talents.length > 0) {
				var data = {
					jobId : self.project.role.role_id,
					withs : [
						'schedule_notes.user.bam_cd_user'
					],
					query : [
						[ 'whereIn', 'invitee_id', talents ],
					]
				};

				return self.core.resource.schedule.get(data);
			}
			else {
				return $.when();
			}
		})
		.then(function(result) {
			// assign each schedule to respective talent
			_.each(self.project.role.matches.data, function(talent, index) {
				self.project.role.matches.data[index].schedule = {};
				_.each(result.data, function(s) {
					if (talent.user && talent.user.id == s.invitee_id) {
						self.project.role.matches.data[index].schedule = s;
					}
				});
			});

			// get talentnum to get favorite_talent
			var talents = _.map(self.project.role.matches.data, function(n) {
				return n.talentnum;
			});

			if (talents.length > 0) {
				var data = {
					query : [
						[ 'with', 'bam_talentci.user' ],
						[ 'whereIn', 'bam_talentnum', talents ]
					]
				}

				return self.core.resource.favorite_talent.get(data);
			}
			else {
				return $.when();
			}
		})
		.then(function(result) {
			// asssign each favorite object to respective talent
			_.each(self.project.role.matches.data, function(talent, index) {
				self.project.role.matches.data[index].favorite = null;
				_.each(result.data, function(n) {
					if (talent.talentnum == n.bam_talentnum) {
						self.project.role.matches.data[index].favorite = n;
					}
				});
				console.log(talent);
			});

			self.core.service.databind('#role-match', self.project);

			self.core.service.paginate('#matches-pagination', { total : self.project.role.matches.total, class : 'pagination', name : 'page' });
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

handler.prototype.changeRole = function() {
	window.location = '/projects/' + self.projectId + '/roles/' + $('#roles-list').val() + '/matches';
}

handler.prototype.getDetailsForAddNoteModal = function() {

	self.core.service.databind('#cd-full-name-span', self.user);

	var id = $(this).attr("id");
		id = id.split("_");
		id = id[1].split("-");

	if(id[0] == "user") { // no existing schedule yet
		var userId = id[1];
		self.core.resource.schedule.post({ jobId : self.roleId, invitee_id : userId, inviter_id : self.user.id, rating : 0 })
			.then(function(res) {
				self.core.service.databind('#utility-buttons', res);
			});
	}

	else { // existing schedule
		var scheduleId = id[1];

		var data = {
			scheduleId : scheduleId
		};

		self.core.resource.schedule.get({ jobId : self.roleId, scheduleId : scheduleId })
			.then(function(res) {
				console.log(res);
				self.core.service.databind('#utility-buttons', res);
			});
	}

}

handler.prototype.getDetailsForEditNoteModal = function() {
	var ids = $(this).attr('id');
		ids = ids.split("_");

	var scheduleId = ids[1];
	var noteId = ids[2];

	var data = {
		scheduleId: scheduleId,
		noteId: noteId,
	};

	self.core.resource.schedule_note.get(data)
	.then(function(res) {

		self.core.service.databind('.talent-note-body-edit', res);
		self.core.service.databind('#note-created-at', res);
		self.core.service.databind('#note-utility', res);

		var data = {
			cdUserId : self.user.bam_cd_user_id
		}

		self.core.resource.cd_user.get(data)
		.then(function(res){
			self.core.service.databind('#cd-full-name-span-edit', res);
		});
	});
}

handler.prototype.addNoteForTalent = function(e) {

	e.preventDefault();

	var scheduleId = $(this).attr('id');
		scheduleId = scheduleId.split("_");
		scheduleId = scheduleId[1];

	var noteBody = $('.talent-note-body').val();

	if(noteBody.length < 1) {
		$('.talent-note-body').focus();
		$('.note-required').fadeIn().delay(3000).fadeOut();
	}

	else {
		var data = {
			scheduleId: scheduleId,
			body: noteBody,
		};

		self.core.resource.schedule_note.post(data)
		.then(function(res) {
			$('.note-required').hide();
			$('.note-saved-success').fadeIn();
			setTimeout(function() {
				location.reload();
			}, 3000);
		});
	}

}

handler.prototype.editNoteForTalent = function(e) {

	e.preventDefault();

	var ids = $(this).attr('id');
		ids = ids.split("_");

	var	scheduleId = ids[1];
	var noteId = ids[2];

	var noteBody = $('.talent-note-body-edit').val();

	if(noteBody.length < 1) {
		$('.talent-note-body-edit').focus();
		$('.note-required').fadeIn().delay(3000).fadeOut();
	}

	else {
		var data = {
			scheduleId: scheduleId,
			noteId: noteId,
			body: noteBody,
		};

		self.core.resource.schedule_note.patch(data)
		.then(function(res) {
			$('.note-required').hide();
			$('.note-saved-success').fadeIn();
			setTimeout(function() {
				location.reload();
			}, 3000);
		});
	}
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
