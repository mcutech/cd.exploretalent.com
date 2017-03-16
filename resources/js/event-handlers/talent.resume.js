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
			self.talent = res;

			var data = {
				q : [
					[ 'where', 'bam_talentnum', '=', self.talent.talentnum ]
				]
			}

			return self.core.resource.favorite_talent.get(data);
		})
		.then(function(res) {

			self.talent.favorite = _.first(res.data);
			console.log(self.talent.bam_talent_music);
			self.getRoleInfo();

			if(!self.talent.heightText() && !self.talent.bam_talentinfo2.ethnicity && !self.talent.bam_talentinfo1.weightpounds && !self.talent.bam_talentinfo1.haircolor && !self.talent.bam_talentinfo1.build && !self.talent.bam_talentinfo1.eyecolor && !self.talent.bam_talentinfo2.special_skills){
				$('#acting-modeling-link, #acting-modeling').addClass('hide');
			}

			if(!self.talent.bam_talent_music && !self.talent.bam_talent_music[0].music_role && !self.talent.bam_talent_music[0].number_of_gigs && !self.talent.bam_talent_music[0].genre && !self.talent. bam_talent_music[0].music_instruments && !self.talent.bam_talent_music[0].des_1 && !self.talent.bam_talent_music[0].searching_gig_des && !self.talent.bam_talent_music[0].major_influence){
				$('#musician-link, #musician').addClass('hide');
			}

			if(!self.talent.bam_talent_dance && !self.talent.bam_talent_dance[0].dance_style_1 && !self.talent.bam_talent_dance[0].num_of_perfom && !self.talent.bam_talent_dance[0].years_experience && !self.talent.bam_talent_dance[0].dancer_background && !self.talent.bam_talent_dance[0].influences && !self.talent.bam_talent_dance[0].searching_gig_des){
				$('#dance-link, #dance').addClass('hide');
			}

			self.core.service.databind('#talent-resume-info', self.talent);
			self.core.service.databind('#talent-primary-photo', self.talent);
			self.core.service.databind('#talent-resume-div', self.talent);
			self.core.service.databind('#talent-photo', self.talent);
			// self.core.service.databind('#talent-photo', self.talent);

			var photos = _.filter(self.talent.bam_talent_media2, function(val){
				return val.type == 1;
			});
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

			$('.talent-resume-wrapper').removeClass('hide');

		});
}

handler.prototype.getRoleInfo = function() {
	var qs = self.core.service.query_string();

	if(qs.casting_id != 0 && qs.role_id != 0){
		var data = {
			projectId : qs.casting_id,
			jobId : qs.role_id,
			query : [
				[ 'with', 'bam_casting' ]
			]
		}

		self.core.resource.job.get(data)
			.then(function(res) {
				res.talent = self.talent;
				self.core.service.databind('#project-role-actions', res);
			});
	}
	else {
		self.core.service.databind('#add-to-like-it-list', { talent : self.talent, role_id : 0 });
		self.core.service.databind('.favorite-button', { talent : self.talent, role_id : 0 });
	}
}

module.exports = function(core, user, talentnum) {
	return new handler(core, user, talentnum);
};
