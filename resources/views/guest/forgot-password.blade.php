@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('master.class', 'page-signin')

@section('guest.body')

	<div class="signin-container">

		<div class="signin-form">
			<form id="reset-password-form">
				<div class="signin-text">
					<h4><span class="text-primary">Forgot Password</span></h4>
				</div>

				<div class="form-group">
					<input type="text" name="email" id="email" class="form-control input-lg" placeholder="Input Email Here" autofocus data-required>
				</div>

				<div class="row form-group" style="margin-top: 15px;">
					<div id="valid-email" style="display: none;" class="alert alert-success margin-bottom-small" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Success:</span>
						Please check your email.
					</div>
				</div>

				<div class="row form-group" style="margin-top: 5px;">
					<div id="invalid-email" style="display: none;" class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Invalid Email!
					</div>
				</div>

				<div class="row form-group" style="margin-top: 5px;">
					<div id="email-not-found" style="display: none;" class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						We can't find a user with that e-mail address.
					</div>
				</div>

				<div class="form-actions margin-top-zero-zz-lg">
					<input type="submit" value="RESET PASSWORD" class="signin-btn bg-primary" id="send-email-btn">
				</div>
			</form>
		</div>

	</div>

	<div class="not-a-member">
		Not a member? <a href="/register">Sign Up</a>
	</div>

@stop
