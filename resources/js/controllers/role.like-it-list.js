module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.like-it-list.js')(core, user, projectId, roleId);

	$('#roles-list').on('change', handler.refreshRole);
	$('#search-button').on('click', function(e) {
		handler.filter = 1;
		handler.findMatches();
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

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.findMatches(true);
		}
	});

	$('#send-invites-button').on('click', handler.sendInvites);

	$('#additional-filters').removeClass('hide');

	$(document).on('click', '.like-it-list-checkbox', function() {

		$(this).toggleClass('checked');
		handler.countCheckedTalents();

		$('#remove-all-checked-talents-btn-disabled').removeAttr('disabled');


		var checked_talents = [];
		var checked = $('.like-it-list-checkbox.checked');

		$.each(checked, function(index, value) {
			checked_talents.push(value);
		});

		var length = checked_talents.length;
		if (length == 0) {
			$('#remove-all-checked-talents-btn-disabled').prop('disabled', true);
			$('#mark-all-talents-as-checked-btn').removeClass('hide');
			$('#mark-all-talents-as-unchecked-btn').addClass('hide');
		}

	});

	$(document).on('click', '#mark-all-talents-as-checked-btn', function() {

		var checkbox = $('.like-it-list-checkbox');

		$.each(checkbox, function(index, value) {
			// check if already checked
			if(!$(this).hasClass('checked')) {
				// check if not 1st element (dummy data-bind element has no id attribute)
				if($(this).attr('id')) {
					$(this).click();
				}
			}
		});

		$('#mark-all-talents-as-checked-btn').addClass('hide');
		$('#mark-all-talents-as-unchecked-btn').removeClass('hide');
	});

	$(document).on('click', '#mark-all-talents-as-unchecked-btn', function() {


		var checkbox = $('.like-it-list-checkbox');

		$.each(checkbox, function(index, value) {
			// check if already checked
			if($(this).hasClass('checked')) {
				// check if not 1st element (dummy data-bind element has no id attribute)
				if($(this).attr('id')) {
					$(this).click();
				}
			}
		});

		$('#remove-all-checked-talents-btn-disabled').prop('disabled', true);
		$('#mark-all-talents-as-checked-btn').removeClass('hide');
		$('#mark-all-talents-as-unchecked-btn').addClass('hide');
	});

	$(document).on('click', '#remove-all-checked-talents-btn', handler.removeAllChecked);

	$(document).on('click', '#remove-all-like-it-list', handler.removeAllLikeItList);

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
}
