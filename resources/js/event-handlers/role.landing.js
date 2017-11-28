'use strict'

function handler (core, user, projectId, roleId) {
  self = this
  self.core = core
  self.user = user
  self.projectId = projectId
  self.roleId = roleId
  self.page = 1
  self.first_load = true

  self.getAllProjects()
  self.getProjectInfo()

  console.log(self.user)
}

handler.prototype.getAllProjects = function () {
  let data = {
    query: [
      [ 'with', 'bam_roles' ],
      ['orderBy', 'last_modified', 'DESC']
    ],
    per_page: 500
  }

  self.core.resource.project.get(data)
    .then(function (res) {
      self.core.service.databind('#projects-list', { data: res.data })
      $('#projects-list').val(self.projectId)
    })
}

handler.prototype.getProjectInfo = function () {
  let data = {
    projectId: self.projectId,
    query: [
      [ 'with', 'bam_roles' ]
    ]
  }

  self.core.resource.project.get(data)
    .then(function (res) {
      self.project = res

      let role = _.find(self.project.bam_roles, function (r) {
        return r.role_id == self.roleId
      })

      console.log(res)
      self.core.service.databind('#cd-email', res)
      self.core.service.databind('#roles-list', { data: self.project.bam_roles })
      $('#roles-list').val(self.roleId)
      role.bam_casting = self.project
      self.core.service.databind('#role-filter-form', role)
      self.core.service.databind('#ghost-onboarding', self.user.bam_cd_user)

      self.findMatches()
    })
}

handler.prototype.findRolesForSelectedProject = function (projectId) {
  let data = {
    projectId: projectId,
    query: [
      [ 'with', 'bam_roles' ]
    ]
  }

  self.core.resource.project.get(data)
    .then(function (res) {
      self.project = res

      self.core.service.databind('#roles-list', { data: self.project.bam_roles })
      $('#roles-list').val(self.roleId)
    })
}

handler.prototype.redirectToSelectedRole = function () {
  self.roleId = $('#roles-list').val()
  let role = _.find(self.project.bam_roles, function (r) {
    return r.role_id == $('#roles-list').val()
  })

  // redirect to new url
  window.location.replace('/projects/' + role.casting_id + '/roles/' + role.role_id + '/landing')
}

handler.prototype.findMatches = function (append) {
  if (self.refreshing) {
    return
  }

  append = append === true
  self.page = append ? self.page + 1 : 1
  self.refreshing = true
  let data = self.getFilters('submissions')

  $('#search-loader').show()

  if (!append) {
    $('#role-matches-result').hide()
  }

  self.core.resource.talent.search(data)
    .then(function (talents) {
      let promise = $.when(talents)

      if (talents.total < 24) {
        data = self.getFilters('matches')
        promise = self.core.resource.talent.search(data)
      }

      return promise
    })
    .then(function (talents) {
      self.core.service.databind('#role-matches-result', talents, append)
      self.refreshing = false

      $('#search-loader').hide()
      if (!append) {
        $('#role-matches-result').show()
      }

      $('#filter-content-modal').modal('hide')
    })
}

