'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.getProjectInfo();
}

handler.prototype.getProjectInfo = function(e) {
	var data = {
		projectId : self.projectId,
		query : [
			[ 'with', 'bam_roles' ]
		]
	}

	self.core.resource.project.get(data)
		.then(function(res) {
			self.project = res;

			var markets = _.map(self.project.market.split('>'), function(m) {
				return { name : m };
			});

			self.project.markets = { data : markets };
			console.log(self.project);

			self.core.service.databind('#project-details', self.project);
			self.core.service.databind('#project-overview-link', self.project);
		});
}

handler.prototype.saveNewRole = function(e) {

	e.preventDefault();

	//to be used later to determine where to link page
	var buttonId = $(this).attr('id');
	//var height = $('#heightinches').val(),
		//height = height.split(",");



	var age_min_val, age_max_val, height_min_val, height_max_val;
	if($('#age-min-input').val()=='<3'){
		age_min_val = 0;
	}else{
		age_min_val = $('#age-min-input').val();
	}
	if($('#age-max-input').val()=='70+'){
		age_max_val =70;
	}else{
		age_max_val = $('#age-max-input').val();
	}

	height_min_val = $('#height-min-dropdown').val();
	height_max_val = $('#height-max-dropdown').val();

	var data = {
		projectId : self.projectId,
		name : $('#role-name-text').val(),
		number_of_people : $('#role-number-text').val(),
		des : $('#role-description-text').val(),
		gender_male : $('#gender-male-checkbox').val(),
		gender_female : $('#gender-female-checkbox').val(),
		//age_min : $('#age-range-min').text(),
		age_min : age_min_val,
		//age_max : $('#age-range-max').text(),
		age_max: age_max_val,
		//height_min : height[0],
		height_min: height_min_val,
		//height_max : height[1],
		height_max: height_max_val,
		ethnicity_any : $('#ethnicity-any').val(),
		ethnicity_african : $('#ethnicity-african').val(),
		ethnicity_african_am : $('#ethnicity-african-am').val(),
		ethnicity_asian : $('#ethnicity-asian').val(),
		ethnicity_caribbian : $('#ethnicity-caribbian').val(),
		ethnicity_caucasian : $('#ethnicity-caucasian').val(),
		ethnicity_hispanic : $('#ethnicity-hispanic').val(),
		ethnicity_mediterranean : $('#ethnicity-mediterranean').val(),
		ethnicity_middle_est : $('#ethnicity-middle-est').val(),
		ethnicity_american_in : $('#ethnicity-american-in').val(),
		built_any : $('#built-any').val(),
		built_medium : $('#built-medium').val(),
		built_athletic : $('#built-athletic').val(),
		built_bb : $('#built-bb').val(),
		built_xlarge : $('#built-xlarge').val(),
		built_large : $('#built-large').val(),
		built_petite : $('#built-petite').val(),
		built_thin : $('#built-thin').val(),
		built_lm : $('#built-lm').val(),
		hair_any : $('#hair-any').val(),
		hair_auburn : $('#hair-auburn').val(),
		hair_black : $('#hair-black').val(),
		hair_blonde : $('#hair-blonde').val(),
		hair_brown : $('#hair-brown').val(),
		hair_chestnut : $('#hair-chestnut').val(),
		hair_dark_brown : $('#hair-dark-brown').val(),
		hair_grey : $('#hair-grey').val(),
		hair_red : $('#hair-red').val(),
		hair_salt_paper : $('#hair-salt-paper').val(),
		hair_white : $('#hair-white').val()
	};

	// if any is chosen, change all keys to 0 aside from any
	if(data["ethnicity_any"] == 1) {
		for(var key in data) {
		    if(key.startsWith('ethnicity') && key != 'ethnicity_any') {
		    	data[key] = 0;
		    }
		}
	}
	if(data["built_any"] == 1) {
		for(var key in data) {
		    if(key.startsWith('built') && key != 'built_any') {
		    	data[key] = 0;
		    }
		}
	}
	if(data["hair_any"] == 1) {
		for(var key in data) {
		    if(key.startsWith('hair') && key != 'hair_any') {
		    	data[key] = 0;
		    }
		}
	}

	if (self.core.service.form.validate('#create-role-div')) { // for required text fields



		if($('input[type="checkbox"][name="gender"]:checked').length < 1) {
	        $('.gender-error-required').fadeIn().delay(3000).fadeOut();
	        $('.gender-error-required').focus();
		}

		else {

			if(buttonId=="save-and-add-role-btn"){

				$(this).prop('disabled', true);
				$('#loading_role').addClass('fa fa-spin fa-spinner');
			}


			if($('input[type="checkbox"][name="ethnicity"]:checked').length < 1) {
		        data["ethnicity_any"] = 1;
			}

			if($('input[type="checkbox"][name="built"]:checked').length < 1) {
		        data["built_any"] = 1;
			}

			if($('input[type="checkbox"][name="hair-color"]:checked').length < 1) {
		        data["hair_any"] = 1;
			}

			return self.core.resource.job.post(data)
			.then(function(res) {
				$('.role-saved-success').fadeIn();

				if(buttonId == 'save-role-btn') { // link to project overview page
					self.core.resource.project.patch({projectId : self.projectId, status : 0})
						.then(function(res) {
							setTimeout(function(){
								console.log('save-role-btn');
								window.location = '/projects/' + self.projectId + "/roles/" + res.casting_id + "/find-talents";
							}, 3000);
						});

				}

				else { // 'save-and-add-role-btn' just reloads page
					self.core.resource.project.patch({projectId : self.projectId, status : 0})
						.then(function(res) {
							setTimeout(function(){
								location.reload();
							}, 3000);
						});
				}

			});
		}
	}

}

handler.prototype.cancelRole = function(e) {
	if(window.confirm("Are you sure you want to cancel this role?")) {
		return;
	}
	else {
		e.preventDefault();
	}
}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};
