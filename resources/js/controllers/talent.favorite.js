module.exports = function(core, user){
	var handler = require('../event-handlers/talent.favorite.js')(core, user);

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

	$('.search-button').on('click', handler.refresh);		

	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		$('#address-search').val($(this).siblings('input[type="hidden"').val());
	});


	$('#place-miles').slider('value', $('#place-miles-in').val());

	$('#place-miles').on('slide', function(e, ui) {
		$('#place-miles-in').val(ui.value);
	});


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

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.refresh(true);
		}
	});
};
