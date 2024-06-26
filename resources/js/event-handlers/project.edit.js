'use strict'

function handler (core, user, projectId) {
  self = this
  self.core = core
  self.user = user
  self.projectId = projectId

  self.getProjectInfo()
}

handler.prototype.getProjectInfo = function (e) {
  let data = {
    withs: [
      'bam_roles'
    ],
    wheres: [
      [ 'where', 'casting_id', '=', self.projectId ]
    ]
  }

  return self.core.resource.project.get(data)
    .then(function (res) {
      let asap = res.data[0]

      self.casting = asap

      console.log(asap)

      if (new Date().getTime() > asap.asap * 1000) {
        alert('This project has already expired, please update the submission deadline to update this project.')
        console.log(asap.asap)
      }

      if (asap.casting_image && !($('#main-casting-image-div').hasClass('edited-image'))) {
        $('#preview').attr('src', 'https://etdownload.s3.amazonaws.com/' + asap.casting_image.media_path_full)
        $('#main-casting-image-div').addClass('uploaded')
      }

      if (res.total > 0) {
      //
        let casting = res.data[0]

        if (casting.market == 'N/A') {
          // $('input[type="checkbox"][name="manual-market-checkbox"]').prop('checked', 'checked');
          $('#nationwide-market-checkbox').click()
        } else {
          casting.market = casting.market.split('>')
        }

        // convert each market in object to lowercase and strip space and comma, then check checkbox of markets
        _.each(casting.market, function (data) {
          data = data.toLowerCase().replace(/[^a-zA-Z]+/g, '_')
          $('#market_' + data).prop('checked', 'checked')
        })

        casting.date = self.core.service.date

        if (casting.app_date_time) {
          casting.app_date_time = '<p>' + casting.app_date_time + '</p>'
          casting.app_date_time = $(casting.app_date_time).text() // strip tags
        }

        // determines which div to show for Submission details (self-response or open call div)
        if (casting.snr == '2') {
          $('#open-call-option-content').show()
          $('#self-submissions-option-content').hide()
          $('#open-call-option').click()
        } else {
          $('#self-submissions-option-content').show()
          $('#open-call-option-content').hide()
          $('#self-submission-option').click()
        }

        self.core.service.databind('.edit-project-wrapper', casting)
        return $.when()
      }
    })
}

