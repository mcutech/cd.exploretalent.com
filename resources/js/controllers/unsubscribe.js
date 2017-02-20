module.exports = function(core, user, talentnum) {
	var handler = require('../event-handlers/unsubscribe.js')(core, user);

	$('#savebtn').on('click', function(){
		handler.saveChanges();
	});
}
