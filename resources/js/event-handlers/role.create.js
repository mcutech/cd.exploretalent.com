'use strict'

function handler (core, user, projectId, roleId) {
  self = this
  self.core = core
  self.user = user
  self.projectId = projectId
  self.getProjectInfo()
  self.asap
}

handler.prototype.getProjectInfo = function (e) {
  let data = {
    projectId: self.projectId,
    query: [
      [ 'with', 'bam_roles' ]
    ]
  }

  self.core.resource.project.get(data)
    .then(function (res) {
      self.project = res

      let markets = _.map(self.project.market.split('>'), function (m) {
        return { name: m }
      })

      self.project.markets = { data: markets }

      self.core.service.databind('#project-details', self.project)
      self.core.service.databind('#project-overview-link', self.project)
    })
    .then(function () {
      let casting_id = self.project.casting_id
      let castingDataId = {
        query: [
          ['where', 'casting_id', casting_id ]
        ]
      }
      self.core.resource.project.get(castingDataId)
        .then(function (res) {
          self.asap = res.data[0].asap
        })
    })
}

handler.prototype.saveNewRole = function (e) {
  e.preventDefault()

  function parseDate (inputDate) {
    let timestamp = new Date()
    let revert = (-1 * timestamp.getTimezoneOffset() * 60)
    inputDate = inputDate.split('-')
    return Date.UTC(inputDate[0], inputDate[1] - 1, inputDate[2]) / 1000 - revert
  }

  let shootDate = $('#datepicker-role-shootDate').val()
  let shootTimestamp = parseDate(shootDate)
  let auditionDate = $('#datepicker-role-auditionDate').val()
  let auditionTimestamp = parseDate(auditionDate)
  let expiryDate = $('#datepicker-role-expiryDate').val()
  let expirationTimestamp = parseDate(expiryDate)
  let expirationValidation = new Date().getTime() / 1000 < expiryDate || !expiryDate

  // to be used later to determine where to link page
  let buttonId = $(this).attr('id')
  // let height = $('#heightinches').val(),
  // height = height.split(",");

  let age_min_val, age_max_val, height_min_val, height_max_val
  if ($('#age-min-input').val() == '<3') {
    age_min_val = 0
  } else {
    age_min_val = $('#age-min-input').val()
  }
  if ($('#age-max-input').val() == '70+') {
    age_max_val = 70
  } else {
    age_max_val = $('#age-max-input').val()
  }

  height_min_val = $('#height-min-dropdown').val()
  height_max_val = $('#height-max-dropdown').val()

  let data = {
    projectId: self.projectId,
    name: $('#role-name-text').val(),
    number_of_people: $('#role-number-text').val(),
    des: $('#role-description-text').val(),
    gender_male: $('#gender-male-checkbox').val(),
    gender_female: $('#gender-female-checkbox').val(),
    // age_min : $('#age-range-min').text(),
    age_min: age_min_val,
    // age_max : $('#age-range-max').text(),
    age_max: age_max_val,
    // height_min : height[0],
    height_min: height_min_val,
    // height_max : height[1],
    height_max: height_max_val,
    ethnicity_any: $('#ethnicity-any').val(),
    ethnicity_african: $('#ethnicity-african').val(),
    ethnicity_african_am: $('#ethnicity-african-am').val(),
    ethnicity_asian: $('#ethnicity-asian').val(),
    ethnicity_caribbian: $('#ethnicity-caribbian').val(),
    ethnicity_caucasian: $('#ethnicity-caucasian').val(),
    ethnicity_hispanic: $('#ethnicity-hispanic').val(),
    ethnicity_mediterranean: $('#ethnicity-mediterranean').val(),
    ethnicity_middle_est: $('#ethnicity-middle-est').val(),
    ethnicity_native_am: $('#ethnicity-american-in').val(),
    built_any: $('#built-any').val(),
    built_medium: $('#built-medium').val(),
    built_athletic: $('#built-athletic').val(),
    built_bb: $('#built-bb').val(),
    built_xlarge: $('#built-xlarge').val(),
    built_large: $('#built-large').val(),
    built_petite: $('#built-petite').val(),
    built_thin: $('#built-thin').val(),
    built_lm: $('#built-lm').val(),
    hair_any: $('#hair-any').val(),
    hair_auburn: $('#hair-auburn').val(),
    hair_black: $('#hair-black').val(),
    hair_blonde: $('#hair-blonde').val(),
    hair_brown: $('#hair-brown').val(),
    hair_chestnut: $('#hair-chestnut').val(),
    hair_dark_brown: $('#hair-dark-brown').val(),
    hair_grey: $('#hair-grey').val(),
    hair_red: $('#hair-red').val(),
    hair_salt_paper: $('#hair-salt-paper').val(),
    hair_white: $('#hair-white').val(),
    shoot_timestamp: shootTimestamp,
    audition_timestamp: auditionTimestamp,
    expiration_timestamp: expirationTimestamp
  }

  if (!data.expiration_timestamp) {
    data.expiration_timestamp = self.asap
  }

  // if any is chosen, change all keys to 0 aside from any
  if (data['ethnicity_any'] == 1) {
    for (let key in data) {
      if (key.startsWith('ethnicity') && key != 'ethnicity_any') {
        data[key] = 0
      }
    }
  }
  if (data['built_any'] == 1) {
    for (let key in data) {
      if (key.startsWith('built') && key != 'built_any') {
        data[key] = 0
      }
    }
  }
  if (data['hair_any'] == 1) {
    for (let key in data) {
      if (key.startsWith('hair') && key != 'hair_any') {
        data[key] = 0
      }
    }
  }

  if (!expiryDate) {
    $('.deadline-error-required').fadeIn().delay(3000).fadeOut()
    // $('#datepicker-role-expiryDate').focus();
    $('.ui-datepicker').hide().delay(3000).fadeIn()
  } else if (auditionTimestamp < expirationTimestamp) {
    $('.audition-date-error-invalid').fadeIn().delay(3000).fadeOut()
    // $('#datepicker-role-auditionDate').focus();
    $('.ui-datepicker').hide().delay(3000).fadeIn()
  } else if (shootTimestamp <= auditionTimestamp) {
    $('.shoot-date-error-invalid').fadeIn().delay(3000).fadeOut()
    // $('#datepicker-role-shootDate').focus();
    $('.ui-datepicker').hide().delay(3000).fadeIn()
  }

  if (!expiryDate) {
    $('.deadline-error-required').fadeIn().delay(3000).fadeOut()
    $('#datepicker-role-expiryDate').focus()
    $('.ui-datepicker').hide().delay(3000).fadeIn()
  } else if (auditionTimestamp < expirationTimestamp) {
    $('.audition-date-error-invalid').fadeIn().delay(3000).fadeOut()
    $('#datepicker-role-auditionDate').focus()
    $('.ui-datepicker').hide().delay(3000).fadeIn()
  } else if (shootTimestamp <= auditionTimestamp) {
    $('.shoot-date-error-invalid').fadeIn().delay(3000).fadeOut()
    $('#datepicker-role-shootDate').focus()
    $('.ui-datepicker').hide().delay(3000).fadeIn()
  }

  // if(expirationValidation){
  if (self.core.service.form.validate('#create-role-div')) { // for required text fields
    if ($('input[type="checkbox"][name="gender"]:checked').length < 1) {
      $('.gender-error-required').fadeIn().delay(3000).fadeOut()
      $('.gender-error-required').focus()
    } else {
      if ($('input[type="checkbox"][name="ethnicity"]:checked').length < 1) {
        data['ethnicity_any'] = 1
      }

      if ($('input[type="checkbox"][name="built"]:checked').length < 1) {
        data['built_any'] = 1
      }

      if ($('input[type="checkbox"][name="hair-color"]:checked').length < 1) {
        data['hair_any'] = 1
      }

      $('#save-and-add-role-btn').attr('disabled', 'disabled')
      $('#save-role-btn').attr('disabled', 'disabled')

      return self.core.resource.job.post(data)
        .then(function (res) {
          let role = res

          $('.role-saved-success').fadeIn()
          if (buttonId == 'save-and-add-role-btn') {
            $('#loading_role').addClass('fa fa-spin fa-spinner')
          }
          if (buttonId == 'save-role-btn') { // link to project overview page
            self.core.resource.project.patch({ projectId: self.projectId, status: 0 })
              .then(function (res) {
                $('#loading_role_match').addClass('fa fa-spin fa-spinner')
                window.location = '/projects/' + self.projectId + '/roles/' + role.role_id + '/find-talents'
              })
          } else { // 'save-and-add-role-btn' just reloads page
            self.core.resource.project.patch({ projectId: self.projectId, status: 0 })
              .then(function (res) {
                setTimeout(function () {
                  location.reload()
                }, 3000)
              })
          }
        })
    }
  }
}

handler.prototype.cancelRole = function (e) {
  if (window.confirm('Are you sure you want to cancel this role?')) {

  } else {
    e.preventDefault()
  }
}

module.exports = function (core, user, projectId) {
  return new handler(core, user, projectId)
}
