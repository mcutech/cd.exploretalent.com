'use strict';
var _ = require('lodash');

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.marketscheck = [];
	self.talent = [];
	// assign query string variable to filter form
	var qs = self.core.service.query_string();
	var form = {
		zip 		: '',
		age_min 	: '',
		age_max 	: '',
		sex 		: '',
		has_photo 	: '',
		height_min 	: '',
		height_max 	: '',
		build 		: '',
		ethnicity 	: '',
		join_status : '',
	}
	_.assign(form, qs);
	self.core.service.databind('#talent-filter-form', form);
	self.refresh();
}

handler.prototype.refresh = function() {

	var talents;
	var talentnums;

	var data = self.getFilters();
	$('#talent-search-loader').show();
	$('#talent-search-result').hide();

	self.core.resource.search_talent.get(data)
		.then(function(res) {
			talents = res;
			if (talents.total) {
				talentnums = _.map(talents.data, function(talent) {
					return talent.talentnum;
				});

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

			var qs = self.core.service.query_string();
			var form = self.core.service.form.serializeObject('#talent-filter-form');
			_.merge(qs, form);
			qs = _.omit(qs, function(n) {
				return n == '';
			});

			// add filters to query string
			var url = window.location.href.replace(window.location.search, '');
			url = url + '?' + $.param(qs);
			window.history.pushState(null, null, url);
			self.core.service.databind('#talent-search-result', talents);

			self.core.service.paginate('#talents-pagination', { class : 'pagination', total : talents.total, name : 'page' });
			if(talents.total < 25) {
				$('#talents-pagination').hide();
			}
			else {
				$('#talents-pagination').show();
			}

			self.talent = talents;
			$('#talent-search-loader').hide();
			$('#talent-search-result').show();
		});
}

handler.prototype.getFilters = function() {
	var qs = self.core.service.query_string();
	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var subquery = [];
	var asdasd = [];
	var data = {
		query 	: [
		],
		page	: qs.page || 1
	};

	_.each(self.marketscheck, function(val, ind){
		if(val.check == 'check'){
			asdasd.push(val.name);
		}
	});

	if(self.marketscheck.length != 0){
		console.log(self.marketscheck);
		_.each(self.marketscheck, function(val, ind){
			if(val.check == 'check'){
				if(asdasd.length > 1){
					subquery.push([ 'orWhere', 'city', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
					subquery.push([ 'orWhere', 'city1', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
					subquery.push([ 'orWhere', 'city2', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
					subquery.push([ 'orWhere', 'city3', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
				} else if(asdasd.length == 1){
					subquery.push([ 'orWhere', 'city', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
					subquery.push([ 'orWhere', 'city1', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
					subquery.push([ 'orWhere', 'city2', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
					subquery.push([ 'orWhere', 'city3', 'like', '%'+val.name.substring(0, val.name.indexOf(','))+'%' ]);
				}
			}
		});
		data.query.push([ 'where', subquery ]);
	}


	if (parseInt(form.age_min)) {
		data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
	}

	if (parseInt(form.age_max)) {
		data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ]);
	}

	if (form.sex) {
		if (!(form.sex instanceof Array)) {
			data.query.push([ 'where', 'sex', '=', form.sex ]);
		}
	}

	if (form.has_photo) {
		if (!(form.has_photo instanceof Array)) {
			data.query.push([ 'where', 'has_photos', '=', form.has_photo ]);
		}
	}

	if (parseInt(form.height_min)) {
		data.query.push([ 'where', 'heightinches', '>=', form.height_min ]);
	}

	if (parseInt(form.height_max)) {
		data.query.push([ 'where', 'heightinches', '<=', form.height_max ]);
	}

	if (form.build) {
		if (form.build instanceof Array) {
			var subfilter = [];
			_.each(form.build, function(build, index) {
				if (index > 0) {
					subfilter.push([ 'orWhere', 'build', '=', build ]);
				}
				else {
					subfilter.push([ 'where', 'build', '=', build ]);
				}
			});

			data.query.push([ 'where', subfilter ]);
		}
		else {
			data.query.push([ 'where', 'build', '=', form.build ]);
		}
	}

	if (form.ethnicity) {
		if (form.ethnicity instanceof Array) {
			var subfilter = [];
			_.each(form.ethnicity, function(ethnicity, index) {
				if (index > 0) {
					subfilter.push([ 'orWhere', 'ethnicity', '=', ethnicity ]);
				}
				else {
					subfilter.push([ 'where', 'ethnicity', '=', ethnicity ]);
				}
			});

			data.query.push([ 'where', subfilter ]);
		}
		else {
			data.query.push([ 'where', 'ethnicity', '=', form.ethnicity ]);
		}
	}

	if (form.join_status) {
		if (!(form.join_status instanceof Array)) {
			if (form.join_status == 5) {
				data.query.push([ 'where', 'is_pro', '=', 1 ]);
			}
			else {
				data.query.push([ 'where', 'is_pro', '=', 0 ]);
			}
		}
	}

	var searchterm = $('#search-talent-input').val();

	if(searchterm.length > 1) {

		data = {
			query 	: [],
			page	: qs.page || 1
		};

		form = [];
		subquery = [];
		subfilter = [];

		data.query.push([ 'where',
			[
				[ 'where', 'talentnum', '=', searchterm ],
				[ 'orWhere', 'fname', 'LIKE', '%' + searchterm + '%' ],
				[ 'orWhere', 'lname', 'LIKE', '%' + searchterm + '%' ],
			]
		]);

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

handler.prototype.addToMarket = function() {
	var txt = ($('#jquery-select2-example').select2('data').text);
	var txt1 = _.find(self.marketscheck, function(val){
		return val.name == txt;
	});
	if(!txt1){
		self.marketscheck.push({ name : txt , check : 'check'});
	}
	self.talent.market_checks = self.marketscheck;
	self.core.service.databind('#markets_checks', self.talent);
	$('#jquery-select2-example').select2('val', '');

}

handler.prototype.removeFromMarket = function() {
	var id = $(this).parent().attr('id');
	var rmv = _.find(self.marketscheck, function(n, ind){
		if(n.name.replace(/\s/g, '').replace(/,/g, '') == id){
			if(n.check == 'check'){
				self.marketscheck[ind].check = 'uncheck';
			} else {
				self.marketscheck[ind].check = 'check';
			}
			//self.marketscheck[ind].check = 'uncheck';
		}
	});
	self.talent.market_checks = self.marketscheck;
	self.core.service.databind('#markets_checks', self.talent);

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
	console.log(castingId);

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
				console.log(roleId)
			});
		});
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

module.exports = function(core, user) {
	return new handler(core, user);
};
