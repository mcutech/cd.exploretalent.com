module.exports = function(core, user) {


	var handler = require('../event-handlers/rolematches.js')(core, user);

	$('#search-talents').on('click', handler.ApplyData);
}