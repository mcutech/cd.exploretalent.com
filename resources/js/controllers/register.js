module.exports = function(core) {
	$("#sign-up").click(function(e){
		e.preventDefault();

		var lname = $('#last-name').val();
		var fname = $('#first-name').val();
		var username = $('#login').val();
		var email = $('#email').val();
		var pass = $('#password').val();
		var confirmpass = $('#confirm-password').val();

		var regexName = new RegExp("[a-zA-Z]$");
		var regexUsername = new RegExp("^[a-zA-Z0-9]*$");
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

		if(!username){
			$('#login').focus().css("border-color","#b94a48");
			$('#req-username').show().delay(5000).fadeOut();
			$('#req-usernametxt').text('This field is required.').show().delay(5000).fadeOut();
			return;
		}else{
			if ( !regexUsername.test(username) ) {
				$('#login').focus().css("border-color","#b94a48");
				$('#req-username').show().delay(5000).fadeOut();
				$('#req-usernametxt').text('Invalid Username.').show().delay(5000).fadeOut();
				return;
			}
			$('#login').css("border-color","#d6d6d6");
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
			}
			$('#email').css("border-color","#d6d6d6");
		}

		if(!pass){
			$('#password').focus().css("border-color","#b94a48");
			$('#req-pass').show().delay(5000).fadeOut();
			$('#req-passtxt').text('This field is required.').show().delay(5000).fadeOut();
			return;
		}else{
			if ( !regexUsername.test(pass) ){
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
			if ( !regexUsername.test(confirmpass) ) {
				$('#confirm-password').focus().css("border-color","#b94a48");
				$('#req-confirmpass').show().delay(5000).fadeOut();
				$('#req-confirmpasstxt').text('Invalid Password.').show().delay(5000).fadeOut();
				return;
			}
			$('#confirm-password').css("border-color","#d6d6d6");
		}

		if(pass != confirmpass){
			console.log('pass not match')
			$('#password, #confirm-password').focus().css("border-color","#b94a48");
			$('#req-confirmpass').show().delay(5000).fadeOut();
			$('#req-unmatchtxt').text('Password doesn\'t match.').show().delay(5000).fadeOut();
			return;
		}
			console.log('ok');
		
		var user = {
			email: email,
			password: pass
		}
		core.resource.user.post(user)
			.then(function(result) {
				setTimeout(function(){
					core.service.rest.post(core.config.api.base + '/sessions', { email : email, password : pass })
					.then(function(result){
						var data = {
							lname	: lname ,
							fname	: fname ,
							login	: username,
							email1	: email,
							pass	: pass
						};
						core.resource.cd_user.post(data)
							.then(function(result) {
							console.log(result);
							window.location = '/login';
						});	
					})
				}, 1000);

			});
		
	});
};
