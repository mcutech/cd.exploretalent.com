'use strict';
var _ = require('lodash');

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;
	self.project = null;
	self.favTalent = null;
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
			self.refreshMatches();
		});
}


handler.prototype.refreshMatches = function() {
	var qs = self.core.service.query_string();
	var data = self.getFilters();
	var talents;

	$('#role-match-loader').show();
	$('#role-match').hide();

	self.core.resource.search_talent.get(data)
		.then(function(res) {
			talents = res;
			if (talents.data.length < 1) {
				$('#role-match-loader').hide();
				alert('No results for search');
				return $.when();
			}

			var talentnums = _.map(talents.data, function(talent) {
				return talent.talentnum;
			});

			var data2 = {
				query : [
					[ 'with', 'user' ],
					[ 'with', 'bam_talentinfo1' ],
					[ 'with', 'bam_talentinfo2' ],
					[ 'with', 'bam_talent_media2' ],
					[ 'whereIn', 'talentci.talentnum', talentnums ]
				]
			};

			return self.core.resource.talent.get(data2)
		})
		.then(function(result) {
			result.total = talents.total;
			result.page = talents.page;
			self.project.role.matches = result;

			// get talent user ids to get schedule
			var talentIds = _.map(self.project.role.matches.data, function(n) {
				if (n.user) {
					return n.user.id;
				}
			});

			if (talentIds.length > 0) {
				var data = {
					withs : [
						'schedule_notes.user.bam_cd_user'
					],
					query : [
						[ 'whereIn', 'invitee_id', talentIds ],
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
			var talentnums = _.map(self.project.role.matches.data, function(n) {
				return n.talentnum;
			});

			if (talentnums.length > 0) {
				var data = {
					query : [
						[ 'with', 'bam_talentci.user' ],
						[ 'whereIn', 'bam_talentnum', talentnums ]
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
			});

			self.core.service.databind('#role-match', self.project);

			self.core.service.paginate('#matches-pagination', { total : self.project.role.matches.total, class : 'pagination', name : 'page' });
			$('#role-match-loader').hide();
			$('#role-match').show();
		});
}


handler.prototype.rateSchedule = function(e) {
	var $btn = $(e.target);
	var $parent = $btn.parent();
	var scheduleId = $parent.attr('data-id').replace('schedule-', '');
	var rating = $btn.text();

	if (parseInt(scheduleId)) {
		self.core.resource.schedule.patch({ scheduleId : scheduleId, rating : rating })
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
			});
	}
	else {
		var userId = $parent.attr('data-id').replace('user-', '');
		var data = {
			bam_role_id		: self.roleId,
			invitee_id		: userId,
			inviter_id		: self.user.id,
			rating			: rating,
			invitee_status	: self.core.resource.schedule_cd_status.PENDING,
			inviter_status	: self.core.resource.schedule_cd_status.PENDING,
			status			: self.core.resource.schedule_status.PENDING
		}
		self.core.resource.schedule.post(data)
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
			});
	}
}

handler.prototype.removeAllLikeItList = function() {
	if (confirm('Are you sure you want to remove all Like It List entries?')) {
		self.project.role.deleteLikeItList()
			.then(function() {
				alert('Like It List entries removed.');
			});
	}
}

handler.prototype.rateAll = function() {
	var data = self.getFilters();

	self.core.service.rest.post(self.core.config.api.base + '/cd/talentci/import/' + self.roleId, data)
		.then(function(result) {
			self.refreshLikeItList();
		});
}

handler.prototype.changeRole = function() {
	window.location = '/projects/' + self.projectId + '/roles/' + $('#roles-list').val() + '/matches';
}

