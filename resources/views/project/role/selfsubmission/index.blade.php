@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Self Submissions', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/selfsubmissions', 'active' => true] ] ])

@section('header.title', 'Self Submissions')

@section('sidebar.body')

	@include('project.role-options.role-selfsubmission')

@stop
