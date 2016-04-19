'use strict';
var _ = require('lodash');

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.refresh();
}

handler.prototype.refresh = function(append) {
	if (self.refreshing) {
		return;
	}

	append = append === true;
	self.page = append ? self.page + 1 : 1;
	self.refreshing = true;

	var talents;
	var talentnums;

	var data = self.getFilters();
	$('#talent-search-loader').show();

	if (!append) {
		$('#talent-search-result').hide();
	}

	self.core.resource.talent.search(data)
		.then(function(talents) {
			self.core.service.databind('#talent-search-result', talents, append);
			self.refreshing = false;

			$('#talent-search-loader').hide();
			if (!append) {
				$('#talent-search-result').show();
			}
		});
}

handler.prototype.getFilters = function() {
	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var data = {
		query : [
		],
		per_page : 24,
		page : self.page
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

	return data;
}

handler.prototype.addToFavorites = function(e) {
	var $element = $(e.target);

	if (!$element.is('button')) {
		$element = $element.parents('button');
	}

	var id = $element.attr('data-id').split('-');

	if (id[0] == 'favorite') {
		self.core.resource.favorite_talent.delete({ favoriteId : id })
			.then(function() {
				var $i = $element.find('i');
				$i.removeClass('text-warning');
				$i.addClass('text-light-gray');
			});
	}
	else {
		self.core.resource.favorite_talent.post({ bam_talentnum : id[1] })
			.then(function() {
				var $i = $element.find('i');
				$i.addClass('text-warning');
				$i.removeClass('text-light-gray');
			});
	}
}

handler.prototype.addToLikeitlist = function() {
	var scheduleData = {
		query : [
			[ 'where', 'bam_role_id', '=', self.roleId ],
			[ 'where', 'invitee_id', '=', self.inviteeId ],
			[ 'where', 'inviter_id', '=', self.inviterId ]
		]
	};

	self.core.resource.schedule.get(scheduleData)
		.then(function(result){
			var data = {
					bam_role_id		: self.roleId,
					invitee_id		: self.inviteeId,
					inviter_id		: self.inviterId,
					rating			: self.ratingValue,
					invitee_status	: self.core.resource.schedule_cd_status.PENDING,
					inviter_status	: self.core.resource.schedule_cd_status.PENDING,
					status			: self.core.resource.schedule_status.PENDING
			}

			if(result.total != 0){
				self.core.resource.schedule.patch({scheduleId : result.data[0].id, rating : self.ratingValue})
					.then(function(){
						alert('Added to like it list.');
					});
			}else {
				self.core.resource.schedule.post(data)
					.then(function(){
						alert('Added to like it list.');
					});
			}
			$('#addtolist').modal('hide');
			$('#role-list').val([]);
		});
}

handler.prototype.refreshCastingRole = function() {
	self.ratingValue = $(this).attr("data-value");
	self.inviteeId = $(this).attr("data-id");

	self.core.resource.project.get()
		.then(function(res) {
			self.core.service.databind('#casting-div', res);

		});

}

handler.prototype.selectCastingRole = function() {
	var castingId = $('#casting-list').val();
	self.castingId = castingId;

	var data = {
		projectId	: castingId,
		withs		: [ 'bam_roles' ]
	}

	self.core.resource.project.get(data)
		.then(function(res) {
			self.core.service.databind('#role-div', res);
			self.inviterId = res.user_id;

			$('#role-list').change(function() {
				var roleId = null;
				roleId = $('#role-list').val();
				self.roleId = roleId;
			});
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
};