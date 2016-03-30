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
					<a href="/"
						class="navbar-brand">
						<img src="../images/logo-home-et-cd.png" width="180px">
					</a>
					<button type="button"
						class="navbar-toggle collapsed"
						data-toggle="collapse"
						data-target="#main-navbar-collapse">
						<i class="navbar-icon fa fa-bars"></i>
					</button>
				</div>

				<div id="main-navbar-collapse"
					class="collapse navbar-collapse main-navbar-collapse">
					<ul class="nav navbar-nav primary-nav">
						<li>
							<a href="#" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-film"></i></div>
								<div class="primary-nav-text">My Projects</div>
							</a>
						</li>
						<li>
							<a href="#" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-plus"></i></div>
								<div class="primary-nav-text">Create Project</div>
							</a>
						</li>
						<li>
							<a href="#" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-search"></i></div>
								<div class="primary-nav-text">Browse Talent</div>
							</a>
						</li>
						<li>
							<a href="#" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-star-o"></i></div>
								<div class="primary-nav-text">Favorite Talent</div>
							</a>
						</li>
						<li>
							<a href="#" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-file-text-o"></i></div>
								<div class="primary-nav-text">Manage Auditions</div>
							</a>
						</li>
						<li>
							<a href="#" class="nav-link">
								<div class="primary-nav-icon"><i class="fa fa-comment-o"></i></div>
								<div class="primary-nav-text">Feedback</div>
							</a>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right right-navbar-nav secondary-nav">
						<li>
							<a href="/settings" class="nav-link"><i class="dropdown-icon fa fa-cog"></i> <span class="secondary-nav-text">Settings</span></a>
						</li>
						<li>
							<a href="#" class="logout" class="nav-link"><i class="dropdown-icon fa fa-power-off"></i> <span class="secondary-nav-text">Logout</span></a>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>
	@yield('navbar.body')
</div>
@stop
