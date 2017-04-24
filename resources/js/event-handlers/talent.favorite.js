function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.talent = null;
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

	self.core.resource.favorite_talent.get()
	.then(function(result){
		self.done = (result.total < result.per_page);

		var talentnums = _.map(result.data, function(talent) {
			return talent.bam_talentnum;
		});

		talentnums.push(0);

		var data = {
			query : [
				[ 'whereIn', 'talentnum', talentnums ],
			]
		};

		return self.core.resource.talent.search(data)
	})
	.then(function(res) {
        talents = res;

        var promises = [];

		_.each(talents.data, function(talent) {
			talent.talent_role_id = 0;
			talent.talent_project_id = 0;
            promises.push(self.getTalentVideos(talent));
		});

        return $.when.apply($, promises);
    })
    .then(function() {
		self.core.service.databind('#favorite-result', talents, append);
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

handler.prototype.getTalentVideos = function(talent) {

    var deferred = $.Deferred();
    var data = {
        query : [
            [ 'where', 'talentnum', '=', talent.talentnum ],
            [ 'where', 'type', '=', '6' ]
        ]
    };

    self.core.resource.talent_videos.get(data)
        .then(function(video){
            talent.video_id = (video.data.length > 0) ? video.data[0].video_id : '';
            deferred.resolve();
        });

    return deferred.promise();
}

module.exports = function(core, user){
	return new handler(core, user);
}
