@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Settings', 'url' => '/settings', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-cog page-header-icon"></i> Settings
@stop

@section('sidebar.body')
<div id="settings" class="row"> <div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10">
		<form class="panel form-horizontal" action="#" id="settings-form" role="form" novalidate>
			<div class="panel-heading">
				<span class="panel-title"><i class="fa fa-fw fa-user"></i> User Information</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group no-margin-hr">
							<label for="company" class="control-label">Company name *</label>
							<input data-bind="<%= company %>" type="text" class="form-control" name="company" id="company" placeholder="Company name" data-required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="fname" class="control-label">First name *</label>
							<input data-bind="<%= fname %>" type="text" class="form-control" name="fname" id="fname" placeholder="First name" data-required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="lname" class="control-label">Last name *</label>
							<input data-bind="<%= lname %>" type="text" class="form-control" name="lname" id="lname" placeholder="Last name" data-required>
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
								<option value="">Select state</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group no-margin-hr">
							<label for="zip" class="control-label">Zip</label>
							<input data-bind="<%= zip %>" type="text" class="form-control" name="zip" id="zip" placeholder="Zip">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="phone1" class="control-label">Phone 1 *</label>
							<input data-bind="<%= phone1 %>" type="text" class="form-control" name="phone1" id="phone1" placeholder="Phone 1" data-required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="phone2" class="control-label">Phone 2</label>
							<input data-bind="<%= phone2 %>" type="text" class="form-control" name="phone2" id="phone2" placeholder="Phone 2">
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
							<input data-bind="<%= fax %>" type="text" class="form-control" name="fax" id="fax" placeholder="Fax">
						</div>
					</div>
				</div>
				<hr>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="email1" class="control-label">Email 1 *</label>
							<input data-bind="<%= email1 %>" type="email" class="form-control" name="email1" id="email1" placeholder="Email 1" data-required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="email2" class="control-label">Email 2</label>
							<input data-bind="<%= email2 %>" type="email" class="form-control" name="email2" id="email2" placeholder="Email 2">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group no-margin-hr">
							<label for="pass" class="control-label">Password</label>
							<input data-bind="<%= pass %>" type="password" class="form-control" name="pass" id="pass" placeholder="Password">
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
