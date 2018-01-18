'use strict'
let _ = require('lodash')

function handler (core, user, projectId, roleId) {
  self = this
  self.core = core
  self.user = user
  self.projectId = projectId
  self.roleId = roleId
  self.refreshProjects()
}

handler.prototype.refreshProjects = function () {
  let data = {
    query: [
      [ 'with', 'bam_roles' ]
    ]
  }
  self.core.resource.project.get(data)
    .then(function (res) {
      self.core.service.databind('#projects-list', res)
    })
}

handler.prototype.refreshInbox = (e) => {
  self.jobId = e.val
  let data = {
    query : [
      ['join', 'schedules', 'schedules.id', 'schedule_id'],
      ['where', 'schedule_id', self.jobId],
      ['with', 'schedule']
    ]
  }
  self.core.resource.conversation.get(data)
    .then(function (res){
      console.log(res)
    })
}

handler.prototype.refreshRoles = function (e) {
  self.projectId = $('#projects-list').val()
  let data = {
    projectId: self.projectId,
  }

  self.core.service.databind('#roles-list', [])

  self.core.resource.job.get(data)
    .then(function (res) {
      let roles = res
      self.core.service.databind('#roles-list', roles)
      console.log(roles)
    })
}

handler.prototype.refreshMessages = function () {
  $('.conversation-item').removeClass('active')
  $(this).addClass('active')
  self.conversationId = parseInt($(this).attr('data-id'))

  let schedule = _.find(self.schedules.data, function (schedule) {
    return schedule.conversation.id == self.conversationId
  })

  self.core.service.databind('#messages-container', schedule)
  $('#messages').animate({ scrollTop: $('#messages')[0].scrollHeight })
}

handler.prototype.sendMessage = function () {
  if ($('#message-text').val()) {
    let data = {
      conversationId: self.conversationId,
      body: $('#message-text').val()
    }

    self.core.resource.message.post(data)
      .then(function (res) {
        let $element = $('[data-bind-template].conversation-box').clone()
        let data2 = res
        data2.user = self.user

        $element.removeAttr('data-bind-template')
        $element.removeAttr('data-bind-value')
        self.core.service.databind($element, data2)
        $('#messages').append($element)
        $('#messages').animate({ scrollTop: $('#messages')[0].scrollHeight })
        $('#message-text').val('')
      })
  }
}

module.exports = function (core, user, projectId, roleId) {
  return new handler(core, user, projectId, roleId)
}
