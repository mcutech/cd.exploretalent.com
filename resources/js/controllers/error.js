module.exports = function (core, user) {
  function thirty_pc () {
    let height = $(window).height()
    let errorPage = (height)
    errorPage = parseInt(errorPage) - 80 + 'px'
    $('#error-page').css('height', errorPage)
    $('#content-wrapper').css('padding', '20px')
  }

  $(document).ready(function () {
    thirty_pc()
    $(window).bind('resize', errorPage)
  })
}
