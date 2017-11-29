module.exports = function (core, user) {
  console.log(core)
  if (parseInt(user.bam_cd_user_id)) {
    $('#redirect-login-page').fadeIn()
    let qs = core.service.query_string()
    window.location = qs.redirect ? decodeURIComponent(qs.redirect) : '/welcome'
  } else {
    core.service.rest.settings.headers = {}

    localStorage.removeItem('refresh_token')
    localStorage.removeItem('access_token')

    $('.signin-input').fadeIn()

    $('#login-form').on('submit', function (e) {
      e.preventDefault()
      let email = $('#email').val()
      let pass = $('#password').val()

      if (!email) {
        $('#invalid-email').fadeIn().delay(5000).fadeOut()
        return
      }

      if (!pass) {
        $('#invalid-pass').fadeIn().delay(5000).fadeOut()
        return
      }

      core.service.rest.post(core.config.api.base.replace('/v1', '') + '/oauth/access_token', {
        username: email,
        password: pass,
        user_type: 'bam_cd_user',
        client_id: '74d89ce4c4838cf495ddf6710796ae4d5420dc91',
        client_secret: '61c9b2b17db77a27841bbeeabff923448b0f6388',
        grant_type: 'password'
      })
        .then(function (result) {
          let qs = core.service.query_string()

          localStorage.setItem('access_token', result.access_token)
          localStorage.setItem('refresh_token', result.refresh_token)
          localStorage.setItem('expires_on', Math.round(new Date().getTime() / 1000) + parseInt(result.expires_in))
          window.location = qs.redirect ? decodeURIComponent(qs.redirect) : '/welcome'
        },
        function (error) {
          if (error.responseText) {
            error = JSON.parse(error.responseText)

            if (error.errors && error.errors.auth && error.errors.auth == 'You shall not pass!') {
              $('#invalid-user').show()
              $('#invalid-user').delay(5000).fadeOut()
            } else {
              $('#duplicate-email').show()
              $('#duplicate-email').delay(5000).fadeOut()
            }
          }
        })
    })
  }
}
