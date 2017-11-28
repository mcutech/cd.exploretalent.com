module.exports = function (core, user) {
  let handler = require('../event-handlers/project.quickpost.js')(core, user)
  $(document).on('click', '#btn-send-to-booking', handler.addToBooking)
}
