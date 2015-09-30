module.exports = function(core, user) {


	var handler = require('../event-handlers/talents.js')(core, user);


	$(document).on('click', '#talent-photo', handler.refreshTalentPhotos);
	$('#search-talents').on('click', handler.ApplyData);
	$(document).on('click', '.btn-link', handler.addToFav);
}
