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
			self.project.date = self.core.service.date;
			self.core.service.databind('#invite-to-audition-modal', self.project);

			return self.refreshLikeItList();
		})

}

handler.prototype.refreshLikeItList = function() {
	var qs = self.core.service.query_string();
	var data = {
		page : qs.page || 1
	};

	return self.project.role.getLikeItList(data)
		.then(function(result) {
			self.project.role.likeitlist = result;
			self.core.service.databind('.page-header', self.project);
			self.core.service.databind('#submissions-sub-menu', self.project);
			self.core.service.databind('#like-it-list', self.project);

			self.core.service.paginate('#like-it-list-pagination', { class : 'pagination', total : result.total, name : 'page' });
		});
}

handler.prototype.rateSchedule = function(e) {
	var $btn = $(e.target);
	var rating = $btn.text();
	var $parent = $btn.parent();
	var id = $parent.data('id').replace('schedule-', '');

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

handler.prototype.changeRole = function() {
	window.location = '/projects/' + self.projectId + '/roles/' + $('#roles-list').val() + '/like-it-list';
}

handler.prototype.refreshTalentPhotos = function(e){
	var id;

	if ($(e.target).is('a')) {
		id = $(e.target).attr('data-id');
	}
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

handler.prototype.sendInvites = function(e) {
	e.preventDefault();

	var form = self.core.service.form.serializeObject('.invite-to-audition-form');
	var schedules = self.project.role.likeitlist.data;

	// get schedules with rating
	if (form.rating instanceof Array) {
		// any not selected
		if (form.rating.indexOf('all') == -1) {
			schedules = _.filter(self.project.role.likeitlist.data, function(s) {
				console.log(s.rating);
				return form.rating.indexOf(s.rating + '') > -1;
			});
		}
	}
	else {
		if (form.rating != 'all') {
			schedules = _.filter(self.project.role.likeitlist.data, function(s) {
				return s.rating == form.rating;
			});
		}
	}

	var body = [
		'Casting: ' + form.casting_name + ' (ID #' + self.project.casting_id + ')',
		'Role: ' + form.role_name + ' (ID #' + self.project.role.role_id + ')',
		form.role_des,
		'Date: ' + form.casting_date,
		'Address: ' + form.address1 + ' ' + form.address2 + ' ' + form.city + ' ' + form.state + ' ' + form.zip,
		'\r\n',
		'Message from Casting Director:',
		'\r\n',
		form.message
	];

	body = body.join('\r\n');

	// create conversations for each schedule
	_.each(schedules, function(s) {
		var conversation;

		self.core.resource.conversation.get({ schedule_id : s.id })
			.then(function(result) {
				if (result.total > 0) {
					conversation = _.first(result.data);
					return $.when();
				}
				else {
					var data = {
						schedule_id : s.id,
						user_ids : [
							schedule.invitee_id,
							schedule.inviter_id
						]
					};
					return self.core.resource.conversation.post(data);
				}
			})
			.then(function(result) {
				if (result) {
					conversation = result;
				}

				var data = {
					conversationId : conversation.id,
					body : body
				}

				return self.core.resource.message.post(data);
			});
	});

	$('#send-invites-success').fadeIn().delay(3000).fadeOut();
}

handler.prototype.getDetailsForAddNoteModal = function() {

	self.core.service.databind('#cd-full-name-span', self.user);

	var scheduleId = $(this).attr('id');
		scheduleId = scheduleId.split("_");
		scheduleId = scheduleId[1];

	var data = { 
		scheduleId : scheduleId
	};


	_.find(self.project.role.likeitlist.data, function(obj) {
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
