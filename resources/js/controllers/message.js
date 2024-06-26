module.exports = function (core, user, projectId, roleId) {
  let Handler = require('../event-handlers/message.js')(core, user, projectId, roleId)

  $(document).on('click', '.remove-talent', Handler.deleteConvo)
  $(document).on('click', '.show-conversation', e => {
    e.preventDefault()
    $('.talent-item').removeClass('active')
    $(e.target).parents('.talent-item').addClass('active')

    let id = $(e.target).attr('data-id')
    Handler.renderMessages(id)
  })

  $(document).on('click', '.reply', Handler.reply)

  let windowHeight = window.innerHeight - 157
  $('#messages-panel')[0].style.height = windowHeight + 'px'
}
