function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.refresh();
}
handler.prototype.refresh = function(){
	var qs = self.core.service.query_string();
	var data = {
		withs	: [
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_media2'
		],
		/*wheres : [
			[ 'leftJoin', 'laret_users', 'laret_users.bam_talentnum', '=', 'talentci.talentnum' ],
			[ 'select', '*', 'laret_favorite_talents.id AS favorite', 's1.id AS schedule_id1', 's2.id AS schedule_id2', 's1.rating AS rating1', 's2.rating AS rating2' ],
			[ 'leftJoin', 'laret_favorite_talents', 'laret_favorite_talents.bam_talentnum', '=', 'talentci.talentnum' ],
			[ 'leftJoin', 'laret_schedules AS s1', 's1.invitee_id', '=', 'laret_users.id' ],
			[ 'leftJoin', 'laret_schedules AS s2', 's2.inviter_id', '=', 'laret_users.id' ],
			[ 'where', [
					[ 'where', 'laret_favorite_talents.bam_cd_user_id', '=', self.user.bam_cd_user_id ],
					[ 'orWhere', [
							[ 'whereNull', 'laret_favorite_talents.bam_cd_user_id']
						]
					]
				]
			],
		],*/
		page : qs.page || 0
	}

	if (self.filter) {
		data.wheres = data.wheres.concat(self.filter);
	}

	self.core.resource.favorite_talent.get()
	.then(function(result){
		console.log(result);
	}) 
	
};
module.exports = function(core, user){
	return new handler(core, user);
}