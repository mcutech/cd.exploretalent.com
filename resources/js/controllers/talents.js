module.exports = function(core, user) {
	var handler = require('../event-handlers/talents.js')(core, user);

	$('#search-talents').on('click', handler.ApplyData);
	$(document).on('click', '.fav-btn', handler.addToFav);
}
