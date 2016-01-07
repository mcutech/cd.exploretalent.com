'use strict';

module.exports = function(core, user) {
	$(document).on('click', '#talent-photo, #view-resume-photos', function(e) {
		var id;

		// Bind null data first
		self.core.service.databind('#talent-photos-modal', {
			getFullName: function() { return "Loading" },
			bam_talent_media2: []
		});

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
			],
			// wheres : [
			// 	[ 'where', 'talent_media2.type', '=', '1' ],
			// ]
		};

		return self.core.resource.talent.get(data)
			.then(function(talent) {

				var photosArray = [];

				$.each(talent.bam_talent_media2, function(index, value) {
					// add only profile pic and main pictures (no thumbnails)
					if(value.type == 1 || value.type == 2) {
						photosArray.push(value);
					}
				});
				talent.bam_talent_media2 = photosArray;
				self.core.service.databind('#talent-photos-modal', talent);
			});
	});
}


