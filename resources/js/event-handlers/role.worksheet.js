'use strict';
var _ = require('lodash');

function handler(core, user, projectId, roleId) {
	self = this;
	self.core = core;
	self.user = user;
	self.projectId = projectId;
	self.roleId = roleId;

	self.refresh();
}

handler.prototype.refresh = function() {
	self.core.service.databind('#schedules', { data : [] });
	$('#schedules').append('<div class="text-center"> <h1><i class="fa fa-spinner fa-spin"></i></h1> </div>');
	var promise = $.when();
	if (!self.campaign) {
		// get campaign object first
		var data = {
			query : [
				[ 'with', 'bam_role.bam_casting' ],
				[ 'where', 'bam_role_id', '=', self.roleId ],
				[ 'orderBy', 'created_at', 'DESC' ]
			]
		};

		promise = self.core.resource.campaign.get(data)
			.then(function(res){
				self.campaign = _.first(res.data);
				self.core.service.databind('#campaign-details', self.campaign);
				return $.when();
			});
	}

	promise.then(function() {
			return self.getSchedules();
		})
		.then(function(res) {
			_.each(res.data, function(s) {
				s.campaign = self.campaign;
				if (!s.conversation) {
					s.conversation = { messages : [] };
				}
			});

			self.core.service.databind('#schedules', res);
		});
}

handler.prototype.getSchedules = function() {
	var data = {
		query : [
			[ 'join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'search.talents.talentnum' ],
			[ 'join', 'bam.laret_schedules', 'bam.laret_schedules.invitee_id', '=', 'bam.laret_users.id' ],
			[ 'where', 'bam.laret_schedules.bam_role_id', '=', self.campaign.bam_role_id ],
			[ 'where', 'bam.laret_schedules.rating', '<>', 0 ],
			[ 'select', 'bam.laret_schedules.id AS schedule_id' ]
		]
	};

	var qs = self.core.service.form.serializeObject('#filter-form');

	if (qs.confirmation_status) {
		data.query.push([ 'where', 'bam.laret_schedules.invitee_status', '=', qs.confirmation_status ]);
	}

	if (qs.callback_status) {
		data.query.push([ 'where', 'bam.laret_schedules.status', '=', qs.callback_status ]);
	}

	if (qs.talentname) {
		data.query.push([ 'where',
			[
				[ 'where', 'fname', 'LIKE', '%' + qs.talentname + '%' ],
				[ 'orWhere', 'lname', 'LIKE', '%' + qs.talentname + '%' ],
				[ 'orWhere', 'talentlogin', 'LIKE', '%' + qs.talentname + '%' ],
				[ 'orWhere', 'talentnum', 'LIKE', '%' + qs.talentname + '%' ]
			]
		]);
	}

	if (qs.notes) {
		data.query.push([ 'join', 'bam.laret_schedule_notes', 'bam.laret_schedule_notes.schedule_id', '=', 'bam.laret_schedules.id' ])
		data.query.push([ 'where', 'bam.laret_schedule_notes.body', 'LIKE', '%' + qs.notes + '%' ]);
	}

	return self.core.resource.search_talent.get(data)
		.then(function(res) {
			var schedule_ids = _.map(res.data, function(talent) {
				return talent.schedule_id;
			});

			schedule_ids.push(0);

			var data2 = {
				query : [
					[ 'whereIn', 'schedules.id', schedule_ids ],
					[ 'with', 'invitee.bam_talentci.bam_talentinfo1' ],
					[ 'with', 'invitee.bam_talentci.bam_talentinfo2' ],
					[ 'with', 'invitee.bam_talentci.bam_talent_media2' ],
					[ 'with', 'schedule_notes.user.bam_cd_user' ],
					[ 'with', 'conversation.messages.user.bam_talentci' ],
					[ 'with', 'bam_role' ],
				]
			}

			return self.core.resource.schedule.get(data2);
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

		if($element.hasClass('btn-success')) {
			status = 1;
		}
		else {
			status = 2;
		}
	}

	else if ($element.hasClass('hired-button')) {

		if($element.hasClass('btn-success')) {
			status = 1;
		}
		else {
			status = 3;
		}
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
			// get conversation
			var data = {
				query : [
					[ 'where', 'schedule_id', '=', self.scheduleId ]
				]
			};

			return self.core.resource.conversation.get(data);
		})
		.then(function(res) {
			var conversation = _.first(res.data);
			// send reschedule message

			var data = {
				conversationId  : conversation.id,
				user_id 		: self.user.id,
				body 			: 'Rescheduled to <span style="color:#ffa500;font-weight:bold;">' + $('#reschedule-date').val() + '</span>'
			};

			return self.core.resource.message.post(data);
		})
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

	var conversation;

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
			conversation = _.first(res.data);
			var data = {
				query : [
					[ 'where', 'bam_role_id', '=', conversation.schedule.bam_role_id ]
				]
			};
			return self.core.resource.campaign.get(data);
		})
		.then(function(res) {
			conversation.campaign = _.first(res.data);
			console.log(conversation);
			_.each(conversation.messages, function(val, ind){
				var pstdate = new Date(val.created_at);
				pstdate.setHours(pstdate.getHours() + 8);
				console.log(ind);
				conversation.messages[ind].created_at = pstdate;
			});
			/*var pstdate = moment(conversation.campaign.created_at);
			console.log(pstdate);*/
			self.core.service.databind('#message-modal', conversation);
			$('#message-modal #messages-container').animate({ scrollTop: $('#message-modal #messages').height() }, 1000);
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
