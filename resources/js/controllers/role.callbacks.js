module.exports = function(core, user, roleId, projectId) {
	var handler = require('../event-handlers/role.callbacks.js')(core, user, roleId, projectId);

	$('#roles-list').on('change', handler.refreshRole);
	$('#search-button').on('click', handler.findMatches);

	//refine search toggle location search
	$(document).on('click', '#location-search-change-btn', function(e){
		e.preventDefault();
		$('#location-search-display').show();
		$('#location-search-change').hide();
	});
	$(document).on('click', '#location-search-display-btn', function(e){
		e.preventDefault();
		$('#location-search-display').hide();
		$('#location-search-change').show();
	});

	$(document).on('click', '#toggle-advanced-filters-btn', function(e) {
		e.preventDefault();
		$('#advanced-filters-div').slideToggle();
	});

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.findMatches(true);
		}
	});

	$(document).on('keyup', '#age-min-text', function() {
		$('#age-range-slider').slider('values', 0, $(this).val());
		$('input[name="age_min"]').val($(this).val());
	});

	$(document).on('keyup', '#age-max-text', function() {
		$('#age-range-slider').slider('values', 1, $(this).val());
		$('input[name="age_max"]').val($(this).val());
	});

	$(document).on('change', '#height-min-dropdown', function() {
		$('#height-range-slider').slider('values', 0, $(this).val());
		$('input[name="height_min"]').val($(this).val());
	});

	$(document).on('change', '#height-max-dropdown', function() {
		$('#height-range-slider').slider('values', 1, $(this).val());
		$('input[name="height_max"]').val($(this).val());
	});
}
