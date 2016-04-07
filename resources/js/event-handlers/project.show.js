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
				
			self.core.service.databind('.find-talents-wrapper', res)

			self.getProjectsForDropdown();

		});
}

handler.prototype.getProjectsForDropdown = function(e) {


	var data = {
		wheres : [
			[ 'where', 'user_id', '=', self.user.bam_cd_user_id ]
		]
	};

	self.core.resource.project.get(data)
		.then(function(res) {

			self.core.service.databind('#casting-list-by-this-user', res)

			$('#casting-list-by-this-user').val(self.projectId);

		});
}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};
