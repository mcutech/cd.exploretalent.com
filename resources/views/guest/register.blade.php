@extends('layouts.guest')

@section('title', 'Register')

@section('master.class', 'page-signup')

@section('guest.body')

<div class="joincd-wrapper">
	<!-- Container -->
	<div class="row-fluid clearfix padding-large">
	<div class="col-md-12 white-text text-center">
		<h2 class="text-bold">Post your Casting, Project or Job for Free</h2>
		<small>Too busy to set up your account? Need help? Post casting calls only? <u>Email your project to us</u> or <u>Call us at (702) 446-0888.</u></small>
		
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-8 margin-medium">
		<!-- Form -->
		<div class="signup-form">
			<form action="index.html" id="signup-form">
				<div class="row-fluid clearfix text-center">
					<div class="col-md-12">
						<img src="/images/logo-home-et.png" alt="">
					</div>
				</div>
				<div class="signup-text">
					<span>Create a Casting Director Account (Post your Casting, Project or Job for Free)</span>
				</div>

				<div class="alert alert-success" style="display:none;">
					<p>Account created! Please login  using your email and password</p>
				</div>

				<div class="row-fluid clearfix">
					<div class="col-md-6">
						<div class="form-group w-icon">
							<input type="text" name="fname" id="first-name" class="form-control input-lg" placeholder="First Name" data-required>
							<span class="fa fa-user signup-form-icon"></span>
						</div>
						<div id="req-fname" style="display:none;" class="alert alert-danger form-group" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							<span id="req-fnametxt" style="display:none;"></span>
						</div>
					</div>

					<div class="col-md-6 form-group">
						<div class="form-group w-icon">
							<input type="text" name="lname" id="last-name" class="form-control input-lg" placeholder="Last Name" data-required autofocus>
							<span class="fa fa-user signup-form-icon"></span>
						</div>
						<div id="req-lname" style="display:none;" class="alert alert-danger form-group" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							<span id="req-lnametxt" style="display:none;"></span>
						</div>
					</div>
					
					<div class="col-md-6 form-group">
						<div class="form-group w-icon">
							<input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email Address" data-required>
							<span class="fa fa-envelope signup-form-icon"></span>
						</div>
						<div id="req-email" style="display:none;" class="alert alert-danger form-group" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							<span id="req-emailtxt" style="display:none;"></span>
						</div>
					</div>

					<div class="col-md-6 form-group">
						<div class="form-group w-icon">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" data-required data-match="confirmPassword" data-minlength="8">
							<span class="fa fa-lock signup-form-icon"></span>
						</div>
						<div id="req-pass" style="display:none;" class="alert alert-danger form-group" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							<span id="req-passtxt" style="display:none;"></span>
						</div>
					</div>
					
					<div class="col-md-6 form-group">
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
					</div>

					<div class="col-md-6 form-group">
						<div class="form-group w-icon margin-zero">
							<input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="Phone" data-required>
							<span class="fa fa-phone signup-form-icon"></span>
						</div>
						<div id="req-phone" style="display:none;" class="alert alert-danger form-group" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							<span id="req-phonetxt" style="display:none;"></span>
						</div>
					</div>
					
					<div class="col-md-12 form-group">
						<div class="text-center">
							<div class="form-actions" id="form-action-signup-btn">
								<input type="submit" id="sign-up" value="Create an Account" class="signup-btn bg-primary">
							</div>
							<div class="form-group">
								<div>By creating this account you agree to our <a href="" original-title="">Terms of Use</a></div>
								<div>(Forget your login name or password? Call 800-742-1200 or email <a href="" original-title="">cd@exploretalent.com</a></div>
							</div>
						</div>

						<div id="req-confirmpass" style="display:none;" class="alert alert-danger form-group" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							<span class="sr-only">Error:</span>
							<span id="error-signup" style="display:none;">An unknown error has occured.</span>
						</div>

						<div class="form-group text-center loader" style="display:none">
							<p><small>Preparing your account, please wait ...</small> <i class="fa fa-spin fa-refresh"></i></p>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- / Form -->
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-12 text-center white-text">
		Already have an account? <a href="/login">Login</a>
	</div>
	<div class="col-md-12">
		<hr class="margin-bottom-zero">
	</div>
	</div> {{-- row-fluid --}}

	<div class="row-fluid clearfix success-benefits-container">
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<div class="panel success-benefits-item panel-design">
				<div class="panel-body">
					<div class="panel-body-in-title-container">
					<span class="panel-body-in-title"><i class="fa fa-trophy"></i> Casting Directors Success Stories</span>
					</div>
					<ul class="list-unstyled">
						<li>
						<p>"I just want to say thanks again to Explore Talent and Sara for your courtesy and for assisting me with casting my spot. The actors were truly professional and everyone was really happy to be a part of the project!" <span class="text-right"> - Lawrence Dotson</span></p>
						</li>
						<li><p>"I'm a casting director with Explore Talent and just want to say that this sight is amazing. The results I received from posting my casting with them was just incredible." <span class="text-right">- Jose Andres</span></p>
						</li>
						<li><p>"I went to the site and I found someone who is PERFECT! The shoot went exceptionally well! Shane and his mom were so personable and Shane did an excellent job. Both the director and I were very pleased! Thanks so much for your help and I'll definitely give you a call on the next project. Thanks again." <span class="text-right">- Mayleen Ramey</span></p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	
		<div class="col-md-5">
			<div class="panel success-benefits-item panel-design">
				<div class="panel-body">
					<div class="panel-body-in-title-container">
					<span class="panel-body-in-title"><i class="fa fa-thumbs-o-up"></i> List of Benefits</span>
					</div>
					<ul class="list-unstyled">
						<li><p><i class="fa fa-check text-success"></i>
						Our Booking Assistants can help you every step of the way - we will post for you and contact talents as requested
						</p></li>
						<li><p><i class="fa fa-check text-success"></i>
						Be able to easily contact talents for their castings</p>
						</li>
						<li><p><i class="fa fa-check text-success"></i>
						Castings can be displayed on the Home Page</p>
						</li>
						<li><p><i class="fa fa-check text-success"></i>
						Get your casting call, audition, or job displayed to all of our 9.4 million members</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div> {{-- row-fluid --}}

	<div class="row-fluid clearfix">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="panel panel-design">
				<div class="panel-body text-center">
					<span class="panel-body-in-title">Samples of Past Projects</span>
					<div class="sample-projects-container text-center">
						<div class="sample-projects-item">
							<img src="/images/sample1.jpg" alt="">
						</div>
						<div class="sample-projects-item">
							<img src="/images/sample2.jpg" alt="">
						</div>
						<div class="sample-projects-item">
							<img src="/images/sample3.jpg" alt="">
						</div>
						<div class="sample-projects-item">
							<img src="/images/sample4.jpg" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div> {{-- row-fluid --}}

	<div class="row-fluid clearfix">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="panel text-center panel-design">
				<div class="panel-body">
				<ul class="list-inline margin-zero">
					<li><span class="panel-body-in-title">Talent Agents</span></li>
					<li><button class="btn btn-primary" type="button">Interested in representing our talent?</button></li>
				</ul>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div> {{-- row-fluid --}}

	<div class="row-fluid clearfix">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="panel panel-design">
				<div class="panel-body">
					<div class="control-group">
						<div class="display-inline-block text-left">
							<span class="panel-body-in-title">Featured Talent Search</span>
						</div>
						<div class="display-inline-block pull-right">
							<button class="btn btn-primary">Become a Featured Talent</button>
							<button class="btn btn-primary">View All</button>
						</div>
					</div>
					<div class="row-fluid clearfix talent-search-container">
						@for ($i = 0; $i <= 11; $i++)
						<div class="col-md-2">
							<div class="talent-search-item-container">
							<div class="image-container"><img src="/images/talents-sample-image.jpg" alt=""></div>
							<div class="text-container"><div class="text-success"><strong>Stephanie Cannon</strong></div><div>37 Houston, TX</div></div>
							</div>
						</div>
						@endfor
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>

</div>
@stop
