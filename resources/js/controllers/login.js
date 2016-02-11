module.exports = function(core, user) {
	if (parseInt(user.bam_cd_user_id)) {
		var qs = core.service.query_string();
		window.location = qs.redirect ? decodeURIComponent(qs.redirect) : '/projects';
	}
	else {
		core.service.rest.settings.headers = {};

		localStorage.removeItem('refresh_token');
		localStorage.removeItem('access_token');

		$("#login-form").on('submit', function(e){
			e.preventDefault();
			var email = $('#email').val();
			var pass = $('#password').val();

			if(!email){
				$('#invalid-email').fadeIn().delay(5000).fadeOut();
				return;
			}

			if(!pass){
				$('#invalid-pass').fadeIn().delay(5000).fadeOut();
				return;
			}

			core.service.rest.post(core.config.api.base.replace('/v1', '') + '/oauth/access_token', {
					username       : email,
					password       : pass,
					user_type      : 'bam_cd_user',
					client_id      : '74d89ce4c4838cf495ddf6710796ae4d5420dc91',
					client_secret  : '61c9b2b17db77a27841bbeeabff923448b0f6388',
					grant_type     : 'password'
				})
				.then(function(result) {
					var qs = core.service.query_string();

					localStorage.setItem('access_token', result.access_token);
					localStorage.setItem('refresh_token', result.refresh_token);
					localStorage.setItem('access_date', new Date());
					window.location = qs.redirect ? decodeURIComponent(qs.redirect) : '/projects';
				},
				function(error){
					if (error.responseText) {
						var error = JSON.parse(error.responseText);

						if (error.errors && error.errors.auth && error.errors.auth == 'You shall not pass!') {
							$('#invalid-user').show();
							$("#invalid-user").delay(5000).fadeOut();
						}
						else {
							$('#duplicate-email').show();
							$("#duplicate-email").delay(5000).fadeOut();
						}
					}
				});
		});
	}
};
