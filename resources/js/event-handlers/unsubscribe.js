'use strict'
let _ = require('lodash')

function handler (core, user) {
  self = this
  self.core = core
  self.user = user
  self.refresh()

  let data = {
    query: [
      ['where', 'user_id', '=', self.user.id]
    ]
  }
  self.core.resource.user_option.get(data)
    .then(function (res) {
      self.core.service.databind('#notifications', res)
    })
}

handler.prototype.refresh = function () {
  self.core.service.databind('#talent-email', self.user)
  self.core.resource.cd_user_subscription.get()
    .then(function (res) {
      if (res.data[0].email !== res.data[0].sms) {
        if (res.data[0].email == 1) {
          res.email = 1
        } else {
          res.email = 0
        }

        if (res.data[0].sms == 1) {
          res.sms = 1
        } else {
          res.sms = 0
        }
      } else {
        if (res.data[0].email == 1) {
          res.email = 0
        } else {
          res.email = 1
        }

        if (res.data[0].sms == 1) {
          res.sms = 0
        } else {
          res.sms = 1
        }
      }
      self.core.service.databind('#unsubscribe-emails', res)
    })
}

handler.prototype.saveChanges = function () {
  let data = {
    query: [
      ['where', 'bam_cd_user_id', self.user.bam_cd_user_id]
    ]
  }

  self.core.resource.cd_user_subscription.get(data)
  .then(function (res) {
    if (res.total == 0) {
      let data = {
        bam_cd_user_id: self.user.user_id,
        sms: $('#emailchck').is(':checked') ? 0 : 1,
        email: $('#smschck').is(':checked') ? 0 : 1
      }
      self.core.resource.cd_user_subscription.post(data)
      .then(function (res) {
        window.location = '/'
      })
    } else {
      let data = {
        subscriptionId: res.data[0].id,
        sms: $('#emailchck').is(':checked') ? 0 : 1,
        email: $('#smschck').is(':checked') ? 0 : 1
      }

      self.core.resource.cd_user_subscription.patch(data)
      .then(function (res) {
        window.location = '/'
      })
    }
  })

  let user_option_data = {
    query: [
      ['where', 'user_id', '=', self.user.id]
    ]
  }

  let talent_reply_data = {
    option: 'Talent Reply Notification',
    value: $('#talentReply').is(':checked') ? 1 : 0
  }

  let talent_submit_data = {
    option: 'Talent Submit Notification',
    value: $('#talentSubmit').is(':checked') ? 1 : 0
  }

  self.core.resource.user_option.get(user_option_data)
    .then(function (res) {
      if (res.total == 0) {
        self.core.resource.user_option.post(talent_reply_data)
        self.core.resource.user_option.post(talent_submit_data)
      } else {
        talent_reply_data.id = res.data[0].id
        talent_submit_data.id = res.data[1].id
        self.core.resource.user_option.patch(talent_reply_data)
        self.core.resource.user_option.patch(talent_submit_data)
      }
    })
}

module.exports = function (core, user) {
  return new handler(core, user)
}
