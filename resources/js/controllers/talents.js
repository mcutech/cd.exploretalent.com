module.exports = function(core, user) {
	var handler = require('../event-handlers/talents.js')(core, user);

	$(document).on('click', '.fav-btn', handler.addToFavorites);
	$('#talent-filter-button').on('click', handler.refresh);
}
