module.exports = function(core, user) {


	var handler = require('../event-handlers/talents.js')(core, user);

	
	$(document).on('click', '.btn-link', handler.addToFav);
	$('#search-talents').on('click', handler.ApplyData);
}