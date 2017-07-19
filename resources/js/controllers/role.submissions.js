module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.submissions.js')(core, user, projectId, roleId);

	$('#hasphotoForm').click(function() {
		if($('#has-photo').is(':checked')) {
			$("#radio-selected").text("Yes");
		}
		else   {
			$("#radio-selected").text("Any");
		}
	});

	/* TAB */
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {		
		$('#address-search').val($(this).siblings('input[type="hidden"').val());				
	});

	$('#place-miles').slider('value', $('#place-miles-in').val());	

	$('#place-miles').on('slide', function(e, ui) {
		$('#place-miles-in').val(ui.value);
	});

	$('#genderForm :checkbox').change(function (){
		if ($(this).is(':checked')) {
			if($('#checkboxFemale').is(':checked')){
				$('#selected').text($(this).val());
			}
			else if($('#checkboxMale').is(':checked')){
				$('#selected').text($(this).val());
			}
			if($('#checkboxMale').is(':checked') && $('#checkboxFemale').is(':checked')){
				$('#selected').text("Any");
			}
		} else {
			if($('#checkboxFemale').is(':checked')){
				$('#selected').text("Female");
			}
			else if($('#checkboxMale').is(':checked')){
				$('#selected').text("Male");
			}
			if(!$('#checkboxMale').is(':checked') && !$('#checkboxFemale').is(':checked')){
				$('#selected').text("Any");
			}
		}
	});

	$('#roles-list').on('change', handler.refreshRole);
	$('#search-button').on('click', handler.findMatches);
	$('#add-all-button').on('click', handler.addAll);

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

	$('#show_only_matched').on('click', function(){		
		handler.findMatches();		
	});
}
