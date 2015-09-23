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
			//console.log(talent);
			//layoutInit(self.core, self.user, talent);
			//$('.search-talents-div').databind(talent);
			return $.when();

		});
}

handler.prototype.refreshList = function(){
	var data = {
		//page : $.queryToObject().talent_page ? $.queryToObject().talent_page : 1,
		withs : [
			'bam_talentinfo1',
			'bam_talentinfo2',
			'bam_talent_resume',
			'bam_talent_media2',
		],
		//wheres : group,
		//wheres : [['join', 'laret_favorite_talents', 'talentci.talentnum', '=', 'laret_favorite_talents.bam_talentnum'], data],
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
				/*$('#talent-list').databind(list);
				$('#talent-pagination').paginate({
					class 	 : 'pagination float-right margin-top-medium',
					count	 : list.total,
					name 	 : 'talent_page',
					per_page : 24
				});*/
				self.core.service.databind('#talents-list', list);
				//return $.when();
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