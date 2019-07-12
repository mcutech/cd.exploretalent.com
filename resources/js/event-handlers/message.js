'use strict'
function Handler (core, user, projectId, roleId) {
  self = this
  self.core = core
  self.cdn = '//etdownload.s3.amazonaws.com/'
  self.me = user
  self.projectId = projectId
  self.roleId = roleId
  self.me = user.id
  self.getConversations()
}

Handler.prototype.getConversations = function () {
  let data = {
    query: [
      [ 'with', 'users.bam_user' ],
      [ 'with', 'users.bam_cd_user' ],
      [ 'with', 'users.bam_talentci.bam_talent_media2_profile' ],
      [ 'with', { messages: [
        [ 'limit', 1 ],
        [ 'orderBy', 'id', 'DESC' ]
      ] } ]
    ]
  }
  core.resource.conversation.get(data)
    .then(conversations => {
      _.each(conversations.data, (c, i) => {
        _.each(c.users, user => {
          c.name = 'Unknown'
          c.photo = '/images/filler.jpg'
          c.message = '...'
          c.created_at = moment(c.created_at)
          if (c.messages.length > 0) {
            c.created_at = moment(c.messages[0].created_at)
            c.message = c.messages[0].body
            if (c.message.length > 60) {
              c.message = c.message.slice(0, 60) + '...'
            }
          }

          if (user.bam_talentnum > 0) {
            c.name = user.bam_talentci.fname + ' ' + user.bam_talentci.lname
            if (user.bam_talentci.bam_talent_media2_profile.length > 0) {
              c.photo = self.cdn + user.bam_talentci.bam_talent_media2_profile[0].bam_media_path_full
            }
          }

          if (user.bam_cd_user_id > 0) {
            c.name = user.bam_cd_user.fname + ' ' + user.bam_cd_user.lname
          }

          if (user.bam_user_id > 0) {
            c.name = user.bam_user.fname + ' ' + user.bam_user.lname
          }
        })

        c.user = _.find(c.users, u => {
          return u.id === c.user_id
        })
      })

      self.conversations = conversations
      self.renderConversations()
    })
}

Handler.prototype.renderConversations = () => {
  self.core.service.databind('#from', self.conversations)
}

Handler.prototype.renderMessages = () => {
  self.core.service.databind('#to', self.messages)
}

module.exports = (core, user, projectId, roleId) => {
  return new Handler(core, user, projectId, roleId)
}
