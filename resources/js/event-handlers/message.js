'use strict'
function Handler (core, user) {
  self = this
  self.core = core
  self.cdn = '//etdownload.s3.amazonaws.com/'
  self.user = user
  self.me = user.id
  self.getConversations()
  console.log(self.me)
  console.log(self.me)
}

Handler.prototype.getConversations = () => {
  let data = {
    query: [
      [ 'with', 'users.bam_user' ],
      [ 'with', 'users.bam_cd_user' ],
      [ 'with', 'users.bam_talentci.bam_talent_media2_profile' ],
      [ 'orderBy', 'updated_at', 'DESC' ],
      [ 'with', { messages: [
        [ 'orderBy', 'created_at', 'ASC' ]
      ] } ]
    ]
  }
  core.resource.conversation.get(data)
    .then(conversations => {
      console.log(conversations)
      _.each(conversations.data, (c, i) => {
        _.each(c.users, user => {
          c.me = self.me
          self.messages = c.mesages
          c.name = 'Unknown'
          c.photo = '/images/filler.jpg'
          c.message = '...'
          c.created_at = moment(c.created_at)
          if (c.messages.length > 0) {
            c.created_at = moment(c.last_message.created_at)
            c.message = c.last_message.body
            if (c.message.length > 45) {
              c.message = c.message.slice(0, 45) + '...'
            }
          }

          if (user.bam_talentnum > 0) {
            c.name = user.bam_talentci.fname + ' ' + user.bam_talentci.lname
            c.address = user.bam_talentci.address1
            if (user.bam_talentci.bam_talent_media2_profile.length > 0) {
              c.photo = self.cdn + user.bam_talentci.bam_talent_media2_profile[0].bam_media_path_full
            }
          }

          if (user.bam_cd_user_id > 0) {
            c.name = user.bam_cd_user.fname + ' ' + user.bam_cd_user.lname
            c.address = user.bam_cd_user.address1
          }

          if (user.bam_user_id > 0) {
            c.name = user.bam_user.fname + ' ' + user.bam_user.lname
            c.address = user.bam_user.address1
          }
        })

        c.user = _.find(c.users, u => {
          return u.id === c.user_id
        })
      })

      self.conversations = conversations
      self.renderConversations()

      // Load first conversation
      if (conversations.data.length) {
        self.renderMessages(conversations.data[0].id)
      }
    })
}

Handler.prototype.renderConversations = () => {
  self.core.service.databind('.from', self.conversations)
}

Handler.prototype.renderMessages = (id) => {
  let conversations = self.conversations
  let qs = core.service.query_string
  let conversation = _.find(conversations.data, (i) => {
    return i.id == id
  })

  let data = {
    page: qs.page || 1,
    conversationId: id,
    query: [
      ['orderBy', 'created_at', 'ASC']
    ]
  }

  core.resource.message.get(data)
    .then((message) => {
      console.log(message)
      core.service.databind('#to', message)
    })

  core.service.databind('#reply', conversation)
}

Handler.prototype.reply = (e) => {
  e.preventDefault()
  let container = $(e.target).parents('.message-content').find('.messages-container')

  let form = self.core.service.form.serializeObject('#message-reply')
  if (form.body.length) {
    console.log(container)
    core.resource.message.post(form)
      .then((res) => {
        self.renderMessages(res.conversation_id)
        self.getConversations()
        $(e.target).parent().parent().find('input[name=body]').val('')
      })
    container.scrollTop(9999)
  }
}

Handler.prototype.deleteConvo = (e) => {
  let del = $(e.target).attr('data-id')

  if (confirm('Are you sure you want to delete this conversation?')) {
    core.resource.conversation.delete({ conversationId: del })
      .then((res) => {
        self.getConversations()
      })
  }
}

module.exports = (core, user, projectId, roleId) => {
  return new Handler(core, user, projectId, roleId)
}
