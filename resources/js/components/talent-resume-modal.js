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
						talent.bam_talent_music[ind].music_role = "Song Writer";3.
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


	$('#uidemo-tabs-default-demo-musician').find('a').on("click", function(e){
		e.preventDefault();
		if($(this).hasClass('show-more-btn')){
			$(this).closest('div').find('p').each(function(){
				if($(this).hasClass('main')){
					$(this).addClass('hide');
				} else {
					$(this).removeClass('hide');
				}
			});
			$(this).removeClass('show-more-btn').addClass('show-less-btn').html('Show less...');
		} else {
			$(this).closest('div').find('p').each(function(){
				if($(this).hasClass('main')){
					$(this).removeClass('hide');
				} else {
					$(this).addClass('hide');
				}
			});
			$(this).removeClass('show-less-btn').addClass('show-more-btn').html('Show more...');
		}
	});

	$('#uidemo-tabs-default-demo-dance').find('a').on("click", function(e){
		e.preventDefault();
		if($(this).hasClass('show-more-btn')){
			$(this).closest('div').find('p').each(function(){
				if($(this).hasClass('main')){
					$(this).addClass('hide');
				} else {
					$(this).removeClass('hide');
				}
			});
			$(this).removeClass('show-more-btn').addClass('show-less-btn').html('Show less...');
		} else {
			$(this).closest('div').find('p').each(function(){
				if($(this).hasClass('main')){
					$(this).removeClass('hide');
				} else {
					$(this).addClass('hide');
				}
			});
			$(this).removeClass('show-less-btn').addClass('show-more-btn').html('Show more...');
		}
	});

	// close resume modal before opening photo modal
	$(document).on('click', '#view-resume-photos', function(){
		$('#talent-resume-modal').modal('toggle');
	});

}
