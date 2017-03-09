module.exports = function(core, user) {
	var $this, scheduleId;

	$(document).on('click', '.show-add-note-btn', function() {
		$this = $(this);
		scheduleId = $this.attr('data-id');

		if (scheduleId) {
			$('#talent-add-note-modal').modal('show');
		}
		else {
			alert('Add talent on like it list first to add note.');
		}
	});

	$(document).on('click', '#add-note-btn', function() {
		if (scheduleId ) {
			var data = {
				scheduleId : scheduleId,
				body : $('#add-note-body').val()
			}

			if (!data.body) {
				$('#add-note-required').fadeIn().delay(3000).fadeOut();
			}
			else {
				core.resource.schedule_note.post(data)
					.then(function(res) {
						$('#add-note-success').fadeIn().delay(3000).fadeOut();

						var str = '<div class="note-item">' +
							'<div class="name-date">' +
								'<div class="name">' + user.bam_cd_user.getFullName() + '</div>' +
								'<div class="date">' + moment(res.created_at).format('YY-MM-DD HH:mm') + '</div>' +
							'</div>' +
							'<div class="note-body">' + res.body + '</div>' +
							'<a href="#" class="show-edit-note-btn" data-id="' + scheduleId + '-' + res.id + '"><i class="fa fa-pencil"></i> Edit this note</a>' +
						'</div>';

						$this.parents('.talent-note-v2').find('#schedule-notes').append(str);
						$('#add-note-body').val('');

						setTimeout(function() {
							$('#talent-add-note-modal').modal('hide');
						}, 800);
						
					});
			}
		}
	});
}
