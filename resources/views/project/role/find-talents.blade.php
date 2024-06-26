@extends('layouts.role', [ 'active' => 'find-talents','project_details' =>
false, 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => '../.././' ], [ 'name' => 'Find Talents', 'url' => './find-talents', 'active' => true ] ] , 'likeitlist' => true, 'matches' => false, 'talentList' => true])

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Find Talents - <b data-bind="<%= name + ' ' + '(' + casting_id + ')' %>"></b>
@stop

@section('role.body')
<div class="role-item margin-top-medium">
    <div class="row-fluid clearfix">
        <div class="talents-wrapper">
            <div class="talents-search-filter-content">
                <div class="row clearfix">
                    @include('project.components.filter')
                </div>
                <div id="submission-total" class="row">
                    <div class="margin-left-small margin-bottom-small col-md-12">
                    There are <span data-bind="<%= total %>"></span> talents that match your search criteria.
                    </div>
                </div>
                <div class="row" id="add-all-div">
                    <div class="col-md-12 padding-left-medium padding-bottom-medium">
                        <button id="add-all-button" class="hide btn btn-default margin-right-normal"><i class="fa fa-check"></i> <span>Add All to Like it List</span></button>
                        You have <span id="add-all-total" data-bind="<%= likeitlist.total %>">0</span> talents on your like it list.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 talents-search-result" id="role-matches-result">
                        <div class="row" id="role-matches">
                            @include('components.talent4', [ 'databind' => [ 'template' => '#role-matches', 'value' => 'data' ], 'ratings' => true, 'notes' => false, 'favorites_notes' => true, 'default_btn' => true, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
                        </div>
                    </div>
                </div>
                <div id="search-loader" class="text-center padding-top-large">
                    <h3>Loading Talents</h3>
                    <h1><i class="fa fa-spinner fa-spin"></i></h1>
                </div>
            </div>
            <div class="talents-content">
                @include('components.modals.talent-add-to-like-it-list')
                @include('components.modals.share-like-it-list')
                @include('components.modals.talent-view-photos')
                @include('components.modals.talent-add-note')
                @include('components.modals.talent-edit-note')
            </div>
        </div>
    </div>
</div>

<a href="javascript:" id="go-to-top-btn">
    <i class="fa fa-chevron-up"></i>
</a>

@stop

