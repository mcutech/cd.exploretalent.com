function handler(core, user, projectId){
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.refresh();
}
handler.prototype.refresh = function(){
	var data = {
		projectId	: self.projectId,
		withs		: [ 'bam_roles' ]
	}

	self.core.resource.project.get(data)
	.then(function(result){
		result.date = self.core.service.date;
		self.core.service.databind('.project-overview-wrapper', result);
		console.log(result);
	})
}

module.exports = function(core, user, projectId){
	return new handler(core, user, projectId);
}