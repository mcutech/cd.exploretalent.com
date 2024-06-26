module.exports = function (core, user) {
  let projects
  let user_id
  let bam_role_id
  let $button

  $(document).on('click', '.add-to-like-it-list', function () {
    if (!$(this).hasClass('liked-talent')) { // Add
      console.log($(this))
      $('#add-like-it-list-modal #casting-list').val(-1).select2()
      $('#add-like-it-list-modal #role-list').val(-1).select2()

      let promise = $.when()
      let $this = $(this)
      $button = $this
      console.log($button, 'button')

      let id = $this.parent().attr('data-id')
      id = id.split('-')
      console.log(this)
      console.log(id)
      user_id = id[0]
      console.log(user_id)

      if (id.length > 1 && parseInt(id[1])) {
        bam_role_id = id[1]
        addToLikeItList()
      } else {
        $('#add-like-it-list-modal').modal('show')

        if (!projects) {
          let data = {
            q: [
              [ 'with', 'bam_roles' ]
            ]
          }

          promise = core.resource.project.get(data)
        }

        promise.then(function (res) {
          if (!projects) {
            projects = res
          }

          core.service.databind('#add-like-it-list-modal #casting-list', projects)
        })
      }
    } else { // Remove
      if (confirm('Are you sure you want to remove this talent from your Like it List?')) {
        let $this = $(this)
        $button = $this

        let scheduleId = $button.find('.like-it-list-schedule-id').val()

        let data = {
          scheduleId: scheduleId,
          rating: 0
        }

        self.core.resource.schedule.put(data)
          .then(function (res) {
            $button.removeClass('btn-success liked-talent').addClass('btn-outline')
            $button.find('span').text('Add to Like it List')
            $button.closest('.talent-item').find('.show-add-note-btn').attr('data-id', '')
          })
      }
    }
  })

  $(document).on('mouseenter', '.add-to-like-it-list', function () {
    if ($(this).hasClass('btn-success')) {
      $(this).find('span').text('Remove from Like it List')
      $(this).find('i').removeClass('fa-check').addClass('fa-times')
      $(this).attr('title', 'Remove from Like it List')
      $(this).removeClass('btn-success')
      $(this).addClass('btn-danger')
    }
  }).on('mouseleave', '.add-to-like-it-list', function () {
    if ($(this).hasClass('btn-danger')) {
      $(this).find('span').text('Added to Like it List')
      $(this).find('i').removeClass('fa-times').addClass('fa-check')
      $(this).removeAttr('title')
      $(this).removeClass('btn-danger')
      $(this).addClass('btn-success')
    }
  })

  $('#add-like-it-list-modal #casting-list').on('change', function () {
    let project = _.find(projects.data, function (p) {
      return p.casting_id == $('#add-like-it-list-modal #casting-list').val()
    })

    core.service.databind('#add-like-it-list-modal #role-list', project)
  })

  $('#add-like-it-list-button').on('click', addToLikeItList)

  function addToLikeItList () {
    if (!bam_role_id) { bam_role_id = $('#add-like-it-list-modal #role-list').val() }

    let data = {
      q: [
        [ 'where', 'bam_role_id', '=', bam_role_id ],
        [ 'where', 'invitee_id', '=', user_id ]
      ]
    }

    core.resource.schedule.get(data)
      .then(function (res) {
        console.log(res)
        let schedule = _.first(res.data)

        if (schedule) {
          // update
          let data = {
            scheduleId: schedule.id,
            rating: 5
          }

          core.resource.schedule.patch(data)
            .then(function (res) {
              let total = parseInt($('#like-it-list-total').text().replace('(', '').replace(')', ''))

              if (total) {
                total++
              } else {
                total = 1
              }

              $('#like-it-list-total').text('(' + total + ')')

              $button.find('.like-it-list-schedule-id').val(res.id)
              $button.removeClass('btn-outline').addClass('btn-success liked-talent')
              $button.find('i').removeClass('fa-plus').addClass('fa-check')
              $button.find('span').text('Added to Like it List')
              $('#add-like-it-list-modal').modal('hide')
              $button.closest('.talent-item').find('.show-add-note-btn').attr('data-id', res.id)
            })
        } else if (!schedule) {
          // create
          let data = {
            bam_role_id: bam_role_id,
            rating: 5,
            invitee_id: user_id,
            inviter_id: user.id,
            invitee_status: self.core.resource.schedule_cd_status.PENDING,
            inviter_status: self.core.resource.schedule_cd_status.PENDING,
            status: self.core.resource.schedule_status.PENDING
          }

          core.resource.schedule.post(data)
            .then(function (res) {
              let total = parseInt($('#like-it-list-total').text().replace('(', '').replace(')', ''))

              if (total) {
                total++
              } else {
                total = 1
              }

              $('#like-it-list-total').text('(' + total + ')')

              $button.find('.like-it-list-schedule-id').val(res.id)
              $button.removeClass('btn-outline').addClass('btn-success liked-talent')
              $button.find('i').removeClass('fa-plus').addClass('fa-check')
              $button.find('span').text('Added to Like it List')
              $('#add-like-it-list-modal').modal('hide')
              $button.closest('.talent-item').find('.show-add-note-btn').attr('data-id', res.id)
            })
        }
      })
  }
}
