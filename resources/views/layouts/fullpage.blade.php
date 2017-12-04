@extends('layouts.navbar-fullpage')

@section('title', '')

@section('navbar.body')

	<div id="content-wrapper" class="full-page">
		@include('layouts.components.page-header')
			@yield('sidebar.body')
	</div>

	<div id="main-menu-bg"></div>
@stop
