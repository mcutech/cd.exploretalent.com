'use strict';

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;
	self.page = 1;
	self.first_load = true;

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

			self.core.service.databind('#project-details', self.project)
			self.core.service.databind('#roles-list', { data : self.project.bam_roles })
			$('#roles-list').val(self.roleId);

			self.project.role = { role_id : self.roleId, likeitlist : { total : '' }, submissions : { total : '' } };
			self.core.service.databind('#project-links', self.project )

			self.refreshRole();
		});
}

handler.prototype.refreshRole = function() {
	var role = _.find(self.project.bam_roles, function(r) {
		return r.role_id == $('#roles-list').val();
	});

	self.project.role = role;
	self.project.role.bam_casting = self.project;

	// change url
	window.history.pushState({}, '', '/projects/' + role.casting_id + '/roles/' + role.role_id + '/callbacks');

	// update filter form
	self.core.service.databind('#role-filter-form', self.project.role);

	// submissions count
	self.project.role.getSubmissionsCount()
		.then(function(count) {
			self.project.role.submissions = { total : count };

			self.core.service.databind('#project-links', self.project )
		});

	self.findMatches();
}

handler.prototype.findMatches = function(append) {
	if (self.refreshing) {
		return;
	}

	append = append === true;
	self.page = append ? self.page + 1 : 1;
	self.refreshing = true;
	var data = self.getFilters();

	if (append) {
		self.first_load = self.first_load ? self.first_load : false;
	}
	else {
		self.first_load = false;
	}

	$('#search-loader').show();

	if (!append) {
		$('#role-matches-result').hide();
	}

	self.core.resource.talent.search(data)
		.then(function(talents) {
			_.each(talents.data, function(talent) {
				talent.talent_role_id = self.roleId;
			});

			self.core.service.databind('#role-matches-result', talents, append);
			self.refreshing = false;

			$('#search-loader').hide();
			if (!append) {
				$('#role-matches-result').show();
			}
		});
}

handler.prototype.getFilters = function() {
	var form = self.core.service.form.serializeObject('#role-filter-form');
	var data = {
		per_page : 24,
		page : self.page,
		query : [
			[ 'join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'search.talents.talentnum' ],
			[ 'leftJoin', 'bam.laret_schedules', 'bam.laret_schedules.invitee_id', '=', 'bam.laret_users.id' ],
			[ 'where', 'bam.laret_schedules.rating', '<>', 0 ],
			[ 'where', 'bam.laret_schedules.status', '=', 2 ],
			[ 'where', 'bam.laret_schedules.bam_role_id', '=', $('#roles-list').val() ]
		]
	}

	if (!self.first_load) {
		if (form.markets) {
			if (form.markets instanceof Array) {
				var subquery = [];

				_.each(form.markets, function(market) {
					if (subquery.length == 0) {
						subquery.push([ 'where', 'city', 'like', '%' + market + '%' ]);
					}
					else {
						subquery.push([ 'orWhere', 'city', 'like', '%' + market + '%' ]);
					}

					subquery.push([ 'orWhere', 'city1', 'like', '%' + market + '%' ]);
					subquery.push([ 'orWhere', 'city2', 'like', '%' + market + '%' ]);
					subquery.push([ 'orWhere', 'city3', 'like', '%' + market + '%' ]);
				});

				data.query.push([ 'where', subquery ]);
			}
			else {
				data.query.push([ 'where', [
						[ 'where', 'city', '=', form.markets ],
						[ 'orWhere', 'city1', '=', form.markets ],
						[ 'orWhere', 'city2', '=', form.markets ],
						[ 'orWhere', 'city3', '=', form.markets ]
					]
				]);
			}
		}

		if (form.age_min) {
			data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
		}

		if (form.age_max) {
			data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ]);
		}

		if (form.sex) {
			data.query.push([ 'where', 'sex', '=', form.sex ]);
		}

		if (form.has_photo) {
			data.query.push([ 'where', 'has_photos', '=', form.has_photo == 'true' ? 1 : 0 ]);
		}

		if(form.search_text) {
			data.query.push([ 'where',
				[
					[ 'where', 'talentnum', '=', form.search_text ],
					[ 'orWhere', 'fname', 'LIKE', '%' + form.search_text + '%' ],
					[ 'orWhere', 'lname', 'LIKE', '%' + form.search_text + '%' ],
				]
			]);
		}

		if (form.height_min) {
			data.query.push([ 'where', 'heightinches', '>=', form.height_min ]);
		}

		if (form.height_max) {
			data.query.push([ 'where', 'heightinches', '<=', form.height_max ]);
		}

		if (form.build) {
			if (form.build instanceof Array) {
				data.query.push([ 'whereIn', 'build', form.build ]);
			}
			else {
				data.query.push([ 'where', 'build', '=', form.build ]);
			}
		}

		if (form.ethnicity) {
			if (form.ethnicity instanceof Array) {
				data.query.push([ 'whereIn', 'ethnicity', form.ethnicity ]);
			}
			else {
				data.query.push([ 'where', 'ethnicity', '=', form.ethnicity ]);
			}
		}
	}

	return data;
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
