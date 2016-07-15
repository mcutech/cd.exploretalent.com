@extends('layouts.project', [ 'active' => '', 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => '../.././' ], [ 'name' => 'Callbacks', 'url' => './callbacks', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Callbacks - <b data-bind="<%= name + ' ' + '(' + casting_id + ')' %>"></b>
@stop

@section('project.body')
<div class="row-fluid clearfix">
	<div id="project-roles" class="col-md-4 form-inline project-select-option">
		<label >Role :</label>
		<select id="roles-list" class="select-roles form-control">
			<option data-bind-template="#roles-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : role_id, value : name + ' (' + role_id + ')' }) %>"></option>
		</select>
	</div>
</div>

<div class="role-item margin-top-medium">
	<div class="row-fluid clearfix">
		<div class="talents-wrapper">
			<div class="talents-search-filter-content">
				<div class="row clearfix">
					@include('project.components.filter')
				</div>
				<div class="row">
					<div id="no-callbacks-div" class="col-md-12 hide">
						<div class="alert alert-success">
							<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/worksheet" class="text-success">You have no callbacks set, please mark talents as callbacks in your auditions worksheet.</a>
						</div>
					</div>
					<div class="col-md-12 talents-search-result" id="role-matches-result">
						<div class="row" id="role-matches">
							@include('components.talent4', [ 'databind' => [ 'template' => '#role-matches', 'value' => 'data' ], 'ratings' => true, 'default_btn' => true, 'notes' => false, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
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
				@include('components.modals.talent-resume')
				@include('components.modals.talent-add-note')
				@include('components.modals.talent-edit-note')
			</div>

		</div>
	</div>
</div>
@stop

