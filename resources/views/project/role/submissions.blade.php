@extends('layouts.role', [ 'active' => 'submissions', 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ],['name' => 'Project Overview', 'url' => '/projects/'.$projectId], [ 'name' => 'Submissions', 'url' => './submissions', 'active' => true ] ], 'likeitlist' => true , 'matches' => false])

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Submissions - <b data-bind="<%= name %>"></b>
@stop

@section('role.body')
<div id="no-submission-div" class="alert alert-success hide">
	No talent has applied for this particular role yet. We have matched talents already for you to choose from. Please
	<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/find-talents" class="text-success">click here</a>
	to go to your Role Matches and talents to your like it list.
</div>
<div class="panel role-item margin-top-medium">
	<div class="row-fluid clearfix">
		<div class="talents-wrapper">
			<div class="talents-search-filter-content">
				<div class="row clearfix">
					@include('project.components.filter')
				</div>
				<div class="row">
					<div class="col-md-12 talents-search-result" id="role-matches-result">
						<div class="row" id="role-matches">
							@include('components.talent4', [ 'databind' => [ 'template' => '#role-matches', 'value' => 'data' ], 'ratings' => true, 'notes' => false, 'favorites_notes' => true, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
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
			</div>
		</div>
	</div>
</div>
@stop

