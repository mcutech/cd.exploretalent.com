@extends('layouts.navbar-fullpage')

@section('title', 'CD ExploreTalent')

@section('navbar.body')

	<div id="content-wrapper" class="">
		@include('layouts.components.page-header')
			@yield('sidebar.body')
	</div>

	<div id="main-menu-bg"></div>
@stop
