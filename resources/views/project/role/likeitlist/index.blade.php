@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Like it List', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/likeitlist', 'active' => true] ] ])

@section('header.title', 'Like It List')

@section('sidebar.body')
	@include('project.role-options.role-likeitlist')
@stop
