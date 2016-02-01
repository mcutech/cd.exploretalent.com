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
	self.refreshInvitation();
	self.inviteStatus = '';
	self.uncheckTalent = [];
	self.refreshAccessToken();
	// @if ENV='production'
	$('#when-where-container').hide();
	// @endif
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
		// $('#roles-list').val(self.project.role.role_id);
		self.project.date = self.core.service.date;
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
		self.core.service.databind('#invite-to-audition-modal', self.project);

		self.core.service.paginate('#like-it-list-pagination', { class : 'pagination', total : result.total, name : 'page' });

		self.getFavoriteTalents();

		self.refreshSelfSubmissions();

		$('input[name="likeitlist-checkbox"]').removeAttr('checked');
		$('#loading-div').hide();
		$('#roles-list').val(self.project.role.role_id);
	});
}

handler.prototype.getFavoriteTalents = function() {
	var talents = _.map(self.project.role.likeitlist.data, function(n) {
		return n.getTalent().bam_talentnum;
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

handler.prototype.refreshSelfSubmissions = function() {
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
		$('#self-submissions-counter').text(res.total); // counter
	});
}

handler.prototype.rateSchedule = function(e) {
	var $btn = $(e.target);
	var rating = $btn.text();
	var $parent = $btn.parent();
	var id = $parent.data('id').replace('schedule-', '');

	self.core.resource.schedule.patch({ scheduleId : id, rating : rating })
	.then(function() {
		$parent.find('.rating-button').removeClass('active');
		$btn.addClass('active');
	});
}

handler.prototype.removeAllLikeItList = function() {
	if (confirm('Are you sure you want to remove all Like It List entries?')) {
		self.project.role.deleteLikeItList()
		.then(function() {
			alert('Like It List entries removed.');
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

	self.core.resource.schedule.patch({ scheduleId : id, rating : 0 })
	.then(function() {
		alert('Entry removed.');
		self.refreshLikeItList();
	});
}

handler.prototype.unrateCheckedSchedules = function(e) {

	var checkedDataIds = $('input[name="likeitlist-checkbox"]:checked');
	console.log(checkedDataIds);

	var checkedIdsArray = [];
	$.each(checkedDataIds, function(index, value) {
		var dataId = $(this).attr('data-id');
		checkedIdsArray.push(dataId);
	});

	// remove all undefined from array
	checkedIdsArray = checkedIdsArray.filter(function(n){ return n != undefined });

	var promises = [];

	$.each(checkedIdsArray, function(index, value) {
		var promise = self.core.resource.schedule.patch({ scheduleId : value, rating : 0 });
		promises.push(promise);

	});

	$.when.apply($, promises).then(function() {
		alert('Entries removed.');
		$('#remove-all-checked-likeitlist').attr('disabled', 'disabled');
		//$('#remove-all-checked-likeitlist').attr('disabled', 'disabled');
		$('#check-all-likeitlist').removeAttr('disabled');
		// $('input[name="likeitlist-checkbox"]').removeAttr('checked');
		self.refreshLikeItList();
		self.refreshUncheck();
	});
}

//adding to uncheck array
handler.prototype.addToUncheck = function() {
	//console.log($(this).attr('data-id'));
	var dc = $(this).attr('data-id');
	if($(this).is(':checked')){
		var greenday = _.remove(self.uncheckTalent, function(val){
			return val == dc;
			//return _.contains([dc],self.uncheckTalent);
		});
	} else {
		var blink = _.find(self.uncheckTalent, function(n){
			return n == dc;
		});
		//check if the uncheck already exist
		if(!blink)
			self.uncheckTalent.push(dc);
		$(this).removeAttr('checked');
	}
	console.log(self.uncheckTalent);
}

//to check if the talent is uncheck
handler.prototype.refreshUncheck = function() {
	_.each(self.uncheckTalent, function(val, ind){
		$('input[data-id="'+val+'"]:checkbox').removeAttr('checked');
		console.log($('input[data-id="'+val+'"]:checkbox').attr('class'));
	});
	/*console.log(self.project.role.likeitlist);
	  _.each(self.project.role.likeitlist.data, function(val){
	  _.each(self.uncheckTalent, function(val1){
	  if(val1 == val){
	  $('input[data-id="'+val+'"]:checkbox').prop('checked', true);
	  }
	  })
	  });*/
}

//remove all uncheck
handler.prototype.removeAllUncheck = function() {
	self.uncheckTalent = [];
}

handler.prototype.changeRole = function() {
	window.location = '/projects/' + self.projectId + '/roles/' + $('#roles-list').val() + '/like-it-list';
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

handler.prototype.refreshInvitation = function() {
	var data = {
		query : [
			['where', 'bam_role_id', self.roleId],
			//['where', 'status', '>', '0']
		]
	}

	self.core.resource.campaign.get(data)
	.then(function(res){
		// var linktoworksheet = '/audition-worksheet/'+res.data[0].id;
		//console.log(res);
		if(res.data[0].status > 0 || res.data[0].status == 0){
			$("#invitetoaudition-text")
			.html('<span class="text-muted">You have already sent an invitation on</span> '+ res.data[0].updated_at +
				  '<a href="/audition-worksheet/'+res.data[0].id+'" class="btn-link margin-left-small"><i class="fa fa-pencil"></i> Manage Here</a>');
				  $('#invitetoauditionbutton').attr("disabled", true);
		}
	});
}

handler.prototype.sendInvites = function() {
	var data = {
		query 	: [
			[ 'where', 'bam_role_id', self.project.role.role_id ]
		]
	};

	self.core.resource.campaign.get(data)
	.then(function(res) {
		var form = self.core.service.form.serializeObject('#invite-to-audition-form');

		var data = [
			[ 'where', 'rating', '<>', 0 ],
			[ 'where', 'bam_role_id', '=', self.project.role.role_id ],
			[ 'join', 'users', 'users.id', '=', 'invitee_id' ],
			[ 'select', 'bam_talentnum AS talentnum' ]
		];

		var campaignData = {
			campaign_type_id 	: self.core.resource.campaign_type.CD_INVITE,
			bam_cd_user_id		: self.user.bam_cd_user_id,
			bam_role_id			: self.project.role.role_id,
			when				: form.when,
			where				: form.where,
			name				: 'CD Invite Role #' + self.project.role.role_id,
			description			: form.message,
			query_model			: 'Schedule',
			query_model_raw     : 'Bam\\Talentci',
			query_key_id        : 'talentnum',
			query_key_cell      : 'cell',
			query_key_email     : 'email1',
			query				: JSON.stringify(data),
			replies				: form.replies,
			status				: 0
		}

		// update campaign
		if (res.total) {
			campaignData.campaignId = _.first(res.data).id;
			return self.core.resource.campaign.patch(campaignData);
		}
		// create campaign
		else {
			return self.core.resource.campaign.post(campaignData);
		}
	})
	.then(function(res) {
		alert('Invitations sent!');
		$('#invite-to-audition-modal').modal('toggle'); //auto-close modal
		self.refreshProjectDetails();
		self.refreshInvitation();
	});
}

handler.prototype.refreshAccessToken = function() {
	core.service.rest.post(core.config.api.base.replace('/v1', '') + '/oauth/access_token', {
		client_id      : '74d89ce4c4838cf495ddf6710796ae4d5420dc91',
		client_secret  : '61c9b2b17db77a27841bbeeabff923448b0f6388',
		grant_type     : 'password'
	})
	.then(function(result) {
		self.core.service.databind('#share-like-list-link', { data: result } );
	});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
