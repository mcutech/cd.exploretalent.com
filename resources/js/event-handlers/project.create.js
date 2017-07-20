'use strict';
// var layoutInit = require('./layout.js');

function handler(core, user, talentlogin) {
  self = this;
  self.core = core;
  self.user = user;

    console.log(self.core.resource);

  // email autofill with CD email
  self.core.service.databind('#self-sub-email', self.user);

}

handler.prototype.createNewProject = function(e){

  e.preventDefault();

  function parseDate(inputDate){
    var timestamp = new Date(),
        revert = -1 * timestamp.getTimezoneOffset() * 60;
    inputDate = inputDate.split('-');
    return Date.UTC(inputDate[0], inputDate[1]-1, inputDate[2])/1000 - revert;
  }

  var projectname = $('#project-name').val();
  var category = $('#project-category').val();

  var submissiondeadline = $('#bs-datepicker-submissiondeadline').val();
  var asaptimestamp = parseDate(submissiondeadline);


  var dd = new Date(),
      dn = dd.getFullYear() + '-' + (dd.getMonth() + 1) + '-' + dd.getDate();
  var submissiontimestamp = parseDate(dn);

  var rate = $('#project-rate').val();
  var ratedes = $('#project-rate-desc').val();

  var auditiondate = $('#bs-datepicker-audition').val();
  var auditiontimestamp = parseDate(auditiondate);

  var shootdate = $('#bs-datepicker-shootdate').val();
  var shoottimestamp = parseDate(shootdate);

  var union = $('input[type="radio"][name="radioUnion"]:checked').val();
  var projecttype = $('input[type="radio"][name="radioSubmissionType"]:checked').val();
  var zipcode = $('#zip-code').val();
  var auditiondesc = $('#audition-description').val();

  var promise = $.when();

  // sets checked boxes as market (after Auto Select Markets button is clicked (will check zipcode))
  var markets = [];

  // Nationwide Casting
  if($('#nationwide-market-checkbox').hasClass('checked')) {
    markets = 'N/A';
    zipcode = 'N/A';
  }

  else if(!$('.auto-markets-div').is(':visible')) { // if auto select markets btn was not clicked (save btn is clicked)

    promise = self.autoSelectMarkets()
      .then(function(res) {

        _.each(res, function(data) {

          markets.push(data.city + ", " + data.state);

        });

        // if all checkboxes checked, set markets as N/A
        if($('input[type="checkbox"][name="manual-market-checkbox"]:checked').length == $('input[type="checkbox"][name="manual-market-checkbox"]').length) {
          markets = 'N/A';
        }
        else {
          // for manually selected markets
          $('input[type="checkbox"][name="manual-market-checkbox"]:checked').next('span').each(function() {

            var text = $(this).text();
            if(markets.indexOf(text) == -1) {
              markets.push($(this).text());
            }

          });

          markets = markets.join('>');
        }

        return $.when();
      });

  }

  else {

    $('input[type="checkbox"][name="market-checkbox"]:checked').next('span').each(function() {
      markets.push($(this).text());
    });

    // if all checkboxes checked, set markets as N/A
    if($('input[type="checkbox"][name="manual-market-checkbox"]:checked').length == $('input[type="checkbox"][name="manual-market-checkbox"]').length) {
      markets = 'N/A';
    }
    else {
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

  }

  promise.then(function() {

    var submissiondeadline = $('#bs-datepicker-submissiondeadline').val();

    var data = {
      user_id : self.user.bam_cd_user_id,
      name : projectname,
      name_original : projectname,
      project : projectname,
      cat : category,
      date_created : submissiontimestamp,
      last_modified : submissiontimestamp,
      sub_timestamp : submissiontimestamp,
      asap : asaptimestamp,
      rate : rate,
      rate_des: ratedes,
      aud_timestamp: auditiontimestamp,
      shoot_timestamp: shoottimestamp,
      union2: union,
      project_type : projecttype,
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
      $('.ui-datepicker').hide().delay(3000).fadeIn();
    }

    else if(auditiontimestamp < asaptimestamp) {
      $('.audition-date-error-invalid').fadeIn().delay(3000).fadeOut();
      $('#bs-datepicker-audition').focus();
      $('.ui-datepicker').hide().delay(3000).fadeIn();
    }

    else if(shoottimestamp <= auditiontimestamp) {
      $('.shoot-date-error-invalid').fadeIn().delay(3000).fadeOut();
      $('#bs-datepicker-shootdate').focus();
      $('.ui-datepicker').hide().delay(3000).fadeIn();
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
      if(projecttype == "1") {

        var selfSubEmail = $('#self-sub-email').val();
        var selfSubAddress = $('#self-sub-address').val();

        if(selfSubEmail.length < 1 && selfSubAddress.length < 1) {
          $('.self-sub-error-required').fadeIn().delay(3000).fadeOut();
          $('#self-sub-email').focus();
        }

        else {
          data["snr"] = '1';
          data["snr_email"] = selfSubEmail;
          // data["address2"] = selfSubAddress;
          data["srn_address"] = selfSubAddress;

          return self.core.resource.project.post(data)
            .then(function(res) {
              console.log(res);
				$('#create-project-btn').attr('disabled', 'disabled');
              window.location = "/projects/"+res.casting_id+"/roles/create";
            });
        }

      }

      else if(projecttype == "2") {

        if($('#bs-datepicker-open-call').val().length < 1) {

          $('.open-call-date-error-required').fadeIn().delay(3000).fadeOut();
          $('#bs-datepicker-open-call').focus();
          $('.ui-datepicker').hide().delay(3000).fadeIn();
        }

        else if($('#open-call-location').val().length < 1) {

          $('.open-call-location-error-required').fadeIn().delay(3000).fadeOut();
          $('#open-call-location').focus();
        }

        else {
          data["snr"] = '2';
          data["app_date_time"] = $('#bs-datepicker-open-call').val() + " from " + $('#bs-timepicker-open-call-from').val() + " to " + $('#bs-timepicker-open-call-to').val();
          data["app_loc"] = $('#open-call-location').val();

          if($('#appointment-only-checkbox:checked').length > 0) {
            data["by_app_only"] = '1';
          }
          else {
            data["by_app_only"] = '0';
          }

          return self.core.resource.project.post(data)
            .then(function(res) {
              console.log(res);
				$('#create-project-btn').attr('disabled', 'disabled');
              window.location = "/projects/"+res.casting_id;
            });
        }

<<<<<<< HEAD
      }
    }
  });
=======
				_.each(res, function(data) {

					markets.push(data.city + ", " + data.state);

				});

				// if all checkboxes checked, set markets as N/A
				if($('input[type="checkbox"][name="manual-market-checkbox"]:checked').length == $('input[type="checkbox"][name="manual-market-checkbox"]').length) {
					markets = 'N/A';
				}
				else {
					// for manually selected markets
					$('input[type="checkbox"][name="manual-market-checkbox"]:checked').next('span').each(function() {

						var text = $(this).text();
						if(markets.indexOf(text) == -1) {
							markets.push($(this).text());
						}

					});

					markets = markets.join('>');
				}

				return $.when();
			});

	}

	else {

		$('input[type="checkbox"][name="market-checkbox"]:checked').next('span').each(function() {
			markets.push($(this).text());
		});

		// if all checkboxes checked, set markets as N/A
		if($('input[type="checkbox"][name="manual-market-checkbox"]:checked').length == $('input[type="checkbox"][name="manual-market-checkbox"]').length) {
			markets = 'N/A';
		}
		else {
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

	}

	promise.then(function() {

		var submissiondeadline = $('#bs-datepicker-submissiondeadline').val();

		var data = {
			user_id : self.user.bam_cd_user_id,
			name : projectname,
			name_original : projectname,
			project : projectname,
			cat : category,
			date_created : submissiontimestamp,
			last_modified : submissiontimestamp,
			sub_timestamp : submissiontimestamp,
			asap : asaptimestamp,
			rate : rate,
			rate_des: ratedes,
			aud_timestamp: auditiontimestamp,
			shoot_timestamp: shoottimestamp,
			union2: union,
			project_type : projecttype,
			zip : zipcode,
			market: markets,
			location : zipcode,
			des: auditiondesc
			// app_id : 1

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
			$('.ui-datepicker').hide().delay(3000).fadeIn();
		}

		else if(auditiontimestamp < asaptimestamp) {
			$('.audition-date-error-invalid').fadeIn().delay(3000).fadeOut();
			$('#bs-datepicker-audition').focus();
			$('.ui-datepicker').hide().delay(3000).fadeIn();
		}

		else if(shoottimestamp <= auditiontimestamp) {
			$('.shoot-date-error-invalid').fadeIn().delay(3000).fadeOut();
			$('#bs-datepicker-shootdate').focus();
			$('.ui-datepicker').hide().delay(3000).fadeIn();
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



			if(projecttype == "1") {

				var selfSubEmail = $('#self-sub-email').val();
				var selfSubAddress = $('#self-sub-address').val();

				if(selfSubEmail.length < 1 && selfSubAddress.length < 1) {
					$('.self-sub-error-required').fadeIn().delay(3000).fadeOut();
					$('#self-sub-email').focus();
				}

				else {
					data["snr"] = '1';
					data["snr_email"] = selfSubEmail;
					// data["address2"] = selfSubAddress;
					data["srn_address"] = selfSubAddress;

                    var body1 = {};
                    var body2 = {};

                    body1.app_id = 1;
                    body2.app_id = 4;

                    return self.core.resource.project.post(data)
						.then(function(res) {

                            body1.casting_id = res.casting_id;
                            body2.casting_id = res.casting_id;

                            if($('#main-casting-image-div').addClass('uploaded')){
								self.uploadImage(res.casting_id);
								// self.loadImage(res.casting_id);
							}		

                            self.core.resource.project_app.post(body1).then(function(res) {
                                console.log('result from ET post');
                                console.log(res);
                            });
                            self.core.resource.project_app.post(body2).then(function(res) {
                                console.log('result from AU psot');
                                console.log(res);
                            });
						});
				}

			}

			else if(projecttype == "2") {

				if($('#bs-datepicker-open-call').val().length < 1) {

					$('.open-call-date-error-required').fadeIn().delay(3000).fadeOut();
					$('#bs-datepicker-open-call').focus();
					$('.ui-datepicker').hide().delay(3000).fadeIn();
				}

				else if($('#open-call-location').val().length < 1) {

					$('.open-call-location-error-required').fadeIn().delay(3000).fadeOut();
					$('#open-call-location').focus();
				}

				else {
					data["snr"] = '2';
					data["app_date_time"] = $('#bs-datepicker-open-call').val() + " from " + $('#bs-timepicker-open-call-from').val() + " to " + $('#bs-timepicker-open-call-to').val();
					data["app_loc"] = $('#open-call-location').val();

					if($('#appointment-only-checkbox:checked').length > 0) {
						data["by_app_only"] = '1';
					}
					else {
						data["by_app_only"] = '0';
					}

                    var body1 = {};
                    var body2 = {};

                    body1.app_id = 1;
                    body2.app_id = 4;

					return self.core.resource.project.post(data)
						.then(function(res) {
                            body1.casting_id = res.casting_id;
                            body2.casting_id = res.casting_id;
							if($('#main-casting-image-div').addClass('uploaded')){
								self.uploadImage(res.casting_id);
							}

                            self.core.resource.project_app.post(body1).then(function(res) {
                                console.log('results from ET post');
                                console.log(res);
                            });
                            self.core.resource.project_app.post(body2).then(function(res) {
                                console.log('results from AU post');
                                console.log(res);
                            });
						});
				}

			}
		}
	});
>>>>>>> origin

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
    $('#toggle-all-markets-checked').hide();
  }
  else {
    $(this).text("Hide markets");
    $('#toggle-all-markets-checked').show();
  }

}

handler.prototype.toggleAllMarketsChecked = function(e) {

  e.preventDefault();
  $(this).toggleClass('checked');

  if($(this).hasClass('checked')) {
    $(this).text("Unselect All Markets");
    $('input[type="checkbox"][name="manual-market-checkbox"]').prop('checked', 'checked');
  }
  else {
    $(this).text("Select All Markets");
    $('input[type="checkbox"][name="manual-market-checkbox"]').removeAttr('checked');
  }

}

handler.prototype.uploadImage = function(casting_id) {
 
    var data = new FormData();
    data.append('casting_id', casting_id);
    data.append('file', $('#photo-uploader')[0].files[0]);


    $.ajax({
      url: self.core.config.api.base + '/cd/casting_images',
      type: 'POST',
      data: data,
      headers : {
        Authorization : 'Bearer ' + localStorage.getItem('access_token')
      },
      cache: false,
      dataType: 'json',
      processData: false, // Don't process the files
      contentType: false, // Set content type to false as jQuery will tell the server its a query string request,
      crossDomain: true

    });

}

module.exports = function(core, user, talentlogin) {
  return new handler(core, user, talentlogin);
};
