module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.find-talents.js')(core, user, projectId, roleId);

	$('#roles-list').on('change', handler.refreshRole);
	$('#search-button').on('click', handler.findMatches);

	//refine search toggle location search
	$(document).on('click', '#location-search-change-btn', function(e){
		e.preventDefault();
		$('#location-search-display').show();
		$('#location-search-change').hide();
	});
	$(document).on('click', '#location-search-display-btn', function(e){
		e.preventDefault();
		$('#location-search-display').hide();
		$('#location-search-change').show();
	});

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.findMatches(true);
		}
	});
};
