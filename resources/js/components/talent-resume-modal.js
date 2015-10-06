
'use strict';

module.exports = function(core, user) {
	$(document).on('click', '#talent-resume', function(e) {
		var id;

		if ($(e.target).is('a')) {
			id = $(e.target).attr('data-id');
		}
		else {
			id = $(e.target).parents('a').attr('data-id');
		}

		var data = {
			talentId :id,
			query : [
				['with', 'bam_talent_media2'],
				['with', 'bam_talentinfo1'],
				['with', 'bam_talentinfo2'],
				['with', 'bam_talent_dance'],
				['with', 'bam_talent_music']
			]
		};

		return self.core.resource.talent.get(data)
			.then(function(talent) {
			console.log(talent);
				self.core.service.databind('#talent-resume-modal', talent);
			});
	});
}
