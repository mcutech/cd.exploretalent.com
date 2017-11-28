module.exports = function (core) {
  $('#phone').mask('999-999-9999')

  $('#send-casting').click(function (e) {
    e.preventDefault()

    let form = {}
    // core.service.form.serializeObject("#quick-post");
    form.user_id = 1
    form.name = $("input[name='name']").val()
    form.body = $("textarea[name='body']").val()
    form.lazy_project_status_id = 1

    core.resource.quickpost.post(form)
      .then(function (result) {
        $('#success-div').removeClass('hide')
        $("input[name='name']").val('')
        $("textarea[name='body']").val('')
        setTimeout(function () {
          $('#quick-post').modal('hide')
          $('#success-div').addClass('hide')
        }, 1000)
      })
  })

  $('#sign-up').click(function (e) {
    e.preventDefault()

    let lname = $('#last-name').val()
    let fname = $('#first-name').val()
    let email = $('#email').val()
    let phone = $('#phone').val()
    let pass = $('#password').val()
    let confirmpass = $('#confirm-password').val()

    let regexName = new RegExp('[a-zA-Z]$')
    let regexPass = new RegExp('^[a-zA-Z0-9]*$')
    let regexEmail = new RegExp('^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$')

    if (!lname) {
      $('#last-name').focus().css('border-color', '#b94a48')
      $('#req-lname').show().delay(5000).fadeOut()
      $('#req-lnametxt').text('This field is required.').show().delay(5000).fadeOut()
      return
    } else {
      if (!regexName.test(lname)) {
        $('#last-name').focus().css('border-color', '#b94a48')
        $('#req-lname').show().delay(5000).fadeOut()
        $('#req-lnametxt').text('Invalid Last Name').show().delay(5000).fadeOut()
        return
      }
      $('#last-name').css('border-color', '#d6d6d6')
    }

    if (!fname) {
      $('#first-name').focus().css('border-color', '#b94a48')
      $('#req-fname').show().delay(5000).fadeOut()
      $('#req-fnametxt').text('This field is required.').show().delay(5000).fadeOut()
      return
    } else {
      if (!regexName.test(fname)) {
        $('#first-name').focus().css('border-color', '#b94a48')
        $('#req-fname').show().delay(5000).fadeOut()
        $('#req-fnametxt').text('Invalid First Name').show().delay(5000).fadeOut()
        return
      }
      $('#first-name').css('border-color', '#d6d6d6')
    }

    if (!email) {
      $('#email').focus().css('border-color', '#b94a48')
      $('#req-email').show().delay(5000).fadeOut()
      $('#req-emailtxt').text('This field is required.').show().delay(5000).fadeOut()
      return
    } else {
      if (!regexEmail.test(email)) {
        $('#email').focus().css('border-color', '#b94a48')
        $('#req-email').show().delay(5000).fadeOut()
        $('#req-emailtxt').text('Invalid Email Address.').show().delay(5000).fadeOut()
        return
      } $('#email').css('border-color', '#d6d6d6')
    }
    if (!phone) {
      $('#phone').focus().css('border-color', '#b94a48')
      $('#req-phone').show().delay(5000).fadeOut()
      $('#req-phonetxt').text('This field is required.').show().delay(5000).fadeOut()
      return
    } else {
      // remove all hyphens from phone (mask)
      phone = phone.replace(/-/g, '')
    }
    $('#phone').css('border-color', '#d6d6d6')

    if (!pass) {
      $('#password').focus().css('border-color', '#b94a48')
      $('#req-pass').show().delay(5000).fadeOut()
      $('#req-passtxt').text('This field is required.').show().delay(5000).fadeOut()
      return
    } else {
      if (!regexPass.test(pass)) {
        $('#password').focus().css('border-color', '#b94a48')
        $('#req-pass').show().delay(5000).fadeOut()
        $('#req-passtxt').text('Invalid Password.').show().delay(5000).fadeOut()
        return
      } else {
        if (!/[A-Z]+/.test(pass)) {
          $('#password').focus().css('border-color', '#b94a48')
          $('#pass-min-letter').show().delay(5000).fadeOut()
          $('#pass-min-letter').text('Password must have atleast 1 capital letter').show().delay(5000).fadeOut()
          return
        } else {
          if (pass.length < 8) {
            $('#password').focus().css('border-color', '#b94a48')
            $('#pass-min-length').show().delay(5000).fadeOut()
            $('#pass-min-length').text('Password must contain atleast 8 characters').show().delay(5000).fadeOut()
            return
          }
        }
      }
      $('#password').css('border-color', '#d6d6d6')
    }
    if (!confirmpass) {
      $('#confirm-password').focus().css('border-color', '#b94a48')
      $('#req-confirmpass').show().delay(5000).fadeOut()
      $('#req-confirmpasstxt').text('This field is required.').show().delay(5000).fadeOut()
      return
    } else {
      if (!regexPass.test(confirmpass)) {
        $('#confirm-password').focus().css('border-color', '#b94a48')
        $('#req-confirmpass').show().delay(5000).fadeOut()
        $('#req-confirmpasstxt').text('Invalid Password.').show().delay(5000).fadeOut()
        return
      }
      $('#confirm-password').css('border-color', '#d6d6d6')
    }

    if (pass != confirmpass) {
      $('#password, #confirm-password').focus().css('border-color', '#b94a48')
      $('#req-confirmpass').show().delay(5000).fadeOut()
      $('#req-unmatchtxt').text('Password doesn\'t match.').show().delay(5000).fadeOut()
      return
    }

    let data = {
      lname: lname,
      fname: fname,
      email1: email,
      phone1: phone,
      pass: pass,
      status: 1,
      app_ids: [1]
    }

    core.resource.cd_user.post(data)
      .then(function (result) {
        return core.service.rest.post(core.config.api.base.replace('/v1', '') + '/oauth/access_token', {
          username: email,
          password: pass,
          client_id: '74d89ce4c4838cf495ddf6710796ae4d5420dc91',
          client_secret: '61c9b2b17db77a27841bbeeabff923448b0f6388',
          grant_type: 'password',
          user_type: 'bam_cd_user'
        })
      })
      .then(function (result) {
        localStorage.setItem('access_token', result.access_token)
        core.service.rest.settings.headers = { Authorization: 'Bearer ' + result.access_token }
        $('#req-confirmemail').show().delay(5000).fadeOut()
        $('#req-ok').text('We\'ve sent you a message on your email address with a link to log you into your account.').show().delay(5000).fadeOut()
        setTimeout(function () {
          window.location = '/welcome'
        }, 1000)
      }, function () {
        $('#email').focus().css('border-color', '#b94a48')
        $('#req-confirmpass').show().delay(5000).fadeOut()
        $('#req-uniqueemailtxt').text('The E-mail has already been taken, we\'ve sent you a message on your email address with a link to log in into your account.').show().delay(5000).fadeOut()

        $('#error-signup').show().delay(5000).fadeOut()
        console.log('invalid')
      })
  })
}
