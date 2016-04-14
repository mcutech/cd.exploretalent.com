function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.talent = null;
	self.refresh();
}
handler.prototype.refresh = function(append){
	// $('#div-for-favorite').removeClass('hide');
	// $('#div-for-rolematch').addClass('hide');
	if (self.refreshing) {
		return;
	}

	append = append === true;
	self.page = append ? self.page + 1 : 1;
	self.refreshing = true;

	var talents;

	$('#talent-search-loader').show();

	if (!append) {
		$('#talent-search-result').hide();
	}

	self.core.resource.favorite_talent.get()
	.then(function(result){
		var talentnums = _.map(result.data, function(talent) {
			return talent.bam_talentnum;
		});

		talentnums.push(0);

		var data = {
			query : [
				[ 'whereIn', 'talentnum', talentnums ],
			]
		};

		return self.core.resource.search_talent.get(data)

	})
	.then(function(res) {
		talents = res;
		if (talents.total) {
			talentnums = _.map(talents.data, function(talent) {
				return talent.talentnum;
			});

			talentnums.push(0);

			var data2 = {
				query : [
					[ 'whereIn', 'talentci.talentnum', talentnums ],
					[ 'with', 'bam_talent_media2' ],
					[ 'with', 'user' ]
				]
			};
			return self.core.resource.talent.get(data2);
		}
		else {
			return $.when({ data : [] });
		}
	})
	.then(function (res) {
		_.each(talents.data, function(talent) {
			var talentci = _.find(res.data, function(tm) {
				return talent.talentnum == tm.talentnum;
			});

			if (talentci) {
				talent.bam_talent_media2 = talentci.bam_talent_media2;
				talent.user = talentci.user;
			}
		});

		// if (talents.total) {
		if (false) {		// TODO: uncomment line above when API is working
			// get favorite talents
			var data2 = {
				query : [
					[ 'whereIn', 'bam_talentnum', talentnums ]
				]
			};

			return self.core.resource.favorite_talent.get(data2);
		}
		else {
			return $.when({ data : [] });
		}
	})
	.then(function(res) {
		if (talents.total) {
			//assign favorite talents to talent
			_.each(talents.data, function(talent) {
				talent.favorite = _.find(res.data, function(favorite) {
					return talent.talentnum == favorite.bam_talentnum;
				});
			});
		}
		console.log(talents);
		self.core.service.databind('#favorite-result', talents, append);
		self.refreshing = false;

		// $('#talent-search-loader').hide();
		if (!append) {
			$('#talent-search-result').show();
		}
	});

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
	self.inviteeId = $(this).parent().attr("data-id");
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
