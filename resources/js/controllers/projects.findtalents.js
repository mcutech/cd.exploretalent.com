module.exports = function(core, user, projectId) {

	var handler = require('../event-handlers/projects.findtalents.js')(core, user, projectId);

	$('#select-role').on('click', handler.selectRole);


};
