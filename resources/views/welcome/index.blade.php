@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Welcome', 'url' => '/welcome', 'active' => true] ] ])

@section('sidebar.page-header')
{{-- <i class="fa page-header-icon"></i> <b>Welcome!</b> --}}
@stop

@section('sidebar.body')
	<div id="no-projects-found" class="panel padding-normal text-align-center padding-top-normal-zz-xs">
		<div>
			<h2><b>Welcome to Our New CD Interface</b></h2>
			<p class="margin-zero">Our tools are always 100% FREE for you to cast talents for your projects.</p>
			<p>We're here to help. Call us at <b class="text-primary">702-446-0888</b> or <a href="/feedback" class="text-primary"><b>Leave Message</b></a></p>
		</div>
		<div class="video-btn">
			See what we can do for you
			<div class="video">
				<a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#watch-video-modal">Watch the video <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="project-btn-container row">
			<a href="/projects/create" class="btn btn-default project-btns create-btn col-xs-12 col-sm-5"><i class="fa fa-plus"></i> Create a Free Casting Now!</a>
			<div class="col-xs-12 col-sm-2 divider margin-top-zero-small-zz-xs margin-bottom-zero-small-zz-xs"><span>or</span></div>
			<a href="/talents" class="btn btn-default project-btns browse-btn col-xs-12 col-sm-5"><i class="fa fa-search"></i> Browse Talents</a>
		</div>
		<div class="row hide margin-top-large" id="profile-link">
			<div class="text-center"><a href="/projects">View my Projects</a></div>
		</div>
	</div>
@include('project.modals.watch-video')
@stop
