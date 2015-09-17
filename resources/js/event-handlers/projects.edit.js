'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	self.getProjectInfo();

	setTimeout(function(){
		self.autoSelectMarkets();
	}, 1000);
}

handler.prototype.getProjectInfo = function(e) {

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

				if(casting.app_date_time) {
					casting.app_date_time = $(casting.app_date_time).text();
				}

				// determines which div to show for Submission details (self-response or open call div)
				if(casting.project_type == "8") {
					$("#open-call-option-content").show();
        			$("#self-submissions-option-content").hide();
				}
				else {
					$("#self-submissions-option-content").show();
        			$("#open-call-option-content").hide();
				}

				self.core.service.databind('.edit-project-wrapper', casting)
				return $.when();
			}
		});
}

handler.prototype.updateProject = function(e){

	e.preventDefault();

	var projectname = $('#project-name').val();
	var category = $('#project-category').val();
	var submissiondeadline = $('#bs-datepicker-submissiondeadline').val();
	var asaptimestamp = Math.floor((new Date(submissiondeadline)).getTime() / 1000);
	var submissiontimestamp = Math.floor((new Date()).getTime() / 1000);
	var rate = $('#project-rate').val();
	var ratedes = $('#project-rate-desc').val();
	var auditiondate = $('#bs-datepicker-audition').val();
	var auditiontimestamp = Math.floor((new Date(auditiondate)).getTime() / 1000);
	var shootdate = $('#bs-datepicker-shootdate').val();
	var shoottimestamp = Math.floor((new Date(shootdate)).getTime() / 1000);
	var union = $('input[type="radio"][name="radioUnion"]:checked').val();
	// var projecttype = $('input[type="radio"][name="radioSubmissionType"]:checked').val();
	var zipcode = $('#zip-code').val();
	var auditiondesc = $('#audition-description').val();

	// sets checked boxes as market (after Auto Select Markets button is clicked (will check zipcode))
	var markets = [];

	$('input[type="checkbox"][name="market-checkbox"]:checked').next('span').each(function() {
		markets.push($(this).text());
	});

	var markets = markets.join('>');
		// because checkboxes are checked by default, the first hidden div in loop is included.. this will remove it from the value of market sent to data
		while(markets.charAt(0) === '>')
	    markets = markets.substr(1);

	var data = {
		projectId : self.projectId,
		user_id : self.user.bam_cd_user_id,
		name : projectname,
		name_original : projectname,
		project : projectname,
		cat : category,
		sub_timestamp : submissiontimestamp,
		asap : asaptimestamp,
		rate : rate,
		rate_des: ratedes,
		aud_timestamp : auditiontimestamp,
		shoot_timestamp : shoottimestamp,
		union2 : union,
		// project_type : projecttype,
		zip : zipcode,
		market: markets,
		location : zipcode,
		des: auditiondesc,
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

	else if(markets.length < 1) {
		$('.markets-error-required').fadeIn();
		$('.auto-markets-div').focus();

		setTimeout(function(){
			$('.markets-error-required').fadeOut();
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
		if($('#self-submissions-option-content').is(':visible')) {

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
				data["srn_address"] = $('#self-sub-address').val();
				
				return self.core.resource.project.patch(data)
				.then(function(res) {

					console.log(res);

					$('#update-profile-success-text').fadeIn();

					setTimeout(function() {
						$('#update-profile-success-text').fadeOut();
					}, 3000);

				});
			}

		}

		else if($('#open-call-option-content').is(':visible')) {

			if($('#open-call-details').val().length < 1) {

				$('.open-call-date-error-required').fadeIn();
				$('#open-call-details').focus();

				setTimeout(function(){
					$('.open-call-date-error-required').fadeOut();
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
				data["app_date_time"] = '<p>' + $('#open-call-details').val() + '</p>';
				data["app_loc"] = $('#open-call-location').val();

				return self.core.resource.project.patch(data)
				.then(function(res) {

					console.log(res);
					$('#update-profile-success-text').fadeIn();

					setTimeout(function() {
						$('#update-profile-success-text').fadeOut();
					}, 3000);

				});
			}

		}
	}
}

handler.prototype.autoSelectMarkets = function(){
	
	var zipcode = $('#zip-code').val();

	if(zipcode.length < 1) {
		$('.zipcode-error-required').fadeIn();
		$('#zip-code').focus();

		setTimeout(function(){
			$('.zipcode-error-required').fadeOut();
		}, 3000);
	}

	else {

		var data = {
			zip : zipcode,
			distance: 500,
		}

		return self.core.resource.market.get(data)
		.then(function(res) {

			if(res.length < 1) {

				$('.zipcode-error-invalid').fadeIn();
				$('#zip-code').focus();

				setTimeout(function(){
					$('.zipcode-error-invalid').fadeOut();
				}, 3000);

			}

			self.core.service.databind('.auto-markets-div', { data : res });

		});

	}

}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};