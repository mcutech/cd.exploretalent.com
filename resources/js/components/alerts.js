module.exports = function(core, user){

	self = this;
	self.core = core;
	self.user = user;

	// FOR TOP ALERT
	var data = {
		query : [
			[ 'orderBy', 'created_at', 'DESC' ],
			[ 'where', 'priority', '=', '1' ],
			[ 'where', 'app_id', '=', '8']
		],
		per_page : 1
	}

	self.core.resource.alert.get(data)
	.then(function(res) {
		console.log(res);
		self.core.service.databind('#top-alert-div', res.data[0]);
		// to determine margin-top of body.. move down if top-alert-div is visible
		var topAlertDiv = $('#top-alert-div');
		if(topAlertDiv.is(':visible')) {
			$('#main-navbar').css('margin-top', '40px');
			$('#main-wrapper').css('margin-top', '40px');
		}
		else {
			$('#main-navbar').css('margin-top', '0px');
			$('#main-wrapper').css('margin-top', '40px');
		}
	});

}