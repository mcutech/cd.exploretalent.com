@extends('layouts.master')

@section('master.body')

<div id="main-wrapper">
	<div id="main-navbar"
		class="navbar navbar-inverse"
		role="navigation">

		<div class="navbar-inner">

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
							<a href="#" class="nav-link logout"><i class="dropdown-icon fa fa-power-off"></i> <span class="secondary-nav-text">Logout</span></a>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>
	@yield('navbar.body')
</div>
@stop

