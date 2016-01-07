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
								<div>By creating this account you agree to our <a href="" type="button" data-toggle="modal" data-target="#terms-conditions" original-title="">Terms of Use</a></div>
								<div>(Forget your login name or password? Call 702-446-0888 or email <a href="" original-title="">cd@exploretalent.com</a></div>
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
		<hr class="blue margin-bottom-zero">
	</div>
	</div> {{-- row-fluid --}}

	<div class="row-fluid clearfix success-benefits-container">
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<div class="panel success-benefits-item panel-design">
				<div class="panel-body">
					<div class="panel-body-in-title-container">
					<span class="panel-body-in-title title"><i class="fa fa-trophy"></i> Casting Directors Success Stories</span>
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
					<span class="panel-body-in-title title"><i class="fa fa-thumbs-o-up"></i> List of Benefits</span>
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
					<span class="panel-body-in-title title">Samples of Past Projects</span>
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
					<li><span class="panel-body-in-title title hide">Talent Agents</span></li>
					<li><span class="panel-body-in-title text-default text-underline">Email us: <a href=""><u>cd@exploretalent.com</u></a></span></li>
				</ul>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div> {{-- row-fluid --}}
	
	<div class="row-fluid clearfix panel footer-area margin-zero">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="panel-body">
				<div class="row-fluid clearfix celebrity-advice-container text-center form-group">
					<h5 class="col-md-12 text-bold text-left">Celebrity Advice</h5>
					<div class="col-md-2 image-container">
						<img src="https://www.exploretalent.com/graphics/celebrityadvice01.jpg" alt="" class="celebrity-item img-responsive">
					</div>
					<div class="col-md-2 image-container">
						<img src="https://www.exploretalent.com/graphics/celebrityadvice02.jpg" alt="" class="celebrity-item img-responsive">
					</div>
					<div class="col-md-2 image-container">
						<img src="https://www.exploretalent.com/graphics/celebrityadvice03.jpg" alt="" class="celebrity-item img-responsive">
					</div>
					<div class="col-md-2 image-container">
						<img src="https://www.exploretalent.com/graphics/celebrityadvice04.jpg" alt="" class="celebrity-item img-responsive">
					</div>
					<div class="col-md-2 image-container">
						<img src="https://www.exploretalent.com/graphics/celebrityadvice05.jpg" alt="" class="celebrity-item img-responsive">
					</div>
					<div class="col-md-2 image-container">
						<img src="https://www.exploretalent.com/graphics/celebrityadvice06.jpg" alt="" class="celebrity-item img-responsive">
					</div>
				</div>
				<div class="row-fluid clearfix et-links form-group">
					<div class="col-md-2">
						<ul class="list-unstyled">
							<li class="margin-bottom-zero-small"><a href="http://www.exploretalent.com/casting.php" original-title=""><b>Auditions &amp; Jobs</b></a></li>
							<li><a href="http://www.exploretalent.com/acting-auditions.php/" original-title="">Acting Auditions</a></li>
							<li><a href="http://www.exploretalent.com/modeling-auditions.php/" original-title="">Modeling Auditions</a></li>
							<li><a href="http://www.exploretalent.com/dance-auditions.php/" original-title="">Dance Auditions</a></li>
							<li><a href="http://www.exploretalent.com/music-jobs.php/" original-title="">Music Auditions</a></li>
							<li><a href="http://www.exploretalent.com/crew-jobs.php" original-title="">Crew Jobs</a></li>
							<li><a href="http://www.exploretalent.com/directory/auditions" original-title="">All Auditions/Jobs</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="list-unstyled">
							<li class="margin-bottom-zero-small"><a href="http://www.exploretalent.com/media/video/acting" original-title=""><b>Videos</b></a></li>
							<li><a href="http://www.exploretalent.com/media/video/testimonials/" original-title="">Video Testimonials</a></li>
							<li><a href="http://www.exploretalent.com/media/video/" original-title="">More Videos</a></li>
							<li><a href="http://www.exploretalent.com/media/hiphop-interviews" original-title="">Hip Hop Musicians Advice</a></li>
							<li><a href="http://www.exploretalent.com/media/video/acting" original-title="">Acting Workshop</a></li>
							<li><a href="http://www.exploretalent.com/media/video/urban" original-title="">Celebrity Videos</a></li>
							<li><a href="http://www.exploretalent.com/media/video/search" original-title="">Member Video Search</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="list-unstyled">
							<li class="margin-bottom-zero-small"><a href="http://www.exploretalent.com/search.php" original-title=""><b>Find Talent</b></a></li>
							<li><a href="http://www.exploretalent.com/search2.php" original-title="">Search Models and Actors</a></li>
							<li><a href="http://www.exploretalent.com/search_musicians.php" original-title="">Search Musicians</a></li>
							<li><a href="http://www.exploretalent.com/search_featured.php" original-title="">Featured Talents</a></li>
							<li><a href="http://www.exploretalent.com/contests/featured-contestants" original-title="">Featured Contestants</a></li>
							<li><a href="http://www.exploretalent.com/join/index/now" original-title="">See Who Just Joined ET</a></li>
							<li><a href="http://www.exploretalent.com/online" original-title="">Who's Online</a></li>
							<li><a href="http://www.exploretalent.com/activityfeed" original-title="">Talent Activity Feed</a></li>
							<li><a href="http://www.exploretalent.com/directory/talents/" original-title="">All Talents</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="list-unstyled">
							<li class="margin-bottom-zero-small"><a href="http://www.exploretalent.com/about" original-title=""><b>About Explore Talent</b></a></li>
							<li><a href="http://www.exploretalent.com/about" original-title="">About Us</a></li>
							<li><a href="http://back.exploretalent.com/?&amp;fr=a" original-title="">Take Me to the Old Site</a></li>
							<li><a href="http://www.exploretalent.com/about/faq" original-title="">FAQ</a></li>
							<li><a href="http://www.exploretalent.com/about/advertise" original-title="">Affiliates</a></li>
							<li><a href="http://www.exploretalent.com/about/advertise" original-title="">Advertising with Us</a></li>
							<li><a href="http://www.exploretalent.com/testimonials" original-title="">Testimonials</a></li>
							<li><a href="http://www.exploretalent.com/tour" original-title="">Take a Member Tour</a></li>

						</ul>					
					</div>
					<div class="col-md-2">
						<ul class="list-unstyled">
							<li class="margin-bottom-zero-small"><a href="http://www.exploretalent.com/articles" original-title=""><b>More on Explore Talent</b></a></li>
							<li><a href="http://www.exploretalent.com/articles" original-title="">Articles</a></li>
							<li><a href="http://news.exploretalent.com" original-title="">News</a></li>
							<li><a href="http://trends.exploretalent.com" original-title="">Trends</a></li>
							<li><a href="http://www.exploretalent.com/mail" original-title="">Web Mail</a></li>
							<li><a href="http://www.exploretalent.com/links/links.htm" original-title="">Links</a></li>
						</ul>					
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row-fluid clearfix et-description form-group">
					<div class="col-md-12">
						<div>
						<hr>
						<span itemprop="description">
							<p class="text-gray text-center">
							ExploreTalent is neither an employment agent nor a modeling agency. We do not guarantee employment, jobs or bookings. Explore Talent only provides Internet exposure, resources, and tools for you to match your talent with auditions and casting directors. If you have any questions, contact our <a class="" href="/faq.php" original-title="">Customer Service department</a> at (800) 598-7500. Here is our <a class="" href="/about/agreement" original-title="">User Agreement</a>.
							</p>
							<p class="text-gray text-center">
							ExploreTalent.com is the worldwide leader in acting Modeling Auditions. We are offering thousands of casting calls and Auditions. Get more Casting, auditions resources and Talent Agents than all other sites combined. Spending hours and not finding the Acting Jobs &amp; Modeling Jobs you need? Find Reality TV Shows Casting Calls the modeling auditions Acting Auditions, modeling jobs, acting jobs, all in one place. Stop spending hours searching for casting &amp; auditions. Submit yourself to casting calls, auditions - Get a call when Casting directors wants you.
							</p>
						</span>
						<div class="font11 text-gray text-center margin-bottom-small">
							ExploreTalent has an aggregate rating of <span itemprop="ratingValue"><span class="rating-static rating-45"></span>
							7.3</span>/<span itemprop="bestRating">10</span> based on
							<span itemprop="reviewCount">42,891</span> <a href="http://www.exploretalent.com/testimonials" target="_blank" original-title="">users' reviews</a>
							</div>
						</div>
						<p class="text-center margin-bottom-small">
							Check us out on <a class="" target="_blank" href="http://www.youtube.com/user/ExploreTalent/" original-title="">YouTube</a>,
							<a class="" target="_blank" href="http://www.myspace.com/exploretalent" original-title="">MySpace</a>,
							<a class="" target="_blank" href="https://www.facebook.com/ExploreTalent" original-title="">FaceBook</a>,
							<a class="" target="_blank" href="http://twitter.com/exploretalent" original-title="">Twitter</a>,
							<a class="" target="_blank" href="https://www.pinterest.com/ExploreTalent/" original-title="">Pinterest</a> and
							<a class="" target="_blank" href="http://www.crunchbase.com/organization/explore-talent" original-title="">CrunchBase</a>
						</p>
						<div class="text-center margin-bottom-zero">
							<ul class="list-unstyled list-inline">
								<li>Find acting auditions by city:</li>
								<li><a class="text-lblue mb-0 padTB-10" target="_blank" href="/acting-auditions-new-york" original-title="acting auditions new york">Acting Auditions in New York</a>,</li>

								<li><a class="text-lblue" target="_blank" href="/acting-auditions-los-angeles" original-title="acting auditions los angeles">Acting Auditions Los Angeles</a>,</li>

								<li><a class="text-lblue" target="_blank" href="/acting-auditions-chicago" original-title="acting auditions chicago">Acting Auditions Chicago</a>,</li>

								<li><a class="text-lblue" target="_blank" href="/acting-auditions-atlanta" original-title="acting auditions atlanta">the Acting Auditions Atlanta</a>,</li>

								<li><a class="text-lblue" target="_blank" href="/acting-auditions-miami" original-title="acting auditions miami">Acting Auditions Miami</a></li>
							</ul>
						</div>
						<div class="text-center">
							<ul class="list-unstyled list-inline">
								<li>Find Modeling jobs by city:</li>
								<li><a class="text-lblue" target="_blank" href="/modeling-jobs-new-york" original-title="modeling jobs new york">Modeling Jobs in New York</a>,</li>
								<li><a class="text-lblue" target="_blank" href="/modeling-jobs-los-angeles" original-title="modeling jobs los angeles">Modeling Jobs in Los Angeles</a>,</li>
								<li><a class="text-lblue" target="_blank" href="/modeling-jobs-chicago" original-title="modeling jobs chicago">Modeling Jobs in Chicago</a>,</li>
								<li><a class="text-lblue" target="_blank" href="/modeling-jobs-atlanta" original-title="modeling jobs atlanta">Modeling Jobs in Atlanta</a></li>
							</ul>
						</div>
						<hr>
						<ul class="list-unstyled list-inline text-center">
							<li>©  ExploreTalent.com</li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about" original-title="">About ExploreTalent.com</a></li>
							<li><a class="text-lblue padLR-5" href="/tour" original-title="">Tour</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/" original-title="">Home</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about/privacy" original-title="">Privacy Policy</a></li>
							<li><a class="text-lblue padLR-5" href="/search/acting" original-title="">Acting Auditions</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about/agreement" original-title="">Terms of Use</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/articles" original-title="">Articles</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about/advertise" original-title="">Become an Affiliate</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/requests/index/contact" original-title="">Contact Us</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about/disclaimer" original-title="">Disclaimer</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about/dmca" original-title="">DMCA</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about/fairuse" original-title="">Fair Use Disclaimer</a></li>
							<li><a class="text-lblue padLR-5" href="http://www.exploretalent.com/about/sitemap" original-title="">Site Map</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>

</div>
@include('guest.modals.terms-conditions')
@stop
