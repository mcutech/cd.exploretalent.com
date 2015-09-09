@extends('layouts.master')


@section('master.body')
	@include('components.sidebar')
	@yield('test.body')
@stop
