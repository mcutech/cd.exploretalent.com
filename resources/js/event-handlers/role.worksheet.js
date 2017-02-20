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

handler.prototype.refresh = function() { self.core.service.databind('#schedules', { data : [] });
	$('#schedules').append('<div class="text-center"> <h1><i class="fa fa-spinner fa-spin"></i></h1> </div>');
	var promise = $.when();
	if (!self.campaign) {
		// get campaign object first
		var data = {
			query : [
				[ 'with', 'bam_role.bam_casting' ],
				[ 'where', 'bam_role_id', '=', self.roleId ],
				[ 'orderBy', 'created_at', 'DESC' ]
			],
		};

		promise = self.core.resource.campaign.get(data)
			.then(function(res){
				self.campaign = _.first(res.data);
				return $.when();
			});
	}

	promise.then(function() {
			if (self.campaign)
				return self.getSchedules();
			else
				return $.when();
		})
		.then(function(res) {
			if (res) {
				_.each(res.data, function(s) {
					s.campaign = self.campaign;
					if (!s.conversation) {
						s.conversation = { messages : [] };
					}

					_.each(s.conversation.messages, function(val, ind){
						s.conversation.messages[ind].created_at += ' GMT-0700';
					});
				});

				self.core.service.databind('#campaign-details', self.campaign);
				self.core.service.databind('#schedules', res);
				self.core.service.paginate('#worksheet-pagination', { total : res.total, class : 'pagination', name : 'page', per_page: res.per_page });
				self.core.service.paginate('#worksheet-pagination2', { total : res.total, class : 'pagination', name : 'page', per_page: res.per_page });
			}
			else {
				self.core.service.databind('#schedules', { data : [] });
				alert('Worksheet not available. Create an invite first.');
			}
		});
}

handler.prototype.getSchedules = function() {
	var qs = self.core.service.query_string();

	var data = {
		query : [
			[ 'join', 'bam.laret_users', 'bam.laret_users.bam_talentnum', '=', 'search.talents.talentnum' ],
			[ 'join', 'bam.laret_schedules', 'bam.laret_schedules.invitee_id', '=', 'bam.laret_users.id' ],
			[ 'where', 'bam.laret_schedules.bam_role_id', '=', self.campaign.bam_role_id ],
			[ 'where', 'bam.laret_schedules.rating', '<>', 0 ],
			[ 'select', 'bam.laret_schedules.id AS schedule_id' ]
		],
		page : qs.page || 1
	};

	var form = self.core.service.form.serializeObject('#filter-form');

	if (form.confirmation_status) {
		data.query.push([ 'where', 'bam.laret_schedules.invitee_status', '=', form.confirmation_status ]);
	}

	if (form.callback_status) {
		data.query.push([ 'where', 'bam.laret_schedules.status', '=', form.callback_status ]);
	}

	if (form.talentname) {
		data.query.push([ 'where',
			[
				[ 'where', 'fname', 'LIKE', '%' + form.talentname + '%' ],
				[ 'orWhere', 'lname', 'LIKE', '%' + form.talentname + '%' ],
				[ 'orWhere', 'talentlogin', 'LIKE', '%' + form.talentname + '%' ],
				[ 'orWhere', 'talentnum', 'LIKE', '%' + form.talentname + '%' ]
			]
		]);
	}

	if (form.notes) {
		data.query.push([ 'join', 'bam.laret_schedule_notes', 'bam.laret_schedule_notes.schedule_id', '=', 'bam.laret_schedules.id' ])
		data.query.push([ 'where', 'bam.laret_schedule_notes.body', 'LIKE', '%' + form.notes + '%' ]);
	}

	var talents;

	return self.core.resource.search_talent.get(data)
		.then(function(res) {
			talents = res;
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
					[ 'with', {
						'conversation.messages': [
							['skip', 0],
							['take', 5],
							[ 'orderBy', 'created_at', 'DESC' ]
						]
					}],
				],
				per_page : 25
			}

			return self.core.resource.schedule.get(data2);
		})
		.then(function(res) {
			res.total = talents.total;
			console.log(res);
			return $.when(res);
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
			// self.refresh();
			if ($element.hasClass('accept-button')) {
				$element.removeClass('btn-outline').addClass('btn-success');
				$element.siblings('.decline-button').removeClass('btn-danger');
			}
			else if ($element.hasClass('decline-button')) {
				$element.removeClass('btn-outline').addClass('btn-danger');
				$element.siblings('.accept-button').removeClass('btn-success');
			}
		});
}

handler.prototype.updateScheduleCDStatus = function(e) {
	e.preventDefault();
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

			//self.refresh();

			if($element.hasClass('callback-button')){

				if($element.hasClass('btn-success')){
				 	$element.removeClass('btn-success');
				 	$element.addClass('btn-outline');
				}else{
				 	$element.removeClass('btn-outline');
				 	$element.addClass('btn-success');
				 	if($element.parent('.actions-content').find('.hired-button').hasClass('btn-success'))
				 	{
				 		$element.parent('.actions-content').find('.hired-button').removeClass('btn-success');
				 		$element.parent('.actions-content').find('.hired-button').addClass('btn-outline');
				 	}
				}
			}
			if($element.hasClass('hired-button')){
			 	if($element.hasClass('btn-success')){
			 	  	$element.removeClass('btn-success');
			 	  	$element.addClass('btn-outline');
			 	}else{
			 	  	$element.removeClass('btn-outline');
			 	  	$element.addClass('btn-success');
			 	  	if($element.parent('.actions-content').find('.callback-button').hasClass('btn-success'))
				 	{
				 		$element.parent('.actions-content').find('.callback-button').removeClass('btn-success');
				 		$element.parent('.actions-content').find('.callback-button').addClass('btn-outline');
				 	}
			 	}
			}
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

	// databind dummy to modal first
	var dummy = {
		schedule : {
			bam_role : { },
			invitee : {
				bam_talentci : {
					getPrimaryPhoto : function() { },
					getFullName : function() { },
					getLocation : function() { },
					getAge : function() { },
					heightText : function() { },
					bam_talentinfo1 : { }
				}
			},
		},
		campaign : { },
		messages : [ ]
	}

	self.core.service.databind('#message-modal', dummy);

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
			_.each(conversation.messages, function(val, ind){
				conversation.messages[ind].created_at += ' GMT-0700';

				// check if contains youtube video
				var regex = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
				var path = val.body.match(regex);

				if (path && path.length >= 8 && path[7]) {
					var embed = '<br/><iframe style="border:0px" width="420" height="315" src="https://www.youtube.com/embed/' + path[7] + '"> </iframe>';
					val.body += embed;
				}
			});

			$('#message-modal #messages .per-message:not([data-bind-template])').remove();
			self.core.service.databind('#message-modal', conversation);
			$('#message-modal #messages-container').animate({ scrollTop: $('#message-modal #messages').height() }, 1000);
			self.conversation = conversation;
		});
}

handler.prototype.reply = function() {
	if ($('#message-text').val()) {
		var data = {
			conversationId 	: self.conversation.id,
			user_id 		: self.user.id,
			body			: $('#message-text').val()
		};

		$('#message-text').val('');
		$('#reply-button').addClass('disabled');

		self.core.resource.message.post(data)
			.then(function() {
				self.refreshMessages(self.conversation.schedule.id);
				$('#reply-button').removeClass('disabled');
			});
	}
}

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
