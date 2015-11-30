'use strict';
var _ = require('lodash');

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;

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
						[ 'with', 'bam_talent_media2' ]
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
				talent.bam_talent_media2 = _.find(res.data, function(tm) {
					return talent.talentnum == tm.talentnum;
				});

				if (talent.bam_talent_media2) {
					talent.bam_talent_media2 = talent.bam_talent_media2.bam_talent_media2;
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

			$('#talent-search-loader').hide();
			$('#talent-search-result').show();
		});
}

handler.prototype.getFilters = function() {
	var qs = self.core.service.query_string();
	var form = self.core.service.form.serializeObject('#talent-filter-form');
	var data = {
		query 	: [
		],
		page	: qs.page || 1
	};

	if (form.zip) {
		data.query.push([ 'where', 'zip', '=', form.zip ]);
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

module.exports = function(core, user) {
	return new handler(core, user);
};
