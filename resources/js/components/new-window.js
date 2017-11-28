module.exports = function () {
  // windowed new window
  $(document).on('click', '[target=_blank]', function (e) {
  // $('[target=_blank]').on('click', function(e) {
    let URL = this.href

    let x = screen.width / 2 - 1050 / 2
    let y = screen.height / 2 - 450 / 2

    window.open(URL, '_blank', 'height=' + screen.height / 2 + ', width=1000, left=' + x + ',top=' + y)
    return false
  })

  // full screen new window
  $(document).on('click', '[target=_blank-full]', function (e) {
    let URL = this.href

    window.open(URL, '_blank')
    return false
  })
}
