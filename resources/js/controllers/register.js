module.exports = function(core) {
	$('#phone').mask('999-999-9999');

	$("#sign-up").click(function(e){
		e.preventDefault();

		var lname = $('#last-name').val();
		var fname = $('#first-name').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var pass = $('#password').val();
		var confirmpass = $('#confirm-password').val();

		var regexName = new RegExp("[a-zA-Z]$");
		var regexPass = new RegExp("^[a-zA-Z0-9]*$");
		var regexEmail = new RegExp("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$");

		if(!lname){
			$('#last-name').focus().css("border-color","#b94a48");
			$('#req-lname').show().delay(5000).fadeOut();
			$('#req-lnametxt').text('This field is required.').show().delay(5000).fadeOut();
			return;
		}else{
			if ( !regexName.test(lname) ){
				$('#last-name').focus().css("border-color","#b94a48");
				$('#req-lname').show().delay(5000).fadeOut();
				$('#req-lnametxt').text('Invalid Last Name').show().delay(5000).fadeOut();
				return;
			}
			$('#last-name').css("border-color","#d6d6d6");
		}

		if(!fname){
			$('#first-name').focus().css("border-color","#b94a48");
			$('#req-fname').show().delay(5000).fadeOut();
			$('#req-fnametxt').text('This field is required.').show().delay(5000).fadeOut();
			return;
		}else{
			if ( !regexName.test(fname) ) {
				$('#first-name').focus().css("border-color","#b94a48");
				$('#req-fname').show().delay(5000).fadeOut();
				$('#req-fnametxt').text('Invalid First Name').show().delay(5000).fadeOut();
				return;
			}
			$('#first-name').css("border-color","#d6d6d6");
		}

		if(!email){
			$('#email').focus().css("border-color","#b94a48");
			$('#req-email').show().delay(5000).fadeOut();
			$('#req-emailtxt').text('This field is required.').show().delay(5000).fadeOut();
			return;
		}else{
			if ( !regexEmail.test(email) ) {
				$('#email').focus().css("border-color","#b94a48");
				$('#req-email').show().delay(5000).fadeOut();
				$('#req-emailtxt').text('Invalid Email Address.').show().delay(5000).fadeOut();
				return;
			} $('#email').css("border-color","#d6d6d6"); }
			if(!phone){
				$('#phone').focus().css("border-color","#b94a48");
				$('#req-phone').show().delay(5000).fadeOut();
				$('#req-phonetxt').text('This field is required.').show().delay(5000).fadeOut();
				return;
			}else{
				// remove all hyphens from phone (mask)
				phone = phone.replace(/-/g, '');
			}

			if(!pass){
				$('#password').focus().css("border-color","#b94a48");
				$('#req-pass').show().delay(5000).fadeOut();
				$('#req-passtxt').text('This field is required.').show().delay(5000).fadeOut();
				return;
			}else{
				if ( !regexPass.test(pass) ){
					$('#password').focus().css("border-color","#b94a48");
					$('#req-pass').show().delay(5000).fadeOut();
					$('#req-passtxt').text('Invalid Password.').show().delay(5000).fadeOut();
					return;
				}
				$('#password').css("border-color","#d6d6d6");
			}

			if(!confirmpass){
				$('#confirm-password').focus().css("border-color","#b94a48");
				$('#req-confirmpass').show().delay(5000).fadeOut();
				$('#req-confirmpasstxt').text('This field is required.').show().delay(5000).fadeOut();
				return;
			}else{
				if ( !regexPass.test(confirmpass) ) {
					$('#confirm-password').focus().css("border-color","#b94a48");
					$('#req-confirmpass').show().delay(5000).fadeOut();
					$('#req-confirmpasstxt').text('Invalid Password.').show().delay(5000).fadeOut();
					return;
				}
				$('#confirm-password').css("border-color","#d6d6d6");
			}

			if(pass != confirmpass){
				$('#password, #confirm-password').focus().css("border-color","#b94a48");
				$('#req-confirmpass').show().delay(5000).fadeOut();
				$('#req-unmatchtxt').text('Password doesn\'t match.').show().delay(5000).fadeOut();
				return;
			}

			var data = {
				query : [
					[ 'where', 'email', '=', email ]
				]
			}

			var data = {
				lname	: lname ,
				fname	: fname ,
				email1	: email,
				phone1  : phone,
				pass	: pass,
				status	: 1
			};

			core.resource.cd_user.post(data)
			.then(function(result) {
				return core.service.rest.post(core.config.api.base.replace('/v1', '') + '/oauth/access_token', {
					username       : email,
					password       : pass,
					client_id      : '74d89ce4c4838cf495ddf6710796ae4d5420dc91',
					client_secret  : '61c9b2b17db77a27841bbeeabff923448b0f6388',
					grant_type     : 'password'
				});
			})
			.then(function(result){
				localStorage.setItem('access_token', result.access_token);
				core.service.rest.settings.headers = { Authorization : 'Bearer ' + result.access_token };

				window.location = '/projects';
			}, function(){
				$('#email').focus().css("border-color","#b94a48");
				$('#req-confirmpass').show().delay(5000).fadeOut();
				$('#req-uniqueemailtxt').text('The email has already been taken.').show().delay(5000).fadeOut();

				$('#error-signup').show().delay(5000).fadeOut();
			});
	});
};
