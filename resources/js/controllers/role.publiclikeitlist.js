module.exports = function(core, user, projectId){
	var handler = require('../event-handlers/role.publiclikeitlist.js')(core, user, projectId);	

	//$(document).on('click', '.edit-role', handler.editRole);
	$(document).on('click', '.view-all-modal', handler.viewAllModal);



};