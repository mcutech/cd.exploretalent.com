'use strict';

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
			self.core.service.databind('#talent-resume-div', res);
		});
}

module.exports = function(core, user, talentnum) {
	return new handler(core, user, talentnum);
};
