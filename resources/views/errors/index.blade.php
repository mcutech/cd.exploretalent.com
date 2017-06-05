@extends('layouts.no-breadcrumbs')

@section('sidebar.page-header')
{{-- <i class="fa page-header-icon"></i> <b>Welcome!</b> --}}
@stop

@section('sidebar.body')
	<div id="error-page" class="panel padding-normal padding-top-normal-zz-xs">
		<div class="error-container">
			<div class=""><a href="/welcome"><img src="/images/logo-home-et-cd.png" width="200px" class="logo-for-desktop"></a></div>
			<div><h1><i class="fa fa-frown-o"></i> ERROR 404</h1></div>
			<div>Sorry we can't find the page you're looking for. <a href="/projects">Check out your Projects</a> or <a href="/welcome">head back to home.</a></div>
		</div>
	</div>
@stop
