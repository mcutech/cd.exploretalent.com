@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Alternate Emails', 'url' => '/alternate emails', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-cog page-header-icon"></i> Alternate Emails
@stop

@section('sidebar.body')
<div id="settings" class="row">
    <div class="col-md-2">
        <input class="form-control">
    </div>
    <div class="btn-success row btn margin-bottom-normal">Add Email</div>
    <div class="row col-md-12">
        <table class="table table-bordered">
        <thead>
        <tr>
            <th>Emails</th>
            <th>Action</th>
        </tr>
        </thead>
        <tr>
        <td>alicia.utech@gmail.com</td>
        <td>
            <div class="btn btn-default">Set as primary</div>
            <div class="btn btn-default">Set as secondary</div>
            <div class="btn btn-default">Delete</div>
        </td>
        </tr>
        </table>
    </div>

</div>
@stop
