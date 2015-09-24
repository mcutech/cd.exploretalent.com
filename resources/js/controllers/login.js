module.exports = function(core, user) {
	if (user.bam_cd_user_id) {
		window.location = '/projects';
	}

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

		core.service.rest.post(core.config.api.base + '/sessions', { email : email, password : pass })
			.then(function(result) {
				var qs = core.service.query_string.toObject();

				window.location = qs.redirect ? decodeURIComponent(qs.redirect) : '/projects';

			},
			function(){
				$('#invalid-user').show();
				$("#invalid-user").delay(5000).fadeOut();
			});
	});
};
