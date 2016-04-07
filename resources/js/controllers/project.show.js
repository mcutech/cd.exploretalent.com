module.exports = function(core, user, projectId) {

	var handler = require('../event-handlers/project.show.js')(core, user, projectId);

	$(document).on('change', '#casting-list-by-this-user', function() {

		var castingId = $(this).val();
		window.location.href = '/projects/'+castingId;

	})

};
