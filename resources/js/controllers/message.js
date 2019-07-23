module.exports = function (core, user, projectId, roleId) {
  let Handler = require('../event-handlers/message.js')(core, user, projectId, roleId)

  $('.talent-item-container').slimScroll({
    height: '100%',
    start: 'top'
  })

  $('.messages-container').slimScroll({
    height: '80%',
    start: 'top'
  })

  $(document).on('click', '.show-conversation', e => {
    e.preventDefault()
    let id = $(e.target).attr('data-id')
    Handler.renderMessages(id)
  })
  $(document).on('click', '.reply', Handler.reply)

  let windowHeight = window.innerHeight - 157
  $('#messages-panel')[0].style.height = windowHeight + 'px'
}
