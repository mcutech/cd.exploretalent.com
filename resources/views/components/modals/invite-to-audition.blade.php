<div id="invite-to-audition-modal" class="modal fade invite-to-auditions-wrapper" tabindex="-1" role="dialog" style="display: none;">
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
							<label class="checkbox-inline"><input name="rating" type="checkbox" value="1" /> 1</label>
							<label class="checkbox-inline"><input name="rating" type="checkbox" value="2" /> 2</label>
							<label class="checkbox-inline"><input name="rating" type="checkbox" value="3" /> 3</label>
							<label class="checkbox-inline"><input name="rating" type="checkbox" value="4" /> 4</label>
							<label class="checkbox-inline"><input name="rating" type="checkbox" value="5" /> 5</label>
							<label class="checkbox-inline"><input name="rating" type="checkbox" value="all" checked /> all</label>
						</div>
					</div>
					<h4>Casting Details</h4>
					<div class="form-group">
						<label class="col-md-3">Name</label>
						<div class="col-md-9">
							<input name="casting_name" data-bind="<%= name %>" type="text" class="form-control input-sm" data-date-picker data-date-format="yy-mm-dd" readonly style="cursor: pointer; background-color: #fff">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3">Date</label>
						<div class="col-md-9">
							<input name="casting_date" data-bind="<%= date.formatYMD(asap) %>" type="text" class="form-control input-sm" data-date-picker data-date-format="yy-mm-dd" readonly style="cursor: pointer; background-color: #fff">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Address</label>
						<div class="col-md-9">
							<input name="address1" data-bind="<%= address1 %>" type="text" class="form-control input-sm margin-bottom-normal" placeholder="Address line 1">
							<input name="address2" data-bind="<%= address2 %>" type="text" class="form-control input-sm" placeholder="Address line 2">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">City</label>
						<div class="col-md-4">
							<input name="city" data-bind="<%= city %>" type="text" class="form-control input-sm">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">State</label>
						<div class="col-md-4">
							<select name="state" data-bind="<%= state %>" type="text" class="form-control input-sm">
								<option>New York</option>
							</select>
						</div>
						<label class="col-md-2"> Zipcode</label>
						<div class="col-md-3">
							<input name="zip" data-bind="<%= zip %>" type="text" class="form-control input-sm">
						</div>
					</div>
					<h4>Role</h4>
					<div class="form-group">
						<label class="control-label col-md-3">Name</label>
						<div class="col-md-9">
							<input name="role_name" data-bind="<%= role.name %>" type="text" class="form-control input-sm" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Description</label>
						<div class="col-md-9">
							<textarea name="role_des" data-bind="<%= role.des %>" type="text" class="form-control input-sm"></textarea>
						</div>
					</div>
					<h4>Message</h4>
					<div class="form-group">
						<label class="control-label col-md-3">Message</label>
						<div class="col-md-9">
							<textarea name="message" type="text" rows="4" class="form-control input-sm">
Please send Name, Email, Tel, Zip, Age, Gender. **If submitting for a minor, please send parents Name, Email, Tel, Zip and ALSO include childs Name, Age, Gender to

Note: A waiver for the CD\'s policies will be provided for your reference at the audition. MUST LIVE WITHIN 250 MILES OF LOS ANGELES and be agreeable to come for callback auditions if you qualify. Travel expenses not provided. Not all auditioned will get called back or cast. Roles will be cast on a first come first served basis and closed as they are filled so respond asap if you are interested.**

ET DISCLAIMER:

Please do not click reply to this email. Please follow instructions in the body of the message on what email address to send your information to.
Explore Talent has a strict set of policies that we enforce to protect you.  Casting with Nudity, Adult content, or any other projects that require fees will not be allowed. Exclusive contracts will not be accepted as well.  If at anytime, you receive an invite for an event that violates these conditions, Exploretalent suggests complete disassociation with that project or if you choose to continue then proceed with the utmost caution and at your own risk in terms of any communication, or agreement with these Casting Directors, or projects.
Exclusive contracts will not be accepted as well.

Please DO NOT SEND MONEY TO CASTING DIRECTORS OR ANYONE ELSE EVER.

Thanks.
MANAGEMENT
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Send SMS</label>
						<div class="col-md-9">
							<label class="inline-checkbox"><input name="sms" type="checkbox" id="send-sms-slidetoggle">  Text Message to Talent</input></label>
						</div>
					</div>
					<div id="sms-message-textarea" class="form-group display-none">
						<label class="control-label col-md-3">SMS Message</label>
						<div class="col-md-9">
							<textarea name="sms_body" type="text" rows="4" class="form-control input-sm"></textarea>
						</div>
					</div>
					<hr>
					<div class="text-center">
						<button id="send-invites-button" type="button" class="btn btn-success">Send Invites</button>
						<button class="btn btn-warning" data-dismiss="modal">Cancel</button>
						<span id="send-invites-success" class="text-success margin-left-medium" style="display: none;"><i class="fa fa-check"></i> Invites sent successfully.</span>
					</div>

				</form>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
