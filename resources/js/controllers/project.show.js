module.exports = function(core, user, projectId){
	var handler = require('../event-handlers/project.show.js')(core, user, projectId);
};
