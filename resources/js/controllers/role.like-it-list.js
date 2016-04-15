module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.like-it-list.js')(core, user, projectId, roleId);
}
