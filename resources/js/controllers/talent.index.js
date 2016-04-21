module.exports = function(core, user) {
	var handler = require('../event-handlers/talent.index.js')(core, user);

	$(document).on('click', '.fav-btn', handler.addToFavorites);
	$('#search-button').on('click', handler.refresh);	
	$(document).on('click', '#add-to-like-it-list', handler.refreshCastingRole);
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

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.refresh(true);
		}
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

	//responsive filter turns to modal when mobile
	$(document).ready(function(){
		if($(this).width() <= 752){
			$('#filter-content-modal').css('display', 'none');
			$('#filter-content-modal').addClass('modal fade');
		}
		else{
			$('#filter-content-modal').css('display', 'block');
			$('#filter-content-modal').removeClass('modal fade');
		}
	});
	$(window).resize(function(){
		if($(this).width() <= 752){
			$('#filter-content-modal').css('display', 'none');
			$('#filter-content-modal').addClass('modal fade');
		}
		else{
			$('#filter-content-modal').css('display', 'block');
			$('#filter-content-modal').removeClass('modal fade');
		}
	});
}
