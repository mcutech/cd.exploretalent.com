module.exports = function (core, user, projectId, roleId) {
  let handler = require('../event-handlers/role.edit.js')(core, user, projectId, roleId)

  $('#update-role-btn').on('click', handler.updateRole)

  $('#cancel-role-btn').on('click', handler.cancelRole)

  let age_range_sliders_options = {
    'range': true,
    'min': 0,
    'max': 100,
    'values': [ 0, 100 ]
  }

  $('.ui-slider-age-range').slider(age_range_sliders_options)

  $('.ui-slider-age-range').on('slide', function (event, ui) {
    $('#age-range-min').text(' ' + ui.values[ 0 ])
    $('#age-range-max').text(ui.values[ 1 ])
  })

  let height_range_sliders_options = {
    'range': true,
    'min': 22,
    'max': 96,
    'values': [ 22, 96 ]
  }

  $('.ui-slider-height-range').slider(height_range_sliders_options)

  $('.ui-slider-height-range').on('slide', function (event, ui) {
    let inches1 = ui.values[0]
    let inches2 = ui.values[1]

    if (inches1 == '22' || inches1 == '23') {
      let feet1 = '2'
      inches1 = '0'

      if (inches2 == '22' || inches2 == '23') {
        let feet2 = '2'
        inches2 = '0'
      } else {
        let feet2 = Math.floor(inches2 / 12)
        inches2 %= 12
      }
    } else {
      let feet1 = Math.floor(inches1 / 12)
      let feet2 = Math.floor(inches2 / 12)

      inches1 %= 12
      inches2 %= 12
    }

    if (ui.values[0] == '22' || ui.values[0] == '23') {
      feet1 = '< 2'
    }

    if (ui.values[1] == '22' || ui.values[1] == '23') {
      feet2 = '< 2'
    }

    $('#height-min-span').html(feet1 + '\' ' + inches1 + '"')
    $('#height-max-span').html(feet2 + '\' ' + inches2 + '"')

    if (ui.values[0] == '23') {
      ui.values[0] == '22'
    }
    if (ui.values[1] == '23') {
      ui.values[1] == '22'
    }

    $('#heightinches').val(ui.values[0] + ',' + ui.values[1])
  })

  // uncheck all checkboxes if any is chosen
  $('#ethnicity-any').on('click', function () {
    $('input[name="ethnicity"]:not(".ethnicity-any-checkbox")').attr('checked', 'checked')
    $('input[name="ethnicity"]:not(".ethnicity-any-checkbox")').val(1)
  }, function () {
    $('input[name="ethnicity"]:not(".ethnicity-any-checkbox")').removeAttr('checked')
    $('input[name="ethnicity"]:not(".ethnicity-any-checkbox")').val(0)
  })

  $('#built-any').on('click', function () {
    $('input[name="built"]:not(".built-any-checkbox")').attr('checked', 'checked')
    $('input[name="built"]:not(".built-any-checkbox")').val(1)
  }, function () {
    $('input[name="built"]:not(".built-any-checkbox")').removeAttr('checked')
    $('input[name="built"]:not(".built-any-checkbox")').val(0)
  })

  $('#hair-any').on('click', function () {
    $('input[name="hair-color"]:not(".hair-any-checkbox")').attr('checked', 'checked')
    $('input[name="hair-color"]:not(".hair-any-checkbox")').val(1)
  }, function () {
    $('input[name="hair-color"]:not(".hair-any-checkbox")').removeAttr('checked')
    $('input[name="hair-color"]:not(".hair-any-checkbox")').val(0)
  })

  // uncheck Any checkbox if specific value is checked
  $('input[name="ethnicity"]:not(".ethnicity-any-checkbox")').on('click', function () {
    $('#ethnicity-any').removeAttr('checked')
    $('#ethnicity-any').val(0)
  })

  $('input[name="built"]:not(".built-any-checkbox")').on('click', function () {
    $('#built-any').removeAttr('checked')
    $('#built-any').val('checked')
  })

  $('input[name="hair-color"]:not(".hair-any-checkbox")').on('click', function () {
    $('#hair-any').removeAttr('checked')
    $('#hair-any').val(0)
  })

  // for checkbox values convert to 1 (if checked) and 0 (if not checked)
  $('input[type=\'checkbox\']').change(function () {
    this.value = (Number(this.checked))
  })

  $(document).on('keyup', '#age-min-input', function () {
    $('#age-range-slider').slider('values', 0, $(this).val())
    $('input[name="age_min"]').val($(this).val())
  })

  $(document).on('keyup', '#age-max-input', function () {
    $('#age-range-slider').slider('values', 1, $(this).val())
    $('input[name="age_max"]').val($(this).val())
  })

  $(document).on('change', '#height-min-dropdown', function () {
    $('#height-range-slider').slider('values', 0, $(this).val())
    $('input[name="height_min"]').val($(this).val())
  })

  $(document).on('change', '#height-max-dropdown', function () {
    $('#height-range-slider').slider('values', 1, $(this).val())
    $('input[name="height_max"]').val($(this).val())
  })

  // set date for shoot, audition and expiry of roles
  $('.calendar-input').mask('9999-99-99')

  $('#datepicker-role-expiryDate').datepicker({
    defaultDate: +1,
    dateFormat: 'yy-mm-dd',
    minDate: 0
  })

  $('#datepicker-role-auditionDate').datepicker({
    defaultDate: +1,
    dateFormat: 'yy-mm-dd',
    minDate: 0
  })

  $('#datepicker-role-shootDate').datepicker({
    defaultDate: +1,
    dateFormat: 'yy-mm-dd',
    minDate: 0
  })

  $(document).on('click', '.calendar-btn', function () {
    $(this).siblings('input.calendar-input').datepicker().focus()
  })

  function dontAllowLetters (element) {
    element.keydown(function (e) {
      // Allow: backspace, delete, tab, escape, and enter
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
      // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
      // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return
      }
      // Ensure that it is a number and stop the keypress
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault()
      }
    })
  }

  dontAllowLetters($('#role-number-text'))
}
