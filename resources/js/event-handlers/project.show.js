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
							gorup2.push('Extra Large');
						} else {
							group2.push(val.split('built_')[1].replace(/^[a-z]/, function(m){ return m.toUpperCase() }));
						}
						res.build = group2;
					}
				});
			}
		});


		self.core.service.databind('.project-overview-wrapper', result);
		console.log(result);
	})
}

handler.prototype.editRole = function(){
	var pathname = window.location.pathname;
	var i = pathname.split('/');
	var cast_id = i[2];
	console.log(cast_id);
	var roleId = $(this).attr('id');

	window.location = '/projects/'+cast_id+'/roles/'+roleId+'/edit';
}

handler.prototype.editProject = function(e){
	e.preventDefault();
	var pathname = window.location.pathname;
	var i = pathname.split('/');
	var cast_id = i[2];

	window.location = '/projects/'+cast_id+'/edit';
}

module.exports = function(core, user, projectId){
	return new handler(core, user, projectId);
}

// 8 == open call