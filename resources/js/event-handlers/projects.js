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

	var qs = self.core.service.query_string();
	var data = {
		withs : [
			'bam_roles'
		],
		query : [],
		page : qs.page || 0,
		per_page : 20
	};

	var searchterm = $('#project-name[name="project"]').val();
	if(searchterm) {
		data.query.push([ 'where',
			[
				[ 'where', 'project', 'LIKE', '%' + searchterm + '%' ],
				[ 'orWhere', 'name', 'LIKE', '%' + searchterm + '%' ],
				[ 'orWhere', 'name_original', 'LIKE', '%' + searchterm + '%' ],
				[ 'orWhere', 'casting_id', '=', searchterm ],
			]
		]);
	}

	var status = $('#project-status[name="status"]').val();
	if(status) {
		if(status == '1') { // ACTIVE
			data.query.push([ 'where',
				[
					[ 'where', 'status', '=', 1 ],
				]
			]);
		}
		else if(status == '0') { // PENDING REVIEW
			data.query.push([ 'where',
				[
					[ 'where', 'status', '=', 0 ],
				]
			]);
		}
		else { // ALL
			// push nothing to query
		}
	}

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
				if(res1.aud_timestamp){
					var i1 = (new Date(res1.aud_timestamp*1000));
					var d1 = i1.getDate();
					var m1 = i1.getMonth()+1;
					var y1 = i1.getFullYear();
					res1.aud_timestamp1 = y1 + "-" + m1 + "-" + d1;
				}
				else {
					res1.aud_timestamp1 = '';
				}

				res1.asap1 = y + "-" + m + "-" + d;
				//console.log(newdate);
				//res1.asap = i;
				//console.log(i);
			});
			self.core.service.databind('#project-listing', res);
			self.core.service.paginate('#projects-pagination', { total : res.total, class : 'pagination', name : 'page', per_page: res.per_page });
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

//`
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
