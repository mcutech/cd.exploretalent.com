'use strict';
var _ = require('lodash');

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;
	self.refreshFilters();
}

handler.prototype.refresh = function() {
	var form = self.core.service.form.serializeObject('#filter-form');
	var data = {
		query : [
			[ 'with', 'bam_role.schedules.invitee.bam_talentci.bam_talent_media2' ],
			[ 'with', 'bam_role.schedules.conversation.messages' ],
			[ 'with', 'bam_role.schedules.schedule_notes' ],
			[ 'where', 'status', '=', 1 ]
		]
	};

	if (parseInt(form.role)) {
		data.query.push([ 'where', 'bam_role_id', '=', form.role ]);
	}

	self.core.resource.campaign.get(data)
		.then(function(res) {
			var campaign = _.first(res.data);
			if (campaign && campaign.bam_role) {
				// assign bam_role and campaign objects so we don't have to query again
				_.each(campaign.bam_role.schedules, function(n) {
					n.bam_role = campaign.bam_role;
					n.campaign = campaign;
				});
				// remove schedule with rating = 0
				_.remove(campaign.bam_role.schedules, function(n) {
					return n.rating == 0;
				});
			}
			else {
				// create empty object so we wont have problems in databind
				campaign = {
					bam_role : {
						schedules : []
					}
				};
			}
			self.core.service.databind('#schedules', campaign);
			self.campaign = campaign;
		});
}

handler.prototype.refreshFilters = function() {
	self.core.resource.project.get()
		.then(function(res) {
			res.data = [ { casting_id : 0, name : 'All Projects' } ].concat(res.data);
			self.core.service.databind('#projects-list', res);
			$('#projects-list').val(0);
		});

	self.refresh();
}


handler.prototype.refreshFilterRoles = function() {
	var data = {
		projectId 	: $('#projects-list').val()
	};

	self.core.resource.job.get(data)
		.then(function(res) {
			res.data = [ { role_id : 0, name : 'All Roles' } ].concat(res.data);
			self.core.service.databind('#roles-list', res);
			$('#roles-list').val(0);
		});
}

handler.prototype.updateScheduleStatus = function(e) {
	var $element = $(e.target);

	if (!$element.is('button')) {
		$element = $element.parents('button');
	}

	var status = 0;
	if ($element.hasClass('accept-button')) {
		status = 2;
	}
	else if ($element.hasClass('decline-button')) {
		status = 3;
	}

	var data = {
		scheduleId		: $element.parents('.schedule').attr('data-id'),
		invitee_status	: status
	}

	self.core.resource.schedule.patch(data)
		.then(function(res) {
			self.refresh();
		});
}

handler.prototype.updateScheduleCDStatus = function(e) {
	var $element = $(e.target);

	if (!$element.is('button')) {
		$element = $element.parents('button');
	}

	var status = 0;

	if ($element.hasClass('callback-button')) {
		status = 2;
	}
	else if ($element.hasClass('hired-button')) {
		status = 3;
	}

	var data = {
		scheduleId 	: $element.parents('.schedule').attr('data-id'),
		status 		: status
	}

	self.core.resource.schedule.patch(data)
		.then(function(res) {
			self.refresh();
		});
}

handler.prototype.setScheduleId = function(e) {
	var $element = $(e.target);

	if (!$element.is('button')) {
		$element = $element.parents('button');
	}

	self.scheduleId = $element.parents('.schedule').attr('data-id');
}

handler.prototype.reschedule = function(e) {
	var data = {
		when 			: $('#reschedule-date').val(),
		scheduleId 		: self.scheduleId,
		invitee_status 	: 4
	};

	self.core.resource.schedule.patch(data)
		.then(function(res) {
			self.refresh();
		});
}

handler.prototype.addNote = function() {
	var data = {
		user_id		: self.user.id,
		scheduleId	: self.scheduleId,
		body		: $('#note-text').val()
	}

	self.core.resource.schedule_note.post(data)
		.then(function(res) {
			self.refresh();
		});
}

handler.prototype.showMessageModal = function(e) {
	var $element = $(e.target);

	if (!$element.is('button')) {
		$element = $element.parents('button');
	}

	var scheduleId = $element.parents('.schedule').attr('data-id');
	self.refreshMessages(scheduleId);
}

handler.prototype.refreshMessages = function(scheduleId) {
	var data = {
		query : [
			[ 'where', 'schedule_id', '=', scheduleId ],
			[ 'with', 'schedule.bam_role' ],
			[ 'with', 'schedule.invitee.bam_talentci.bam_talentinfo2' ],
			[ 'with', 'schedule.invitee.bam_talentci.bam_talentinfo1' ],
			[ 'with', 'schedule.invitee.bam_talentci.bam_talent_media2' ],
			[ 'with', 'messages.user.bam_talentci' ],
			[ 'with', 'messages.user.bam_cd_user' ],
		]
	};

	self.core.resource.conversation.get(data)
		.then(function(res) {
			if (res.total) {
				return $.when(res);
			}
			else {
				return self.core.resource.schedule.get({ scheduleId : scheduleId })
					.then(function(res) {
						// create new conversation
						var data2 = {
							schedule_id 	: scheduleId,
							user_id 		: res.inviter_id,
							user_ids		: [ res.inviter_id, res.invitee_id ]
						};

						return self.core.resource.conversation.post(data2);
					})
					.then(function() {
						return self.core.resource.conversation.get(data);
					});
			}
		})
		.then(function(res) {
			var conversation = _.first(res.data);
			conversation.campaign = self.campaign;
			self.core.service.databind('#message-modal', conversation);
			self.conversation = conversation;
		});
}

handler.prototype.reply = function() {
	var data = {
		conversationId 	: self.conversation.id,
		user_id 		: self.user.id,
		body			: $('#message-text').val()
	};

	self.core.resource.message.post(data)
		.then(function() {
			self.refreshMessages(self.conversation.schedule.id);
		});
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