handler.prototype.updateProject = function (e) {
  e.preventDefault()

  function parseDate (inputDate) {
    let timestamp = new Date()
    let revert = -1 * timestamp.getTimezoneOffset() * 60
    inputDate = inputDate.split('-')
    return Date.UTC(inputDate[0], inputDate[1] - 1, inputDate[2]) / 1000 - revert
  }

  let projectname = $('#project-name').val()
  let category = $('#project-category').val()

  let submissiondeadline = $('#bs-datepicker-submissiondeadline').val()
  let asaptimestamp = parseDate(submissiondeadline)

  let dn = new Date()

  let dd = dn.getFullYear() + '-' + (dn.getMonth() + 1) + '-' + dn.getDate()
  let submissiontimestamp = parseDate(dd)

  let rate = $('#project-rate').val()
  let ratedes = $('#project-rate-desc').val()

  let auditiondate = $('#bs-datepicker-audition').val()
  let auditiontimestamp = parseDate(auditiondate)

  let shootdate = $('#bs-datepicker-shootdate').val()
  let shoottimestamp = parseDate(shootdate)

  let union = $('input[type="radio"][name="radioUnion"]:checked').val()
  // let projecttype = $('input[type="radio"][name="radioSubmissionType"]:checked').val();
  let zipcode = $('#zip-code').val()
  let auditiondesc = $('#audition-description').val()

  let promise = $.when()

  // sets checked boxes as market (after Auto Select Markets button is clicked (will check zipcode))
  let markets = []

  // Nationwide Casting
  if ($('#nationwide-market-checkbox').hasClass('checked')) {
    markets = 'N/A'
    zipcode = 'N/A'
  } else if (!$('.auto-markets-div').is(':visible')) { // if auto select markets btn was not clicked (save btn is clicked)
    promise = self.autoSelectMarkets()
      .then(function (res) {
        _.each(res, function (data) {
          markets.push(data.city + ', ' + data.state)
        })

        // if all checkboxes checked, set markets as N/A
        if ($('input[type="checkbox"][name="manual-market-checkbox"]:checked').length == $('input[type="checkbox"][name="manual-market-checkbox"]').length) {
          markets = 'N/A'
        } else {
          // for manually selected markets
          $('input[type="checkbox"][name="manual-market-checkbox"]:checked').next('span').each(function () {
            let text = $(this).text()
            if (markets.indexOf(text) == -1) {
              markets.push($(this).text())
            }
          })

          markets = markets.join('>')
        }

        return $.when()
      })
  } else {
    $('input[type="checkbox"][name="market-checkbox"]:checked').next('span').each(function () {
      markets.push($(this).text())
    })

    // if all checkboxes checked, set markets as N/A
    if ($('input[type="checkbox"][name="manual-market-checkbox"]:checked').length == $('input[type="checkbox"][name="manual-market-checkbox"]').length) {
      markets = 'N/A'
    } else {
      // for manually selected markets
      $('input[type="checkbox"][name="manual-market-checkbox"]:checked').next('span').each(function () {
        let text = $(this).text()
        if (markets.indexOf(text) == -1) {
          markets.push($(this).text())
        }
      })

      markets = markets.join('>')
      // because checkboxes are checked by default, the first hidden div in loop is included.. this will remove it from the value of market sent to data
      while (markets.charAt(0) === '>') { markets = markets.substr(1) }
    }
  }

  promise.then(function () {
    let data = {
      projectId: self.projectId,
      user_id: self.user.bam_cd_user_id,
      name: projectname,
      name_original: projectname,
      project: projectname,
      cat: category,
      last_modified: submissiontimestamp,
      // sub_timestamp : submissiontimestamp,
      asap: asaptimestamp,
      rate: rate,
      rate_des: ratedes,
      status: 0,
      aud_timestamp: auditiontimestamp,
      shoot_timestamp: shoottimestamp,
      union2: union,
      // project_type : projecttype,
      zip: zipcode,
      market: markets,
      location: zipcode,
      des: auditiondesc
    }

    if (projectname.length < 1) {
      $('.project-name-error-required').fadeIn().delay(3000).fadeOut()
      $('#project-name').focus()
    } else if (projectname.length < 5) {
      $('.project-name-error-five').fadeIn().delay(3000).fadeOut()
      $('#project-name').focus()
    } else if (category.length < 1) {
      $('.category-error-required').fadeIn().delay(3000).fadeOut()
      $('#project-category').focus()
    } else if (submissiondeadline.length < 1) {
      $('.submission-deadline-error-required').fadeIn().delay(3000).fadeOut()
      $('#bs-datepicker-submissiondeadline').focus()
      $('.ui-datepicker').hide().delay(3000).fadeIn()
    } else if (auditiontimestamp < asaptimestamp) {
      $('.audition-date-error-invalid').fadeIn().delay(3000).fadeOut()
      $('#bs-datepicker-audition').focus()
      $('.ui-datepicker').hide().delay(3000).fadeIn()
    } else if (shoottimestamp <= auditiontimestamp) {
      $('.shoot-date-error-invalid').fadeIn().delay(3000).fadeOut()
      $('#bs-datepicker-shootdate').focus()
      $('.ui-datepicker').hide().delay(3000).fadeIn()
    } else if (rate.length < 1) {
      $('.rate-error-required').fadeIn().delay(3000).fadeOut()
      $('#project-rate').focus()
    } else if (zipcode.length < 1) {
      $('.zipcode-error-required').fadeIn().delay(3000).fadeOut()
      $('#zip-code').focus()
    } else if (markets.length < 1) {
      $('.markets-error-required').fadeIn().delay(3000).fadeOut()
      $('.auto-markets-div').focus()
    } else if (auditiondesc.length < 1) {
      $('.audition-description-error-required').fadeIn().delay(3000).fadeOut()
      $('#audition-description').focus()
    } else {
      if ($('#self-submissions-option-content').is(':visible')) {
        let selfSubEmail = $('#self-sub-email').val()
        let selfSubAddress = $('#self-sub-address').val()

        if (selfSubEmail.length < 1 && selfSubAddress.length < 1) {
          $('.self-sub-error-required').fadeIn().delay(3000).fadeOut()
          $('#self-sub-email').focus()
        } else {
          data['snr'] = '1'
          data['snr_email'] = selfSubEmail
          // data["address2"] = selfSubAddress;
          data['srn_address'] = selfSubAddress

          return self.core.resource.project.patch(data)
            .then(function (res) {
              if ($('#main-casting-image-div').hasClass('image-edited')) {
                if ($('#main-casting-image-div').hasClass('uploaded')) {
                  self.uploadImage(self.casting.casting_id)
                } else {
                  self.deleteImage(self.casting.casting_image.id)
                }
              }

              $('#update-profile-success-text').fadeIn().delay(3000).fadeOut()
            })
        }
      } else if ($('#open-call-option-content').is(':visible')) {
        if ($('#open-call-details').val().length < 1) {
          $('.open-call-date-error-required').fadeIn().delay(3000).fadeOut()
          $('#open-call-details').focus()
        } else if ($('#open-call-location').val().length < 1) {
          $('.open-call-location-error-required').fadeIn().delay(3000).fadeOut()
          $('#open-call-location').focus()
        } else {
          data['snr'] = '2'
          data['app_date_time'] = $('#open-call-details').val()
          data['app_loc'] = $('#open-call-location').val()

          if ($('#appointment-only-checkbox:checked').length > 0) {
            data['by_app_only'] = '1'
          } else {
            data['by_app_only'] = '0'
          }

          return self.core.resource.project.patch(data)
            .then(function (res) {
              if ($('#main-casting-image-div').hasClass('image-edited')) {
                if ($('#main-casting-image-div').hasClass('uploaded')) {
                  self.uploadImage(self.casting.casting_id)
                } else {
                  self.deleteImage(self.casting.casting_image.id)
                }
              }

              $('#update-profile-success-text').fadeIn().delay(3000).fadeOut()
            })
        }
      }
    }
  })
}

