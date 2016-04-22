module.exports = function(core, user){
	var handler = require('../event-handlers/talent.favorite.js')(core, user);

	$(document).on('click', '.rating-button', handler.refreshCastingRole);
	$(document).on('change', '#casting-list', handler.selectCastingRole);
	$(document).on('click', '#btn-add-to-likeitlist', handler.addToLikeitlist);

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


};
