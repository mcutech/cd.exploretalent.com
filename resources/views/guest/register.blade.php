@extends('layouts.guest')

@section('title', 'Register')

@section('master.class', 'page-signup')

@section('guest.body')

	<!-- Page background -->
	<div id="page-signup-bg">
		<!-- Background overlay -->
		<div class="overlay"></div>
		<!-- Replace this with your bg image -->
	</div>
	<!-- / Page background -->

	<!-- Container -->
	<div class="signup-container" style="margin: 20px auto;">

		<!-- Form -->
		<div class="signup-form">
			<form action="index.html" id="signup-form">
				<div class="row-fluid clearfix text-center">
					<div class="col-md-12">
						<img src="/images/logo-home-et.png" alt="">
					</div>
				</div>
				<div class="signup-text">
					<span class="text-primary">Create a Casting Director Account</span>
				</div>

                <div class="alert alert-success" style="display:none;">
                    <p>Account created! Please login  using your email and password</p>
                </div>

				<div class="form-group w-icon">
					<input type="text" name="lname" id="last-name" class="form-control input-lg" placeholder="Last Name" data-required autofocus>
					<span class="fa fa-user signup-form-icon"></span>
				</div>
				<div id="req-lname" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="req-lnametxt" style="display:none;"></span>
				</div>


				<div class="form-group w-icon">
					<input type="text" name="fname" id="first-name" class="form-control input-lg" placeholder="First Name" data-required>
					<span class="fa fa-user signup-form-icon"></span>
				</div>
				<div id="req-fname" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="req-fnametxt" style="display:none;"></span>
				</div>

				<div class="form-group w-icon">
					<input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email Address" data-required>
					<span class="fa fa-envelope signup-form-icon"></span>
				</div>
				<div id="req-email" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="req-emailtxt" style="display:none;"></span>
				</div>

				<div class="form-group w-icon">
					<input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="Phone" data-required>
					<span class="fa fa-phone signup-form-icon"></span>
				</div>
				<div id="req-phone" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="req-phonetxt" style="display:none;"></span>
				</div>

				<div class="form-group w-icon">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" data-required data-match="confirmPassword" data-minlength="8">
					<span class="fa fa-lock signup-form-icon"></span>
				</div>
				<div id="req-pass" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="req-passtxt" style="display:none;"></span>
				</div>

				<div class="form-group w-icon">
					<input type="password" name="confirmPassword" id="confirm-password" class="form-control input-lg" placeholder="Confirm Password" data-required data-match="password">
					<span class="fa fa-lock signup-form-icon"></span>
				</div>
				<div id="req-confirmpass" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="req-confirmpasstxt" style="display:none;"></span>
					<span id="req-unmatchtxt" style="display:none;"></span>
				</div>

                <div class="form-actions" id="form-action-signup-btn">
					<input type="submit" id="sign-up" value="SIGN UP" class="signup-btn bg-primary">
				</div>

				<div id="req-confirmpass" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="error-signup" style="display:none;">An unknown error has occured.</span>
				</div>

                <div class="form-group text-center loader" style="display:none">
                    <p><small>Preparing your account, please wait ...</small> <i class="fa fa-spin fa-refresh"></i></p>
                </div>
			</form>
			<!-- / Form -->

		</div>
		<!-- Right side -->
	</div>

	<div class="have-account margin-top-normal-zz-lg">
		Already have an account? <a href="/login">Login</a>
	</div>

@stop
