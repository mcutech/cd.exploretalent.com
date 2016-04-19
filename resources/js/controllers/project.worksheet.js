'use strict';

module.exports = function(core, user) {
	var handler = require('../event-handlers/project.worksheet.js')(core, user);

	$('#status-list').on('change', handler.refresh);
}