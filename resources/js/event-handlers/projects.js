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
			_.each(res.data, function(value, index){
				res.data[index].date = self.core.service.date;
			})

			self.core.service.databind('#project-listing', res);
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
};
