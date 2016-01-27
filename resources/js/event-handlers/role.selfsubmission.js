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

			self.project.markets = _.map(self.project.market.split('>'), function(market) {
				return { name : market };
			});

			$('#roles-list').val(self.project.role.role_id);

			return self.refreshLikeItList();
		})
}

handler.prototype.refreshLikeItList = function(soft) {
	var data = {
		query : [
			[ 'where', 'bam_role_id', '=', self.roleId ],
			[ 'where', 'bam_user_id', '=', 0 ],
			[ 'where', 'status', '<', 2 ]
		]
	};

	return self.core.resource.schedule_import.get(data)
		.then(function(res) {
			self.project.role.schedule_import = _.first(res.data);

			if (self.project.role.schedule_import) {
				var elapsed = new Date() - new Date(self.project.role.schedule_import.created_at + ' GMT');
				var rate = self.project.role.schedule_import.count_done / (elapsed / 1000);
				var remaining = (self.project.role.schedule_import.count_total - self.project.role.schedule_import.count_done) / rate;

				if (rate) {
					self.project.role.schedule_import.estimated_time = 'Estimated ' + Math.floor(remaining / 60) + ' minutes ' + Math.floor(remaining % 60) + ' second/s remaining.';
				}
				else {
					self.project.role.schedule_import.estimated_time = 'Calculating remaining time...';
				}
			}

			return self.project.role.getLikeItList();
		})
		.then(function(result) {
			self.project.role.likeitlist = result;
			self.core.service.databind('.page-header', self.project);
			self.core.service.databind('#submissions-sub-menu', self.project);
			self.core.service.databind('#like-it-list-div', self.project);

			if (!soft) {
				self.refreshSelfSubmissions();
			}

			if (self.project.role.schedule_import) {
				setTimeout(function() {
					self.refreshLikeItList(true);
				}, 5000);
			}
		});
}

handler.prototype.refreshSelfSubmissions = function() {
	var data = self.getFilters();
	var total;

	return self.core.resource.search_talent.get(data)
		.then(function(res) {
			total = res.total;
			var ids = _.map(res.data, function(talent) {
				return talent.id;
			});

			ids.push(0);

			var data2 = {
				query : [
					[ 'with', 'invitee.bam_talentci.bam_talentinfo1' ],
					[ 'with', 'invitee.bam_talentci.bam_talentinfo2' ],
					[ 'with', 'invitee.bam_talentci.bam_talent_media2' ],
					[ 'with', 'schedule_notes.user.bam_cd_user' ],
					[ 'whereIn', 'id', ids ]
				]
			};

			return self.core.resource.schedule.get(data2);
		})
		.then(function(res) {
			res.total = total;
			self.project.role.selfsubmissions = res;
			self.core.service.databind('#self-submissions', self.project);
			self.core.service.paginate('#self-submissions-pagination', { class : 'pagination', total : res.total, name : 'page' });

			self.getFavoriteTalents();

			$('#loading-div').hide();
			$('#self-submissions-counter').text(res.total); // counter
		});
}

handler.prototype.getFavoriteTalents = function() {
	var talents = _.map(self.project.role.selfsubmissions.data, function(n) {
		return n.invitee.bam_talentnum;
	});

	if (talents.length > 0) {
		var data = {
			query : [
				[ 'with', 'bam_talentci.user' ],
				[ 'whereIn', 'bam_talentnum', talents ]
			]
		};

		self.core.resource.favorite_talent.get(data)
			.then(function(result) {
				self.favTalent = result;
				_.each(result.data, function(talent) {
					$('#favorite-' + talent.bam_talentci.user.id).removeClass('text-light-gray').addClass('text-warning');
				});
			});
	}
}

