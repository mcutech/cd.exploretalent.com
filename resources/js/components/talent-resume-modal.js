
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
				_.each(talent.bam_talent_music, function(res, ind){
					if(res.music_type2 == '1'){
						talent.bam_talent_music[ind].music_role = "DJ";
					}
					if(res.music_type2 == '2'){
						talent.bam_talent_music[ind].music_role = "Singer";
					}
					if(res.music_type2 == '3'){ 
						talent.bam_talent_music[ind].music_role = "Song Writer";
					}
					if(res.music_type2 == '4'){
						talent.bam_talent_music[ind].music_role = "Teacher";
					}
					if(res.music_type2 == '5'){
						talent.bam_talent_music[ind].music_role = "Player";	
					}
					if(res.music_type2 == '6'){
						talent.bam_talent_music[ind].music_role = "Lyricist";	
					}
					if(res.music_type2 == '7'){
						talent.bam_talent_music[ind].music_role = "Sound Man";	
					}
					if(res.music_type2 == '8'){
						talent.bam_talent_music[ind].music_role = "Composer";	
					}
					if(res.music_type2 == '9'){
						talent.bam_talent_music[ind].music_role = "Conductor";	
					}
				});
				
				self.core.service.databind('#talent-resume-modal', talent);
				
			});
	});


}
