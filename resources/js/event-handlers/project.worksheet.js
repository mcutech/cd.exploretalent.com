'use strict'
let _ = require('lodash')

function handler (core, user, projectId) {
  self = this
  self.core = core
  self.user = user
  self.projectId = projectId

  self.refreshProjects()
}

handler.prototype.refreshProjects = function () {
  self.core.resource.project.get()
    .then(function (projects) {
      self.project = projects
      self.core.service.databind('#projects-list', projects)
      if (parseInt(self.projectId)) { $('#projects-list').val(self.projectId).select2() }
      self.getRoles()
      self.refreshList()
    })
}

handler.prototype.refreshList = function () {
  let qs = self.core.service.query_string()

  let data = {
    query: [
      [ 'select', 'roles.role_id' ],
      [ 'join', 'roles', 'roles.casting_id', '=', 'castings.casting_id' ],
      [ 'join', 'laret_campaigns', 'laret_campaigns.bam_role_id', '=', 'roles.role_id' ],
      [ 'groupBy', 'roles.role_id' ]
    ],
    per_page: 500
  }

  if ($('#projects-list').val()) {
    data.query.push([ 'where', 'castings.casting_id', '=', $('#projects-list').val() ])
  }

  if ($('#roles-list').val()) {
    data.query.push([ 'where', 'roles.role_id', '=', $('#roles-list').val() ])
  }

  self.core.resource.project.get(data)
    .then(function (res) {
      let roleIds = _.map(res.data, 'role_id')
      roleIds.push(0)

      let data2 = {
        query: [
          [ 'whereIn', 'bam_role_id', roleIds ],
          [ 'with', 'bam_role.bam_casting' ],
          [ 'orderBy', 'created_at', 'DESC' ]
        ],
        page: qs.page || 1,
        per_page: 25
      }

      return self.core.resource.campaign.get(data2)
    })
    .then(function (res) {
      console.log(res)
      self.campaigns = res
      let promises = []

      _.each(self.campaigns.data, function (campaign) {
        promises.push(self.getCampaignTalentCount(campaign))
      })

      return $.when.apply($, promises)
    })
    .then(function () {
      self.campaigns.current_project_id = $('#projects-list').val()
      self.campaigns.current_role_id = $('#roles-list').val()

      if ($('#roles-list').val() == '') {
        self.campaigns.current_role_id = $('#roles-list option:nth-child(2)').val()
      }
      console.log(self.campaigns)

      $('#no-casting-div').addClass('hide')

      if (self.campaigns.total == 0) {
        $('.no-worksheet').addClass('hide')
        $('#no-casting-div').removeClass('hide')
      }

      self.core.service.databind('#no-casting-div', self.campaigns)
      self.core.service.databind('#campaigns-list', self.campaigns)
      self.core.service.paginate('#worksheet-pagination', { total: self.campaigns.total, class: 'pagination', name: 'page', per_page: self.campaigns.per_page })
      self.core.service.paginate('#worksheet-pagination2', { total: self.campaigns.total, class: 'pagination', name: 'page', per_page: self.campaigns.per_page })
    })
}

handler.prototype.getCampaignTalentCount = function (campaign) {
  let deferred = $.Deferred()

  campaign.bam_role.getLikeItList().then(function (res) {
    campaign.bam_role.likeitlist = res
    deferred.resolve()
  })

  return deferred.promise()
}

handler.prototype.projectChanged = function () {
  self.getRoles()
  self.refreshList()

  window.history.pushState({}, '', '/projects/' + ($('#projects-list').val() || 0) + '/worksheet')
}

handler.prototype.getRoles = function () {
  let projectId = $('#projects-list').val()

  let data = {
    projectId: projectId,
    query: [
      [ 'with', 'bam_roles' ]
    ]
  }

  self.core.resource.project.get(data)
    .then(function (res) {
      if (res.bam_roles && res.bam_roles.length > 0) {
        $('#role-div').removeClass('hide')
        self.core.service.databind('#roles-list', res)
      } else {
        $('#role-div').addClass('hide')
      };
    })
}

module.exports = function (core, user, projectId) {
  return new handler(core, user, projectId)
}
