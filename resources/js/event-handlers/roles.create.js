'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	self.getProjectInfo();

}

handler.prototype.getProjectInfo = function(e) {

	$('#role-name-text').focus();

	var data = {
		withs : [
			'bam_roles'
		],
		wheres : [
			[ 'where', 'casting_id', '=', self.projectId ]
		]
	};

	return self.core.resource.project.get(data)
		.then(function(res) {
			if (res.total > 0) {
				var casting = res.data[0];

				console.log(casting);

				casting.date = self.core.service.date;

				if(casting.rate_des == '1') {
					casting.rate_des = 'event'; 
				}
				else if(casting.rate_des == '2') {
					casting.rate_des = 'hour'; 
				}
				else if(casting.rate_des == '3') {
					casting.rate_des = 'day'; 
				}
				else if(casting.rate_des == '4') {
					casting.rate_des = 'week'; 
				}
				else if(casting.rate_des == '5') {
					casting.rate_des = 'month'; 
				}
				else {
					casting.rate_des = 0;
				}

				self.core.service.databind('.project-details-div', casting)
				return $.when();
			}
		});
}

handler.prototype.saveNewRole = function() {

	var height = $('#heightinches').val(),
		height = height.split(",");

	var data = {
		projectId : self.projectId,
		name : $('#role-name-text').val(),
		number_of_people : $('#role-number-text').val(),
		des : $('#role-description-text').val(),
		gender_male : $('#gender-male-checkbox').val(),
		gender_female : $('#gender-female-checkbox').val(),
		age_min : $('#age-range-min').text(),
		age_max : $('#age-range-max').text(),
		height_min : height[0],
		height_max : height[1],
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

	if (self.core.service.form.validate('#create-role-div')) { // for required text fields

		if($('input[type="checkbox"][name="gender"]:checked').length < 1) {
	        $('.gender-error-required').fadeIn().delay(3000).fadeOut();
	        $('.gender-error-required').focus();
		}

		else if($('input[type="checkbox"][name="ethnicity"]:checked').length < 1) {
	        $('.ethnicity-error-required').fadeIn().delay(3000).fadeOut();
	        $('.ethnicity-error-required').focus();
		}

		else if($('input[type="checkbox"][name="built"]:checked').length < 1) {
	        $('.built-error-required').fadeIn().delay(3000).fadeOut();
	        $('.built-error-required').focus();
		}

		else if($('input[type="checkbox"][name="hair-color"]:checked').length < 1) {
	        $('.hair-color-error-required').fadeIn().delay(3000).fadeOut();
	        $('.hair-color-error-required').focus();
		}

		else {
			return self.core.resource.job.post(data)
			.then(function(res) {
				console.log(res);
				$('.role-saved-success').fadeIn();

				setTimeout(function(){
					location.reload();
				}, 3000);

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