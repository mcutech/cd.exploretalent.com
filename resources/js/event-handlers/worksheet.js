'use strict';

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
			[ 'with', 'inviter.bam_cd_user.user' ],
			[ 'with', 'invitee.bam_talentci.bam_talent_media2' ],
			[ 'with', 'bam_role' ]
		]
	};

	if (parseInt(form.role)) {
		data.query.push([ 'where', 'bam_role_id', '=', form.role ]);
	}

	self.core.resource.schedule.get(data)
		.then(function(res) {
			console.log(res);
			self.core.service.databind('#schedules', res);
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
	else if ($element.hasClass('reschedule-button')) {
		status = 4;
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

module.exports = function(core, user, projectId, roleId) {
	return new handler(core, user, projectId, roleId);
}
