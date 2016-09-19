<div id="message-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Messaging</h4>
			</div>
			<div class="modal-body">
				<div class="messaging-modal-wrapper">
					<div class="row">
						<div class="col-md-12">
							<div class="casting-role">
								<label class="casting-name"> Role Name:</label>
								<span clas="role-name" data-bind="<%= schedule.bam_role.name %>"></span>
							</div>
						</div>
					</div>
					<div class="label-primary" style="height: 75px;">
						<div class="display-inline-block">
							<div class="" style="width:50px; display: flex; align-items: center; overflow: hidden; width: 60px; height: 75px; ">
								<img data-bind="<%= schedule.invitee.bam_talentci.getPrimaryPhoto() %>" class="img-responsive"/>
							</div>
						</div>
						<span class="display-inline-block" style="vertical-align:top;">
							<div class="prof-info" style="margin-left: 0px;">
								<div class="col-md-12">
									<span class="prof-name" data-bind="<%= schedule.invitee.bam_talentci.getFullName() %>"></span>
									<span class="closest-city" data-bind="<%= schedule.invitee.bam_talentci.getLocation() %>"></span>
									<span class="age" data-bind="<%= schedule.invitee.bam_talentci.getAge() %>"></span>
								</div>
								<div class="col-md-12">
									<span class="gender" data-bind="<%= schedule.invitee.bam_talentci.bam_talentinfo1.sex %>,"></span>
									<span class="height" data-bind="<%= schedule.invitee.bam_talentci.heightText() %>,"></span>
									<span class="weight" data-bind="<%= schedule.invitee.bam_talentci.bam_talentinfo1.weightpounds %>lbs,"></span>
									<span class="eyes" data-bind="<%= schedule.invitee.bam_talentci.bam_talentinfo1.eyecolor %>,"></span>
									<span class="build" data-bind="<%= schedule.invitee.bam_talentci.bam_talentinfo1.build %>"></span>
								</div>
							</div>
						</span>
					</div>

					<div id="messages-container" class="row message">
						<div class="col-md-12" id="messages">
							<div data-bind-template="#messages" data-bind-value="messages" class="col-md-12 padding-normal per-message padding-left-zero">
								<div class="margin-left-small">
									<span class="name" data-bind="<%= user.bam_talentci ? user.bam_talentci.getFullName() : user.bam_cd_user.getFullName() %>"></span>
									<span class="time" data-bind="<%= moment(created_at).fromNow() %>"></span>
								</div>
								<div class="margin-top-small-normal margin-left-small" data-bind="<%= body %>" data-bind-target="html">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- / .modal-body -->
			<div class="modal-footer text-align-left">
				<div class="row">
					<div class="col-md-12 margin-top-small">
						<textarea id="message-text" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="row-fluid margin-top-small">
					<div class="col-md-10 padding-zero">
						<span>
							Invited to audition for role: <span data-bind="<%= schedule.bam_role.name %>"></span> on <span data-bind="<%= campaign.created_at %>"></span>
						</span>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-success" id="reply-button">Reply</button>
					</div>
				</div>
			</div>
		</div> <!-- / .modal -->
	</div>
</div>
