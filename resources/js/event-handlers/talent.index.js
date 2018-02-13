'use strict'
let _ = require('lodash')

function handler (core, user) {
  self = this
  self.core = core
  self.user = user

  self.xorigins = []

  if (self.user.user_apps.length > 0) {
    _.each(self.user.user_apps, function (app) {
      self.xorigins = _.union(self.xorigins, _.map(app.app.app_xorigins, function (xorigin) {
        return xorigin.x_origin
      }))
    })
  }

  self.xorigins = self.xorigins.length == 0 ? [-1] : self.xorigins

  self.refresh()
}

handler.prototype.refresh = function (append) {
  if (self.refreshing) {
    return
  }

  append = append === true

  if (append && self.done) {
    return
  }

  self.page = append ? self.page + 1 : 1
  self.refreshing = true

  let talents
  let promises = []

  let data = self.getFilters()
  $('#talent-search-loader').show()

  if (!append) {
    $('#talent-search-result').hide()
    $('#no-talent-result').addClass('hidden')
    self.preloadTalents = null
  }

  self.getTalents().then(function (talents) {
        // check if talent has a greeting video
    _.each(talents.data, function (value, index) {
      promises.push(self.getTalentVideos(value))
    })

    return $.when.apply($, promises).then(function () {
      try {
                // console.log(talents);
        self.core.service.databind('#submission-total', talents)
        self.core.service.databind('#talent-search-result', talents, append)
      } catch (e) {
        console.log(e)
      }

      self.refreshing = false

      $('#talent-search-loader').hide()
      if (!append) {
        $('#talent-search-result').show()
        if (talents.total === 0) {
          $('#no-talent-result').removeClass('hidden')
        }
      }
    })
  })
}

handler.prototype.getTalents = function () {
  let deferred = $.Deferred()

  if (self.preloadTalents) {
    let ret = self.preloadTalents
    self.searchTalents(true).then(function (res) {
      self.preloadTalents = res
    })
    deferred.resolve(ret)
  } else {
    self.searchTalents().then(function (res) {
      self.searchTalents(true).then(function (res) {
        self.preloadTalents = res
      })
      deferred.resolve(res)
    })
  }

  return deferred.promise()
}

handler.prototype.searchTalents = function (nextPage) {
  let deferred = $.Deferred()

  if (nextPage) {
    self.page = self.page + 1
  }

  let talents
  let promise

  let data = self.getFilters()
  let form = self.core.service.form.serializeObject('#talent-filter-form')

  if (form.search_text && !isNaN(form.search_text)) {
    if (nextPage) {
      promise = $.when({})
    } else {
      promise = self.core.resource.talent.get({ talentId: form.search_text, query: [ [ 'with', 'bam_talent_media2' ], [ 'with', 'bam_talentinfo1' ] ] })
    }
  } else {
    promise = self.core.resource.talent.search(data)
  }

  promise.then(function (talents) {
    console.log(talents)
    if (!talents.data) {
      talents.schedule = {}
      talents.favorite = null

      talents = _.assign(talents, talents.bam_talentinfo1)

      let ret = {
        data: [
          talents
        ],
        total: 1,
        per_page: 25
      }

      talents = ret
    }

    _.each(talents.data, function (talent) {
      talent.talent_role_id = 0
      talent.talent_project_id = 0
    })

    deferred.resolve(talents)
  })

  return deferred.promise()
}

handler.prototype.getFilters = function () {
  let form = self.core.service.form.serializeObject('#talent-filter-form')
  let data = {
    query: [
    ],
    per_page: 24,
    page: self.page
  }

  if (self.xorigins.length > 0) {
    data.query.push([ 'whereIn', 'x_origin', self.xorigins ])
  }

  if (form.address_search == 0) { // market filter
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
  } else if (form.address_search == 1) { // location filter
    let lngLat = JSON.parse(form.lng_lat)

    if (lngLat.length > 0) {
      let d = lngLat.distance / 69

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
      data.query.push([ 'where', 'dobyyyy', '<=', new Date().getFullYear() - parseInt(form.age_min) ])
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

  if (form.has_photo == 'true') {
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

  return data
}

handler.prototype.getTalentVideos = function (talent) {
  let deferred = $.Deferred()
  let data = {
    query: [
            [ 'where', 'talentnum', '=', talent.talentnum ],
            [ 'where', 'type', '=', '6' ]
    ]
  }

  self.core.resource.talent_videos.get(data)
        .then(function (video) {
          talent.video_id = (video.data.length > 0) ? video.data[0].video_id : ''
          deferred.resolve()
        })

  return deferred.promise()
}

module.exports = function (core, user) {
  return new handler(core, user)
}
