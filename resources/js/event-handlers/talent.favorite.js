function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.talent = null;

	self.xorigins = [];

	if (self.user.user_apps.length > 0) {
		_.each(self.user.user_apps, function(app) {
			self.xorigins = _.union(self.xorigins, _.map(app.app.app_xorigins, function(xorigin){
				return xorigin.x_origin;
			}));
		});
	}

  self.xorigins = self.xorigins.length == 0 ? [-1] : self.xorigins;

	self.refresh();
}
handler.prototype.refresh = function(append){
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

	$('#search-loader').show();

	if (!append) {
		$('#talent-search-result').hide();
	}

	self.core.resource.favorite_talent.get({ page: self.page })
	.then(function(result){
		self.done = (result.total < result.per_page);

		var talentnums = _.map(result.data, function(talent) {
			return talent.bam_talentnum;
		});

		talentnums.push(0);

		var data = {
			query : [
				[ 'whereIn', 'talentnum', talentnums ],
				[ 'whereIn', 'x_origin', self.xorigins ]
			]
		};

		return self.core.resource.talent.search(data)
	})
	.then(function(talents) {
		_.each(talents.data, function(talent) {
			talent.talent_role_id = 0;
			talent.talent_project_id = 0;
		});

        try {
		    self.core.service.databind('#favorite-result', talents, append);
        }
        catch(e) {
            console.log(e);
        }

		self.refreshing = false;

		$('#search-loader').hide();
		if (!append) {
			$('#talent-search-result').show();
			 if (talents.total == 0) {
			 		$('#talent-search-result').hide();
			 		$('#no-favorite-talent').removeClass('hide');
			 		$('#no-favorite-talent').show();
			 }
		}
	});
};

module.exports = function(core, user){
	return new handler(core, user);
}
