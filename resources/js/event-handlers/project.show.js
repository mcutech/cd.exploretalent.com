'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	self.getProjectInfo();
}

handler.prototype.getProjectInfo = function(e) {
	var data = {
		projectId : self.projectId,
		query : [
			[ 'with', 'bam_roles' ]
		]
	}

	self.core.resource.project.get(data)
		.then(function(res) {
			self.project = res;
			var markets = _.map(self.project.market.split('>'), function(m) {
				return { name : m };
			});

			self.project.markets = { data : markets };

			// if market is N/A change market value
			if(self.project.markets.data[0].name == 'N/A')
				self.project.markets.data[0].name = 'All of United States';

			console.log(self.project);
            console.log('bam_roles', self.project.bam_roles);
			self.core.service.databind('#project-details', self.project);

			// create dummy for faster databind
			_.each(self.project.bam_roles, function(role) {
				role.likeitlist = { total : '' };
				role.callbacks = { total : '' };
				role.booked = { total : '' };
				role.campaign = null;
			});

			self.core.service.databind('.find-talents-wrapper', self.project)

			var promises = [];

			_.each(self.project.bam_roles, function(role) {
				promises.push(self.getRoleStats(role));
			});

			return $.when.apply($, promises);
		})
		.then(function() {
			self.core.service.databind('.find-talents-wrapper', self.project)
		})
        .then(function() {
            // to check role timestamp
            // var timestamp = $('.role-expiry').text();
            // console.log('timestamp', timestamp);
            $('.role-expiry').each(function(index, value){
                var $parent = $(this).parents('li');
                if ($(this).is(':contains("N/A")')) {
                    $parent.find('.hide-if-null').hide();
                }
            });
        });
}

handler.prototype.getRoleStats = function(role) {
	var deferred = $.Deferred();

	role.getLikeItListCount().then(function(total) {
		role.likeitlist = { total : total };

		return role.getSchedulesCount(2);
	})
	.then(function(total) {
		role.callbacks = { total : total };

		return role.getSchedulesCount(3);
	})
	.then(function(total) {
		role.booked = { total : total };

		var data = {
			query : [
				[ 'where', 'bam_role_id', '=', role.role_id ]
			]
		}

		return self.core.resource.campaign.get(data);
	})
	.then(function(res) {
		role.campaign = _.first(res.data);
		deferred.resolve();
	});

	return deferred.promise();
}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};
