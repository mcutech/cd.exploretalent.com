'use strict'
let _ = require('lodash')

function handler (core, user) {
  self = this
  self.core = core
  self.user = user

  console.log(user)
}

handler.prototype.sendLinkToEmail = function (e) {
  e.preventDefault()

  let email = $('#email').val()

  if (/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b/.test(email)) {
    let data = {
      email: email,
      type: 'bam_cd_user'
    }

    self.core.resource.reminder.post(data)
      .then(function (res) {
        $('#invalid-email').hide()
        $('#valid-email').fadeIn().delay(5000).fadeOut()
      }, function (res1) {
        $('#email-not-found').fadeIn().delay(5000).fadeOut()
      })
  } else {
    $('#valid-email').hide()
    $('#invalid-email').fadeIn().delay(5000).fadeOut()
  }
}

module.exports = function (core, user) {
  return new handler(core, user)
}
