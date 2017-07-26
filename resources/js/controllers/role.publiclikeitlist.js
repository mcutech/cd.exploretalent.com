module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.publiclikeitlist.js')(core, user, projectId, roleId);

	$('#roles-list').on('change', handler.refreshRole);
	$('#search-button').on('click', function(e) {
		handler.filter = 1;
		handler.findMatches();
	});	

	$('#place-miles').slider('value', $('#place-miles-in').val());	

	$('#place-miles').on('slide', function(e, ui) {
		$('#place-miles-in').val(ui.value);
	});

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

	$(document).on('keyup', '#age-min-input', function() {
		$('#age-range-slider').slider('values', 0, $(this).val());
		$('input[name="age_min"]').val($(this).val());
	});

	$(document).on('keyup', '#age-max-input', function() {
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

	//add notes function back
	$(document).on('click', '.talent-note-v2 .back-btn', function(){
		$(this).closest('.talent-item').find('.talent-note-v2').hide();
		$(this).closest('.talent-item').find('.talent-photo-v2').show();
		$(this).closest('.talent-item').find('.talent-functions-v2 ').show();
	});

	//talents add notes function
	$(document).on('click', '.talent-function-icon.notes', function() {
		$(this).closest('.talent-item').find('.talent-note-v2').show();
		$(this).closest('.talent-item').find('.talent-photo-v2').hide();
		$(this).closest('.talent-item').find('.talent-functions-v2 ').hide();
	});

	$('.mark-talent-as-checked').hide();

};
