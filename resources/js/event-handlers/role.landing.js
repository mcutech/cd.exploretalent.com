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

			self.findMatches();
		});
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
			console.log(talents);
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
			[ 'where', 'bam.laret_schedules.submission', '=', 1 ],
			[ 'where', 'bam.laret_schedules.bam_role_id', '=', self.roleId ]
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



handler.prototype.confirmCdInfo = function() {

	// no logic applied on this other than when contact talent is clicked, 
	// user is gonna go through forms and verify/update information

	//hide the last form shown(assuming that user not skipping)
	$('#onboarding-congratulations').hide();

	//showing first modal
	$('#ghost-onboarding-modal').show();
	$('#onboarding-confirm-email').show();
	// modal settings	
	$('#ghost-onboarding-modal').modal({backdrop: 'static', keyboard: false})  

	console.log(self.user.bam_cd_user);
	return self.core.service.databind('#ghost-onboarding', self.user.bam_cd_user);
}

handler.prototype.updateCdInfo = function() {

	var form = self.core.service.form.serializeObject('#ghost-onboarding-form');
	
	form.cdUserId =  self.user.bam_cd_user_id;
	form.pass = form.cdpass;

	delete form.cdpass;
	delete form.conf_cdpass;
	
	//update information
	self.core.resource.cd_user.patch(form)
		.then(function(res) {
			
			$('#onboarding-company-name').hide();
		 	$('#onboarding-congratulations').show();
						
		}, function(err) {
			alert("errors while saving");
				
		});
}



module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
