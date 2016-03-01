function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.talent = null;
	self.refresh();
}
handler.prototype.refresh = function(){
	// $('#div-for-favorite').removeClass('hide');
	// $('#div-for-rolematch').addClass('hide');
	var qs = self.core.service.query_string();
	var data = {
		withs	: [
			'bam_talentci.bam_talentinfo1',
			'bam_talentci.bam_talentinfo2',
			'bam_talentci.bam_talent_media2',
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

handler.prototype.refreshCastingRole = function() {
	self.inviteeId = $(this).parent().attr("data-id").replace('user-', '');
	self.ratingValue = $(this).text();

	self.core.resource.project.get()
		.then(function(res) {
			self.core.service.databind('#casting-div', res);

		});

}

handler.prototype.selectCastingRole = function() {
	var castingId = $('#casting-list').val();
	self.castingId = castingId;
	console.log(castingId);

	var data = {
		projectId	: castingId,
		withs		: [ 'bam_roles' ]
	}

	self.core.resource.project.get(data)
		.then(function(res) {
			self.core.service.databind('#role-div', res);
			self.inviterId = res.user_id;

			$('#role-list').change(function() {
				var roleId = null;
				roleId = $('#role-list').val();
				self.roleId = roleId;
				console.log(roleId)
			});
		});
}

handler.prototype.addToLikeitlist = function() {
	var scheduleData = {
		query : [
			[ 'where', 'bam_role_id', '=', self.roleId ],
			[ 'where', 'invitee_id', '=', self.inviteeId ],
			[ 'where', 'inviter_id', '=', self.inviterId ]
		]
	};

	self.core.resource.schedule.get(scheduleData)
		.then(function(result){
			var data = {
					bam_role_id		: self.roleId,
					invitee_id		: self.inviteeId,
					inviter_id		: self.inviterId,
					rating			: self.ratingValue,
					invitee_status	: self.core.resource.schedule_cd_status.PENDING,
					inviter_status	: self.core.resource.schedule_cd_status.PENDING,
					status			: self.core.resource.schedule_status.PENDING
			}

			if(result.total != 0){
				self.core.resource.schedule.patch({scheduleId : result.data[0].id, rating : self.ratingValue})
					.then(function(){
						alert('Added to like it list.');
					});
			}else {
				self.core.resource.schedule.post(data)
					.then(function(){
						alert('Added to like it list.');
					});
			}
			$('#addtolist').modal('hide');
			$('#role-list').val([]);
		});
}

module.exports = function(core, user){
	return new handler(core, user);
}
