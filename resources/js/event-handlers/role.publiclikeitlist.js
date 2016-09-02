var _ = require('lodash');
'use strict';

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;
	self.page = 1;
	self.first_load = true;

	self.getDetails();
}

handler.prototype.getDetails = function() {
	var data = {
		projectId : self.projectId,
		jobId : self.roleId,
		query : [
			[ 'with', 'bam_casting.bam_cd_user' ]
		]
	}

	self.core.resource.job.get(data)
		.then(function(res) {
			self.core.service.databind('#project-details', res)
			self.core.service.databind('#role-filter-form', res);
			self.findMatches();
		});
}

handler.prototype.findMatches = function(append) {
	var form = self.core.service.form.serializeObject('#role-filter-form');

	if (self.refreshing) {
		return;
	}

	append = append === true;

	if (append && self.done) {
		return;
	}

	self.page = append ? self.page + 1 : 1;
	self.refreshing = true;

	var data = {
		per_page : 24,
		page : self.page,
		query : [
			[ 'where', 'rating', '<>', 0 ],
			[ 'where', 'bam_role_id', '=', self.roleId ],
			[ 'with', 'invitee.bam_talentci' ]
		]
	}

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

	var options = {
		bam_role_id : self.roleId
	}

	self.core.resource.schedule.get(data)
		.then(function(res) {
			self.done = (res.total < res.per_page);
			var talentnums = _.map(res.data, function(r) {
				if (r.invitee && r.invitee.bam_talentci) {
					return r.invitee.bam_talentci.talentnum;
				}
				else {
					return 0;
				}
			});

			talentnums.push(0);

			var data2 = self.getFilters(talentnums);

			return self.core.resource.talent.search(data2, options);
		})
		.then(function(talents) {
			_.each(talents.data, function(talent) {
				talent.talent_role_id = self.roleId;
				talent.talent_project_id = self.projectId;
			});

			try {
			self.core.service.databind('#role-matches-result', talents, append);
			} catch(e) { }

			self.refreshing = false;

			$('#search-loader').hide();

			if (!append) {
				$('#role-matches-result').show();

				if(talents.total > 0) {
					$('.like-it-list-only').removeClass('hide');
				}
				else {
					$('.like-it-list-only').addClass('hide');
				}
			}
		});
}

handler.prototype.getFilters = function(talentnums) {
	var form = self.core.service.form.serializeObject('#role-filter-form');
	var data = {
		per_page : 24,
		page : self.page,
		query : [
			[ 'whereIn', 'talentnum', talentnums ]
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

		if (parseInt(form.age_min)) {
			data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
		}

		if (parseInt(form.age_max)) {
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

		if(form.favorite_talent == '1') {
			data.query.push([ 'join', 'bam.laret_favorite_talents', 'bam.laret_favorite_talents.bam_talentnum', '=', 'search.talents.talentnum' ]);
		}
	}

	return data;
}

handler.prototype.refreshInvitation = function() {
	var data = {
		query : [
			[ 'where', 'bam_role_id', self.project.role.role_id ],
			[ 'orderBy', 'created_at', 'DESC' ]
		],
		per_page : 1
	}

	self.core.resource.campaign.get(data)
	.then(function(res){
		var campaign = _.first(res.data);
		if (campaign && (campaign.status > 0 || campaign.status == 0)) {
				$("#invitetoaudition-text")
				.html('<span class="text-muted">You have already sent an invitation on</span> ' + campaign.updated_at +
					  '<a href="/projects/' + self.project.role.casting_id + '/roles/' + self.project.role.role_id + '/worksheet" class="btn-link margin-left-small"><i class="fa fa-pencil"></i> Manage Here</a>');

				$('#invitetoauditionbutton').attr("disabled", true);
		}
		else {
			$("#invitetoaudition-text").text('');
			$('#invitetoauditionbutton').attr("disabled", false);
		}
	});
}

handler.prototype.sendInvites = function() {
	var form = self.core.service.form.serializeObject('#invite-to-audition-form');

	var data = [
		[ 'where', 'rating', '<>', 0 ],
		[ 'where', 'bam_role_id', '=', self.project.role.role_id ],
		[ 'join', 'users', 'users.id', '=', 'invitee_id' ],
		[ 'select', 'bam_talentnum AS talentnum' ]
	];

	var campaignData = {
		campaign_type_id 	: self.core.resource.campaign_type.CD_INVITE,
		bam_cd_user_id		: self.user.bam_cd_user_id,
		bam_role_id			: self.project.role.role_id,
		when				: form.when,
		where				: form.where,
		name				: 'CD Invite Role #' + self.project.role.role_id,
		description			: form.message,
		query_model			: 'Schedule',
		query_model_raw     : 'Bam\\Talentci',
		query_key_id        : 'talentnum',
		query_key_cell      : 'cell',
		query_key_email     : 'email1',
		query				: JSON.stringify(data),
		replies				: form.replies,
		status				: 0
	}

	self.core.resource.campaign.post(campaignData)
		.then(function(res) {
			alert('Invitations sent!');
			$('#invite-to-audition-modal').modal('toggle');

			self.refreshInvitation();
		});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