handler.prototype.autoSelectMarkets = function () {
  $('.manual-markets-div div label input:checkbox').attr('checked', false)

  let deferred = $.Deferred()

  let zipcode = $('#zip-code').val()

  if (zipcode.length < 1) {
    $('.zipcode-error-required').fadeIn().delay(3000).fadeOut()
    $('#zip-code').focus()

    deferred.resolve()
  } else {
    let data = {
      zip: zipcode,
      distance: 500
    }

    self.core.resource.market.get(data)
      .then(function (res) {
        if (res.length < 1) {
          $('.zipcode-error-invalid').fadeIn().delay(3000).fadeOut()
          $('#zip-code').focus()
        }

        self.core.service.databind('.auto-markets-div', { data: res })

        deferred.resolve(res)
      })
  }

  return deferred.promise()
}

handler.prototype.toggleManualMarketsDiv = function (e) {
  e.preventDefault()
  $('.manual-markets-div').toggleClass('display-none')

  if ($('.manual-markets-div').hasClass('display-none')) {
    $(this).text('Manually select markets')
    $('#toggle-all-markets-checked').hide()
  } else {
    $(this).text('Hide markets')
    $('#toggle-all-markets-checked').show()
  }
}

handler.prototype.toggleAllMarketsChecked = function (e) {
  e.preventDefault()
  $(this).toggleClass('checked')

  if ($(this).hasClass('checked')) {
    $(this).text('Unselect All Markets')
    $('input[type="checkbox"][name="manual-market-checkbox"]').prop('checked', 'checked')
  } else {
    $(this).text('Select All Markets')
    $('input[type="checkbox"][name="manual-market-checkbox"]').removeAttr('checked')
  }
}

handler.prototype.uploadImage = function (casting_id) {
  let data = new FormData()
  data.append('casting_id', casting_id)
  data.append('file', $('#photo-uploader')[0].files[0])

  $.ajax({
    url: self.core.config.api.base + '/cd/casting_images',
    type: 'POST',
    data: data,
    headers: {
      Authorization: 'Bearer ' + localStorage.getItem('access_token')
    },
    cache: false,
    dataType: 'json',
    processData: false, // Don't process the files
    contentType: false, // Set content type to false as jQuery will tell the server its a query string request,
    crossDomain: true

  })
}

handler.prototype.deleteImage = function (image_id) {
  console.log(image_id)

  $.ajax({
    url: self.core.config.api.base + '/cd/casting_images/' + image_id,
    type: 'DELETE',
    headers: {
      Authorization: 'Bearer ' + localStorage.getItem('access_token')
    },
    cache: false,
    processData: false, // Don't process the files
    contentType: false, // Set content type to false as jQuery will tell the server its a query string request,
    crossDomain: true

  })
}

module.exports = function (core, user, projectId) {
  return new handler(core, user, projectId)
}
