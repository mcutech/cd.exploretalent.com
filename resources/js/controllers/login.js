
module.exports = function(core) {
	$("#sign-in").click(function(e){
		e.preventDefault();
		var email = $('#email').val();
		var pass = $('#password').val();

		if(!email){
			$('#invalid-email').show();
			$("#invalid-email").delay(5000).fadeOut();
			return;
		}
		if(!pass){
			$('#invalid-pass').show();
			$("#invalid-pass").delay(5000).fadeOut();
			return;
		}


		core.service.rest.post(core.config.api.base + '/sessions', { email : email, password : pass })
			.then(function(result) {
				window.location = '/projects';

			},
			function(){
				$('#invalid-user').show();
				$("#invalid-user").delay(5000).fadeOut();
			});
	});
};