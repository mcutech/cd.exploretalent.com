module.exports = function(core, user){
	var handler = require('../event-handlers/talent.favorite.js')(core, user);

	$(document).on('click', '.fav-btn', handler.addToFav);
};
