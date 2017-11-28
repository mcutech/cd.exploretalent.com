'use strict'

module.exports = function (core, user) {
  let handler = require('../event-handlers/settings.js')(core, user)

  $('#update-settings-button').on('click', handler.updateUser)
  $('#update-password-button').on('click', handler.updatePassword)
}
