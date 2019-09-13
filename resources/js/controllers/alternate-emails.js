module.exports = function (core, user) {
  let handler = require('../event-handlers/alternate-emails.js')(core, user)

  $(document).on('click', '#add_email', handler.addEmail)
  $(document).on('click', '.set-email', function () {
    let id = $(this).parent().attr('id')
    handler.setEmail(id)
  })

  $(document).on('click', '.set-email-sec', function () {
    let id = $(this).parent().attr('id')
    handler.setEmailSec(id)
  })

  $(document).on('click', '.delete', function () {
    let id = $(this).parent().attr('id')
    handler.deleteEmail(id)
  })
}
