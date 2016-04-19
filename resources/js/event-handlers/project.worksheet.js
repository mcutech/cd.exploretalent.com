'use strict';
var _ = require('lodash');

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user
	self.projectId = projectId;

	self.refreshProjects();
}

handler.prototype.refreshProjects = function() {
	self.core.resource.project.get()
	.then(function(projects) {
		self.core.service.databind('#projects-list', projects);

		if (parseInt(self.projectId))
			$('#projects-list').val(self.projectId);

		self.refreshList();
	});
}

handler.prototype.refreshList = function() {
	var data = {
		query : [
			[ 'select', 'roles.role_id' ],
			[ 'join', 'roles', 'roles.casting_id', '=', 'castings.casting_id' ],
			[ 'join', 'laret_campaigns', 'laret_campaigns.bam_role_id', '=', 'roles.role_id' ],
			[ 'groupBy', 'roles.role_id' ]
		]
	}

	self.core.resource.project.get(data)
	.then(function(res) {
		var roleIds = _.map(res.data, 'role_id');

		var data2 = {
			query : [
				[ 'whereIn', 'bam_role_id', roleIds ],
				[ 'with', 'bam_role.bam_casting' ],
				[ 'orderBy', 'created_at', 'DESC' ]
			]
		}

		return self.core.resource.campaign.get(data2);
	})
	.then(function(res) {
		self.campaigns = res;
		var promises = [];

		_.each(self.campaigns.data, function(campaign) {
			promises.push(self.getCampaignTalentCount(campaign));
		});

		return $.when.apply($, promises);
	})
	.then(function() {
		self.core.service.databind('#campaigns-list', self.campaigns);
	});
}

handler.prototype.getCampaignTalentCount = function(campaign) {
	var deferred = $.Deferred();

	campaign.bam_role.getLikeItList().then(function(res) {
		campaign.bam_role.likeitlist = res;
		deferred.resolve();
	});

	return deferred.promise();
}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
}
