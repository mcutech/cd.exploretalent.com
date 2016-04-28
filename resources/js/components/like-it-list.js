module.exports = function(core, user) {
	var projects;
	var user_id
	var bam_role_id;
	var $button;

	$(document).on('click', '#add-to-like-it-list', function() {
		$('#add-like-it-list-modal #casting-list').val(-1).select2();
		$('#add-like-it-list-modal #role-list').val(-1).select2();

		var promise = $.when();
		var $this = $(this);
		$button = $this;

		var id = $this.parent().attr('data-id');
		id = id.split('-');
		user_id = id[0];

		if (id.length > 1 && parseInt(id[1])) {
			bam_role_id = id[1];
			addToLikeItList();
		}
		else {
			$('#add-like-it-list-modal').modal('show');

			if (!projects) {
				var data = {
					q : [
						[ 'with', 'bam_roles' ]
					]
				}

				promise = core.resource.project.get(data);
			}

			promise.then(function(res) {
				if (!projects) {
					projects = res;
				}

				core.service.databind('#add-like-it-list-modal #casting-list', projects);
			});
		}
	});

	$('#add-like-it-list-modal #casting-list').on('change', function() {
		var project = _.find(projects.data, function(p) {
			return p.casting_id == $('#add-like-it-list-modal #casting-list').val();
		});

		core.service.databind('#add-like-it-list-modal #role-list', project);
	});

	$('#add-like-it-list-button').on('click', addToLikeItList);

	function addToLikeItList() {
		if (!bam_role_id)
			bam_role_id = $('#add-like-it-list-modal #role-list').val();

		var data = {
			q : [
				[ 'where', 'bam_role_id', '=', bam_role_id ],
				[ 'where', 'invitee_id', '=', user_id ],
				[ 'where', 'rating', '<>', 0 ]
			]
		}

		core.resource.schedule.get(data)
			.then(function(res) {
				var data = {
					bam_role_id    : bam_role_id,
					rating         : 5,
					invitee_id     : user_id,
					inviter_id     : user.id,
					invitee_status : self.core.resource.schedule_cd_status.PENDING,
					inviter_status : self.core.resource.schedule_cd_status.PENDING,
					status         : self.core.resource.schedule_status.PENDING
				}

				if (res.total) {
					alert('Already added to like it list.');
				}
				else {
					core.resource.schedule.post(data)
						.then(function(res) {
							$button.removeClass('btn-outline').addClass('btn-success');
							$button.find('span').text('Added LIke it List');
							$('#add-like-it-list-modal').modal('hide');
						});
				}
			})
	}
}
