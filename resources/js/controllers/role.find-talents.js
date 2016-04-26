module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.find-talents.js')(core, user, projectId, roleId);

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
			handler.findMatches(true);
		}
	});
};
