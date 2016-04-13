'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	self.getProjectInfo();
}

handler.prototype.getProjectInfo = function() {
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
			self.core.service.databind('#project-details', self.project)
			self.core.service.databind('#roles-list', { data : self.project.bam_roles })
			$('#roles-list').val(_.first(self.project.bam_roles).role_id);
			self.refreshRole();
		});
}

handler.prototype.refreshRole = function() {
	var roleId = $('#roles-list').val();
	var role = _.find(self.project.bam_roles, function(role) {
		return role.role_id == roleId;
	});

	self.core.service.databind('#role-filter-form', role);
	self.findMatches();
}

handler.prototype.findMatches = function() {
	var form = self.core.service.form.serializeObject('#role-filter-form');
	var data = {
		query : [
		]
	}

	if (parseInt(form.age_min)) {
		data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
	}

	if (parseInt(form.age_max)) {
		data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ]);
	}

	if (parseInt(form.height_min)) {
		data.query.push([ 'where', 'heightinches', '>=', form.height_min ]);
	}

	if (parseInt(form.height_max)) {
		data.query.push([ 'where', 'heightinches', '<=', form.height_max ]);
	}

	console.log(data);

	self.core.resource.search_talent.get(data)
		.then(function(res) {
			console.log(res);
		});

}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
}


