module.exports = function(core, user, projectId){
	var handler = require('../event-handlers/project.show.js')(core, user, projectId);	

	$(document).on('click', '.edit-role', handler.editRole);

	$(document).on('click', '.edit-project', handler.editProject);
};