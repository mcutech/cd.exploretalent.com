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
	self.refreshInvitation();
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

			self.project.role = _.find(self.project.bam_roles, function (role) {
				return role.role_id == self.roleId;
			});

			var markets = _.map(self.project.market.split('>'), function(m) {
				return { name : m };
			});

			self.project.markets = { data : markets };
			self.core.service.databind('#project-details', self.project)
			self.core.service.databind('#roles-list', { data : self.project.bam_roles })
			if (parseInt(self.roleId)) {
				$('#roles-list').val(self.roleId);
			}
			else {
				$('#roles-list').val(_.first(self.project.bam_roles).role_id);
			}
			self.project.role_id = self.roleId || _.first(self.project.bam_roles).role_id;
			self.core.service.databind('#project-links', self.project )
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
			[ 'where', 'bam.laret_schedules.rating', '<>', 0 ],
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

handler.prototype.refreshInvitation = function() {
	var data = {
		query : [
			['where', 'bam_role_id', self.roleId],
		]
	}

	self.core.resource.campaign.get(data)
	.then(function(res){
		console.log(res);
		if(res.data[0].status > 0 || res.data[0].status == 0){
			$("#invitetoaudition-text")
			.html('<span class="text-muted">You have already sent an invitation on</span> '+ res.data[0].updated_at +
				  '<a href="/audition-worksheet/'+res.data[0].id+'" class="btn-link margin-left-small"><i class="fa fa-pencil"></i> Manage Here</a>');
				  $('#invitetoauditionbutton').attr("disabled", true);
		}
	});
}

handler.prototype.sendInvites = function() {
	var data = {
		query 	: [
			[ 'where', 'bam_role_id', self.project.role.role_id ]
		]
	};
console.log(self.project.role.role_id);
	// self.core.resource.campaign.get(data)
	// .then(function(res) {
	// 	var form = self.core.service.form.serializeObject('#invite-to-audition-form');
    //
	// 	var data = [
	// 		[ 'where', 'rating', '<>', 0 ],
	// 		[ 'where', 'bam_role_id', '=', self.project.role.role_id ],
	// 		[ 'join', 'users', 'users.id', '=', 'invitee_id' ],
	// 		[ 'select', 'bam_talentnum AS talentnum' ]
	// 	];
    //
	// 	var campaignData = {
	// 		campaign_type_id 	: self.core.resource.campaign_type.CD_INVITE,
	// 		bam_cd_user_id		: self.user.bam_cd_user_id,
	// 		bam_role_id			: self.project.role.role_id,
	// 		when				: form.when,
	// 		where				: form.where,
	// 		name				: 'CD Invite Role #' + self.project.role.role_id,
	// 		description			: form.message,
	// 		query_model			: 'Schedule',
	// 		query_model_raw     : 'Bam\\Talentci',
	// 		query_key_id        : 'talentnum',
	// 		query_key_cell      : 'cell',
	// 		query_key_email     : 'email1',
	// 		query				: JSON.stringify(data),
	// 		replies				: form.replies,
	// 		status				: 0
	// 	}
    //
	// 	// update campaign
	// 	if (res.total) {
	// 		campaignData.campaignId = _.first(res.data).id;
	// 		return self.core.resource.campaign.patch(campaignData);
	// 	}
	// 	// create campaign
	// 	else {
	// 		return self.core.resource.campaign.post(campaignData);
	// 	}
	// })
	// .then(function(res) {
	// 	alert('Invitations sent!');
	// 	$('#invite-to-audition-modal').modal('toggle'); //auto-close modal
	// 	self.refreshProjectDetails();
	// 	self.refreshInvitation();
	// });
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
