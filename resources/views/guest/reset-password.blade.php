@extends('layouts.guest')

@section('title', 'Reset Password')

@section('master.class', 'page-signin')

@section('guest.body')

	<div class="signin-container">

		<div class="signin-form">
			<form action="index.html" id="login-form">
				<div class="row-fluid clearfix text-center">
					<div class="col-md-12">
						<img src="/images/logo-home-et.png" alt="">
					</div>
				</div>
				<div class="signin-text">
					<span class="text-primary">Casting Director Module</span>
				</div>

				<div class="form-group ">
					<input type="password" name="email" id="enter-password" class="form-control input-lg" placeholder="Enter Password" autofocus data-required>
				</div>

				<div class="form-group ">
					<input type="password" name="password" id="confirm-password" class="form-control input-lg" placeholder="Confirm Password" data-required>
				</div>
				<div class="form-actions">
					<input type="submit" value="Reset Password" class="signin-btn bg-primary" id="reset-password">
					<!-- <a href="/forgot-password" class="forgot-password" id="forgot-password-link">Forgot your password?</a> -->
				</div>

				<div class="row margin-top-small">
					<div id="invalid-pass" style="display:none;" class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Invalid Password
					</div>
				</div>
			</form>
		</div>

	</div>

	<div class="not-a-member">
		Not a member? <a href="/register">Sign Up</a>
	</div>

@stop
