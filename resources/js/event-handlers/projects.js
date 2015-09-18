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
			console.log(res);
			_.each(res.data, function(value, index){
				res.data[index].date = self.core.service.date;
			})
			_.each(res.data, function(res1){
				var i = (new Date(res1.asap*1000));
				var d = i.getDate();
				var m = i.getMonth()+1;
				var y = i.getFullYear();
				//
				
				res1.asap1 = y + "-" + m + "-" + d;
				//console.log(newdate);											
				//res1.asap = i;
				//console.log(i);
			});
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
