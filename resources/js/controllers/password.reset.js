module.exports = function (core, user) {
  let handler = require('../event-handlers/password.reset.js')(core, user)

  $(document).on('click', '#reset-password-btn', handler.resetPassword)

  // on enter key, click reset btn
  $('#confirm-password').keyup(function (event) {
    if (event.keyCode == 13) {
      $('#reset-password-btn').click()
    }
  })
}
