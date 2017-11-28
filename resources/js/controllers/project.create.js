module.exports = function (core, user) {
  let handler = require('../event-handlers/project.create.js')(core, user)

  $('#create-project-btn').on('click', handler.createNewProject)

  $('.calendar-input').mask('9999-99-99')

  $('#bs-datepicker-submissiondeadline').datepicker({
    defaultDate: +1,
    dateFormat: 'yy-mm-dd',
    minDate: 0
  })

  $('#bs-datepicker-audition').datepicker({
    dateFormat: 'yy-mm-dd',
    minDate: 0
  })

  $('#bs-datepicker-shootdate').datepicker({
    dateFormat: 'yy-mm-dd',
    minDate: 0
  })

  $('#bs-datepicker-open-call').datepicker({
    dateFormat: 'DD, MM dth',
    minDate: 0
  })

  $('#bs-timepicker-open-call-from').timepicker()
  $('#bs-timepicker-open-call-to').timepicker()

    // let hideElem = document.getElementById("hide-open-call-onload");
  $('#hide-option-2').ready(function () {
    $('#open-call-option-content').hide()
  })

  $('#self-submission-option').on('click', function () {
    $('#self-submissions-option-content').show()
    $('#project-type-title').text('Self Submission Details')
    $('#open-call-option-content').hide()
  })

  $('#open-call-option').on('click', function () {
    $('#open-call-option-content').show()
    $('#project-type-title').text('Open Call Details')
    $('#self-submissions-option-content').hide()
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

  dontAllowLetters($('#project-rate'))
  dontAllowLetters($('#zip-code'))

  $('#find-markets-btn').on('click', handler.autoSelectMarkets)

  $('#toggle-manual-markets-div').on('click', handler.toggleManualMarketsDiv)

  $('#toggle-all-markets-checked').on('click', handler.toggleAllMarketsChecked)

  $(document).on('click', '.calendar-btn', function () {
    $(this).siblings('input.calendar-input').datepicker().focus()
  })

  $(document).on('click', '#nationwide-market-checkbox', function () {
    $(this).toggleClass('checked')

    if ($(this).hasClass('checked')) {
      $('.hide-if-nationwide').addClass('hide')
    } else {
      $('.hide-if-nationwide').removeClass('hide')
    }
  })

  $(document).on('click', '#image-holder', function () {
    $('#photo-uploader').click()
  })

  function readURL (input) {
    let reader = new FileReader()

    reader.onload = function (e) {
      $('#preview').attr('src', e.target.result)
      $('#main-casting-image-div').addClass('uploaded')
    }

    reader.readAsDataURL(input.files[0])
  }

  $('#photo-uploader').change(function () {
    if (this.files && this.files[0]) {
      $('#default-image-preview').hide()
      $('#remove-button').show()

      if (this.files[0].type.indexOf('image') == -1) {
        alert('Invalid Type')
        $('#preview').attr('src', 'blank')
        $('#main-casting-image-div').removeClass('uploaded')
        return false
      }
        // console.log("render");
      readURL(this)
    }
  })

  $(document).on('click', '#remove-button', function () {
    $('#default-image-preview').show()
    $('#remove-button').hide()
    $('#main-casting-image-div').removeClass('uploaded')
    $('#preview').attr('src', 'blank')
    $('#main-casting-image-div').addClass('image-edited')
  })
}
