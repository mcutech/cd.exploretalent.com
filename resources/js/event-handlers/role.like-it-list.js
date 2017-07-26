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
	self.likeitlistTotal;
	self.filter = 0;

	self.xorigins = [];

	if (self.user.user_apps.length > 0) {
		_.each(self.user.user_apps, function(app) {
			self.xorigins = _.union(self.xorigins, _.map(app.app.app_xorigins, function(xorigin){
				return xorigin.x_origin;
			}));
		});
	}

  self.xorigins = self.xorigins.length == 0 ? [-1] : self.xorigins;

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
	self.project.role.getSubmissionsCount(self.xorigins)
		.then(function(count) {
			self.project.role.submissions = { total : count };

			self.core.service.databind('#project-links', self.project )
		});

	// share like it list
	var link = window.location.origin + '/login?' + $.param({ access_token : localStorage.getItem('access_token'), /*refresh_token : localStorage.getItem('refresh_token'),*/ redirect : encodeURIComponent(window.location.href.replace(/like-it-list/, '')) + 'public-like-it-list'});
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
	$('#no-likeitlist-found').addClass('hide');

	if (!append) {
		$('#role-matches-result').hide();
	}

	var options = {
		bam_role_id : self.roleId
	}

	self.core.resource.schedule.get(data)
		.then(function(res) {
			self.likeitlistTotal = res.total;
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

			var data2 = {
				query : [
					[ 'whereIn', 'talentnum', talentnums ],
					[ 'whereIn', 'x_origin', self.xorigins ]
				]
			}

			data2 = self.getFilters2(data2);

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
					$('#no-likeitlist-found').removeClass('hide');
					$('#no-likeitlist-found').show();
				}
			}
		});
}

handler.prototype.getFilters = function() {
	var data = {
		per_page : 24,
		page : self.page,
		query : [
			[ 'where', 'rating', '<>', 0 ],
			[ 'where', 'bam_role_id', '=', $('#roles-list').val() ],
			[ 'with', 'invitee.bam_talentci' ]
		]
	}	
	return data;
}

handler.prototype.getFilters2 = function(data) {
	var form = self.core.service.form.serializeObject('#role-filter-form');	

	if (!self.first_load) {
		
		if (form.address_search == 0 && self.filter == 1) { // market filter
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
		} else if (form.address_search == 1 && self.filter == 1)  { // location filter
			
			var lngLat = JSON.parse(form.lng_lat);			
		
			if (lngLat.length > 0) {			
				data.query.push(['join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'talentnum']);
				data.query.push(['join', 'bam.laret_locations', 'bam.laret_locations.user_id', '=', 'bam.laret_users.id']);										
				
				data.query.push(['where', 'bam.laret_locations.longitude', '>=', lngLat[0].lng.min - 0.3]);
				data.query.push(['where', 'bam.laret_locations.longitude', '<=', lngLat[0].lng.max + 0.3]);
				
				data.query.push(['where', 'bam.laret_locations.latitude', '>=', lngLat[0].lat.min - 0.3]);
				data.query.push(['where', 'bam.laret_locations.latitude', '<=', lngLat[0].lat.max + 0.3]);										
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

		if(form.young_old) {
			data.query.push([ 'orderBy', 'dobyyyy', form.young_old ]);
			data.query.push([ 'orderBy', 'dobmm', form.young_old ]);
			data.query.push([ 'orderBy', 'dobdd', form.young_old ]);
		}

		if(form.union) {
			if(form.union == '1') {
				data.query.push([ 'where', [
						[ 'where', 'union_aea', '=', 'Yes' ],
						[ 'orWhere', 'union_aftra', '=', 'Yes' ],
						[ 'orWhere', 'union_other', '=', 'Yes' ],
						[ 'orWhere', 'union_sag', '=', 'Yes' ],
					]
				]);
			}
			else {
				data.query.push([ 'where', [
						[ 'where', 'union_aea', '=', 'No' ],
						[ 'orWhere', 'union_aftra', '=', 'No' ],
						[ 'orWhere', 'union_other', '=', 'No' ],
						[ 'orWhere', 'union_sag', '=', 'No' ],
					]
				]);
			}
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

			role.getLikeItListCount(self.xorigins)
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
		[ 'join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'bam.talentci.talentnum' ],
		[ 'join', 'bam.laret_schedules', 'bam.laret_schedules.invitee_id', '=', 'bam.laret_users.id' ],
		[ 'where', 'bam.laret_schedules.rating', '<>', 0 ],
		[ 'where', 'bam.laret_schedules.bam_role_id', '=', self.project.role.role_id ]
	];

	// var data = [
	// 	[ 'where', 'rating', '<>', 0 ],
	// 	[ 'where', 'bam_role_id', '=', self.project.role.role_id ],
	// 	[ 'join', 'users', 'users.id', '=', 'invitee_id' ],
	// 	[ 'select', 'bam_talentnum AS talentnum' ]
	// ];

	var campaignData = {
		campaign_type_id 	: self.core.resource.campaign_type.CD_INVITE,
		bam_cd_user_id		: self.user.bam_cd_user_id,
		bam_role_id			: self.project.role.role_id,
		when				: form.when,
		where				: form.where,
		name				: 'CD Invite Role #' + self.project.role.role_id,
		description			: form.message,
		query_model			: 'Bam\\Talentci',
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

	if(checked.length == self.likeitlistTotal){
		$('#mark-all-talents-as-checked-btn').addClass('hide');
		$('#mark-all-talents-as-unchecked-btn').removeClass('hide');
	}

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
