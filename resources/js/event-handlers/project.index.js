'use strict'

function handler (core, user) {
  self = this
  self.core = core
  self.user = user
  self.refreshList()
}

handler.prototype.refreshList = function () {
  let searchflag = 0

  let qs = self.core.service.query_string()

  let data = {
    query: [
      [ 'with', 'bam_roles' ],
      ['orderBy', 'sub_timestamp', 'DESC']
    ],
    page: qs.page || 1,
    per_page: 20
  }

  let searchterm = $('#project-name').val()

  if (searchterm) {
    data.query.push([ 'where', [
      [ 'where', 'project', 'LIKE', '%' + searchterm + '%' ],
      [ 'orWhere', 'name', 'LIKE', '%' + searchterm + '%' ],
      [ 'orWhere', 'name_original', 'LIKE', '%' + searchterm + '%' ],
      [ 'orWhere', 'casting_id', '=', searchterm ]
    ]
    ])
  }

  let status = $('#project-status').val()

  if (status) {
    if (status == '1') { // ACTIVE
      data.query.push([ 'where', [
        [ 'where', 'status', '=', 1 ]
      ]
      ])
    } else if (status == '0') { // PENDING REVIEW
      data.query.push([ 'where', [
        [ 'where', 'status', '=', 0 ]
      ]
      ])
    } else { // ALL
      // push nothing to query
    }
  }

  let btnExpiredCastings = $('#btn-show-expired-castings')

  if (qs.expired == 'true') {
    btnExpiredCastings.text('Do not show Expired Projects')
    btnExpiredCastings.attr('href', 'projects?expired=false')
  } else {
    // only filter expired by searchterm isn't provided
    if (!searchterm) {
      data.query.push([ 'where', 'asap', '>=', Math.floor(new Date().getTime() / 1000)])
    }

    btnExpiredCastings.text('Show Expired Projects')
    btnExpiredCastings.attr('href', 'projects?expired=true')
  }

  if (searchterm || status != '') {
    searchflag = 1
  }

  console.log(searchflag)

  self.core.resource.project.get(data)
    .then(function (res) {
      if (!res.total) {
        // check if we have no search result, get active and non active projects
        // let expiredCount = 0,
        //   notExpiredCount = 0;

        // self.core.resource.project.get({ query : [ [ 'where', 'asap', '>=', Math.floor( (new Date().getTime() / 1000) - (8*3600)) ] ] })
        //   .then(function(res) {
        //     notExpiredCount = res.total;

        //     return self.core.resource.project.get({ query : [ [ 'where', 'asap', '<', Math.floor(new Date().getTime() / 1000) ] ] });
        //   })
        //   .then(function(res) {
        //     expiredCount = res.total;

        //     if (notExpiredCount == 0) {
        //       if (expiredCount > 0) {
        //         $('#btn-show-expired-castings').removeClass('hide');
        //         // show you have no active project message
        //         $('#no-projects-found').removeClass('hide');
        //         //hide loading GIF
        //         $('.loading-projects').addClass('hide');

        //       }
        //       else {
        //         // redirect to welcome page
        //         window.location = '/welcome';
        //       }
        //     }
        //   });

        // to show the expired button
        self.core.resource.project.get({ query: [ [ 'where', 'asap', '<', Math.floor(new Date().getTime() / 1000) ] ] })
          .then(function (res) {
            if (res.total) {
              $('#btn-show-expired-castings').removeClass('hide')
            }
          })
        self.core.service.databind('#projects-list', res)

        $('#no-projects-found').removeClass('hide')

        if (searchflag == 1) {
          $('.no-projects-text').text('The Project Does Not Exist')
        } else {
          $('.no-projects-text').text('You Have No Active Projects')
        }
      } else {
        $('#no-projects-found').addClass('hide')

        self.core.resource.project.get({ query: [ [ 'where', 'asap', '<', Math.floor(new Date().getTime() / 1000) ] ] })
          .then(function (res) {
            if (res.total) {
              $('#btn-show-expired-castings').removeClass('hide')
            }
          })

        self.core.service.databind('#projects-list', res)
        self.core.service.paginate('#projects-pagination', { total: res.total, class: 'pagination', name: 'page', per_page: res.per_page })
        self.core.service.paginate('#projects-pagination2', { total: res.total, class: 'pagination', name: 'page', per_page: res.per_page })
      }
    })
}

module.exports = function (core, user) {
  return new handler(core, user)
}
