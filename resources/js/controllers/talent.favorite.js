module.exports = function(core, user){
	var handler = require('../event-handlers/talent.favorite.js')(core, user);

	$(document).on('click', '.fav-btn', handler.addToFav);

	$(document).on('click', '.rating-button', handler.refreshCastingRole);
	$(document).on('change', '#casting-list', handler.selectCastingRole);
	$(document).on('click', '#btn-add-to-likeitlist', handler.addToLikeitlist);
};
