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
			[ 'with', 'bam_role.schedules' ]
		]
	};

	if (status == 0) {
		data.query.push([ 'where', 'status', 0 ]);
	} else if (status == 1) {
		data.query.push([ 'where', 'status', '>=', 1 ]);
	} else if (status == -1) {
		data.query.push([ 'where', 'status', '<=', -1 ]);
	}

	self.core.resource.campaign.get(data)
		.then(function(res) {
			_.each(res.data, function(campaign) {
				_.remove(campaign.bam_role.schedules, function(s) {
					return s.rating == 0;
				});
			});

			self.core.service.databind('#campaigns-list', res);
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
}
