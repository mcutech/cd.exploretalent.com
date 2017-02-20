'use strict';

function handler(core, user) {
	self = this;
	self.core = core;
	self.user = user;
	self.refresh();
	self.userOption();
}

handler.prototype.userOption = function() {
	var data = {
		query:[
			['where', 'user_id', '=', self.user.id]
		]
	}

	self.core.resource.user_option.get(data)
		.then(function(res){
			if(!res.total){
				var trnData = {
					option:'Talent Reply Notification',
					value: 0,
				}
				self.core.resource.user_option.post(trnData)
					.then(function(){
						var tsnData = {
							option:'Talent Submit Notification',
							value: 0,
						}
						self.core.resource.user_option.post(tsnData)
							.then(function(res){
							});
					})
			}
		});
}

handler.prototype.refresh = function() {

	var user_subs = {
		cdUserId: self.user.bam_cd_user.user_id,
		query : [
			['with', 'cd_user_subscription']
		]
	}

	self.core.resource.cd_user.get(user_subs)
		.then(function(res) {
			var data = {
				query:[
					['where', 'user_id', '=', self.user.id]
				]
			}

			self.core.resource.user_option.get(data)
			.then(function(res2) {
				res.user_options = res2;//adding user_option resource to res.
				self.core.service.databind('#settings', res);
			})
	});
}

handler.prototype.updatePassword = function(e) {

	e.preventDefault();

	var form = self.core.service.form.serializeObject('#password-form');

	form.cdUserId = self.user.bam_cd_user_id;
	form.pass = form.new_password;

	if(form.new_password == form.conf_new_password){

		delete form.new_password;
		delete form.conf_new_password;

		self.core.resource.cd_user.patch(form)
				.then(function(res) {
					//saved successfully
					$('#update-password-success').removeClass('hide');

					$("input[name='new_password']").val('');
					$("input[name='conf_new_password']").val('');

					setTimeout(function() {
						$('#settings-modal').modal('hide');
						$('#update-password-success').addClass('hide');
				 	}, 1000);
				},function(err){
				//there's an error when trying to update password
				});
	}else{
		$('#update-password-fail').removeClass('hide');
	}

}

handler.prototype.updateUser = function(e) {
	e.preventDefault();
	if (self.core.service.form.validate('#settings-form')) {
		var form = self.core.service.form.serializeObject('#settings-form');
		form.cdUserId = self.user.bam_cd_user_id;

		self.core.resource.cd_user.patch(form)
			.then(function(res) {
				//update cd user subscription
				var subscription_form = {}
				self.core.resource.cd_user_subscription.get({bam_cd_user_id : self.user.bam_cd_user_id})
					.then(function(res){

						if(res.total>0){

							//console.log(res);
							subscription_form.subscriptionId = res.data[0].id;

							if($('#emailok').is(':checked')){
								subscription_form.email = 1;
							}else{
								subscription_form.email = 0;
							}
							if($('#smsok').is(':checked')){
								subscription_form.sms = 1;
							}else{
								subscription_form.sms = 0;
							}

							// return;

							self.core.resource.cd_user_subscription.patch(subscription_form)
								.then(function(res){
									//console.log(res);

								});

						}else{


							if($('#emailok').is(':checked')){
								subscription_form.email = 1;
							}else{
								subscription_form.email = 0;
							}
							if($('smsok').is(':checked')){
								subscription_form.sms = 1;
							}else{
								subscription_form.sms = 0;
							}

							self.core.resource.cd_user_subscription.post(subscription_form)
								.then(function(res){

								});
						}

				});

				var userOption_trn_form = {}
				var userOption_tsn_form = {}

				var data = {
					query:[
						['where', 'user_id', '=', self.user.id]
					]
				}

				self.core.resource.user_option.get(data)
					.then(function(res){

						if($('#talentReply').is(':checked')){
							userOption_trn_form.option = 'Talent Reply Notification';
							userOption_trn_form.value  = 1;
						}else{
							userOption_trn_form.option = 'Talent Reply Notification';
							userOption_trn_form.value  = 0;
						}

						if($('#talentSubmitProject').is(':checked')){
							userOption_tsn_form.option = 'Talent Submit Notification';
							userOption_tsn_form.value  = 1;
						}else{
							userOption_tsn_form.option = 'Talent Submit Notification';
							userOption_tsn_form.value  = 0;
						}

						userOption_trn_form.id = res.data[0].id;
						userOption_tsn_form.id = res.data[1].id;

						self.core.resource.user_option.patch(userOption_trn_form)
							.then(function(res){
						});

						self.core.resource.user_option.patch(userOption_tsn_form)
							.then(function(res){
						});

				});


				$('#update-settings-success').fadeIn().delay(5000).fadeOut();
			}, function(err) {
				$('#update-settings-fail').fadeIn().delay(5000).fadeOut();
			});


	}
}

module.exports = function(core, user) {
	return new handler(core, user);
}
