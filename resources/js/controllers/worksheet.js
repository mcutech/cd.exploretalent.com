'use strict';

module.exports = function(core, user) {
	var handler = require('../event-handlers/worksheet.js')(core, user);

	$('#filter-button').on('click', handler.refresh);
}
