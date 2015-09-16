@extends('layouts.navbar')

@section('title', 'CD ExploreTalent')

@section('navbar.body')

	<div id="main-menu" role="navigation">
		<div id="main-menu-inner">
			<div class="menu-content top" id="menu-content-demo">
				<div>
					<div class="text-bg">
						<span class="text-normal" title="" data-bind="<%= getFullName() %>"></span>
					</div>
					<img src="/images/128x128.jpg" alt="" class="">
					<div class="btn-group">
						<a href="/messages" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-envelope"></i></a>
						<a href="/settings" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
						<a href="#" class="btn btn-xs btn-danger btn-outline dark logout"><i class="fa fa-power-off"></i></a>
					</div>
				</div>
			</div>
			@include('layouts.components.sidebar-nav')
		</div>
	</div>

	<div id="content-wrapper" class="margin-bottom-large">
		@include('layouts.components.breadcrumbs', isset($pages) ? ['pages' => $pages] : ['pages' => null])

		@include('layouts.components.page-header')
			@yield('sidebar.body')
	</div>

	<div id="main-menu-bg"></div>
@stop
