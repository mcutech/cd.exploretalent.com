module.exports = function(core, user) {
	var scheduleId;

	$(document).on('click', '.show-add-note-btn', function() {
		var $this = $(this);
		scheduleId = $this.attr('data-id');

		if (scheduleId) {
			$('#talent-add-note-modal').modal('show');
		}
		else {
			alert('Add talent on like it list first to add note.');
		}
	});

	$(document).on('click', '#add-note-btn', function() {
		if (scheduleId) {
			var data = {
				scheduleId : scheduleId,
				body : $('#add-note-body').val()
			}

			console.log(data);
		}
	});
}
