'use strict';

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
		withs : [ 'bam_roles', 'bam_cd_user' ]
	};

	self.core.resource.project.get(data)
		.then(function(result) {
			self.project = result;
			// get current role object
			self.project.role = _.find(self.project.bam_roles, function (role) {
				return role.role_id == self.roleId;
			});
			self.core.service.databind('#header', self.project);

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
			self.core.service.databind('#like-it-list', self.project);

			self.core.service.paginate('#like-it-list-pagination', { class : 'pagination', total : result.total, name : 'page' });

			self.getFavoriteTalents();

			$('#loading-div').hide();
		});
}

handler.prototype.getFavoriteTalents = function() {
	var talents = _.map(self.project.role.likeitlist.data, function(n) {
		return n.getTalent().bam_talentnum;
	});

	console.log(talents);
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

handler.prototype.viewAllModal = function() {
	// fire modal code
    $(".modal-photos").modal();
}
handler.prototype.refreshTalentPhotos = function(e){
	var id;

	// Bind null data first
	self.core.service.databind('#talent-photos-modal', {
		getFullName: function() { return "Loading" },
		bam_talent_media2: []
	});

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

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
