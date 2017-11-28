module.exports = function (core, user) {
  let handler = require('../event-handlers/password.forgot.js')(core, user)

  $(document).on('click', '#send-email-btn', handler.sendLinkToEmail)
}
