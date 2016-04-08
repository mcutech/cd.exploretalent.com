'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	console.log(self.user);
	self.getProjectInfo();
}

handler.prototype.getProjectInfo = function(e) {
	var data = {
		projectId : self.projectId,
		withs : [
			'bam_roles'
		],
	};

	self.core.resource.project.get(data)
		.then(function(res) {
			res.market = res.market.split('>');

			res.markets = {
				data : []
			};

			$.each(res.market, function(index, value) {

				res.markets.data.push({name : value});
			});

			res.date = self.core.service.date;

			var i = (new Date(res.asap*1000));
			var d = i.getDate();
			var m = i.getMonth()+1;
			var y = i.getFullYear();

			console.log(res);
			if(res.aud_timestamp){
				var i1 = (new Date(res.aud_timestamp*1000));
				var d1 = i1.getDate();
				var m1 = i1.getMonth()+1;
				var y1 = i1.getFullYear();

				res.aud_timestamp1 = y1 + "-" + m1 + "-" + d1;
			}
			else {
				res.aud_timestamp1 = '';
			}

			// m = (m == '12') ? m : '0'+m;
			res.asap1 = y + "-" + m + "-" + d;

			self.core.service.databind('#project-details', res)
			self.core.service.databind('#project-roles', { data : res.bam_roles })
		});
}

handler.prototype.selectRole = function() {
	var roleId = $('#select-role').val();
	console.log(roleId);
			[ 'where', 'sent', '>=', 1 ]

	var data = {
		projectId : self.projectId,
		roleId : roleId,
		query : [
			[ 'with', 'bam_casting' ],
		]
	}


	self.core.resource.job.get(data)
		.then(function(res) {
			console.log(res);
			self.core.service.databind('#talent-filter-form', res)
		});


}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};
