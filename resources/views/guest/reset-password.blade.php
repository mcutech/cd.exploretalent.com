@extends('layouts.guest')

@section('title', 'Reset Password')

@section('master.class', 'page-signin')

@section('guest.body')

	<div class="signin-container">

		<div class="signin-form" id="reset-password-form">
			<div class="row-fluid clearfix text-center">
				<div class="col-md-12">
					<img src="/images/logo-home-et.png" alt="">
				</div>
			</div>
			<div class="signin-text">
				<span class="text-primary">Casting Director Module</span>
			</div>

			<div class="form-group ">
				<input type="password" name="password1" id="enter-password" class="form-control input-lg" placeholder="Enter Password" autofocus data-required>
			</div>

			<div class="form-group ">
				<input type="password" name="password2" id="confirm-password" class="form-control input-lg" placeholder="Confirm Password" data-required>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-actions">
						<input type="submit" value="Reset Password" class="signin-btn bg-primary" id="reset-password-btn">
					</div>
				</div>
				<div class="col-md-7 margin-top-small">
					<div id="invalid-pass" class="alert alert-danger margin-bottom-zero" role="alert" style="display: none;">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Invalid Password! Please make sure that:
						<ul>
							<li>The password is entered twice</li>
							<li>Both passwords have the same value</li>
						</ul>
					</div>
					<div id="success-pass" class="alert alert-success margin-bottom-zero" role="alert" style="display: none;">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Success!</span>
						Password has been changed.
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="not-a-member">
		Not a member? <a href="/register">Sign Up</a>
	</div>

@stop
