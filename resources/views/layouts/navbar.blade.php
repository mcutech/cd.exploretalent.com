@extends('layouts.master')

@section('master.body')

<div id="main-wrapper">
	<div id="main-navbar"
		class="navbar navbar-inverse"
		role="navigation">

		<div class="navbar-inner">
			@include('layouts.components.stationary-alert')

			<div class="navigation-header-container">
				<div class="navbar-header">
					<a href="/welcome"
						class="navbar-brand">
						<img data-bind="<%= skins.loggedInLogo %>" width="180px" class="skins logo-for-desktop">



						<!-- <img src="../images/logo-home-et-cd-mobile2.png" class="logo-for-mobile"> -->
					</a>
				</div>
				<div class="navbar-navigations">
					<ul class="nav navbar-nav primary-nav">
						<li>
							<a href="/projects" class="nav-link padding-left-normal-zz-xs">
								<div class="primary-nav-icon"><i class="fa fa-film"></i></div>
								<div class="primary-nav-text">My Projects</div>
							</a>
						</li>
						<li>
							<a href="/projects/create" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-plus"></i></div>
								<div class="primary-nav-text">Create Project</div>
							</a>
						</li>
						{{-- <li class="">
							<a href="/messages" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-envelope-o"></i></div>
								<div class="primary-nav-text">Messages</div>
							</a>
						</li> --}}
						<li>
							<a href="/talents" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-search"></i></div>
								<div class="primary-nav-text">Browse Talents</div>
							</a>
						</li>
						<li>
							<a href="/talents/favorite" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-star-o"></i></div>
								<div class="primary-nav-text">Favorite Talents</div>
							</a>
						</li>
						<li>
							<a href="/projects/0/worksheet" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-file-text-o"></i></div>
								<div class="primary-nav-text">Manage Auditions</div>
							</a>
						</li>
						<li>
							<a href="/feedback" class="nav-link padding-right-normal-zz-xs">
								<div class="primary-nav-icon"><i class="fa fa-comment-o"></i></div>
								<div class="primary-nav-text">Feedback</div>
							</a>
						</li>
					</ul>
				</div>

				<button type="button"
					class="navbar-toggle collapsed"
					data-toggle="collapse"
					data-target="#main-navbar-collapse">
					<i class="navbar-icon fa fa-bars"></i>
				</button>

				<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
					<ul class="nav navbar-nav pull-right right-navbar-nav secondary-nav">
						<li>
							<a href="/settings" class="nav-link"><i class="dropdown-icon fa fa-cog"></i> <span class="secondary-nav-text">Settings</span></a>
						</li>
						<li>
							<a href="#" class="nav-link logout" title="Logout"><i class="dropdown-icon fa fa-power-off"></i></a>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>
	@yield('navbar.body')
</div>
@stop
