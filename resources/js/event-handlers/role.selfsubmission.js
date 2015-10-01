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
	return self.project.role.getLikeItList()
		.then(function(result) {

			self.project.role.likeitlist = result;
			self.core.service.databind('.page-header', self.project);
			self.core.service.databind('#submissions-sub-menu', self.project);

			return self.refreshSelfSubmissions();
		});
}

handler.prototype.refreshSelfSubmissions = function() {
	var qs = self.core.service.query_string();

	var data = {
		where	: self.filter,
		page	: qs.page || 1
	}

	return self.project.role.getSelfSubmissions(data)
		.then(function(result) {
			
			self.project.role.selfsubmissions = result;
			self.core.service.databind('#self-submissions', self.project);

			self.core.service.paginate('#self-submissions-pagination', { class : 'pagination', total : result.total, name : 'page' });
		});
}

handler.prototype.updateFilter = function() {
	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var filter = [];

	if (form.zip) {
		filter.push([ 'whereHas', 'inviter.bam_talentci', [
				[ 'where', 'talentci.zip', '=', form.zip ]
			]
		]);
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
			filter.push([ 'whereHas', 'inviter.bam_talentci.bam_talentinfo1', [
					[ 'where', 'talentinfo1.sex', '=', form.sex ]
				]
			]);
		}
	}

	if (form.has_photo) {
		if (form.has_photo instanceof Array) {
			// do nothing, if its an array then items is => 2, only 2 items so select all
		}
		else {
			if (parseInt(form.has_photo)) {
				filter.push([ 'whereHas', 'inviter.bam_talentci.bam_talent_media2', [
						[ 'where', 'talent_media2.media_path', '<>', null ]
					]
				]);
			}
			else {
				filter.push([ 'whereHas', 'inviter.bam_talentci.bam_talent_media2', [
						[ 'where', 'talent_media2.media_path', '=', null ]
					]
				]);
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

			filter.push([ 'whereHas', 'inviter.bam_talentci.bam_talentinfo1', [
					[ 'where', subfilter ]
				]
			]);
		}
		else {
			filter.push([ 'whereHas', 'inviter.bam_talentci.bam_talentinfo1', [
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

			filter.push([ 'whereHas', 'inviter.bam_talentci.bam_talentinfo2', [
					[ 'where', subfilter ]
				]
			]);
		}
		else {
			filter.push([ 'whereHas', 'inviter.bam_talentci.bam_talentinfo2', [
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
				filter.push([ 'whereHas', 'inviter.bam_talentci', [
						[ 'where', 'talentci.join_status', '=', 5 ]
					]
				]);
			}
			else {
				filter.push([ 'whereHas', 'inviter.bam_talentci', [
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
	var id = $parent.data('id').replace('schedule-', '');

	if (parseInt(id)) {
		self.core.resource.schedule.patch({ jobId : self.roleId, scheduleId : id, rating : rating })
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
				self.refreshLikeItList();
			});
	}
	else {
		var userId = $parent.data('id').replace('user-', '');
		self.core.resource.schedule.post({ jobId : self.roleId, invitee_id : userId, inviter_id : self.user.id, rating : rating })
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
				self.refreshLikeItList();
			});
	}
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
handler.prototype.refreshTalentPhotos = function(e){
	var id;
	if ($(e.target).is('a'))
		id = $(e.target).attr('data-id');
	else {
		id = $(e.target).parents('a').attr('data-id');
	}
	var data = {
		talentId :id,
		withs : [
			'bam_talent_media2'
		]
	};
	return self.core.resource.talent.get(data)
		.then(function(talent) {
			console.log(talent.getFullName());
			self.core.service.databind('#talent-photos-modal', talent);
		});
}

handler.prototype.changeRole = function() {
	window.location = '/projects/' + self.projectId + '/roles/' + $('#roles-list').val() + '/self-submissions';
}

handler.prototype.getDetailsForAddNoteModal = function() {

	self.core.service.databind('#cd-full-name-span', self.user);

	var scheduleId = $(this).attr('id');
		scheduleId = scheduleId.split("_");
		scheduleId = scheduleId[1];

	var data = { 
		scheduleId : scheduleId
	};


	_.find(self.project.role.selfsubmissions.data, function(obj) {
	  if(obj.id == scheduleId) {
	  	self.core.service.databind('#utility-buttons', obj);
	  }
	});

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
