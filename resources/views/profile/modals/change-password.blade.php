<div id="settings-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="fa fa-lock"></i> Change Password</h4>
			</div>
			<div class="modal-body">
				<form id="password-form">					
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group no-margin-hr">
								<label for="pass" class="control-label">Enter New Password </label>
								<input type="password" class="form-control" name="new_password" placeholder="New Password" data-validate="" data-validate-error="This field is required." >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group no-margin-hr">
							<label for="pass2" class="control-label">Confirm Password </label>
							<input type="password" class="form-control" name="conf_new_password" placeholder="Confirm Password" data-validate="" data-validate-error="This field is required." >
							</div>
						</div>
					</div>
					<div class="row text-right">
						<div class="col-sm-12">							
							<span id="update-password-success" class="text-success margin-left-medium hide"><i class="fa fa-check"></i> Password Updated</span>
							<span id="update-password-fail" class="text-danger margin-left-medium hide"><i class="fa fa-close"></i> Password Does Not Match</span>			
							<button id="update-password-button" type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-lock"></i> Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	