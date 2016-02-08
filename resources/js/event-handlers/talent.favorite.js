function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.talent = null;
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
		page : qs.page || 0
	}

	self.core.resource.favorite_talent.get(data)
	.then(function(result){
		var talent = {
			data : [],
		}
		_.each(result.data, function(res){
			res.bam_talentci.favorite = res.id;
			res.bam_talentci.schedule ={};
			res.bam_talentci.rating = null;
			talent.data.push(res.bam_talentci);
		});
		console.log(talent);
		self.core.service.databind('#favorite-result', talent);
		self.core.service.paginate('#favorite-pagination', { class : 'pagination', total : result.total, name : 'page' });

		self.talent = talent;
		$('#loading-div').hide();
	})

};

handler.prototype.addToFav = function(){
	var b = $(this).closest('.talent-tab').attr('id');
	var talentnum = (b.split('-')[2]);

	var talents = _.find(self.talent.data, function(n){
		return n.talentnum == talentnum;
	});

	if(talents){
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
