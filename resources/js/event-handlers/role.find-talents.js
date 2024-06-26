'use strict'

function Handler (core, user, projectId, roleId) {
  self = this
  self.core = core
  self.user = user
  self.projectId = projectId
  self.roleId = roleId
  self.page = 1

  self.xorigins = []

  if (self.user.user_apps.length > 0) {
    _.each(self.user.user_apps, function (app) {
      self.xorigins = _.union(self.xorigins, _.map(app.app.app_xorigins, function (xorigin) {
        return xorigin.x_origin
      }))
    })
  }

  self.xorigins = self.xorigins.length === 0 ? [-1] : self.xorigins

  self.getProjectInfo()
}

Handler.prototype.getProjectInfo = function () {
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

      self.refreshRole()
    })
}

Handler.prototype.refreshRole = function () {
  self.done = false
  self.refreshing = false
  self.roleId = $('#roles-list').val()
  let role = _.find(self.project.bam_roles, function (r) {
    return r.role_id === parseInt($('#roles-list').val())
  })

  window.history.pushState({}, '', '/projects/' + self.projectId + '/roles/' + role.role_id + '/find-talents')

  role.bam_casting = self.project

  self.core.service.databind('#role-filter-form', role)
  $('#add-all-button span').text('Add All to Like it List')
  $('#add-all-button').removeClass('disabled')

  role.getLikeItListCount(self.xorigins)
    .then(function (count) {
      role.likeitlist = { total: count }

      self.core.service.databind('#add-all-total', role)
      return role.getSubmissionsCount(self.xorigins)
    })
    .then(function (count) {
      role.submissions = { total: count }
      self.project.role = role

      self.core.service.databind('#project-links', self.project)
    })

  self.findMatches()
}

Handler.prototype.findMatches = function (append) {
  if (self.refreshing) {
    return
  }

  append = append === true

  if (append && self.done) {
    $('#search-loader').addClass('hide')
    return
  }

  self.page = append ? self.page + 1 : 1
  self.refreshing = true
  let data = self.getFilters()

  $('#search-loader').show()

  if (!append) {
    $('#role-matches-result').hide()
  }

  let options = {
    bam_role_id: self.roleId
  }

  self.core.resource.talent.search(data, options)
    .then(function (talents) {
      if (talents.data.length === 0) {
        $('#search-loader').addClass('hide')
      }

      self.done = (talents.total < talents.per_page)

      _.each(talents.data, function (talent, ind) {
        talent.talent_role_id = self.roleId
        talent.talent_project_id = self.projectId

        let talentLoc = talent.getLocation()

        // since we use talent search, we assume city1 field
        let getState = talentLoc.split(', ')
        talent.sortState = getState[1]
        talent.sortCity = getState[0]
      })

      // sort state
      let sortResult = _.chain(talents.data).sortBy('sortCity').sortBy('sortState').value()
      talents.data = null // empty the array
      talents.data = sortResult // replace with sorted result

      if (talents.total === 0) {
        $('#add-all-div').addClass('hide')
      } else {
        $('#add-all-div').removeClass('hide')
      }

      // for total number of talent matches
      self.core.service.databind('#submission-total', talents)

      try {
        self.core.service.databind('#role-matches-result', talents, append)
      } catch (e) { console.log(e) }

      self.refreshing = false

      $('#search-loader').hide()
      if (!append) {
        $('#role-matches-result').show()
      }
    })
}

