'use strict';

module.exports = function(core, user) {
	$(document).on('click', '#talent-photo', function(e) {
		var id;

		if ($(e.target).is('a')) {
			id = $(e.target).attr('data-id');
		}
		else {
			id = $(e.target).parents('a').attr('data-id');
		}

		var data = {
			talentId :id,
			withs : [
				'bam_talent_media2'
			]
		};

		return self.core.resource.talent.get(data)
			.then(function(talent) {
				self.core.service.databind('#talent-photos-modal', talent);
			});
	});
}


