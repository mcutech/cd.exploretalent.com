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

	if (append && self.done) {
		return;
	}

	self.page = append ? self.page + 1 : 1;
	self.refreshing = true;

	var talents;
	var promise;

	var data = self.getFilters();
	$('#talent-search-loader').show();

	if (!append) {
		$('#talent-search-result').hide();
		self.preloadTalents = null;
	}

	self.getTalents().then(function(talents) {
		try {
			self.core.service.databind('#talent-search-result', talents, append);
		}
		catch(e) { }

		self.refreshing = false;

		$('#talent-search-loader').hide();
		if (!append) {
			$('#talent-search-result').show();
		}
	});
}

handler.prototype.getTalents = function() {
	var deferred = $.Deferred();

	if (self.preloadTalents) {
		deferred.resolve(self.preloadTalents);
	}
	else {
		self.searchTalents().then(function(res) {
			console.log(res);
			deferred.resolve(res);
		});
	}

	self.searchTalents(true).then(function(res) {
		self.preloadTalents = res;
	});

	return deferred.promise();
}

handler.prototype.searchTalents = function(nextPage) {
	var deferred = $.Deferred();

	if (nextPage) {
		self.page = self.page + 1;
	}

	var talents;
	var promise;

	var data = self.getFilters();
	var form = self.core.service.form.serializeObject('#talent-filter-form');

	if (form.search_text && !isNaN(form.search_text)) {
		if (nextPage) {
			promise = $.when({});
		}
		else {
			promise = self.core.resource.talent.get({ talentId : form.search_text, query : [ [ 'with', 'bam_talent_media2' ], [ 'with', 'bam_talentinfo1' ] ] });
		}
	}
	else {
		promise = self.core.resource.talent.search(data);
	}

	promise.then(function(talents) {
		if (!talents.data) {
			talents.schedule = {};
			talents.favorite = null;
			talents.data = [ talents ];
			talents.total = 1;
			talents.per_page = 25;
		}

		_.each(talents.data, function(talent) {
			talent.talent_role_id = 0;
			talent.talent_project_id = 0;
		});

		deferred.resolve(talents);
	});

	return deferred.promise();
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

	return data;
}
module.exports = function(core, user) {
	return new handler(core, user);
};
