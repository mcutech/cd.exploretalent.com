'use strict';

function handler(core, user, projectId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;

	self.getProjectInfo();

	// setTimeout(function(){
	// 	self.autoSelectMarkets();
	// }, 1000);
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
			console.log(res);
			if (res.total > 0) {
				var casting = res.data[0];

				casting.market = casting.market.split(">");

				// convert each market in object to lowercase and strip space and comma, then check checkbox of markets
				_.each(casting.market, function(data){
					data = data.toLowerCase().replace(/[^a-zA-Z]+/g, "_");
					$('#market_'+data).prop('checked', 'checked');
				});

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
		submissiondeadline = submissiondeadline.split("-");
	var asaptimestamp = Date.UTC(submissiondeadline[0],submissiondeadline[1]-1,submissiondeadline[2]) / 1000;
		asaptimestamp = asaptimestamp + 28800;

	var submissiontimestamp = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()) / 1000;
	var rate = $('#project-rate').val();
	var ratedes = $('#project-rate-desc').val();

	var auditiondate = $('#bs-datepicker-audition').val();
		auditiondate = auditiondate.split("-");
	var auditiontimestamp = Date.UTC(auditiondate[0],auditiondate[1]-1,auditiondate[2]) / 1000;
		auditiontimestamp = auditiontimestamp + 28800;

	var shootdate = $('#bs-datepicker-shootdate').val();
		shootdate = shootdate.split("-");
	var shoottimestamp = Date.UTC(shootdate[0],shootdate[1]-1,shootdate[2]) / 1000;
		shoottimestamp = shoottimestamp + 28800;

	var union = $('input[type="radio"][name="radioUnion"]:checked').val();
	// var projecttype = $('input[type="radio"][name="radioSubmissionType"]:checked').val();
	var zipcode = $('#zip-code').val();
	var auditiondesc = $('#audition-description').val();

	var promise = $.when();

	// sets checked boxes as market (after Auto Select Markets button is clicked (will check zipcode))
	var markets = [];

	if(!$('.auto-markets-div').is(':visible')) { // if auto select markets btn was not clicked (save btn is clicked)

		promise = self.autoSelectMarkets()
		.then(function(res) {

			_.each(res, function(data) {

				markets.push(data.city + ", " + data.state);

			});

			// for manually selected markets
			$('input[type="checkbox"][name="manual-market-checkbox"]:checked').next('span').each(function() {

				var text = $(this).text();
				if(markets.indexOf(text) == -1) {
					markets.push($(this).text());
				}

			});

			markets = markets.join('>');

			return $.when();
		});

	}

	else {

		$('input[type="checkbox"][name="market-checkbox"]:checked').next('span').each(function() {
			markets.push($(this).text());
		});

		// for manually selected markets
		$('input[type="checkbox"][name="manual-market-checkbox"]:checked').next('span').each(function() {

			var text = $(this).text();
			if(markets.indexOf(text) == -1) {
				markets.push($(this).text());
			}

		});

		markets = markets.join('>');
		// because checkboxes are checked by default, the first hidden div in loop is included.. this will remove it from the value of market sent to data
		while(markets.charAt(0) === '>')
	    markets = markets.substr(1);

	}

	promise.then(function() {

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
			aud_timestamp: auditiontimestamp,
			shoot_timestamp: shoottimestamp,
			union2: union,
			// project_type : projecttype,
			zip : zipcode,
			market: markets,
			location : zipcode,
			des: auditiondesc,
		};

		if(projectname.length < 1) {
			$('.project-name-error-required').fadeIn().delay(3000).fadeOut();
			$('#project-name').focus();
		}

		else if(projectname.length < 5) {
			$('.project-name-error-five').fadeIn().delay(3000).fadeOut();
			$('#project-name').focus();
		}

		else if(category.length < 1) {
			$('.category-error-required').fadeIn().delay(3000).fadeOut();
			$('#project-category').focus();
		}

		else if(submissiondeadline.length < 1) {
			$('.submission-deadline-error-required').fadeIn().delay(3000).fadeOut();
			$('#bs-datepicker-submissiondeadline').focus();
			$('.ui-datepicker').hide().delay(3000).fadeIn();;
		}

		else if(rate.length < 1) {
			$('.rate-error-required').fadeIn().delay(3000).fadeOut();
			$('#project-rate').focus();
		}

		else if(zipcode.length < 1) {
			$('.zipcode-error-required').fadeIn().delay(3000).fadeOut();
			$('#zip-code').focus();
		}

		else if(markets.length < 1) {
			$('.markets-error-required').fadeIn().delay(3000).fadeOut();
			$('.auto-markets-div').focus();
		}

		else if(auditiondesc.length < 1) {
			$('.audition-description-error-required').fadeIn().delay(3000).fadeOut();
			$('#audition-description').focus();
		}

		else {
			if($('#self-submissions-option-content').is(':visible')) {

				var selfSubEmail = $('#self-sub-email').val();
				var selfSubAddress = $('#self-sub-address').val();

				if(selfSubEmail.length < 1 && selfSubAddress.length < 1) {
					$('.self-sub-error-required').fadeIn().delay(3000).fadeOut();
					$('#self-sub-email').focus();
				}

				else {
					data["snr_email"] = selfSubEmail;
					data["address2"] = selfSubAddress;
					data["srn_address"] = selfSubAddress;

					return self.core.resource.project.patch(data)
					.then(function(res) {

						$('#update-profile-success-text').fadeIn().delay(3000).fadeOut();

					});
				}

			}

			else if($('#open-call-option-content').is(':visible')) {

				if($('#open-call-details').val().length < 1) {

					$('.open-call-date-error-required').fadeIn().delay(3000).fadeOut();
					$('#open-call-details').focus();

				}

				else if($('#open-call-location').val().length < 1) {

					$('.open-call-location-error-required').fadeIn().delay(3000).fadeOut();
					$('#open-call-location').focus();

				}

				else {
					data["app_date_time"] = '<p>' + $('#open-call-details').val() + '</p>';
					data["app_loc"] = $('#open-call-location').val();

					return self.core.resource.project.patch(data)
					.then(function(res) {

						$('#update-profile-success-text').fadeIn().delay(3000).fadeOut();

					});
				}
			}
		}
	});
}

handler.prototype.autoSelectMarkets = function(){

	var deferred = $.Deferred();

	var zipcode = $('#zip-code').val();

	if(zipcode.length < 1) {
		$('.zipcode-error-required').fadeIn().delay(3000).fadeOut();
		$('#zip-code').focus();

		deferred.resolve();
	}

	else {

		var data = {
			zip : zipcode,
			distance: 500,
		}

		self.core.resource.market.get(data)
		.then(function(res) {

			if(res.length < 1) {

				$('.zipcode-error-invalid').fadeIn().delay(3000).fadeOut();
				$('#zip-code').focus();

			}

			self.core.service.databind('.auto-markets-div', { data : res });

			deferred.resolve(res);

		});

	}

	return deferred.promise();

}

handler.prototype.toggleManualMarketsDiv = function(e) {

	e.preventDefault();
	$('.manual-markets-div').toggleClass('display-none');

	if($('.manual-markets-div').hasClass('display-none')) {
		$(this).text("Manually select markets");
	}
	else {
		$(this).text("Hide markets");
	}

}

module.exports = function(core, user, projectId) {
	return new handler(core, user, projectId);
};
