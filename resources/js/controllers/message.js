module.exports = function (core, user, projectId, roleId) {
  let handler = require('../event-handlers/message.js')(core, user, projectId, roleId)

  // $(document).on('change', '#projects-list', handler.refreshRoles)
  // $(document).on('change', '#roles-list', handler.refreshInbox)
  // $(document).on('click', '.remove-talent', handler.removeConversation)
  // $(document).on('click', '.show-conversation', handler.showConversation)
  // $(document).on('click', '.personal-message-menu', () => {
  // $('.casting-invitation-functions').hide()
  // handler.type = 'personal'
  // handler.updateDataBind()
  // })
  // $(document).on('click', '.casting-invitation-menu', () => {
  //   $('.casting-invitation-functions').show()
  //   handler.type = 'job'
  //   handler.updateDataBind()
  // })
  // $(document).on('keypress', '.message-box textarea', handler.checkSendMessage)

  // $('.talent-item-container').slimScroll({
  //   height: '100%',
  //   start: 'top'
  // })

  $('.messages-container').slimScroll({
    height: '80%',
    start: 'top'
  })

  let windowHeight = window.innerHeight - 157
  $('#messages-panel')[0].style.height = windowHeight + 'px'
}
