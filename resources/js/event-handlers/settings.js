'use strict'

function handler (core, user) {
  self = this
  self.core = core
  self.user = user
  self.refresh()
  self.userOption()

  self.core.resource.cd_user_campaign_subscription.get()
        .then(function (res) {
          console.log(res)
        })
}

handler.prototype.userOption = function () {
  let data = {
    query: [
      ['where', 'user_id', '=', self.user.id]
    ]
  }

  self.core.resource.cd_user_campaign_subscription.get(data)
    .then(function (res) {
      if (!res.total) {
        let trnData = {
          campaign_id: 7078,
          OK: 1
        }
        self.core.resource.cd_user_campaign_subscription.post(trnData)
          .then(function () {
            let tsnData = {
              campaign_id: 7250,
              OK: 1
            }
            self.core.resource.cd_user_campaign_subscription.post(tsnData)
              .then(function (res) {
              })
          })
      }
    })
}

handler.prototype.refresh = function () {
  let user_subs = {
    cdUserId: self.user.bam_cd_user.user_id,
    query: [
      ['with', 'cd_user_subscription']
    ]
  }

  self.core.resource.cd_user.get(user_subs)
    .then(function (res) {
      let data = {
        query: [
          ['where', 'user_id', '=', self.user.id]
        ]
      }

      self.core.resource.cd_user_campaign_subscription.get(data)
      .then(function (res2) {
        console.log('RES2')
        console.log(res2)
        res.cd_user_campaign_subscription = res2
        self.core.service.databind('#settings', res)
      })
    })
}

handler.prototype.updatePassword = function (e) {
  e.preventDefault()

  let form = self.core.service.form.serializeObject('#password-form')

  form.cdUserId = self.user.bam_cd_user_id
  form.pass = form.new_password

  let regEx = /^((?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+){5,})$/.test(form.new_password)

  if (!form.new_password && !form.conf_new_password) {
    alert('Please enter a new password.')
    return
  }

  if (regEx) {
    if (form.new_password == form.conf_new_password) {
      delete form.new_password
      delete form.conf_new_password

      self.core.resource.cd_user.patch(form)
                    .then(function (res) {
                        // saved successfully
                      $('#update-password-success').removeClass('hide')

                      $("input[name='new_password']").val('')
                      $("input[name='conf_new_password']").val('')

                      setTimeout(function () {
                        $('#settings-modal').modal('hide')
                        $('#update-password-success').addClass('hide')
                      }, 500)
                    }, function (err) {
                    // there's an error when trying to update password
                    })
    } else {
      $('#update-password-fail').removeClass('hide')
    }
  } else {
    alert('Your password must contain atleast 5 alphanumeric characters.')
  }
}

handler.prototype.updateUser = function (e) {
  e.preventDefault()
  if (self.core.service.form.validate('#settings-form')) {
    let form = self.core.service.form.serializeObject('#settings-form')
    form.cdUserId = self.user.bam_cd_user_id

    self.core.resource.cd_user.patch(form)
      .then(function (res) {
        console.log(res)
        // update cd user subscription
        let subscription_form = {}
        self.core.resource.cd_user_subscription.get({bam_cd_user_id: self.user.bam_cd_user_id})
          .then(function (res) {
            console.log(res)

            if (res.total > 0) {
              // console.log(res);
              subscription_form.subscriptionId = res.data[0].id

              if ($('#emailok').is(':checked')) {
                subscription_form.email = 1
              } else {
                subscription_form.email = 0
              }
              if ($('#smsok').is(':checked')) {
                subscription_form.sms = 1
              } else {
                subscription_form.sms = 0
              }

              // return;

              self.core.resource.cd_user_subscription.patch(subscription_form)
                .then(function (res) {
                  // console.log(res);
                  console.log('for email and sms res')
                  console.log(res)
                })
            } else {
              if ($('#emailok').is(':checked')) {
                subscription_form.email = 1
              } else {
                subscription_form.email = 0
              }
              if ($('smsok').is(':checked')) {
                subscription_form.sms = 1
              } else {
                subscription_form.sms = 0
              }

              self.core.resource.cd_user_subscription.post(subscription_form)
                .then(function (res) {
                  console.log('for email and sms res')
                  console.log(res)
                })
            }
          })

        let userOption_trn_form = {}
        let userOption_tsn_form = {}

        // let data = {
        //   query:[
        //     ['where', 'user_id', '=', self.user.id]
        //   ]
        // }

        if ($('#talentReply').is(':checked')) {
          userOption_trn_form.campaign_id = 7078
          userOption_trn_form.OK = 1
        } else {
          userOption_trn_form.campaign_id = 7078
          userOption_trn_form.OK = 0
        }

        if ($('#talentSubmitProject').is(':checked')) {
          userOption_tsn_form.campaign_id = 7250
          userOption_tsn_form.OK = 1
        } else {
          userOption_tsn_form.campaign_id = 7250
          userOption_tsn_form.OK = 0
        }

        self.core.resource.cd_user_campaign_subscription.get({bam_cd_user_id: self.user.bam_cd_user_id})
          .then(function (res) {
            console.log('does the campaign exist')
            console.log(res)

            userOption_trn_form.id = res.data[0].id
            userOption_tsn_form.id = res.data[1].id

            if (res.total > 0) {
              self.core.resource.cd_user_campaign_subscription.patch(userOption_trn_form)
                      .then(function (res) {
                        console.log('Patching TRN')
                        console.log(res)
                      })

              self.core.resource.cd_user_campaign_subscription.patch(userOption_tsn_form)
                      .then(function (res) {
                        console.log('Patching TSN')
                        console.log(res)
                      })
            } else {
              self.core.resource.cd_user_campaign_subscription.post(userOption_trn_form)
                      .then(function (res) {
                        console.log('Posting TRN')
                        console.log(res)
                      })

              self.core.resource.cd_user_campaign_subscription.post(userOption_tsn_form)
                      .then(function (res) {
                        console.log('Posting TSN')
                        console.log(res)
                      })
            }
          })

        // userOption_trn_form.id = form.cdUserId;
        // userOption_tsn_form.id = form.cdUserId;

        $('#update-settings-success').fadeIn().delay(5000).fadeOut()
      }, function (err) {
        $('#update-settings-fail').fadeIn().delay(5000).fadeOut()
      })
  }
}

module.exports = function (core, user) {
  return new handler(core, user)
}
