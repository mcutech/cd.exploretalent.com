module.exports = function (core, user) {
  let handler = require('../event-handlers/alternate-emails.js')(core, user)
}
