module.exports = function () {
  $(document).on('click', '.favorite-button', function () {
    let $this = $(this)
    let talentnum

    let id = $this.parent().attr('data-id')

    if (id) {
      id = id.split('-')
      talentnum = id.length > 2 ? id[2] : id[0]
    } else {
      let getURL = window.location.pathname
      let extracttn = getURL.split('/')
      talentnum = extracttn[2]
    }

    if (parseInt(talentnum)) {
      // not favorited yet, favorite it!
      if ($this.hasClass('btn-outline')) {
        let data = {
          bam_talentnum: talentnum
        }

        // create favorite
        self.core.resource.favorite_talent.post(data)
        .then(function (res) {
          // change color
          if ($this.hasClass('producers-pick-btn')) { $this.removeClass('btn-outline').addClass('producers-pick') } else { $this.removeClass('btn-outline').addClass('btn-warning') }
          $this.find('.favorite-button-text').text('Added to Favorites')
        })
      }
      // already favorite, remove favorite!
      else if ($this.hasClass('btn-warning') || $this.hasClass('producers-pick')) {
        // use id as favorite id
        let data = {
          favoriteId: talentnum
        }

        // remove favorite
        self.core.resource.favorite_talent.delete(data)
        .then(function (res) {
          // change color
          if ($this.hasClass('producers-pick')) { $this.removeClass('producers-pick').addClass('btn-outline') } else { $this.removeClass('btn-warning').addClass('btn-outline') }
          $this.find('.favorite-button-text').text('Add to Favorites')
        })
      }
    }
  })
}
