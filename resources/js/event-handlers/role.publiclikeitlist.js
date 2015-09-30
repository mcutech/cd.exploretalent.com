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
		});
}

handler.prototype.getFavoriteTalents = function() {
	var talents = _.map(self.project.role.likeitlist.data, function(n) {
		return n.invitee.bam_talentnum;
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
	if(!$(this).find('i').hasClass('text-light-gray')){
		self.core.resource.favorite_talent.delete({ favoriteId : talentnum})
			.then(function(res){
				self.refreshLikeItList();
			});
	} else {
		self.core.resource.favorite_talent.post({ bam_cd_user_id : self.user.bam_cd_user_id, bam_talentnum : talentnum})
			.then(function(res){
				self.refreshLikeItList();
			});
	}
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
