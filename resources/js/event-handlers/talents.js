'use strict';

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;

	//self.refreshAdvancedSearchValues().then(self.refreshList);
	self.refreshList();
}

handler.prototype.refreshAdvancedSearchValues = function() {
	var data = {
		talentId : self.user.bam_talentnum,
		withs : [
			'bam_talentinfo1',
			'bam_talent_media2'
		]
	};
	return self.core.resource.talent.get(data)

		.then(function(talent) {
			console.log(talent);
			//layoutInit(self.core, self.user, talent);
			//$('.search-talents-div').databind(talent);
			return $.when();

		});
}

handler.prototype.refreshList = function(group){
	var qs = self.core.service.query_string();
	var data = {
		withs	: [
			'user',
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_media2'
		],
		wheres : [
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
			[ 'where', [
					[ 'where', 's1.bam_role_id', '=', self.roleId ],
					[ 'orWhere', [
							[ 'whereNull', 's1.bam_role_id' ]
						]
					]
				]
			],
			[ 'where', [
					[ 'where', 's2.bam_role_id', '=', self.roleId ],
					[ 'orWhere', [
							[ 'whereNull', 's2.bam_role_id' ]
						]
					]
				]
			]
		],
		page : qs.page || 0
	}

	if (self.filter) {
		data.wheres = data.wheres.concat(self.filter);
	}
		return self.core.resource.talent.get(data)
			.then(function(list){
				/*$('#talent-list').databind(list);
				$('#talent-pagination').paginate({
					class 	 : 'pagination float-right margin-top-medium',
					count	 : list.total,
					name 	 : 'talent_page',
					per_page : 24
				});*/
				self.core.service.databind('#talent-result', list);
				$('#loading-div').hide();
				return $.when();
			});
};

handler.prototype.ApplyData = function(e) {

	e.preventDefault();
	var dates = new Date().getFullYear();
	var agesmin = dates - parseInt($('#text-age-min').html());
	var agesmax = dates - parseInt($('#text-age-max').html());
	var group = [];
	var group1 = [];
	var group2 = [];
	//age range, gender, has picture, height range, body type, ethnicity, membership
	//group.age_min.push([ $('#text-age-min').html() ]);
	group.push(['whereBetween', 'talentinfo1.dobyyyy', [parseInt($('#text-age-min').html()), parseInt($('#text-age-max').html())]]);
	group.push(['whereBetween', 'talentinfo1.heightinches', [parseInt($('#val-height-min').html()), parseInt($('#val-height-max').html())]]);

	//gender checkbox
	var checkedgender = $('#checkbox-gender:checked').map(function(){
		return this.value;
	}).get();
	if(checkedgender.length > 0 && checkedgender.length < 2 ){
		group.push(['where', 'talentinfo1.sex', '=', checkedgender[0]]);
	}


	//has picture checkbox
	if($('#has-pic').is(':checked')){
		group.push([ 'whereHas', 'bam_talent_media2', [ 'where', 'talent_media2.media_path', '<>', 'null' ] ]);
	}

	//Body type
	var checkedbody = $('#checkbox-body:checked').map(function(){
		return this.value;
	}).get();

	if(checkedbody.length > 0 && checkedbody.length < 9 ){
		_.each(checkedbody, function(val, index){
			group1.push(['orWhere', 'talentinfo1.build', '=', val]);
		});
		group.push(['where', group1]);
	}

	//ethnicity type
	var checkedethnicity = $('#checkbox-ethnicity:checked').map(function(){
		return this.value;
	}).get();

	if(checkedethnicity.length > 0 && checkedethnicity.length < 8 ){
		_.each(checkedethnicity, function(val, index){
			group2.push(['orWhere', 'talentinfo2.ethnicity', '=', val]);
		});
		group.push(['where', group2]);
	}

	//member
	var checkedmember = $('#checkbox-member:checked').map(function(){
		return this.value;
	}).get();
	if(checkedmember.length > 0 && checkedmember.length < 2 ){
		if(checkedmember[0] == 'pro'){
			group.push(['where', 'join_status', '>', 4]);
		} else {
			group.push(['where', 'join_status', '<', 5]);
		}
	}

	//retrieve data
	var qs = self.core.service.query_string();
	var data = {
		withs	: [
			'user',
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_media2'
		],
		wheres : [
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
			[ 'where', [
					[ 'where', 's1.bam_role_id', '=', self.roleId ],
					[ 'orWhere', [
							[ 'whereNull', 's1.bam_role_id' ]
						]
					]
				]
			],
			[ 'where', [
					[ 'where', 's2.bam_role_id', '=', self.roleId ],
					[ 'orWhere', [
							[ 'whereNull', 's2.bam_role_id' ]
						]
					]
				]
			]
		],
		page : qs.page || 0
	}

	if (self.filter) {
		data.wheres = data.wheres.concat(self.filter);
	}

	return self.core.resource.talent.get(data)
	.then(function(list){
		/*$('#talent-list').databind(list);
		$('#talent-pagination').paginate({
			class 	 : 'pagination float-right margin-top-medium',
			count	 : list.total,
			name 	 : 'talent_page',
			per_page : 24
		});*/
		self.core.service.databind('#talent-result', list);
		return $.when();

		group = [];
		group1 = [];
		group2 = [];
	});
}

handler.prototype.addToFav = function(){
	var favId = $(this).attr('data-id');
	var b = $(this).closest('.talent-tab').attr('id');
	var talentnum = (b.split('-')[2]);
	if(favId){
		self.core.resource.favorite_talent.delete({ favoriteId : talentnum})
			.then(function(res){
				self.refreshList();
			});
	} else {
		self.core.resource.favorite_talent.post({ bam_cd_user_id : self.user.bam_cd_user_id, bam_talentnum : talentnum})
			.then(function(res){
				self.refreshList();
			});
	}
}

module.exports = function(core, user) {
	return new handler(core, user);
};
