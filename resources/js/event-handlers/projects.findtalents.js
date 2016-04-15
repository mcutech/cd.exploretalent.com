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

			var markets = _.map(self.project.market.split('>'), function(m) {
				return { name : m };
			});

			self.project.markets = { data : markets };
			self.core.service.databind('#project-details', self.project)
			self.core.service.databind('#roles-list', { data : self.project.bam_roles })
			if (self.roleId) {
				$('#roles-list').val(self.roleId);
			}
			else {
				$('#roles-list').val(_.first(self.project.bam_roles).role_id);
			}
			self.refreshRole();
		});
}

handler.prototype.refreshRole = function() {
	var roleId = $('#roles-list').val();
	var role = _.find(self.project.bam_roles, function(role) {
		return role.role_id == roleId;
	});

	role.bam_casting = self.project;

	self.core.service.databind('#role-filter-form', role);
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
	var talents, talentnums;

	$('#search-loader').show();

	if (!append) {
		$('#role-matches-result').hide();
	}

	self.core.resource.search_talent.get(data)
		.then(function(res) {
			talents = res;
			if (talents.total) {
				talentnums = _.map(talents.data, function(talent) {
					return talent.talentnum;
				});

				talentnums.push(0);

				var data2 = {
					query : [
						[ 'whereIn', 'talentci.talentnum', talentnums ],
						[ 'with', 'bam_talent_media2' ],
						[ 'with', 'user' ]
					]
				};
				return self.core.resource.talent.get(data2);
			}
			else {
				return $.when({ data : [] });
			}
		})
		.then(function (res) {
			_.each(talents.data, function(talent) {
				var talentci = _.find(res.data, function(tm) {
					return talent.talentnum == tm.talentnum;
				});

				if (talentci) {
					talent.bam_talent_media2 = talentci.bam_talent_media2;
					talent.user = talentci.user;
				}
			});

			// if (talents.total) {
			if (false) {		// TODO: uncomment line above when API is working
				// get favorite talents
				var data2 = {
					query : [
						[ 'whereIn', 'bam_talentnum', talentnums ]
					]
				};

				return self.core.resource.favorite_talent.get(data2);
			}
			else {
				return $.when({ data : [] });
			}
		})
		.then(function(res) {
			if (talents.total) {
				//assign favorite talents to talent
				_.each(talents.data, function(talent) {
					talent.favorite = _.find(res.data, function(favorite) {
						return talent.talentnum == favorite.bam_talentnum;
					});
				});
			}

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
		]
	}

	if (form.markets && form.markets.length) {
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

	if (form.has_photo) {
		data.query.push([ 'where', 'has_photos', '=', form.has_photo == 'true' ? 1 : 0 ]);
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

	return data;
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}