handler.prototype.getFilters = function() {
	var qs = self.core.service.query_string();
	var data = {
		q : [
			[ 'select', 'bam.laret_schedules.id' ],
			[ 'join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'search.talents.talentnum' ],
			[ 'join', 'bam.laret_schedules', 'bam.laret_schedules.invitee_id', '=', 'bam.laret_users.id' ],
			[ 'where', 'bam.laret_schedules.submission', '=', 1 ],
			[ 'where', 'bam.laret_schedules.bam_role_id', '=', self.project.role.role_id ]
		],
		page	: qs.page || 1
	};

	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var subquery = [];

	if (form.markets.length > 0) {
		subquery = [];

		_.each(form.markets, function(market) {
			if (market) {
				if (subquery.length == 0) {
					subquery.push([ 'where', 'city', 'like', '%' + market + '%' ]);
				}
				else {
					subquery.push([ 'orWhere', 'city', 'like', '%' + market + '%' ]);
				}

				subquery.push([ 'orWhere', 'city1', 'like', '%' + market + '%' ]);
				subquery.push([ 'orWhere', 'city2', 'like', '%' + market +'%' ]);
				subquery.push([ 'orWhere', 'city3', 'like', '%' + market +'%' ]);
			}
		});

		data.q.push([ 'where', subquery ]);
	}

	if (parseInt(form.age_min)) {
		data.q.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
	}

	if (parseInt(form.age_max)) {
		data.q.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ]);
	}

	if (form.sex) {
		if (!(form.sex instanceof Array)) {
			data.q.push([ 'where', 'sex', '=', form.sex ]);
		}
	}

	if (form.has_photo) {
		if (!(form.has_photo instanceof Array)) {
			data.q.push([ 'where', 'has_photos', '=', form.has_photo ]);
		}
	}

	if (parseInt(form.height_min)) {
		data.q.push([ 'where', 'heightinches', '>=', form.height_min ]);
	}

	if (parseInt(form.height_max)) {
		data.q.push([ 'where', 'heightinches', '<=', form.height_max ]);
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

			data.q.push([ 'where', subfilter ]);
		}
		else {
			data.q.push([ 'where', 'build', '=', form.build ]);
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

			data.q.push([ 'where', subfilter ]);
		}
		else {
			data.q.push([ 'where', 'ethnicity', '=', form.ethnicity ]);
		}
	}

	if (form.join_status) {
		if (!(form.join_status instanceof Array)) {
			if (form.join_status == 5) {
				data.q.push([ 'where', 'is_pro', '=', 1 ]);
			}
			else {
				data.q.push([ 'where', 'is_pro', '=', 0 ]);
			}
		}
	}

	if (form.name) {
		data.q.push([ 'where',
			[
				[ 'where', 'talentlogin', '=', '%' + form.name + '%' ],
				[ 'orWhere', 'fname', 'LIKE', '%' + form.name + '%' ],
				[ 'orWhere', 'lname', 'LIKE', '%' + form.name + '%' ]
			]
		])
	}

	return data;
}


handler.prototype.rateSchedule = function(e) {
	var $btn = $(e.target);
	var rating = $btn.text();
	var $parent = $btn.parent();
	var id = $parent.data('id').replace('schedule-', '');

	if (parseInt(id)) {
		self.core.resource.schedule.patch({ scheduleId : id, rating : rating })
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
				self.refreshLikeItList();
			});
	}
	else {
		var userId = $parent.data('id').replace('user-', '');
		var data = {
			bam_role_id		: self.roleId,
			inviter_id		: userId,
			invitee_id		: self.user.id,
			rating			: rating,
			submission		: 1,
			invitee_status	: self.core.resource.schedule_cd_status.PENDING,
			inviter_status	: self.core.resource.schedule_cd_status.PENDING,
			status			: self.core.resource.schedule_status.PENDING
		}
		self.core.resource.schedule.post(data)
			.then(function() {
				$parent.find('.rating-button').removeClass('active');
				$btn.addClass('active');
				self.refreshLikeItList();
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

handler.prototype.changeRole = function() {
	window.location = '/projects/' + self.projectId + '/roles/' + $('#roles-list').val() + '/self-submissions';
}


handler.prototype.addToFav = function(){
	var b = $(this).closest('.talent-tab').attr('id');
	var talentnum = (b.split('-')[2]);

	var talents = _.find(self.favTalent.data, function(n){
		return n.bam_talentnum == talentnum;
	});

	if(talents){
		self.core.resource.favorite_talent.delete({ favoriteId : talentnum})
			.then(function(res){
				self.refreshProjectDetails();
			});
	} else {
		self.core.resource.favorite_talent.post({ bam_cd_user_id : self.user.bam_cd_user_id, bam_talentnum : talentnum})
			.then(function(res){
				self.refreshProjectDetails();
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

handler.prototype.addToMarket = function() {
	var selected = ($('#markets-list').select2('data').text);

	var market = _.find(self.project.markets, function(m) {
		return m.name == selected;
	});

	if (!market) {
		self.project.markets.push({ name : selected });
	}

	self.core.service.databind('#talent-filter-form', self.project);
	$('#markets-list').select2('val', '');
}

handler.prototype.removeFromMarket = function() {
	var selected = $(this).val();

	_.remove(self.project.markets, function(market) {
		return market.name == selected;
	});

	self.core.service.databind('#talent-filter-form', self.project);
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
