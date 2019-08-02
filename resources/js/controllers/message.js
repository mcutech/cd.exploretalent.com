module.exports = function (core, user, projectId, roleId) {
  let Handler = require('../event-handlers/message.js')(core, user, projectId, roleId)

  $('.talent-item-container').slimScroll({
    height: '100%',
    start: 'bottom'
  })

  $('.messages-container').slimScroll({
    height: '470px'
  })



  $(document).on('click', '.show-conversation', e => {
    e.preventDefault()
    $('.talent-item').removeClass('active')
    $('.talent-item').find('.active').removeClass('active')
    $(e.target).parent().addClass('active')

    let id = $(e.target).attr('data-id')

      Handler.renderMessages(id)
  })

  $(document).on('click', '.reply', Handler.reply)

  let windowHeight = window.innerHeight - 157
  $('#messages-panel')[0].style.height = windowHeight + 'px'
}
