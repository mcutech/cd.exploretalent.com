module.exports = function(core, user, projectId) {
	var handler = require('../event-handlers/projects.findtalents.js')(core, user, projectId);

	$('#roles-list').on('change', handler.refreshRole);
	$('#search-button').on('click', handler.findMatches);

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.findMatches(true);
		}
	});
};
