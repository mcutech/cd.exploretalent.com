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
		});
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

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
