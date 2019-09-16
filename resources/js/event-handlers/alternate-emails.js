
'use strict'

function Handler (core, user) {
  self = this
  self.core = core
  self.user = user
  console.log(user)
  self.getAllEmails()
}

Handler.prototype.getAllEmails = function () {
  let qs = self.core.service.query_string()
  let emails = {
    with_trashed: 1,
    query: [
      ['user_id', self.user.id],
      ['orderBy', 'created_at', 'DESC']
    ],
    page: qs.page || 1,
    per_page: 10
  }

  self.core.resource.user_email.get(emails)
    .then(function (res) {
      console.log(res)
      self.core.service.databind('#alt_emails', res)
      self.core.service.paginate('#pagination', { total: res.total, class: 'pagination', name: 'page', per_page: res.per_page })
      $('.email').val('')
    })
}

Handler.prototype.addEmail = function () {
  let email = $('.email').val()

  let data = {
    email: email
  }
  if (email.length > 0) {
    self.core.resource.user_email.post(data)
      .then(function (res) {
        $.growl.notice({
          title: '<i class=\'fa fa-check\'> </i> Updated succesfully!',
          message: ''
        })
        self.getAllEmails()
        $('.email').text('')
      }, function (error) {
        if (error) {
          $.growl.error({
            title: '<i class=\'fa fa-times\'> </i> Invalid email address!',
            message: ''
          })
        }
      })
  }
}

Handler.prototype.setEmail = function (id) {
  self.core.resource.user_email.get({
    with_trashed: 1,
    id: id
  })
    .then(function (res) {
      let data = {
        cdUserId: self.user.bam_cd_user.user_id,
        email1: res.email
      }
      self.core.resource.cd_user.patch(data)
        .then(function (res1) {
          console.log(res1)
        })

      self.core.resource.user_email.delete({ id: id, with_trashed: 1 })
        .then(function (res2) {
          self.getAllEmails()
          $.growl.notice({
            title: '<i class=\'fa fa-check\'> </i> Updated succesfully!',
            message: ''
          })
        })
    })
}

Handler.prototype.setEmailSec = function (id) {
  self.core.resource.user_email.get({
    with_trashed: 1,
    id: id
  })
    .then(function (res) {
      let data = {
        cdUserId: self.user.bam_cd_user.user_id,
        email2: res.email
      }
      self.core.resource.cd_user.patch(data)
        .then(function (res1) {
          console.log(res1)
        })

      self.core.resource.user_email.delete({ id: id, with_trashed: 1 })
        .then(function (res2) {
          self.getAllEmails()
          $.growl.notice({
            title: '<i class=\'fa fa-check\'> </i> Updated succesfully!',
            message: ''
          })
        })
    })
}

Handler.prototype.deleteEmail = function (id) {
  if (confirm('Are you sure you want to delete this email?')) {
    self.core.resource.user_email.delete({ id: id, with_trashed: 1 })
      .then(function (res) {
        console.log(res)
        self.getAllEmails()
        $.growl.notice({
          title: '<i class=\'fa fa-check\'> </i> Deleted successfully!',
          message: ''
        })
      })
  }
}

module.exports = function (core, user) {
  return new Handler(core, user)
}