handler.prototype.addToFav = function(e){
	var $element = $(e.target);
	var $icon;
	if (!$element.is('button')) {
		$icon = $element;
		$element = $element.parents('button');
	}
	else {
		$icon = $element.find('i');
	}

	var favId = $(this).attr('data-id');
	var b = $(this).closest('.talent-tab').attr('id');
	var talentnum = (b.split('-')[2]);
	if(favId){
		self.core.resource.favorite_talent.delete({ favoriteId : talentnum})
			.then(function(res){
				$icon.addClass('text-light-gray');
				$icon.removeClass('text-warning');
				$element.attr('data-id', '');
			});
	} else {
		self.core.resource.favorite_talent.post({ bam_cd_user_id : self.user.bam_cd_user_id, bam_talentnum : talentnum})
			.then(function(res){
				$icon.addClass('text-warning');
				$icon.removeClass('text-light-gray');
				$element.attr('data-id', res.id);
			});
	}
}

handler.prototype.getDetailsForAddNoteModal = function() {

	self.core.service.databind('#cd-full-name-span', self.user);

	var id = $(this).attr("id");
		id = id.split("_");
		id = id[1].split("-");

	if(id[0] == "user") { // no existing schedule yet
		var userId = id[1];
		var data = {
			bam_role_id		: self.roleId,
			invitee_id		: userId,
			inviter_id		: self.user.id,
			rating			: 0,
			invitee_status	: self.core.resource.schedule_cd_status.PENDING,
			inviter_status	: self.core.resource.schedule_cd_status.PENDING,
			status			: self.core.resource.schedule_status.PENDING
		}

		self.core.resource.schedule.post(data)
			.then(function(res) {
				self.core.service.databind('#utility-buttons', res);
			});
	}

	else { // existing schedule
		var scheduleId = id[1];

		var data = {
			scheduleId : scheduleId
		};

		self.core.resource.schedule.get({ scheduleId : scheduleId })
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

handler.prototype.getFilters = function() {
	var qs = self.core.service.query_string();
	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var data = {
		query 	: [
		],
		page	: qs.page || 1
	};

	if (form.zip) {
		data.query.push([ 'where', 'zip', '=', form.zip ]);
	}

	if (parseInt(form.age_min)) {
		data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
	}

	if (parseInt(form.age_max)) {
		data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ]);
	}

	if (form.sex) {
		if (!(form.sex instanceof Array)) {
			data.query.push([ 'where', 'sex', '=', form.sex ]);
		}
	}

	if (form.has_photo) {
		if (!(form.has_photo instanceof Array)) {
			data.query.push([ 'where', 'has_photos', '=', form.has_photo ]);
		}
	}

	if (parseInt(form.height_min)) {
		data.query.push([ 'where', 'heightinches', '>=', form.height_min ]);
	}

	if (parseInt(form.height_max)) {
		data.query.push([ 'where', 'heightinches', '<=', form.height_max ]);
	}

	if (form.build) {
		if (form.build instanceof Array) {
			var subfilter = [];
			_.each(form.build, function(build, index) {
				if (index > 0) {
					subfilter.push([ 'orWhere', 'build', '=', build ]);
				}
				else {
					subfilter.push([ 'where', 'build', '=', build ]);
				}
			});

			data.query.push([ 'where', subfilter ]);
		}
		else {
			data.query.push([ 'where', 'build', '=', form.build ]);
		}
	}

	if (form.ethnicity) {
		if (form.ethnicity instanceof Array) {
			var subfilter = [];
			_.each(form.ethnicity, function(ethnicity, index) {
				if (index > 0) {
					subfilter.push([ 'orWhere', 'ethnicity', '=', ethnicity ]);
				}
				else {
					subfilter.push([ 'where', 'ethnicity', '=', ethnicity ]);
				}
			});

			data.query.push([ 'where', subfilter ]);
		}
		else {
			data.query.push([ 'where', 'ethnicity', '=', form.ethnicity ]);
		}
	}

	if (form.join_status) {
		if (!(form.join_status instanceof Array)) {
			if (form.join_status == 5) {
				data.query.push([ 'where', 'is_pro', '=', 1 ]);
			}
			else {
				data.query.push([ 'where', 'is_pro', '=', 0 ]);
			}
		}
	}

	return data;
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
