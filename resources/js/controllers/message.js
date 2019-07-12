module.exports = function (core, user, projectId, roleId) {
  require('../event-handlers/message.js')(core, user, projectId, roleId)

  $('.talent-item-container').slimScroll({
    height: '100%',
    start: 'top'
  })

  $('.messages-container').slimScroll({
    height: '80%',
    start: 'top'
  })

  let windowHeight = window.innerHeight - 157
  $('#messages-panel')[0].style.height = windowHeight + 'px'
}
