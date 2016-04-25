<div id="ghost-onboarding-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div id ="ghost-onboarding" class="modal-content">
			<form id="ghost-onboarding-form">
			<div class="modal-body">

				<div class="row-fluid clearfix">
					<div class="col-md-12 form-group">
						<h5 id ="ghost-modal-header" class="margin-bottom-zero text-bold">To continue searching for talents please confirm some missing information.</h5>
					</div>
				</div>

				<div id="onboarding-confirm-email" class="row-fluid clearfix">
					<div class="col-md-12 form-group">
						<label class="control-label">Confirm Email Address</label>
						<input class="form-control" data-bind="<%= email1 %>" name ="email1" placeholder="Email Address...">
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<a class="btn btn-success proceed-btn confirm-email" href="#">Confirm Email</a>
						</div>
					</div>
				</div> <!-- Confirm Email -->

				<div id="onboarding-create-password" class="row-fluid clearfix" hidden>
					<div class="col-md-12 form-group">
						<label class="control-label">Please <i>Create a Password</i> to continue</label>
						<input type="password" class="form-control" id="cdpass" name= "cdpass" placeholder="Enter Password...">
						<input type="password" class="form-control margin-top-small" id="conf_cdpass" name= "conf_cdpass" placeholder="Confirm Password...">
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<span id="empty_password" class="text-danger margin-left-medium hide"><i class="fa fa-close"></i> Password Cannot Be Empty</span>
							<span id="password_mismatch" class="text-danger margin-left-medium hide"><i class="fa fa-close"></i> Password Does Not Match</span>
							<a class="btn btn-success proceed-btn create-password" href="#">Create Password</a>
						</div>
					</div>
				</div> <!-- Create Password -->

				<div id="onboarding-other-email" class="row-fluid clearfix" hidden>
					<div class="col-md-12 form-group">
						<label class="control-label">Do you have <i>another Email Address?</i></label>
						<input class="form-control" data-bind="<%= email2 %>" name ="email2" placeholder="Another Email...">
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<a class="btn btn-outline" href="">Skip</a>
							<a class="btn btn-success proceed-btn other-email" href="#">Confirm Email</a>
						</div>
					</div>
				</div> <!-- Other Email -->

				<div id="onboarding-name" class="row-fluid clearfix" hidden>
					<div class="col-md-12 form-group">
						<label class="control-label">Enter your Name</label>										<input class="form-control" data-bind="<%= fname %>" name ="fname" placeholder="First Name...">						
							<input class="form-control margin-top-small" data-bind="<%= lname %>" name="lname" placeholder="Last Name...">
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<a class="btn btn-success proceed-btn your-name" href="#">Continue</a>
						</div>
					</div>
				</div> <!-- Name -->

				<div id="onboarding-contact-num1" class="row-fluid clearfix" hidden>
					<div class="col-md-12 form-group">
						<label class="control-label">Enter <i>Contact Number</i> where you can be reached</label>
						<input class="form-control" data-bind="<%= phone1 %>" placeholder="Contact Number...">
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<a class="btn btn-success proceed-btn contact-num1" href="#">Continue</a>
						</div>
					</div>
				</div> <!-- Contact 1-->	

				<div id="onboarding-contact-num2" class="row-fluid clearfix" hidden>
					<div class="col-md-12 form-group">
						<label class="control-label">Do you have <i>another Contact Number</i>?</label>
						<input class="form-control" data-bind="<%= phone2 %>" placeholder="Another Contact Number...">
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<a class="btn btn-outline" href="">Skip</a>
							<a class="btn btn-success proceed-btn contact-num2" href="#">Continue</a>
						</div>
					</div>
				</div> <!-- Contact 2-->

				<div id="onboarding-company-name" class="row-fluid clearfix" hidden>
					<div class="col-md-12 form-group">
						<label class="control-label">Company Name</label>
						<input class="form-control" data-bind="<%= company %>" name="company" placeholder="Company...">
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<a class="btn btn-outline" href="">Skip</a>
							<a class="btn btn-success proceed-btn company-name" href="#">Continue</a>
						</div>
					</div>
				</div> <!-- Company Name-->	

				<div id="onboarding-congratulations" class="row-fluid clearfix" hidden>
					<div class="col-md-12 form-group">
						<p>You have completed the information needed to create your account, 
						and you can now continue to use us to find all the talents for your projects.</p>
					</div>
					<div class="col-md-12">
						<div class="pull-right">
							<a class="btn btn-success proceed-btn congratulations-text" data-dismiss="modal" href="">Continue using site</a>
						</div>
					</div>
				</div> <!-- Congratulations-->																				
			</div>
			</form>
		</div>
	</div>
</div>