module.exports = function (core, user, projectId) {
  let handler = require('../event-handlers/project.show.js')(core, user, projectId)
}
