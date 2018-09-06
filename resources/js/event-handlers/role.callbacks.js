'use strict'

function handler (core, user, projectId, roleId) {
  self = this
  self.core = core
  self.user = user
  self.projectId = projectId
  self.roleId = roleId
  self.page = 1
  self.first_load = true

  self.getProjectInfo()
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
      self.core.service.databind('.page-header', self.project)
      self.core.service.databind('#project-details', self.project)
      self.core.service.databind('#roles-list', { data: self.project.bam_roles })
      $('#roles-list').val(self.roleId)

      self.project.role = { role_id: self.roleId, likeitlist: { total: '' }, submissions: { total: '' } }
      self.core.service.databind('#project-links', self.project)
      self.core.service.databind('#no-callbacks-div', self.project)

      self.refreshRole()
    })
}

handler.prototype.refreshRole = function () {
  self.done = false
  self.refreshing = false
  self.roleId = $('#roles-list').val()
  let role = _.find(self.project.bam_roles, function (r) {
    return r.role_id == $('#roles-list').val()
  })

  self.project.role = role
  self.project.role.bam_casting = self.project

  // change url
  window.history.pushState({}, '', '/projects/' + role.casting_id + '/roles/' + role.role_id + '/callbacks')

  // update filter form
  self.core.service.databind('#role-filter-form', self.project.role)

  // submissions count
  self.project.role.getSubmissionsCount()
    .then(function (count) {
      self.project.role.submissions = { total: count }

      self.core.service.databind('#project-links', self.project)
    })

  self.findMatches()
}

handler.prototype.findMatches = function (append) {
  if (self.refreshing) {
    return
  }

  append = append === true

  if (append && self.done) {
    return
  }

  self.page = append ? self.page + 1 : 1
  self.refreshing = true
  let data = self.getFilters()

  if (append) {
    self.first_load = self.first_load ? self.first_load : false
  } else {
    self.first_load = false
  }

  $('#search-loader').show()

  if (!append) {
    $('#role-matches-result').hide()
  }

  let options = {
    bam_role_id: self.roleId
  }

  self.core.resource.talent.search(data, options)
    .then(function (talents) {
      self.done = (talents.total < talents.per_page)

      _.each(talents.data, function (talent) {
        talent.talent_role_id = self.roleId
        talent.talent_project_id = self.projectId
      })
      if (talents.total == 0) {
        $('#no-callbacks-div').removeClass('hide')
      }

      try {
        self.core.service.databind('#role-matches-result', talents, append)
      } catch (e) { }

      self.refreshing = false

      $('#search-loader').hide()
      if (!append) {
        $('#role-matches-result').show()
      }
    })
}

handler.prototype.getFilters = function () {
  let form = self.core.service.form.serializeObject('#role-filter-form')
  let data = {
    per_page: 24,
    page: self.page,
    query: [
      [ 'join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'search.talents.talentnum' ],
      [ 'leftJoin', 'bam.laret_schedules', 'bam.laret_schedules.invitee_id', '=', 'bam.laret_users.id' ],
      [ 'where', 'bam.laret_schedules.rating', '<>', 0 ],
      [ 'where', 'bam.laret_schedules.status', '=', 2 ],
      [ 'where', 'bam.laret_schedules.bam_role_id', '=', $('#roles-list').val() ]
    ]
  }

  if (!self.first_load) {
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

    if (form.last_access) {
      data.query.push([ 'where', 'last_access', '>', Math.floor(new Date().getTime() / 1000) - parseInt(form.last_access) ])
    }

    if (form.young_old) {
      data.query.push([ 'orderBy', 'dobyyyy', form.young_old ])
      data.query.push([ 'orderBy', 'dobmm', form.young_old ])
      data.query.push([ 'orderBy', 'dobdd', form.young_old ])
    }

    if (form.union) {
      if (form.union == '1') {
        data.query.push([ 'where', [
          [ 'where', 'union_aea', '=', 'Yes' ],
          [ 'orWhere', 'union_aftra', '=', 'Yes' ],
          [ 'orWhere', 'union_other', '=', 'Yes' ],
          [ 'orWhere', 'union_sag', '=', 'Yes' ]
        ]
        ])
      } else {
        data.query.push([ 'where', [
          [ 'where', 'union_aea', '=', 'No' ],
          [ 'orWhere', 'union_aftra', '=', 'No' ],
          [ 'orWhere', 'union_other', '=', 'No' ],
          [ 'orWhere', 'union_sag', '=', 'No' ]
        ]
        ])
      }
    }
  }

  return data
}

module.exports = function (core, user, projectId, roleId) {
  return new handler(core, user, projectId, roleId)
}
