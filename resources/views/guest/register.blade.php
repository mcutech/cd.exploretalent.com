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
	<div class="signup-container">
		<!-- Header -->
		<div class="signup-header">
			<a href="index.html" class="logo">
				Explore Talent
			</a> <!-- / .logo -->
			<div class="slogan">
				<small>World&#39;s Largest Talent Resource</small>
			</div> <!-- / .slogan -->
		</div>
		<!-- / Header -->

		<!-- Form -->
		<div class="signup-form">
			<form action="index.html" id="signup-form">

				<div class="signup-text">
					<span>Create an account</span>
				</div>

                <div class="alert alert-success" style="display:none;">
                    <p>Account createad! Please login  using your email and password</p>
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
					<input type="text" name="login" id="login" class="form-control input-lg" placeholder="Login username" data-required>
					<span class="fa fa-user signup-form-icon"></span>
				</div>
				<div id="req-username" style="display:none;" class="alert alert-danger form-group" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					<span id="req-usernametxt" style="display:none;"></span>
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

                <div class="form-group text-center loader" style="display:none">
                    <p><small>Preparing your account, please wait ...</small> <i class="fa fa-spin fa-refresh"></i></p>
                </div>
			</form>
			<!-- / Form -->

		</div>
		<!-- Right side -->
	</div>

	<div class="have-account">
		Already have an account? <a href="/login">Login</a>
	</div>

@stop
