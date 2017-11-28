module.exports = function () {
  $('[data-select]').each(function () {
    $(this).select2({
      placeholder: $(this).attr('data-placeholder')
    })
  })
}
