'use strict';
var _ = require('lodash');

function handler(core, user, talentnum){
	self = this;
	self.core = core;
	self.user = user;
	self.talentnum = talentnum;
	self.refresh();
}

handler.prototype.refresh = function() {

	var data = {
		talentId : self.talentnum,
		query : [
			[ 'with', 'bam_talent_media2' ],
			[ 'with', 'bam_talentinfo1' ],
			[ 'with', 'bam_talentinfo2' ],
			[ 'with', 'bam_talent_music' ],
			[ 'with', 'bam_talent_dance' ],
			[ 'with', 'user' ]
		]
	};
	self.core.resource.talent.get(data)
		.then(function(res) {
			console.log(res);
			if(!res.heightText() && !res.bam_talentinfo2.ethnicity && !res.bam_talentinfo1.weightpounds && !res.bam_talentinfo1.haircolor && !res.bam_talentinfo1.build && !res.bam_talentinfo1.eyecolor && !res.bam_talentinfo2.special_skills){
				$('#acting-modeling-link, #acting-modeling').addClass('hide');
			}

			if(!res.bam_talent_music[0].music_role && !res.bam_talent_music[0].number_of_gigs && !res.bam_talent_music[0].genre && !res. bam_talent_music[0].music_instruments && !res.bam_talent_music[0].des_1 && !res.bam_talent_music[0].searching_gig_des && !res.bam_talent_music[0].major_influence){
				$('#musician-link, #musician').addClass('hide');
			}

			if(!res.bam_talent_dance[0].dance_style_1 && !res.bam_talent_dance[0].num_of_perfom && !res.bam_talent_dance[0].years_experience && !res.bam_talent_dance[0].dancer_background && !res.bam_talent_dance[0].influences && !res.bam_talent_dance[0].searching_gig_des){
				$('#dance-link, #dance').addClass('hide');
			}

			self.core.service.databind('#talent-resume-info', res);
			self.core.service.databind('#talent-primary-photo', res);
			self.core.service.databind('#talent-resume-div', res);

			var photos = _.filter(res.bam_talent_media2, function(val){
				return val.type == 1;
			});
			console.log(photos);
			if(photos[0]){
				var firstphoto = _.slice(photos, 0, 1);
				self.core.service.databind('#first-photo', firstphoto[0]);
			}

			if(photos[1]){
				var secondphoto = _.slice(photos, 1, 2);
				self.core.service.databind('#second-photo', secondphoto[0]);
			}

			if(photos[2]){
				var thirdphoto = _.slice(photos, 2, 3);
				self.core.service.databind('#third-photo', thirdphoto[0]);
			}
		});
}

module.exports = function(core, user, talentnum) {
	return new handler(core, user, talentnum);
};
