'use strict';

module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/worksheet.js')(core, user, projectId, roleId);
}
