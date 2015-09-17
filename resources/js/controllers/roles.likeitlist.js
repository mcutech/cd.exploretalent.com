module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/roles.likeitlist.js')(core, user, projectId, roleId);
}
