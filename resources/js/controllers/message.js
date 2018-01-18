module.exports = function (core, user, projectId, roleId) {
  let handler = require('../event-handlers/message.js')(core, user, projectId, roleId)

  $(document).on('change', '#projects-list', handler.refreshRoles)
  $(document).on('change', '#roles-list', handler.refreshInbox)
  $(document).on('click', '.remove-talent', handler.removeConversation)
  $(document).on('click', '.conversation-item', handler.refreshMessages)
  $(document).on('click', '.show-conversation', handler.showConversation)

  $(document).on('click', '.send-btn', handler.sendMessage)

  $('.talent-item-container').slimScroll({
    height: '100%'
  })
  $('.messages-container').slimScroll({
    height: '100%'
  })

  let windowHeight = window.innerHeight - 157
  $('#messages-panel')[0].style.height = windowHeight + 'px'
}
