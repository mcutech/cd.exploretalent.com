module.exports = function(core, user) {
	var handler = require('../event-handlers/talents.js')(core, user);

	$(document).on('click', '.fav-btn', handler.addToFavorites);
	$('#talent-filter-button').on('click', handler.refresh);

	$("#jquery-select2-example").select2({
		allowClear: true,
		placeholder: "Seach market"
	});

	$("#jquery-select2-example").on('change', handler.addToMarket);
	$(document).on('click', '.check-markets', handler.removeFromMarket);

	$(document).on('click', '#search-talent-btn', handler.refresh);

	$(document).on('keydown', '#search-talent-input', function(e) {
		if(e.which == 13) { // enter key
			$('#search-talent-btn').click();
		}
	});
}
