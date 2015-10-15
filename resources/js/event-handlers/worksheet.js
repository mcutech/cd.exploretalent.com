'use strict';

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;
	self.refresh();
}

handler.prototype.refresh = function() {
	var data = {
		jobId : self.roleId,
		query : [
			[ 'with', 'invitee.bam_cd_user' ],
			[ 'with', 'invitee.bam_talentci.bam_talent_media2' ],
			[ 'with', 'inviter.bam_cd_user' ],
			[ 'with', 'inviter.bam_talentci.bam_talent_media2' ],
			[ 'with', 'bam_role' ],
			// [ 'where', [
			// 		[ 'where', 'invitee_id', '=', self.user.id ],
			// 		[ 'orWhere', 'inviter_id', '=', self.user.id ]
			// 	]
			// ],
			// [ 'where', [
			// 		[ 'where', 'invitee_accepted', '<>', 0 ],
			// 		[ 'orWhere', [
			// 				[ 'where', 'invitee_accepted', '=', 0 ],
			// 				[ 'where', 'when', '<>', '0000-00-00 00:00:00' ]
			// 			]
			// 		]
			// 	]
			// ]
		]
	};

	self.core.resource.schedule.get(data)
		.then(function(res) {
			console.log(res);
			self.core.service.databind('#schedules', res);
		});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
