'use strict'

function handler (core, user) {
  self = this
  self.core = core
  self.user = user
  self.refresh()
}

handler.prototype.refresh = function () {
  self.core.resource.quickpost.get()
    .then(function (result) {
      console.log(result)
    })
}

handler.prototype.addToBooking = function () {
  let form = self.core.service.form.serializeObject('#booking-form')

  if (!form.name) {
    $('#name-error').addClass('has-error')
  } else {
    $('#name-error').removeClass('has-error')
  }

  if (form.name && !form.body) {
    $('#body-error').addClass('has-error')
  } else {
    $('#body-error').removeClass('has-error')
  }

  if (form.name && form.body) {
    form.user_id = self.user.id
    form.lazy_project_status_id = 1
    self.core.resource.quickpost.post(form)
      .then(function (result) {
        $('#success-div').removeClass('hide')
        $("input[name='name']").val('')
        $("textarea[name='body']").val('')
        self.refresh()
      })
  }
}

module.exports = function (core, user) {
  return new handler(core, user)
}
