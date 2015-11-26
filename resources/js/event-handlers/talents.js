'use strict';

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;

	self.refresh();
}

handler.prototype.refresh = function() {
	var talents;
	var talentnums;

	var data = self.getFilters();

	self.core.resource.search_talent.get(data)
		.then(function(res) {
			talents = res;

			talentnums = _.map(talents.data, function(talent) {
				return talent.talentnum;
			});

			// get favorite talents
			var data2 = {
				query : [
					[ 'whereIn', 'bam_talentnum', talentnums ]
				]
			};

			return self.core.resource.favorite_talent.get(data2);
		})
		.then(function(res) {
			//assign favorite talents to talent
			_.each(talents.data, function(talent) {
				talent.favorite = _.find(res.data, function(favorite) {
					return talent.talentnum == favorite.bam_talentnum;
				});
			});

			console.log(talents);
			self.core.service.databind('#talent-result', talents);
			self.core.service.paginate('#talents-pagination', { class : 'pagination', total : talents.total, name : 'page' });
		});
            //
			// var data2 = {
			// 	query : [
			// 		[ 'whereIn', 'talentnum', talentnums ],
			// 		[ 'where', 'type', '=', 2 ]
			// 	]
			// };
			// return self.core.resource.talent_media2.get(data2);
		// });
		// .then(function(res) {
		// 	_.each(talents.data, function(talent) {
		// 		talent.primary_photo = _.find(res.data, function(tm) {
		// 			return tm.talentnum == talent.talentnum;
		// 		});
		// 	});
        //
		// 	console.log(talents);
		// });
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
