module.exports = function(core) {
	$('[data-slider]').each(function() {
		var options = {
			disabled	: $(this).data('disabled'),
			max 		: $(this).data('max'),
			min 		: $(this).data('min'),
			orientation : $(this).data('orientation'),
			range 		: $(this).data('range'),
			step 		: $(this).data('step'),
			value 		: $(this).data('value'),
			values 		: $(this).data('values'),
		};

		switch($(this).data('type')) {
			case 'age':
				options.slide = function(event, ui) {
					$('#age-min-text').text(ui.values[0]);
					$('[name="age_min"]').val(ui.values[0]);
					$('#age-max-text').text(ui.values[1])
					$('[name="age_max"]').val(ui.values[1]);
				}

				break;
			case 'height':
				options.slide = function(event, ui) {
					var feet1 = Math.floor(ui.values[0] / 12);
					var inches1 = ui.values[0] % 12;
					var feet2 = Math.floor(ui.values[1] / 12);
					var inches2 = ui.values[1] % 12;

					$('#height-min-text').text(feet1 + "'" + inches1 + '"');
					$('#height-max-text').text(feet2 + "'" + inches2 + '"');
					$('[name="height_min"]').val(ui.values[0]);
					$('[name="height_max"]').val(ui.values[1]);
				}
				break;
		}

		$(this).slider(options);
	});
};
