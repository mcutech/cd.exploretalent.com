'use strict';
var _ = require('lodash');

function handler(core, user) {
	self = this;
	self.core = core;
	self.user = user

	var data = {
		query : [
			[ 'with', 'bam_roles' ]
		]
	};
	self.core.resource.project.get(data)
		.then(function(res) {
			self.core.service.databind('#projects-list', res);
			self.projects = res;
			self.refresh();
		});
}

handler.prototype.refresh = function() {
	var status = $('#status-list').val();

	var data = {
		query : [
			[ 'with', 'bam_role.bam_casting' ],
			[ 'orderBy', 'created_at', 'DESC']
		],

	};

	if (status == 0) {
		data.query.push([ 'where', 'status', 0 ]);
	} else if (status == 1) {
		data.query.push([ 'where', 'status', '>=', 1 ]);
	} else if (status == -1) {
		data.query.push([ 'where', 'status', '<=', -1 ]);
	}

	self.core.service.databind('#campaigns-list',{ data : [] });
	$('#campaigns-list').append('<tr> <td colspan="9" class="text-center"> <h1><i class="fa fa-spinner fa-spin"></i></h1> </td> </tr>');

	self.core.resource.campaign.get(data)
		.then(function(res) {
			_.remove(res.data, function(campaign) {
				return campaign.bam_role == null;
			});

			self.campaigns = res;

			var promises = [];

			_.each(self.campaigns.data, function(campaign) {
				_.remove(campaign.bam_role.schedules, function(s) {
					return s.rating == 0;
				});

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

module.exports = function(core, user) {
	return new handler(core, user);
}
