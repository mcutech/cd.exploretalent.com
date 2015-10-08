 module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.publiclikeitlist.js')(core, user, projectId, roleId);

	$(document).on('click', '.view-all-modal', handler.viewAllModal);
	$(document).on('click', '#talent-photo', handler.refreshTalentPhotos);


	$(document).on('click', '.add-casting-note', handler.getDetailsForAddNoteModal);
	$('.add-note-for-talent').on('click', handler.addNoteForTalent);

	$(document).on('click', '.edit-note-link', handler.getDetailsForEditNoteModal);
	$('.edit-note-for-talent').on('click', handler.editNoteForTalent);
	$(document).on('click', '.fav-btn', handler.addToFav);
};
