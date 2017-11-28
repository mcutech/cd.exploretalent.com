module.exports = function (core) {
  $('[data-date-picker]').each(function () {
    $(this).datepicker({
      dateFormat: $(this).attr('data-date-format')
    })
  })
}
