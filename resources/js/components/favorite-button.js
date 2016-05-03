module.exports = function() {
	$(document).on('click', '.favorite-button', function() {
		var $this = $(this);
		var id = $this.parent().attr('data-id');
		id = id.split('-');
		var talentnum = id.length > 2 ? id[2] : id[0];

		if (parseInt(talentnum)) {
			// not favorited yet, favorite it!
			if ($this.hasClass('btn-outline')) {
				var data = {
					bam_talentnum : talentnum
				}

				// create favorite
				self.core.resource.favorite_talent.post(data)
				.then(function(res) {
					// change color
					$this.removeClass('btn-outline').addClass('btn-warning');
					$this.find('.favorite-button-text').text('Added to Favorites');
				});
			}
			// already favorite, remove favorite!
			else if($this.hasClass('btn-warning')) {
				// use id as favorite id
				var data = {
					favoriteId : talentnum
				}

				// remove favorite
				self.core.resource.favorite_talent.delete(data)
				.then(function(res) {
					// change color
					$this.removeClass('btn-warning').addClass('btn-outline');
					$this.find('.favorite-button-text').text('Add to Favorites');
				});
			}
		}
	});
}
