@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Settings', 'url' => '/settings', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-cog page-header-icon"></i> Settings
@stop

@section('sidebar.body')
<div id="settings" class="row"> <div class="col-lg-10">
		<form class="panel form-horizontal" action="#" id="settings-form" role="form" novalidate>
			<div class="panel-heading">
				<span class="panel-title"><i class="fa fa-fw fa-user"></i> User Information</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group no-margin-hr">
							<label for="company" class="control-label">Company name *</label>
							<input data-bind="<%= company %>" type="text" class="form-control" name="company" placeholder="Company name" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="fname" class="control-label">First name *</label>
							<input data-bind="<%= fname %>" type="text" class="form-control" name="fname" placeholder="First name" data-validate="text" data-validate-error="This is not a valid first name." />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="lname" class="control-label">Last name *</label>
							<input data-bind="<%= lname %>" type="text" class="form-control" name="lname" placeholder="Last name" data-validate="text" data-validate-error="This is not a valid last name." />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group no-margin-hr">
							<label for="address1" class="control-label">Street address 1</label>
							<input data-bind="<%= address1 %>" type="text" class="form-control" name="address1" id="address1" placeholder="Street address 1">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group no-margin-hr">
							<label for="address2" class="control-label">Street address 2</label>
							<input data-bind="<%= address2 %>" type="text" class="form-control" name="address2" id="address2" placeholder="Street address 2">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group no-margin-hr">
							<label for="city" class="control-label">City</label>
							<input data-bind="<%= city %>" type="text" class="form-control" name="city" id="city" placeholder="City">
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group no-margin-hr">
							<label for="state" class="control-label">State</label>
							<select data-bind="<%= state %>" class="form-control" name="state" id="state">
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District Of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Lousiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
								<option value="">Not Selected</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group no-margin-hr">
							<label for="zip" class="control-label">Zip</label>
							<input  data-bind="<%= zip %>" type="text" class="form-control" name="zip" placeholder="Zip" data-validate="zip" data-validate-error="This is not a valid zip code." />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="phone1" class="control-label">Phone 1 *</label>
							<input data-bind="<%= phone1 %>" type="text" class="form-control" name="phone1" placeholder="Phone 1" data-validate="phone" data-validate-error="This is not a valid phone number." />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="phone2" class="control-label">Phone 2</label>
							<input data-bind="<%= phone2 %>" type="text" class="form-control" name="phone2" placeholder="Phone 2" data-validate="phone-not-required" data-validate-error="This is not a valid phone number." />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="website" class="control-label">Website</label>
							<input data-bind="<%= website %>" type="text" class="form-control" name="website" id="website" placeholder="Website">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="fax" class="control-label">Fax</label>
							<input  data-bind="<%= fax %>" type="text" class="form-control" name="fax" placeholder="Fax" data-validate="phone-not-required" data-validate-error="This is not a valid fax number." />
						</div>
					</div>
				</div>
				<hr>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="email1" class="control-label">Email 1 *</label>
							<input data-bind="<%= email1 %>" type="email" class="form-control" id="emailid" name="email1" placeholder="Email 1" data-validate="email" data-validate-error="This is not a valid e-mail address." />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="email2" class="control-label">Email 2</label>
							<input data-bind="<%= email2 %>" type="email" class="form-control" name="email2" placeholder="Email 2" data-validate="email-not-required" data-validate-error="This is not a valid e-mail address." />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="pass" class="control-label">Enter Password </label>
							<input type="password" class="form-control" id="pass" name="pass" placeholder="Password" data-validate="" data-validate-error="This field is required." >
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="pass2" class="control-label">Confirm Password </label>
							<input type="password" class="form-control" id="pass2" placeholder="Password" data-validate="" data-validate-error="This field is required." >
						</div>
					</div>
				</div>
				<button id="update-settings-button" type="submit" class="btn btn-primary"><i class="fa fa-fw fa-user"></i> Update information</button>
				<span id="update-settings-success" class="text-success margin-left-medium" style="display: none;"><i class="fa fa-check"></i> Settings successfully updated.</span>
			</div>
		</form>
	</div>
</div>
@stop
