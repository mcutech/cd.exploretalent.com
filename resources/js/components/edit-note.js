module.exports = function (core, user) {
  let $this, scheduleId, noteId
  $(document).on('click', '.show-edit-note-btn', function (e) {
    e.preventDefault()
    $this = $(this)
    let id = $this.attr('data-id').split('-')
    scheduleId = id[0]
    noteId = id[1]

    if (scheduleId) {
      let data = {
        scheduleId: scheduleId,
        noteId: noteId
      }

      core.resource.schedule_note.get(data)
        .then(function (res) {
          core.service.databind('#talent-edit-note-modal', res)
          $('#talent-edit-note-modal').modal('show')
        })
    }
  })

  $(document).on('click', '#edit-note-btn', function () {
    if (scheduleId && noteId) {
      let data = {
        scheduleId: scheduleId,
        noteId: noteId,
        body: $('#edit-note-body').val()
      }

      if (!data.body) {
        $('#edit-note-required').fadeIn().delay(3000).fadeOut()
      } else {
        core.resource.schedule_note.patch(data)
          .then(function (res) {
            $('#edit-note-success').fadeIn().delay(3000).fadeOut()
            $this.parents('.note-item').find('.note-body').text(res.body)
            $('#talent-edit-note-modal').modal('hide')
          })
      }
    }
  })
}
