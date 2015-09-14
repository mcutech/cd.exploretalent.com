@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Settings', 'url' => '/settings', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-cog page-header-icon"></i> Settings
@stop

@section('sidebar.body')
Settings
@stop
