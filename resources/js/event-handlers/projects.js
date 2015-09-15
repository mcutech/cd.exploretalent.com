'use strict';

function handler(core, user){

	self = this;
	self.core = core;
	self.user = user;
	self.refreshList();
}

handler.prototype.refreshList = function(){
	console.log(self.user);

	var data = {
		casting_id : self.user.bam_cd_user.user_id,
		withs : [
			'bam_roles'
		],
		per_page : 5,
		/*wheres : [
			[ 'where', 'casting_id', '=', self.user.bam_cd_user.user_id]
		]*/
	};

	return self.core.resource.project.get(data)
		.then(function(res){
			console.log(res);
			self.core.service.databind('#project-listing', res);
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
};