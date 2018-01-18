'use strict'
let _ = require('lodash')

function handler (core, user, projectId, roleId) {
  self = this
  self.core = core
  self.cdn = '//etdownload.s3.amazonaws.com/'
  self.me = user
  self.projectId = projectId
  self.roleId = roleId
  self.refreshProjects()
  self.refreshInbox()
  self.conversations = { personal : [], job: [] }
  self.jobId = false
}

handler.prototype.removeConversation = (e) => {
  let id = $(e.target).parent().attr('data-id')
  self.core.resource.conversation.delete({ conversationId: id })
    .then((res) => {
      self.conversations.personal.data = _.filter(self.conversations.personal.data, (conv) => {
        return conv.id != id
      })
      self.conversations.job.data = _.filter(self.conversations.job.data, (conv) => {
        return conv.id != id
      })

      self.core.service.databind('.inbox-container', self.conversations)
    })
}

handler.prototype.refreshProjects = () => {
  let data = {
    query: [
      [ 'with', 'bam_roles' ]
    ]
  }
  self.core.resource.project.get(data)
    .then((res) => {
      self.core.service.databind('#projects-list', res)
    })
}

handler.prototype.refreshInbox = (e) => {
  if (e && e.val) {
    self.jobId = e.val
  }

  let data = {
    query : [
      ['whereNull', 'schedule_id'],
    ]
  }

  if (self.jobId) {
    data = {
      query : [
        ['join', 'schedules', 'schedules.id', 'schedule_id'],
        ['where', 'schedule_id', self.jobId],
        ['with', 'schedule']
      ]
    }
  }

  data.query.push(['with', 'users.bam_talentci.bam_talent_media2'])
  data.query.push(['with', 'users.bam_cd_user'])

  self.core.resource.conversation.get(data)
    .then((res) => {
      for (let i = 0, len = res.data.length; i < len; i++) {
        if (res.data[i].name === '') {
          res.data[i].name = []

          let users = _.filter(res.data[i].users, (user) => {
            return user.id != self.me.id
          })

          res.data[i].pic = '/images/filler.jpg'
          res.data[i].location = false

          for (let x = 0, len = users.length; x < len; x++) {
            let user = users[x]

            if (user.id != self.me.id) {
              if (user.bam_talentnum > 0) {
                let pics = _.filter(user.bam_talentci.bam_talent_media2, (media) => {
                  return media.type == 2
                })

                if (pics.length) {
                  res.data[i].pic = self.cdn + pics[0].bam_media_path_full
                }

                // ?????
                res.data[i].location = user.bam_talentci.city + ', ' +  user.bam_talentci.state

                res.data[i].name.push(user.bam_talentci.fname + ' ' + user.bam_talentci.lname)
              } else if (user.bam_cd_user_id > 0) {
                res.data[i].name.push(user.bam_cd_user.fname + ' ' + user.bam_cd_user.lname)
              } else {
                res.data[i].name.push('Unknown')
              }
            }
          }

          res.data[i].name = res.data[i].name.join(',')
        }
      }

      if (!self.jobId) {
        self.conversations.personal = res
      } else {
        self.conversations.job = res
      }
      console.log(self.conversations)
      self.core.service.databind('.inbox-container', self.conversations)
    })
}

handler.prototype.refreshRoles = (e) => {
  self.projectId = $('#projects-list').val()
  let data = {
    projectId: self.projectId,
  }

  self.core.service.databind('#roles-list', [])

  self.core.resource.job.get(data)
    .then((res) => {
      let roles = res
      self.core.service.databind('#roles-list', roles)
      console.log(roles)
    })
}

module.exports = (core, user, projectId, roleId) => {
  return new handler(core, user, projectId, roleId)
}
