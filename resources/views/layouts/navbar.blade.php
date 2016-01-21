@extends('layouts.master')

@section('master.body')


<div id="main-wrapper">
	<div id="main-navbar"
		class="navbar navbar-inverse"
		role="navigation">

		<div class="navbar-inner">
			@include('layouts.components.stationary-alert')
			<div class="navbar-header">
				<button type="button"
					id="main-menu-toggle">
					<i class="navbar-icon fa fa-bars icon"></i>
					<span class="hide-menu-text">
						HIDE MENU
					</span>
				</button>
				<a href="/"
					class="navbar-brand">
					CD ExploreTalent
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
				<ul class="nav navbar-nav pull-right right-navbar-nav">
					<li class="dropdown">
						<a href="#"
							class="dropdown-toggle user-menu"
							data-toggle="dropdown">
							<img src="/images/128x128.jpg"
								alt="">
							<span data-bind="<%= getFullName() %>"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/settings">
									<i class="dropdown-icon fa fa-cog"></i>
									&nbsp;&nbsp;Settings
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#" class="logout">
									<i class="dropdown-icon fa fa-power-off"></i>
									&nbsp;&nbsp;Log Out
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	@yield('navbar.body')
</div>
@stop
