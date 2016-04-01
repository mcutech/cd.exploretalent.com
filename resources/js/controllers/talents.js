module.exports = function(core, user) {
	var handler = require('../event-handlers/talents.js')(core, user);

	$(document).on('click', '.fav-btn', handler.addToFavorites);
	$('#talent-filter-button').on('click', handler.refresh);

	$("#jquery-select2-example").select2({
		allowClear: true,
		placeholder: "Seach market"
	});

	$("#jquery-select2-example").on('change', handler.addToMarket);
	$(document).on('click', '.check-markets', handler.removeFromMarket);

	$(document).on('click', '#search-talent-btn', handler.refresh);

	$(document).on('keydown', '#search-talent-input', function(e) {
		if(e.which == 13) { // enter key
			$('#search-talent-btn').click();
		}
	});
	$(document).on('click', '.rating-button', handler.refreshCastingRole);
	$(document).on('change', '#casting-list', handler.selectCastingRole);
	$(document).on('click', '#btn-add-to-likeitlist', handler.addToLikeitlist);

	// talents functions menu
	$(document).on('mouseover', '.talent-function-icon.profile', function() {
		$('.text-function-label.profile').css("opacity", "1");
	});

	$(document).on('mouseover', '.talent-function-icon.photos', function(){
	    $('.text-function-label.photos').css("opacity", "1");
	});

	$(document).on('mouseover', '.talent-function-icon.notes', function(){
	    $('.text-function-label.notes').css("opacity", "1");
	});

	$(document).on('mouseover', '.talent-function-icon.favorites', function(){
	    $('.text-function-label.favorites').css("opacity", "1");
	});

	$(document).on('mouseover', '.talent-function-icon.add-role', function(){
	    $('.text-function-label.add-role').css("opacity", "1");
	});

	$(document).on('mouseleave', '.talent-function-icon', function(){
		$('.text-function-label').css("opacity", "0");
	});	

	//talents add notes function
	$(document).on('click', '.talent-function-icon.notes', function() {
		$(this).closest('.talent-item').find('.talent-note-v2').show();
		$(this).closest('.talent-item').find('.talent-photo-v2').hide();
		$(this).closest('.talent-item').find('.talent-functions-v2 ').hide();
	});

	//add notes function back
	$(document).on('click', '.talent-note-v2 .back-btn', function(){
		$(this).closest('.talent-item').find('.talent-note-v2').hide();
		$(this).closest('.talent-item').find('.talent-photo-v2').show();
		$(this).closest('.talent-item').find('.talent-functions-v2 ').show();
	});
}
