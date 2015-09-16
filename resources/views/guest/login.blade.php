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
				CD Exploretalent
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

				<div class="form-group ">
					<input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email" autofocus data-required> 
				</div>

				<div class="form-group ">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" data-required>
				</div>
				<div class="form-actions">
					<button type="submit" class="signin-btn btn-primary">SIGN IN</button>
				</div>

				<div class="row margin-top-small">
					<div id="invalid-user" style="display:none;" class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Invalid Username or Password
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
