module.exports = function(core, user) {
	var handler = require('../event-handlers/project.index.js')(core, user);

	$(document).on('click', '#project-search-btn', handler.refreshList);
	$(document).on('change', '#project-status[name="status"]', handler.refreshList);

	$(document).on('keydown', '#project-name', function(e) {
		if(e.which == 13) { // enter key
			$('#project-search-btn').click();
		}
	})
}
