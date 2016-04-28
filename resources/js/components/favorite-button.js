module.exports = function() {
	$(document).on('click', '.favorite-button', function() {
		var $this = $(this);
		var $star = $this.find('i');
		var talentnum = $this.attr('data-id');

		if (parseInt(talentnum)) {
			// not favorited yet, favorite it!
			if ($star.hasClass('text-default')) {
				var data = {
					bam_talentnum : talentnum
				}

				// create favorite
				self.core.resource.favorite_talent.post(data)
				.then(function(res) {
					// change color
					$star.removeClass('text-default').addClass('text-warning');
				});
			}
			// already favorite, remove favorite!
			else if($star.hasClass('text-warning')) {
				// use id as favorite id
				var data = {
					favoriteId : talentnum
				}

				// remove favorite
				self.core.resource.favorite_talent.delete(data)
				.then(function(res) {
					// change color
					$star.removeClass('text-warning').addClass('text-default');
				});
			}
		}
	});
}
