'use strict';

function handler(core, user){

	self = this;
	self.core = core;
	self.user = user;
	self.refreshList();
}

handler.prototype.refreshList = function(){
	if (!self.user.bam_cd_user_id)
		window.location = '/login?redirect=' + encodeURIComponent(window.location);

	var data = {
		withs : [
			'bam_roles'
		],
		per_page : 5
	};

	return self.core.resource.project.get(data)
		.then(function(res){

			console.log(res.data);
			
			_.each(res.data, function(value, index){
				res.data[index].date = self.core.service.date;
			})
			console.log(res);
			self.core.service.databind('#project-listing', res);
		});
}

handler.prototype.roleMatches = function() {
	var cast_id = $(this).parent().attr('id');
	var ids = $(this).attr('id');
	
	window.location = 'projects/'+cast_id+'/roles/'+ids+'/matches';
}

module.exports = function(core, user) {
	return new handler(core, user);
};
