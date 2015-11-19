<div id="message-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
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
					<div class="label-primary">
						<div class="col-md-2 col-xs-2 prof-pic">
							<img data-bind="<%= schedule.invitee.bam_talentci.getPrimaryPhoto() %>" width="70%" />
						</div>
						<div class="row">
							<div class="col-md-10 margin-top-small">
								<div class="prof-info">
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
							</div>
						</div>

					</div>

					<div class="row message">
						<div class="col-md-12" id="messages">
							<div data-bind-template="#messages" data-bind-value="messages" class="col-md-12 padding-normal per-message padding-left-zero">
								<div class="margin-left-small">
									<span class="name" data-bind="<%= user.bam_talentci ? user.bam_talentci.getFullName() : user.bam_cd_user.getFullName() %>"></span>
									<span class="time" data-bind="<%= created_at %>"></span>
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
				<!-- <div class="col&#45;md&#45;12 padding&#45;zero margin&#45;top&#45;small&#45;normal"> -->
				<!-- 	<div class="btn&#45;group"> -->
				<!-- 		<button class="btn btn&#45;success btn&#45;xs" rel="tooltip" title="confirmed"> -->
				<!-- 			<i class="fa fa&#45;check"></i> Confirmed -->
				<!-- 		</button> -->
				<!-- 		<button class="btn btn&#45;default  btn&#45;xs" rel="tooltip" title="cancelled"> -->
				<!-- 			<i class="fa fa&#45;times"></i> Cancelled -->
				<!-- 		</button> -->
				<!-- 		<button class="btn btn&#45;default  btn&#45;xs" rel="tooltip" title="reschedule"> -->
				<!-- 			<i class="fa fa&#45;clock&#45;o"></i> Rescheduled -->
				<!-- 		</button> -->
				<!-- 	</div> -->
				<!-- </div> -->
			</div>
		</div> <!-- / .modal -->
	</div>
</div>
