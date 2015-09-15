'use strict';
// var layoutInit = require('./layout.js');

function handler(core, user, talentlogin) {
	self = this;
	self.core = core;
	self.user = user;

	console.log(self.user);
}

handler.prototype.createNewProject = function(e){

	e.preventDefault();

	var projectname = $('#project-name').val();
	var category = $('#project-category').val();
	var submissiondeadline = $('#bs-datepicker-submissiondeadline').val();
	var submissiontimestamp = new Date(submissiondeadline).getTime() / 1000;
	var rate = $('#project-rate').val();
	var auditiondate = $('#bs-datepicker-audition').val();
	var auditiontimestamp = new Date(auditiondate).getTime() / 1000;
	var shootdate = $('#bs-datepicker-shootdate').val();
	var shoottimestamp = new Date(shootdate).getTime() / 1000;
	var union = $('input[type="radio"][name="radioUnion"]:checked').val();
	var projecttype = $('input[type="radio"][name="radioSubmissionType"]:checked').val();
	var zipcode = $('#zip-code').val();
	var auditiondesc = $('#audition-description').val();

	var data = {
		user_id : self.user.bam_cd_user_id,
		name : projectname,
		name_original : projectname,
		project : projectname,
		cat : category,
		sub_timestamp : submissiontimestamp,
		rate : rate,
		aud_timestamp: auditiontimestamp,
		shoot_timestamp: shoottimestamp,
		union2: union,
		project_type : projecttype,
		zip : zipcode
	};

	if(projectname.length < 1) {
		$('.project-name-error-required').fadeIn();
		$('#project-name').focus();

		setTimeout(function(){
			$('.project-name-error-required').fadeOut();
		}, 3000);
	}

	else if(projectname.length < 5) {
		$('.project-name-error-five').fadeIn();
		$('#project-name').focus();

		setTimeout(function(){
			$('.project-name-error-five').fadeOut();
		}, 3000);
	}

	else if(category.length < 1) {
		$('.category-error-required').fadeIn();
		$('#project-category').focus();

		setTimeout(function(){
			$('.category-error-required').fadeOut();
		}, 3000);
	}

	else if(submissiondeadline.length < 1) {
		$('.submission-deadline-error-required').fadeIn();
		$('#bs-datepicker-submissiondeadline').focus();
		$('.ui-datepicker').hide();

		setTimeout(function(){
			$('.submission-deadline-error-required').fadeOut();
			$('.ui-datepicker').fadeIn();
		}, 1500);
	}

	else if(rate.length < 1) {
		$('.rate-error-required').fadeIn();
		$('#project-rate').focus();

		setTimeout(function(){
			$('.rate-error-required').fadeOut();
		}, 3000);
	}

	else if(zipcode.length < 1) {
		$('.zipcode-error-required').fadeIn();
		$('#zip-code').focus();

		setTimeout(function(){
			$('.zipcode-error-required').fadeOut();
		}, 3000);
	}

	else if(auditiondesc.length < 1) {
		$('.audition-description-error-required').fadeIn();
		$('#audition-description').focus();

		setTimeout(function(){
			$('.audition-description-error-required').fadeOut();
		}, 3000);
	}

	else {
		if(projecttype == "3") {

			data["snr_email"] = $('#self-sub-email').val();

			if($('#self-sub-address').val().length < 1) {
				$('.self-sub-error-required').fadeIn();
				$('#self-sub-address').focus();

				setTimeout(function(){
					$('.self-sub-error-required').fadeOut();
				}, 3000);
			}

			else {
				data["address2"] = $('#self-sub-address').val();
				
				return self.core.resource.project.post(data)
				.then(function(res) {
					console.log(res);
				});
			}

		}

		else if(projecttype == "8") {

			if($('#bs-datepicker-open-call').val().length < 1) {

				$('.open-call-date-error-required').fadeIn();
				$('#bs-datepicker-open-call').focus();
				$('.ui-datepicker').hide();

				setTimeout(function(){
					$('.open-call-date-error-required').fadeOut();
					$('.ui-datepicker').fadeIn();
				}, 1500);
			}

			else if($('#open-call-location').val().length < 1) {

				$('.open-call-location-error-required').fadeIn();
				$('#open-call-location').focus();

				setTimeout(function(){
					$('.open-call-location-error-required').fadeOut();
				}, 3000);
			}
			
			else {
				data["app_date_time"] = '<p>' + $('#bs-datepicker-open-call').val() + " from " + $('#bs-timepicker-open-call-from').val() + " to " + $('#bs-timepicker-open-call-to').val() + '</p>';
				data["app_loc"] = $('#open-call-location').val();

				return self.core.resource.project.post(data)
				.then(function(res) {
					console.log(res);
				});
			}

		}
	}
}

module.exports = function(core, user, talentlogin) {
	return new handler(core, user, talentlogin);
};