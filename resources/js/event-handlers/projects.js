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
			_.each(res.data, function(res1){
				var i = (new Date(res1.asap*1000));
				var d = i.getDate();
				var m = i.getMonth()+1;
				var y = i.getFullYear();
				//
				if(res1.aud_timestamp){
					var i1 = (new Date(res1.aud_timestamp*1000));
					var d1 = i1.getDate();
					var m1 = i1.getMonth()+1;
					var y1 = i1.getFullYear();
					res1.aud_timestamp1 = y1 + "-" + m1 + "-" + d1;
				}

				res1.asap1 = y + "-" + m + "-" + d;
				//console.log(newdate);
				//res1.asap = i;
				//console.log(i);
			});
			self.core.service.databind('#project-listing', res);
		});
}

handler.prototype.deleteProject = function() {

	var castingId = $(this).attr('id');
		castingId = castingId.split('_');
		castingId = castingId[1];

	var data = {
		projectId : castingId
	}

	var con = confirm("Are you sure you want to delete this project?");

	if (con) {
		return self.core.resource.project.delete(data)
		.then(function(res) {
			alert("Project has been deleted!");
			setTimeout(function() {
				location.reload();
			}, 3000);
		});
	}
	else {
		return false;
	}


}

handler.prototype.roleMatches = function() {
	var cast_id = $(this).parent().attr('id');
	var ids = $(this).attr('id');

	window.location.replace('projects/'+cast_id+'/roles/'+ids+'/matches');
}

handler.prototype.deleteRole = function(e) {
	e.preventDefault();
	var cast_id = $(this).parent().attr('id');
	var ids = $(this).attr('id');

	if(confirm("Are you sure you want to delete this role?")){
		self.core.resource.job.delete({ projectId : cast_id, jobId : ids})
			.then(function(res){
				self.refreshList();
			});
	}
}

module.exports = function(core, user) {
	return new handler(core, user);
};
