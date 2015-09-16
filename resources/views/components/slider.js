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
		$(this).slider(options);
	});
};
