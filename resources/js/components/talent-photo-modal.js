'use strict'

module.exports = function (core, user) {
  $(document).on('click', '#talent-photo, #view-resume-photos', function (e) {
    let id

    // Bind null data first
    self.core.service.databind('#talent-photos-modal, #talent-view-photos-modal', {
      getFullName: function () { return 'Loading' },
      getAge: function () { return 'Loading' },
      bam_talent_media2: []
    })

    if ($(e.target).is('a')) {
      id = $(e.target).attr('data-id')
    } else {
      id = $(e.target).parents('a').attr('data-id')
    }

    let data = {
      talentId: id,
      withs: [
        'bam_talent_media2',
        'bam_talentinfo1'
      ]
      // wheres : [
      //   [ 'where', 'talent_media2.type', '=', '1' ],
      // ]
    }

    return self.core.resource.talent.get(data)
      .then(function (talent) {
        let photosArray = []

        $.each(talent.bam_talent_media2, function (index, value) {
          value.count = index
          // add only profile pic and main pictures (no thumbnails)
          if (value.type == 1 || value.type == 2) {
            photosArray.push(value)
          }
        })

        talent.bam_talent_media2 = photosArray
        self.core.service.databind('#talent-photos-modal, #talent-view-photos-modal', talent)

        // add active class to 1st photo in talent-view-photos modal so it will appear
        $('#carousel-custom #carousel-inner div.item').eq(1).addClass('active')
        $('#carousel-custom #carousel-inner div.item').not(':eq(1)').removeClass('active')

        $('#carousel-indicators li').eq(1).addClass('active')

        $('#carousel-indicators li').each(function (index, value) {
          $(this).attr('data-slide-to', index)
        })

        hidePrevOrNextBtn()
      })
  })

  $(document).on('click', 'a.left.carousel-control, a.right.carousel-control', function () {
    hidePrevOrNextBtn()
  })

  $(document).on('click', '.carousel-indicators>li', function () {
    setTimeout(function () {
      hidePrevOrNextBtn()
    }, 800)
  })

  let hidePrevOrNextBtn = function () {
    // hide previous button if first picture is visible
    if ($('#carousel-custom #carousel-inner div.item').eq(1).hasClass('active')) {
      $('a.left.carousel-control').hide()
    } else {
      $('a.left.carousel-control').show()
    }

    // hide next button if last picture is visible
    if ($('#carousel-custom #carousel-inner div.item').last().hasClass('active')) {
      $('a.right.carousel-control').hide()
    } else {
      $('a.right.carousel-control').show()
    }
  }
}
