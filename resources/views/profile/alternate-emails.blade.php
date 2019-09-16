@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Alternate Emails', 'url' => '/alternate emails', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-cog page-header-icon"></i> Alternate Emails
@stop

@section('sidebar.body')
<div id="settings" class="panel-body">
    <div class="input-group col-md-3 margin-bottom-small">
            <input class="form-control email">
        <div class="input-group-btn">
            <button class="btn btn-success" id="add_email">Add</button>
        </div>
    </div>

    <div class="row col-md-8">
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Emails</th>
            <th>Action</th>
        </tr>
        </thead>
            <tbody id="alt_emails">
                <tr data-bind-template="#alt_emails" data-bind-value="data">
                    <td data-bind="<%= email %>"></td>
                    <td data-bind="<%= id %>" data-bind-target="id">
                        <div class="btn btn-primary set-email" value="1">Set as primary</div>
                        <div class="btn btn-warning set-email-sec" value="0">Set as secondary</div>
                        <div class="btn btn-danger delete">Delete</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-xs-12 col-sm-12">
            <div id="pagination" class="pull-right margin-top-large"></div>
        </div>
    </div>

</div>
@stop
