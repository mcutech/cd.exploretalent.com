'use strict';

function handler(core, user, projectId){
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.project;
	self.refresh();
}

handler.prototype.refresh = function(){
	var data = {
		projectId	: self.projectId,
		withs		: [ 'bam_roles' ]
	}

	self.core.resource.project.get(data)
	.then(function(result){
		self.project = result;
		result.date = self.core.service.date;
		var eths = ['ethnicity_african', 'ethnicity_african_am', 'ethnicity_american_in', 'ethnicity_asian', 'ethnicity_caribbian', 'ethnicity_caucasian', 'ethnicity_east_indian', 'ethnicity_hispanic', 'ethnicity_mediterranean', 'ethnicity_middle_est', 'ethnicity_mixed', 'ethnicity_native_am'];
		var builds = ['built_athletic', 'built_average', 'built_bb', 'built_large', 'built_lm', 'built_medium', 'built_petite', 'built_thin', 'built_xlarge'];

		_.each(result.bam_roles, function(res){

			var group1 = [], group2 = [];
			//for gender
			if(res.gender_male == 1 && res.gender_female == 1){
				res.gender = "Any";
			}
			else if(res.gender_male == 1 && res.gender_female == 0){
				res.gender = "Male";
			} else {
				res.gender = "Female";
			}

			//for ethnicity
			if(res.ethnicity_any == 1){
				res.ethnicity = "Any";
			} else {
				_.each(eths, function(val, index){
					if(res[val]){
						if(val == 'ethnicity_american_in'){
							group1.push('American Indian');
						} else if(val == 'ethnicity_african_am'){
							group1.push('African American');
						} else if(val == 'ethnicity_east_indian'){
							group1.push('East Indian');
						} else if(val == 'ethnicity_native_am'){
							group1.push('Native American');
						} else {
							group1.push(val.split('ethnicity_')[1].replace(/^[a-z]/, function(m){ return m.toUpperCase() }));
						}
						res.ethnicity = group1;
					}
				});

			}

			//for build
			if(res.built_any == 1){
				res.build = "Any";
			} else {
				_.each(builds, function(val, index){
					if(res[val]){
						if(val == 'built_bb'){
							group2.push('Body Builder');
						} else if(val == 'built_lm'){
							group2.push('Lean Muscle');
						} else if(val == 'built_xlarge'){
							group2.push('Extra Large');
						} else {
							group2.push(val.split('built_')[1].replace(/^[a-z]/, function(m){ return m.toUpperCase() }));
						}
						res.build = group2;
					}
				});
			}

			if(result.status == '1') {
				$('.panel-active').removeClass('hide');
			}
			else {
				$('.panel-inactive').removeClass('hide');
			}
		});
		self.core.service.databind('.project-overview-wrapper', result);
		self.refreshStats();
	})
}

handler.prototype.refreshStats = function() {
	var promises = [];

	_.each(self.project.bam_roles, function(role) {
		promises.push(role.getLikeItList());
		promises.push(role.getSelfSubmissions());
	});

	$.when.apply($, promises)
		.then(function() {
			_.each(arguments, function(arg, index) {
				if (arg.total > 0) {
					var role_id = _.first(arg.data).bam_role_id;

					switch(index % 2) {
						case 0: // likeitlist
							$('#role-' + role_id + ' .like-it-list').text(arg.total);
							break;
						case 1: // self submissions
							$('#role-' + role_id + ' .self-submissions').text(arg.total);
							break;
						default:
							break;
					}
				}
			});
		});
}

handler.prototype.deleteRole = function(e) {
	e.preventDefault();
	var ids = $(this).attr('id');
	console.log(ids);
	console.log(self.projectId);
	if(confirm("Are you sure you want to delete this role?")){
		self.core.resource.job.delete({ projectId : self.projectId, jobId : ids})
			.then(function(res){
				self.refresh();
			});
	}	
}

module.exports = function(core, user, projectId){
	return new handler(core, user, projectId);
}

// 8 == open call
