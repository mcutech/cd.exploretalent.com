<div id="invite-to-audition" class="modal fade invite-to-auditions-wrapper" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Talent to Invite</h4>
			</div>
			<div class="modal-body">
				<form role="form" class="invite-to-audition-form">
					<div class="row form-group">
					  <label class="col-sm-3">
					    Select by Rating
					  </label>
					  <div class="col-sm-9">
					    <label class="checkbox-inline"><input type="checkbox" /> 1</label>
					    <label class="checkbox-inline"><input type="checkbox" /> 2</label>
					    <label class="checkbox-inline"><input type="checkbox" /> 3</label>
					    <label class="checkbox-inline"><input type="checkbox" /> 4</label>
					    <label class="checkbox-inline"><input type="checkbox" /> 5</label>
					    <label class="checkbox-inline"><input type="checkbox" checked /> all</label>
					  </div>
					</div>
					<h4>Review Details</h4>
					<div class="form-group">
						<label class="col-md-3">Casting Date</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm" data-date-picker data-date-format="yy-mm-dd" readonly style="cursor: pointer; background-color: #fff">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Address</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm margin-bottom-normal" placeholder="Address line 1">
							<input type="text" class="form-control input-sm" placeholder="Address line 2">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">City</label>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">State</label>
						<div class="col-md-4">
							<select type="text" class="form-control input-sm">
								<option></option>
							</select>
						</div>
						<label class="col-md-2"> Zipcode</label>
						<div class="col-md-3">
							<input type="text" class="form-control input-sm">
						</div>
					</div>
					<h4>Wardrobes</h4>
					<div class="form-group">
						<label class="control-label col-md-3">Role Name 1</label>
						<div class="col-md-9">
							<textarea type="text"  class="form-control input-sm"></textarea>
						</div>
					</div>
					<h4>Message</h4>
					<div class="form-group">
						<label class="control-label col-md-3">Subject</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Message</label>
						<div class="col-md-9">
							<textarea type="text" rows="4" class="form-control input-sm"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Send SMS</label>
						<div class="col-md-9">
							<label class="inline-checkbox"><input type="checkbox" id="send-sms-slidetoggle">  Text Message to Talent</input></label>
						</div>
					</div>
					<div id="sms-message-textarea" class="form-group display-none">
						<label class="control-label col-md-3">SMS Message</label>
						<div class="col-md-9">
							<textarea type="text" rows="4" class="form-control input-sm"></textarea>
						</div>
					</div>
					<hr>
					<div class="text-center">
						<button class="btn btn-success">Send Invites</button>
						<button class="btn btn-warning" data-dismiss="modal">Cancel</button>
					</div>

				</form>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
