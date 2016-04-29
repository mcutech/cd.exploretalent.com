@extends('layouts.master')

@section('master.body')

<div id="main-wrapper">
	<div id="main-navbar"
		class="navbar navbar-inverse"
		role="navigation">

		<div class="navbar-inner">

			<div class="navigation-header-container">
				<div class="navbar-header">
					<a id="navbar-main-logo" href="/projects"
						class="navbar-brand">
						<img src="/images/logo-home-et-cd.png" width="180px" class="logo-for-desktop">
					</a>
				</div>

				<div id="main-navbar-collapse" class="navbar-collapse main-navbar-collapse">
					<ul class="nav navbar-nav pull-right right-navbar-nav right-single-nav">
						<li class="">
							<a href="#" class="nav-link popover-item" data-toggle="popover" data-placement="bottom" data-content="Feel free to contact us here or call us at 702-446-0808 if you need any help or assistance." data-title="We're here for you" data-original-title="" title=""><h4 class="secondary-nav-text text-default margin-bottom-zero margin-top-normal">Need Help <i class="fa fa-question-circle"></i></h4></a>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>
	@yield('navbar.body')
</div>
@stop