Handler.prototype.getFilters = function () {
  let form = self.core.service.form.serializeObject('#role-filter-form')

  let data = {
    per_page: 24,
    page: self.page,
    query: [ ]
  }

  if ($('#show_only_matched').is(':checked') === true) {
    let role = _.find(self.project.bam_roles, function (r) {
      return r.role_id === parseInt($('#roles-list').val())
    })

    window.history.pushState({}, '', '/projects/' + self.projectId + '/roles/' + role.role_id + '/find-talents')

    role.bam_casting = self.project
    self.core.service.databind('#role-filter-form', role)
  }

  if (parseInt(form.address_search) === 0) { // market filter
    if (form.markets) {
      if (form.markets instanceof Array) {
        let subquery = []

        _.each(form.markets, function (market) {
          if (subquery.length === 0) {
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
  } else { // location filter
    let lngLat = JSON.parse(form.lng_lat)

    if (lngLat.length > 0) {
      data.query.push(['join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'talentnum'])
      data.query.push(['join', 'bam.laret_locations', 'bam.laret_locations.user_id', '=', 'bam.laret_users.id'])

      data.query.push(['where', 'bam.laret_locations.longitude', '>=', lngLat[0].lng.min - 0.3])
      data.query.push(['where', 'bam.laret_locations.longitude', '<=', lngLat[0].lng.max + 0.3])

      data.query.push(['where', 'bam.laret_locations.latitude', '>=', lngLat[0].lat.min - 0.3])
      data.query.push(['where', 'bam.laret_locations.latitude', '<=', lngLat[0].lat.max + 0.3])
    }
  }

  if (parseInt(form.age_min)) {
    if (form.age_min <= 2) {
      data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - 2 ])
    } else {
      // data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ]);
      data.query.push([ 'where', [
        [ 'where', 'dobyyyy', '<', new Date().getFullYear() - parseInt(form.age_min) ],
        [ 'orWhere', [
          [ 'where', 'dobyyyy', '=', new Date().getFullYear() - parseInt(form.age_min) ],
          [ 'where', [
            [ 'where', 'dobmm', '<', new Date().getMonth() + 1 ],
            [ 'orWhere', [
              [ 'where', 'dobmm', '=', new Date().getMonth() + 1 ],
              [ 'where', 'dobdd', '<=', new Date().getDate() ]
            ]]
          ]]
        ]]
      ]
      ])
    }
  }

  if (parseInt(form.age_max)) {
    if (form.age_max >= 71) {
      data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - 71 ])
    } else {
      data.query.push([ 'where', 'dobyyyy', '>=', new Date().getFullYear() - parseInt(form.age_max) ])
    }
  }

  if (form.sexMale && !form.sexFemale) {
    data.query.push([ 'where', 'sex', '=', form.sexMale ])
  }

  if (form.sexFemale && !form.sexMale) {
    data.query.push([ 'where', 'sex', '=', form.sexFemale ])
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
      if (form.ethnicity.indexOf('African') > -1 && form.ethnicity.indexOf('African American') === -1) {
        form.ethnicity.push('African American')
      } else if (form.ethnicity.indexOf('African American') > -1 && form.ethnicity.indexOf('African') === -1) {
        form.ethnicity.push('African')
      }

      data.query.push([ 'whereIn', 'ethnicity', form.ethnicity ])
    } else {
      if (form.ethnicity === 'African') {
        data.query.push(['where', [
          [ 'where', 'ethnicity', '=', 'African' ],
          [ 'orWhere', 'ethnicity', '=', 'African American' ]
        ]
        ])
      } else if (form.ethnicity === 'African American') {
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
    if (parseInt(form.union) === 1) {
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

  if (form.has_photo === 'true') {
    data.query.push([ 'where', 'has_photos', '=', form.has_photo === 'true' ? 1 : 0 ])
  }

  if (self.xorigins.length > 0) {
    data.query.push([ 'whereIn', 'x_origin', self.xorigins ])
  }

  return data
}

Handler.prototype.addAll = function () {
  let data = self.getFilters()

  self.core.service.rest.post(self.core.config.api.base + '/cd/talentci/import/' + self.roleId, data)
    .then(function () {
      $('#add-all-button span').text('Added to Like it List')
      $('#add-all-button').addClass('disabled')
    })
}

module.exports = function (core, user, projectId, roleId) {
  return new Handler(core, user, projectId, roleId)
}
