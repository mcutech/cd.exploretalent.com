@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Worksheet', 'url' => '/worksheet', 'active' => true] ] ])

@section('sidebar.body')
	@include('project.auditionworksheet')
@stop
