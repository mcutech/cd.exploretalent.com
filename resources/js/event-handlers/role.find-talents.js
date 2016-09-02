'use strict';

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;
	self.page = 1;

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

			self.core.service.databind('.page-header', self.project);
			self.core.service.databind('#project-details', self.project);
			self.core.service.databind('#roles-list', { data : self.project.bam_roles });
			$('#roles-list').val(self.roleId);

			self.project.role = { role_id : self.roleId, likeitlist : { total : '' }, submissions : { total : '' } };
			self.core.service.databind('#project-links', self.project )

			self.refreshRole();
		});
}

handler.prototype.refreshRole = function() {
	self.done = false;
	self.refreshing = false;
	self.roleId = $('#roles-list').val();
	var role = _.find(self.project.bam_roles, function(r) {
		return r.role_id == $('#roles-list').val();
	});

	window.history.pushState({}, '', '/projects/' + self.projectId + '/roles/' + role.role_id + '/find-talents');

	role.bam_casting = self.project;
	console.log(role);
	self.core.service.databind('#role-filter-form', role);
	$('#add-all-button span').text('Add All to Like it List');
	$('#add-all-button').removeClass('disabled');

	role.getLikeItListCount()
		.then(function(count) {
			role.likeitlist = { total : count };

			self.core.service.databind('#add-all-total', role)
			return role.getSubmissionsCount();
		})
		.then(function(count) {
			role.submissions = { total : count };
			self.project.role = role;

			self.core.service.databind('#project-links', self.project );
		});

	self.findMatches();
}

handler.prototype.findMatches = function(append) {
	if (self.refreshing) {
		return;
	}

	append = append === true;

	if (append && self.done) {
		return;
	}

	self.page = append ? self.page + 1 : 1;
	self.refreshing = true;
	var data = self.getFilters();
	var talents, talentnums;

	$('#search-loader').show();

	if (!append) {
		$('#role-matches-result').hide();
	}

	var options = {
		bam_role_id : self.roleId
	}

	self.core.resource.talent.search(data, options)
		.then(function(talents) {
			self.done = (talents.total < talents.per_page);

			_.each(talents.data, function(talent) {
				talent.talent_role_id = self.roleId;
				talent.talent_project_id = self.projectId;
			});

			if(talents.total == 0) {
				$('#add-all-div').addClass('hide');
			}
			else {
				$('#add-all-div').removeClass('hide');
			}

			//for total number of talent matches
			self.core.service.databind('#submission-total', talents);

			try {
			self.core.service.databind('#role-matches-result', talents, append);
			} catch(e) { }

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
		]
	}

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

	if (parseInt(form.age_min)) {
		if(form.age_min <= 2){
			data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - 2 ]);
		}else{
			data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
		}
	}

	if (parseInt(form.age_max)) {
		if(form.age_max >= 71){
			data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - 71 ]);
		}else{
			data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ]);
		}
	}

	if (form.sexMale && !form.sexFemale) {
		data.query.push([ 'where', 'sex', '=', form.sexMale ]);
	}

	if (form.sexFemale && !form.sexMale) {
		data.query.push([ 'where', 'sex', '=', form.sexFemale ]);
	}

	if (form.has_photo == "true") {
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

	if (parseInt(form.height_min)) {
		data.query.push([ 'where', 'heightinches', '>=', form.height_min ]);
	}

	if (parseInt(form.height_max)) {
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
		// African and African American are both searched if either is chosen
		if (form.ethnicity instanceof Array) {

			if(form.ethnicity.indexOf('African') > -1 && form.ethnicity.indexOf('African American') == -1) {
				form.ethnicity.push('African American');
			}
			else if(form.ethnicity.indexOf('African American') > -1 && form.ethnicity.indexOf('African') == -1) {
				form.ethnicity.push('African');
			}

			data.query.push([ 'whereIn', 'ethnicity', form.ethnicity ]);

		}
		else {
			if(form.ethnicity == 'African') {
				data.query.push(['where', [
						[ 'where', 'ethnicity', '=', 'African' ],
						[ 'orWhere', 'ethnicity', '=', 'African American' ]
					]
				]);
			}
			else if(form.ethnicity == 'African American') {
				data.query.push(['where', [
						[ 'where', 'ethnicity', '=', 'African American' ],
						[ 'orWhere', 'ethnicity', '=', 'African' ]
					]
				]);
			}
			else {
				data.query.push([ 'where', 'ethnicity', '=', form.ethnicity ]);
			}
		}
	}

	if (form.last_access) {
		data.query.push([ 'where', 'last_access', '>', Math.floor(new Date().getTime() / 1000) - parseInt(form.last_access) ]);
	}
	console.log(data);
	return data;
}

handler.prototype.addAll = function() {
	var data = self.getFilters();

	self.core.service.rest.post(self.core.config.api.base + '/cd/talentci/import/' + self.roleId, data)
		.then(function() {
			$('#add-all-button span').text('Added to Like it List');
			$('#add-all-button').addClass('disabled');
		});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}


