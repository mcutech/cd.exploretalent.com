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
			});
};


module.exports = function(core, user) {
	return new handler(core, user);
};