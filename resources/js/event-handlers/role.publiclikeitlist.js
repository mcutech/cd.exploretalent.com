'use strict';

function handler(core, user){

	self = this;
	self.core = core;
	self.user = user;

}

handler.prototype.viewAllModal = function() {
	// fire modal code
	
    $(".modal-photos").modal();
}

module.exports = function(core, user) {
	return new handler(core, user);
};
