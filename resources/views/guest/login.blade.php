@extends('layouts.guest')

@section('master.class', 'page-signin')

@section('guest.body')

	<div id="page-signin-bg">
		<div class="overlay"></div>
		<img src="images/signin-bg-1.jpg" alt="">
	</div>

	<div class="signin-container">

		<div class="signin-info">
			<a href="index.html" class="logo">
				Pixel Admin
			</a>
			<div class="slogan" style="font-size: 1em;">
				World&#39;s Largest Talent Resource
			</div>
			<ul>
				<li><i class="fa fa-sitemap signin-icon"></i> Flexible modular structure</li>
				<li><i class="fa fa-file-text-o signin-icon"></i> LESS &amp; SCSS source files</li>
				<li><i class="fa fa-outdent signin-icon"></i> RTL direction support</li>
				<li><i class="fa fa-heart signin-icon"></i> Crafted with love</li>
			</ul>
		</div>

		<div class="signin-form">

			<form action="index.html" id="login-form">
				<div class="signin-text">
					<span>Sign In to your account</span>
				</div>

				<div class="form-group w-icon">
					<input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email" autofocus data-required> <span class="fa fa-user signin-form-icon"></span>
				</div>

				<div class="form-group w-icon">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" data-required>
					<span class="fa fa-lock signin-form-icon"></span>
				</div>

				<div class="form-actions">
					<input type="button" value="SIGN IN" class="signin-btn bg-primary" id="sign-in">
					<a href="#" class="forgot-password" id="forgot-password-link">Forgot your password?</a>
				</div>

				<div id="invalid-user" style="display:none;" class="margin-top-small">
					<p>Invalid Username or Password</p>
				</div>

				<div id="invalid-email" style="display:none;" class="margin-top-small">
					<p>Invalid Email</p>
				</div>

				<div id="invalid-pass" style="display:none;" class="margin-top-small">
					<p>Invalid Password</p>
				</div>

			</form>

			<div class="password-reset-form" id="password-reset-form">
				<div class="header">
					<div class="signin-text">
						<span>Password reset</span>
						<div class="close">&times;</div>
					</div>
				</div>

				<form action="index.html" id="password-reset-form_id">
					<div class="form-group w-icon">
						<input type="text" name="password_reset_email" id="p_email_id" class="form-control input-lg" placeholder="Enter your email">
						<span class="fa fa-envelope signin-form-icon"></span>
					</div>

					<div class="form-actions">
						<input type="submit" value="SEND PASSWORD RESET LINK" class="signin-btn bg-primary">
					</div>
				</form>

			</div>

		</div>

	</div>

	<div class="not-a-member">
		Not a member? <a href="/register">Sign Up</a>
	</div>

@stop
