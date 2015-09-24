'use strict';

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	
	//self.refreshAdvancedSearchValues().then(self.refreshList);
	self.refreshList();

}

handler.prototype.refreshList = function(group){
	var data = {
		//page : $.queryToObject().talent_page ? $.queryToObject().talent_page : 1,
		withs : [
			'bam_talentci.bam_talentinfo1',
			'bam_talentci.bam_talentinfo2',
			'bam_talentci.bam_talent_media2',
		],
		per_page : 12,
		from : 1,
		to : 12
	};
		return self.core.resource.favorite_talent.get(data)
			.then(function(list){
				console.log(list);
				/*$('#talent-list').databind(list);
				$('#talent-pagination').paginate({
					class 	 : 'pagination float-right margin-top-medium',
					count	 : list.total,
					name 	 : 'talent_page',
					per_page : 24
				});*/
				/*_.each(list.data, function(val){
					console.log(val);
				});*/
				//self.core.service.databind('#talents-search-result', list);
				return $.when();
			});
};

module.exports = function(core, user) {
	return new handler(core, user);
};