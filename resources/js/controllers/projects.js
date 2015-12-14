module.exports = function(core, user) {
	var handler = require('../event-handlers/projects.js')(core, user);

	$(document).on('click', '.project-item-delete', handler.deleteProject);
	$(document).on('click', '.delete-role', handler.deleteRole);
	$(document).on('click', '#project-search-btn', handler.refreshList);
	$(document).on('change', '#project-status[name="status"]', handler.refreshList);

	$(document).on('keydown', '#project-name', function(e) {
		if(e.which == 13) { // enter key
			$('#project-search-btn').click();
		}
	})

	$(document).on('click', '.project-overview-btn', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var castingId = $(this).attr('id');
			castingId = castingId.split('_');
			castingId = castingId[1];

		window.location.href = "/projects/" + castingId;	
	})
}
