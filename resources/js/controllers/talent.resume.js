module.exports = function(core, user, talentnum) {
	var handler = require('../event-handlers/talent.resume.js')(core, user, talentnum);

	$(document).on('click', '.photo-click', function() {
		$('#talent-photo').click();
	});
}
