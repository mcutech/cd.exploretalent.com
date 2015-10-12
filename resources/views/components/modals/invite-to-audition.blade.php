<div id="invite-to-audition-modal" class="modal fade invite-to-auditions-wrapper" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Talent to Invite</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<span><strong>Casting Name:</strong> <span data-bind="<%= role.name %>"></span></span>
					</div>
					<div class="col-md-6">
						<span><strong>Talents:</strong> <span data-bind="<%= role.likeitlist.total %>"></span></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 margin-top-small">
						<div class="checkbox">
							<label for="acc-toggle">
								<input type="checkbox" id="acc-toggle"> Enter Date and Location
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div id="date-location" class="hide">
						<div class="col-md-4">
							<div class="input-group date">
								<input type="text" class="form-control" placeholder="date" data-date-picker data-date-format="yy/mm/dd">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3" placeholder="Location"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 margin-top-normal">
						<div>
							<textarea class="form-control" rows="3" placeholder="Message"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 margin-top-normal">
						<div class="checkbox">
							<label>
								<input type="checkbox"> Allow Replies
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-align-right">
						<button class="btn btn-default" type="submit" id="send-invites-button">Send</button>
					</div>
				</div>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
