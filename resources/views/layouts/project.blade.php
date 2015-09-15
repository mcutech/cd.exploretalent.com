@extends('layouts.sidebar', isset($pages) ? ['pages' => $pages] : ['pages' => [ [ 'name' => 'My Projects', 'url' => '/projects', 'active' => true ] ] ])

@section('sidebar.body')
	@yield('project.body')
@stop
