@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Pre Submissions', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/matches', 'active' => true] ] ])

@section('header.title', 'Pre Submissions')

@section('sidebar.body')

	@include('project.role-options.role-match')

@stop
