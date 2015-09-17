'use strict';

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	
	// get role id
	var sPageURL = window.location.pathname;
    var sURLVariables = sPageURL.split('/');
    if(sURLVariables){
    	self.cast_id = sURLVariables[2];
    	self.role_id = sURLVariables[4];
    }

	self.getRoleInfo();
}

//get Role info
handler.prototype.getRoleInfo = function(){
	var groups = [];
	var data = {
		withs : [
			'bam_roles'
		],
		wheres : [
			['where', 'casting_id', '=', self.cast_id],
		]
	};

	return self.core.resource.project.get(data)
		.then(function(res){

			_.each(res.data, function(val){
				_.each(val.bam_roles, function(val1){
					if(self.role_id == val1.role_id){
						self.role_info = val1;
					}
				});
			});
		}).then(function(){
			var vals = self.role_info;
			console.log(vals);
			var item1 = [], item2 = [];
			var dates = new Date().getFullYear();
			var agesmin = dates - parseInt(vals.age_min);
			var agesmax = dates - parseInt(vals.age_max);
			console.log(agesmin + ' ' + agesmax);
			var builds = ['built_athletic', 'built_average', 'built_large', 'built_lm', 'built_medium', 'built_petite', 'built_thin', 'built_xlarge'];
			var ethnicities = ['ethnicity_african', 'ethnicity_african_am', 'ethnicity_american_in', 'ethnicity_asian', 'ethnicity_caribbian', 'ethnicity_caucasian', 'ethnicity_east_indian', 'ethnicity_hispanic', 'ethnicity_mediterranean', 'ethnicity_middle_est', 'ethnicity_mixed', 'ethnicity_native_am'];
			//
			groups.push(['whereBetween', 'talentinfo1.dobyyyy', [parseInt(agesmin), parseInt(agesmax)]]);
			groups.push(['whereBetween', 'talentinfo1.heightinches', [parseInt(self.role_info.height_min), parseInt(self.role_info.height_max)]]);

			var gender = [vals.gender_female, vals.gender_male];

			//for gender
			if(!(vals.gender_male > 0 && vals.gender_female > 0) || !(vals.gender_male > 1 && vals.gender_female > 1)){
				if(vals.gender_male > 0){
					groups.push(['where', 'talentinfo1.sex', '=', 'male']);
				} else {
					groups.push(['where', 'talentinfo1.sex', '=', 'female']);
				}
			}

			//for build
			if(vals.built_any == 0){

				_.each(builds, function(e){
					if(vals[e] > 0){
						var i = e.split('_');
						var abc = '';
						if(i[1] == 'lm'){
							abc = 'Lean-Muscle';
						}
						else if(i[1] == 'xlarge'){
							abc = 'Extra-Large';
						}
						else if(i[1] == 'thin'){
							abc = 'Slim';
						}
						else {
							abc = i[1];
						}
						if(!abc == ''){
							item1.push(['orWhere', 'talentinfo1.build', '=', abc]);
						}
					}
				});
				console.log(item1);
				if(item1.length > 0){
					groups.push(['where', item1]);
				}
				//item1.push(value);

				//console.log(item1);
			}

			// for ethnicity
			if(vals.ethnicity_any == 0){

				_.each(ethnicities, function(e){
					if(vals[e] > 0){
						var i = e.split('_');
						var abc = '';
						if(i.length > 2){
							if(i[3] == 'am'){
								if(i[2] == 'african'){
									//african
									var abc = 'African American';
								} else {
									//native
									var abc = 'Native American';
								}
							}
							else if(i[3] == 'in'){
								abc = 'American Indian';
							}
							else if(i[3] == 'indian'){
								abc = 'East Indian';
							}
							else if(i[3] == 'est'){
								abc = 'Middle Eastern';
							}
						} else {
							/*if(i[1] == 'lm'){
								var abc = 'Lean-Muscle';
							}
							else if(i[1] == 'xlarge'){
								var abc = 'Extra-Large';
							}
							else if(i[1] == 'thin'){
								var abc = 'Slim';
							}
							else {
								var abc = i[1];
							}*/
							abc = i[1];
						}
						if(!abc == ''){
							item2.push(['orWhere', 'talentinfo1.build', '=', abc]);
						}
					}
				});
				console.log(item2);
				if(item2.length > 0){
					groups.push(['where', item2]);
				}
				//item1.push(value);

				//console.log(item1);
			}
			console.log(groups);


			}).then(function(res){
				var data = {
					//page : $.queryToObject().talent_page ? $.queryToObject().talent_page : 1,
					withs : [
						'bam_talentinfo1',
						'bam_talentinfo2',
						'bam_talent_resume',
						'bam_talent_media2',
					],
					wheres : groups,
					//wheres : [['join', 'talentinfo1', 'talentci.talentnum', '=', 'talentinfo1.talentnum'],groups,
					orders : {
						'talentci.talentnum' : 'asc',
						'talentinfo1.rating' : 'desc'
					},
					per_page : 12,
					from : 1,
					to : 12
				};
				console.log(data)
				return self.core.resource.talent.get(data)
				.then(function(list){
					console.log(list);
					/*$('#talent-list').databind(list);
					$('#talent-pagination').paginate({
						class 	 : 'pagination float-right margin-top-medium',
						count	 : list.total,
						name 	 : 'talent_page',
						per_page : 24
					});*/
					self.core.service.databind('.talents-search-result', list);
					return $.when();

					groups = [];
				});
			});

			


}

handler.prototype.refreshList = function(group){
	var data = {
		//page : $.queryToObject().talent_page ? $.queryToObject().talent_page : 1,
		withs : [
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_resume',
			'bam_talent_media2',
		],
		wheres : group,
		//wheres : [['join', 'talentinfo1', 'talentci.talentnum', '=', 'talentinfo1.talentnum'],groups,
		orders : {
			'talentci.talentnum' : 'asc',
			'talentinfo1.rating' : 'desc'
		},
		per_page : 12,
		from : 1,
		to : 12
	};
		return self.core.resource.talent.get(data)
			.then(function(list){
				/*$('#talent-list').databind(list);
				$('#talent-pagination').paginate({
					class 	 : 'pagination float-right margin-top-medium',
					count	 : list.total,
					name 	 : 'talent_page',
					per_page : 24
				});*/
				self.core.service.databind('.talents-search-result', list);
				return $.when();
			});
};

// Search filter
handler.prototype.ApplyData = function(e) {

	e.preventDefault();
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
			console.log(val);
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
			console.log(val);
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

	console.log(group);


	//retrieve data 
	var data = {
		//page : $.queryToObject().talent_page ? $.queryToObject().talent_page : 1,
		withs : [
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_resume',
			'bam_talent_media2',
		],
		wheres : group,
		//wheres : [['join', 'talentinfo1', 'talentci.talentnum', '=', 'talentinfo1.talentnum'],groups,
		orders : {
			'talentci.talentnum' : 'asc',
			'talentinfo1.rating' : 'desc'
		},
		per_page : 12,
		from : 1,
		to : 12
	};

	return self.core.resource.talent.get(data)
	.then(function(list){
		console.log(list);
		console.log(group);
		/*$('#talent-list').databind(list);
		$('#talent-pagination').paginate({
			class 	 : 'pagination float-right margin-top-medium',
			count	 : list.total,
			name 	 : 'talent_page',
			per_page : 24
		});*/
		self.core.service.databind('.talents-search-result', list);
		return $.when();

		group = [];
		group1 = [];
		group2 = [];
	});
}

module.exports = function(core, user) {
	return new handler(core, user);
};