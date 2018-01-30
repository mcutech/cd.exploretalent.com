module.exports = function (core) {
  $('[data-slider]').each(function () {
    let options = {
      disabled: $(this).data('disabled'),
      max: $(this).data('max'),
      min: $(this).data('min'),
      orientation: $(this).data('orientation'),
      range: $(this).data('range'),
      step: $(this).data('step'),
      value: $(this).data('value'),
      values: $(this).data('values')
    }

    switch ($(this).data('type')) {
      case 'age':
        options.slide = function (event, ui) {
          if (ui.values[0] < 3) {
            $('#age-min-text').text('<3')
            $('#age-min-input').val('<3')
          } else {
            $('#age-min-text').text(ui.values[0])
            $('#age-min-input').val(ui.values[0])
          }
          $('[name="age_min"]').val(ui.values[0])

          if (ui.values[1] > 70) {
            $('#age-max-text').text('70+')
            $('#age-max-input').val('70+')
          } else {
            $('#age-max-text').text(ui.values[1])
            $('#age-max-input').val(ui.values[1])
          }
          $('[name="age_max"]').val(ui.values[1])
        }

        break
      case 'height':
        options.slide = function (event, ui) {
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


          if (ui.values[0] == '23') {
            ui.values[0] == '22'
          }
          if (ui.values[1] == '23') {
            ui.values[1] == '22'
          }

          $('[name="height_min"]').val(ui.values[0])
          $('[name="height_max"]').val(ui.values[1])
          $('#height-min-dropdown').val(ui.values[0])
          $('#height-max-dropdown').val(ui.values[1])
        }
        break
    }

    $(this).slider(options)
  })
}
