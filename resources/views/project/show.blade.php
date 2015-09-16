@extends('layouts.project', ['pages' => [ [ 'name' => 'Project Name', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => '/projects/Overview', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-file-text"></i> Project Overview
@stop

@section('sidebar.body')
	Show Project
@stop
