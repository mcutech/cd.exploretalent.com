@extends('layouts.navbar-blankpage')

@section('title', 'CD ExploreTalent')

@section('navbar.body')

    <div id="content-wrapper" class="full-page">
        @include('layouts.components.page-header')
            @yield('sidebar.body')
    </div>

    <div id="main-menu-bg"></div>
@stop
