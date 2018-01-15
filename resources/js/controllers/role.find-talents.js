module.exports = function (core, user, projectId, roleId) {
  let handler = require('../event-handlers/role.find-talents.js')(core, user, projectId, roleId)

  setTimeout(function(){
    $('#search-by-location').click()
  }, 500)

  $('#hasphotoForm').click(function () {
    if ($('#has-photo').is(':checked')) {
      $('#radio-selected').text('Yes')
    } else {
      $('#radio-selected').text('Any')
    }
  })

  $('#genderForm :checkbox').change(function () {
    if ($(this).is(':checked')) {
      if ($('#checkboxFemale').is(':checked')) {
        $('#selected').text($(this).val())
      } else if ($('#checkboxMale').is(':checked')) {
        $('#selected').text($(this).val())
      }
      if ($('#checkboxMale').is(':checked') && $('#checkboxFemale').is(':checked')) {
        $('#selected').text('Any')
      }
    } else {
      if ($('#checkboxFemale').is(':checked')) {
        $('#selected').text('Female')
      } else if ($('#checkboxMale').is(':checked')) {
        $('#selected').text('Male')
      }
      if (!$('#checkboxMale').is(':checked') && !$('#checkboxFemale').is(':checked')) {
        $('#selected').text('Any')
      }
    }
  })

  // $('#roles-list').on('change', handler.refreshRole);

  $(document).on('change', '#roles-list', function (e) {
    e.preventDefault()

    handler.refreshRole()
  })

  $('#search-button').on('click', handler.findMatches)
  $('#add-all-button').on('click', handler.addAll)

  $('#place-miles').slider('value', $('#place-miles-in').val())

  $('#place-miles').on('slide', function (e, ui) {
    $('#place-miles-in').val(ui.value)
  })

  // refine search toggle location search
  $(document).on('click', '#location-search-change-btn', function (e) {
    e.preventDefault()
    $('#location-search-display').show()
    $('#location-search-change').hide()
  })
  $(document).on('click', '#location-search-display-btn', function (e) {
    e.preventDefault()
    $('#location-search-display').hide()
    $('#location-search-change').show()
  })

  $(document).on('click', '#toggle-advanced-filters-btn', function (e) {
    e.preventDefault()
    $('#advanced-filters-div').slideToggle()
  })

  $(document).on('mouseover', '.talent-function-icon.profile', function () {
    $('.text-function-label.profile').css('opacity', '1')
  })

  $(document).on('mouseover', '.talent-function-icon.photos', function () {
    $('.text-function-label.photos').css('opacity', '1')
  })

  $(document).on('mouseover', '.talent-function-icon.notes', function () {
    $('.text-function-label.notes').css('opacity', '1')
  })

  $(document).on('mouseover', '.talent-function-icon.favorites', function () {
    $('.text-function-label.favorites').css('opacity', '1')
  })

  $(document).on('mouseover', '.talent-function-icon.add-role', function () {
    $('.text-function-label.add-role').css('opacity', '1')
  })

  $(document).on('mouseleave', '.talent-function-icon', function () {
    $('.text-function-label').css('opacity', '0')
  })

  // add notes function back
  $(document).on('click', '.talent-note-v2 .back-btn', function () {
    $(this).closest('.talent-item').find('.talent-note-v2').hide()
    $(this).closest('.talent-item').find('.talent-photo-v2').show()
    $(this).closest('.talent-item').find('.talent-functions-v2 ').show()
  })

  // talents add notes function
  $(document).on('click', '.talent-function-icon.notes', function () {
    $(this).closest('.talent-item').find('.talent-note-v2').show()
    $(this).closest('.talent-item').find('.talent-photo-v2').hide()
    $(this).closest('.talent-item').find('.talent-functions-v2 ').hide()
  })

  $(window).on('scroll', function () {
    if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
      handler.findMatches(true)
    }
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
  $('#filter-warning').show()
  $('#show_only_matched').on('click', function () {
    if ($(this).is(':checked')) {
      handler.findMatches()
      $('#search-button').prop('disabled', true)
      $('#filter-warning').show()
    } else {
      $('#search-button').prop('disabled', false)
      $('#filter-warning').hide()
    }
  })

  $('#show_only_matched').prop('checked', true)
  $('#search-button').prop('disabled', true)
}
