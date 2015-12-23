@extends('layouts.guest')

@section('title', 'Login')

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
					<input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email / Username" autofocus data-required>
				</div>

				<div class="form-group ">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" data-required>
				</div>
				<div class="form-actions">
					<input type="submit" value="SIGN IN" class="signin-btn bg-primary" id="sign-in">
					<a href="#" class="forgot-password" id="forgot-password-link">Forgot your password?</a>
				</div>

				<div class="row margin-top-small">
					<div id="invalid-user" style="display:none;" class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Invalid Username or Password
					</div>

					<div id="duplicate-email" style="display:none;" class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Duplicate Email
					</div>

					<div id="invalid-email" style="display:none;" class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Invalid Email
					</div>

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
