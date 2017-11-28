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
      self.projects = res
      self.core.service.databind('#projects-list', self.projects)

      if (self.projectId) {
        $('#projects-list').val(self.projectId)
        self.refreshRoles()
      } else {
        self.refreshConversations()
      }
    })
}

handler.prototype.refreshRoles = function (e) {
  self.projectId = $('#projects-list').val()

  if (e) {
    let url = '/messages/' + self.projectId
    window.history.pushState(null, null, url)
  }

  self.project = _.find(self.projects.data, function (project) {
    return project.casting_id == self.projectId
  })

  self.core.service.databind('#roles-list', self.project)

  if (self.roleId) {
    $('#roles-list').val(self.roleId)
  }

  self.refreshConversations()
}

handler.prototype.refreshConversations = function (e) {
  self.roleId = $('#roles-list').val()

  if (e) {
    let url = '/messages/' + self.projectId + '/' + self.roleId
    window.history.pushState(null, null, url)
  }

  let data = {
    query: [
      [ 'with', 'conversation.users.bam_talentci.bam_talent_media2' ],
      [ 'with', 'conversation.messages.user.bam_talentci' ],
      [ 'with', 'conversation.messages.user.bam_cd_user' ]
    ]
  }

  if (self.roleId) {
    data.query.push([ 'where', 'bam_role_id', '=', self.roleId ])
  } else {
    let role_ids = _.map(self.project.bam_roles, function (role) {
      return role.role_id
    })

    role_ids.push(0)

    data.query.push([ 'whereIn', 'bam_role_id', role_ids ])
  }

  self.core.resource.schedule.get(data)
    .then(function (res) {
      _.remove(res.data, function (schedule) {
        return schedule.conversation == null
      })

      _.each(res.data, function (schedule) {
        schedule.conversation.talent = _.find(schedule.conversation.users, function (user) {
          return user.bam_talentci
        })
      })

      self.schedules = res
      self.core.service.databind('#conversations-list', res)
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
