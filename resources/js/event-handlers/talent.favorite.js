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
			'bam_talentci.bam_talentinfo1',
			'bam_talentci.bam_talentinfo2',
			'bam_talentci.bam_talent_media2'
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

	/*if (self.filter) {
		data.wheres = data.wheres.concat(self.filter);
	}*/

	self.core.resource.favorite_talent.get(data)
	.then(function(result){
		var talent = {
			data : [],
		}
		_.each(result.data, function(res){
			res.bam_talentci.favorite = res.id;
			res.bam_talentci.schedule_id1 = null;
			res.bam_talentci.schedule_id2 = null;
			res.bam_talentci.rating = null;
			res.bam_talentci.rating1 = null;
			res.bam_talentci.rating2 = null;
			talent.data.push(res.bam_talentci);
		});
		console.log(talent);
		self.core.service.databind('#favorite-result', talent);
	}) 
	
};

handler.prototype.addToFav = function(){
	var favId = $(this).attr('data-id');
	var b = $(this).closest('.talent-tab').attr('id');
	var talentnum = (b.split('-')[2]);
	console.log(self.user);
	if(favId){
		self.core.resource.favorite_talent.delete({ favoriteId : talentnum})
			.then(function(res){
				self.refresh();
			});
	} else {
		self.core.resource.favorite_talent.post({ bam_cd_user_id : self.user.bam_cd_user_id, bam_talentnum : talentnum})
			.then(function(res){
				self.refresh();
			});
	}
}

module.exports = function(core, user){
	return new handler(core, user);
}