handler.prototype.getFilters = function (type) {
  let form = self.core.service.form.serializeObject('#role-filter-form')
  let data

  if (type == 'submissions') {
    data = {
      per_page: 24,
      page: self.page,
      query: [
        [ 'join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'search.talents.talentnum' ],
        [ 'leftJoin', 'bam.laret_schedules', 'bam.laret_schedules.invitee_id', '=', 'bam.laret_users.id' ],
        [ 'where', 'bam.laret_schedules.submission', '=', 1 ],
        [ 'where', 'bam.laret_schedules.bam_role_id', '=', self.roleId ]
      ]
    }
  } else if (type == 'matches') {
    data = {
      per_page: 24,
      page: self.page,
      query: [
      ]
    }
  }

  if (form.markets) {
    if (form.markets instanceof Array) {
      let subquery = []

      _.each(form.markets, function (market) {
        if (subquery.length == 0) {
          subquery.push([ 'where', 'city', 'like', '%' + market + '%' ])
        } else {
          subquery.push([ 'orWhere', 'city', 'like', '%' + market + '%' ])
        }

        subquery.push([ 'orWhere', 'city1', 'like', '%' + market + '%' ])
        subquery.push([ 'orWhere', 'city2', 'like', '%' + market + '%' ])
        subquery.push([ 'orWhere', 'city3', 'like', '%' + market + '%' ])
      })

      data.query.push([ 'where', subquery ])
    } else {
      data.query.push([ 'where', [
          [ 'where', 'city', '=', form.markets ],
          [ 'orWhere', 'city1', '=', form.markets ],
          [ 'orWhere', 'city2', '=', form.markets ],
          [ 'orWhere', 'city3', '=', form.markets ]
      ]
      ])
    }
  }

  if (parseInt(form.age_min)) {
    data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ])
  }

  if (parseInt(form.age_max)) {
    data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ])
  }

  if (form.sex) {
    data.query.push([ 'where', 'sex', '=', form.sex ])
  }

  if (form.has_photo) {
    data.query.push([ 'where', 'has_photos', '=', form.has_photo == 'true' ? 1 : 0 ])
  }

  if (form.search_text) {
    data.query.push([ 'where',
      [
        [ 'where', 'talentnum', '=', form.search_text ],
        [ 'orWhere', 'fname', 'LIKE', '%' + form.search_text + '%' ],
        [ 'orWhere', 'lname', 'LIKE', '%' + form.search_text + '%' ]
      ]
    ])
  }

  if (parseInt(form.height_min)) {
    data.query.push([ 'where', 'heightinches', '>=', form.height_min ])
  }

  if (parseInt(form.height_max)) {
    data.query.push([ 'where', 'heightinches', '<=', form.height_max ])
  }

  if (form.build) {
    if (form.build instanceof Array) {
      data.query.push([ 'whereIn', 'build', form.build ])
    } else {
      data.query.push([ 'where', 'build', '=', form.build ])
    }
  }

  if (form.ethnicity) {
    // African and African American are both searched if either is chosen
    if (form.ethnicity instanceof Array) {
      if (form.ethnicity.indexOf('African') > -1 && form.ethnicity.indexOf('African American') == -1) {
        form.ethnicity.push('African American')
      } else if (form.ethnicity.indexOf('African American') > -1 && form.ethnicity.indexOf('African') == -1) {
        form.ethnicity.push('African')
      }

      data.query.push([ 'whereIn', 'ethnicity', form.ethnicity ])
    } else {
      if (form.ethnicity == 'African') {
        data.query.push(['where', [
            [ 'where', 'ethnicity', '=', 'African' ],
            [ 'orWhere', 'ethnicity', '=', 'African American' ]
        ]
        ])
      } else if (form.ethnicity == 'African American') {
        data.query.push(['where', [
            [ 'where', 'ethnicity', '=', 'African American' ],
            [ 'orWhere', 'ethnicity', '=', 'African' ]
        ]
        ])
      } else {
        data.query.push([ 'where', 'ethnicity', '=', form.ethnicity ])
      }
    }
  }

  return data
}

handler.prototype.confirmCdInfo = function () {
  // no logic applied on this other than when contact talent is clicked,
  // user is gonna go through forms and verify/update information

  // hide the last form shown(assuming that user not skipping)
  $('#onboarding-congratulations').hide()

  // showing first modal
  $('#ghost-onboarding-modal').show()
  $('#onboarding-confirm-email').show()
  // modal settings
  $('#ghost-onboarding-modal').modal({backdrop: 'static', keyboard: false})

  return self.core.service.databind('#ghost-onboarding', self.user.bam_cd_user)
}

handler.prototype.updateCdInfo = function (e) {
  let btn = $(this)

  let form = self.core.service.form.serializeObject('#ghost-onboarding-form')

  form.cdUserId = self.user.bam_cd_user_id
  form.pass = form.cdpass

  delete form.cdpass
  delete form.conf_cdpass

  form.phone1 = form.phone1.replace(/-/g, '')
  form.phone2 = form.phone2.replace(/-/g, '')

  // set CD to active
  form.status = 1

  // update information
  self.core.resource.cd_user.patch(form)
    .then(function (res) {
      // fire congratulations text if last detail to be saved (company)
      if (btn.hasClass('company-name')) {
        $('#onboarding-company-name').hide()
        $('#onboarding-congratulations').show()
      }
    }, function (err) {
      alert('errors while saving')
    })
}

module.exports = function (core, user, projectId, roleId) {
  return new handler(core, user, projectId, roleId)
}
