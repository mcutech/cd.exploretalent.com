'use strict';

function handler(core, user ) {
	self = this;
	self.core = core;
	self.user = user;
	self.refreshMessages();
}

handler.prototype.refreshMessages = function() {
	var data = {
		query: [
			['with', 'users.bam_talentci.bam_talent_media2'],
			['with', 'messages.user.bam_cd_user'],
			['with', 'messages.user.bam_talentci.bam_talent_media2']
		]
	}
	self.core.resource.conversation.get(data)
		.then(function(result) {
			_.each(result.data, function(conversation, index){
				result.data[index].owner = self.user;
				console.log(result.data[index].getOtherUser());
			});
			console.log(result);
		   self.core.service.databind('#message-body', result);
			$('.message-list-'+$('#current-conversation').val()).show();
		})
}
handler.prototype.showMessages = function(e){
	console.log('ok');
	console.log($(e.target));
	var conversationId;
	if ($(e.target).hasClass('conversation'))
		conversationId = $(e.target).attr('data-id');
	else
		conversationId = $(e.target).parents('.conversation').attr('data-id');
	console.log(conversationId);

	$('.message-list').hide();
	$('.message-list-'+conversationId).show();
	$('#current-conversation').val(conversationId);
	// $(e.target).parents('.conversation').find('.message-list').show();
	$('#message-input').show();
};

handler.prototype.postMessage= function(){
	console.log('ok post message');
	self.core.resource.message.post({conversationId:$('#current-conversation').val(), body : $('#message-text').val() })
	self.refreshMessages();
	$('#message-text').val('');
};




module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
