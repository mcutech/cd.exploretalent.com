module.exports = function(core, user) {
	var handler = require('../event-handlers/project.index.js')(core, user);

	$(document).on('click', '#project-search-btn', handler.refreshList);
	$(document).on('change', '#project-status[name="status"]', handler.refreshList);

	$(document).on('keydown', '#project-name', function(e) {
		if(e.which == 13) { // enter key
			$('#project-search-btn').click();
		}
	})

	$("#watch-video-modal").on('hidden.bs.modal', function (e) {
		$("#watch-video-modal iframe").attr("src", $("#watch-video-modal iframe").attr("src"));
	});
}
