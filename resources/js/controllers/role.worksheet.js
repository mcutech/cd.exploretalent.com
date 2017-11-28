'use strict'

module.exports = function (core, user, projectId, roleId) {
  let handler = require('../event-handlers/role.worksheet.js')(core, user, projectId, roleId)

  $('#filter-button').on('click', handler.refresh)
  $('#reschedule-button').on('click', handler.reschedule)
  $('#add-note-button').on('click', handler.addNote)
  $('#reply-button').on('click', handler.reply)
  $(document).on('click', '.reschedule-button', handler.setScheduleId)
  $(document).on('click', '.add-note-button', handler.setScheduleId)
  $(document).on('click', '.accept-button', handler.updateScheduleStatus)
  $(document).on('click', '.decline-button', handler.updateScheduleStatus)
  $(document).on('click', '.callback-button', handler.updateScheduleCDStatus)
  $(document).on('click', '.hired-button', handler.updateScheduleCDStatus)
  $(document).on('click', '.message-button', handler.showMessageModal)

  $('#message-modal').on('hidden.bs.modal', function (e) {
    $('#message-modal iframe').attr('src', $('#message-modal iframe').attr('src'))
  })
}
