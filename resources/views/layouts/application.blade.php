@extends ('layouts.master')

@section('body')

<input type="hidden" id="auth-user-id" value="{{ \Auth::user()->id }}">

<div id="main-wrapper">
	@include('cd.layouts.application-header')
	@include('cd.layouts.application-sidebar')

	<div id="content-wrapper">

		@yield('page.breadcrumbs')

		<div class="page-header">
			<div class="row">
				<!-- Page header, center on small screens -->
				<h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
					@yield('page.header.title')
				</h1>

				<div class="col-xs-12 col-sm-8">
					@yield('page.header.extra')
				</div>
			</div>
		</div> <!-- / .page-header -->

		@yield('page.body.application')

	</div>

	<div id="main-menu-bg"></div>
</div>

@stop
