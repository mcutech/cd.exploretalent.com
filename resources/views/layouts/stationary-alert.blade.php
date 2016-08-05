@extends('layouts.master')

@section('master.body')
	@include('layouts.components.stationary-alert')
	@yield('stationary.body')
@stop


