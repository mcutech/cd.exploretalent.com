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
	self.first_load = true;
	self.roleId = $('#roles-list').val();
	var role = _.find(self.project.bam_roles, function(r) {
		return r.role_id == $('#roles-list').val();
	});

	self.project.role = role;
	self.project.role.bam_casting = self.project;

	// change url
	window.history.pushState({}, '', '/projects/' + role.casting_id + '/roles/' + role.role_id + '/like-it-list');

	// update filter form
	self.core.service.databind('#role-filter-form', self.project.role);

	// submissions count
	self.project.role.getSubmissionsCount()
		.then(function(count) {
			self.project.role.submissions = { total : count };

			self.core.service.databind('#project-links', self.project )
		});

	// share like it list
	var link = window.location.origin + '/login?' + $.param({access_token:localStorage.getItem('access_token')}) + '&redirect=' + encodeURIComponent(window.location.href.replace(/like-it-list/, '')) + 'public-like-it-list';
	$('#share-like-list-link').val(link);

	self.findMatches();
	self.refreshInvitation();
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
			console.log(talents.total);
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
			var role = _.find(self.project.bam_roles, function(r) {
				return r.role_id == $('#roles-list').val();
			});

			role.getLikeItListCount()
				.then(function(count) {
				role.likeitlist = { total : count };

				self.core.service.databind('#invite-to-audition-modal', role);
			});



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

handler.prototype.removeAllChecked = function() {

	if(confirm('Are you sure you want to remove checked talents from your Like it List?')) {

		var checkbox = $('.like-it-list-checkbox');
		var idArray = [];

		$.each(checkbox, function(index, value) {

			if($(this).hasClass('checked')) {

				var id = $(this).attr('id');

				if(id) {
					id = id.split('_');
					id = id[1];
					idArray.push(id);
				}

			}

		});

		$.each(idArray, function(index, value) {

			var data = {
				scheduleId : value,
				rating : 0
			};

			self.core.resource.schedule.put(data)
				.then(function(res) {

					self.getProjectInfo();

				});

		});
	}

}

handler.prototype.countCheckedTalents = function() {

	var checked_talents = [];

	var all_checkboxes = $('.like-it-list-checkbox').length;
	var checked = $('.like-it-list-checkbox.checked');

	$.each(checked, function(index, value) {
		checked_talents.push(value);
	});

	var length = checked_talents.length;

	$('#checked-talents-counter').text(length);

}

handler.prototype.removeAllLikeItList = function() {

	if (confirm('Are you sure you want to remove all Like It List entries?')) {
		self.project.role.deleteLikeItList()
		.then(function() {

			alert('Like It List entries removed.');
			self.getProjectInfo();

		});
	}

}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
