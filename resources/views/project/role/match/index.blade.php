@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Pre Submissions', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/matches', 'active' => true] ] ])

@section('header.title', 'Pre Submissions')

@section('sidebar.body')

	<div class="role-matches-wrapper role-matches-talent-view-wrapper">

		<div class="talents-search-filter-content">
			@parent
			<div class="row-fluid clearfix">

				@include('components.talent-filter')

				<div id="role-match-loader" class="text-center padding-top-large">
					<h3>Loading Matches</h3>
					<h1><i class="fa fa-spinner fa-spin"></i></h1>
				</div>

				<div id="role-match" class="col-md-9 talents-search-result" style="display:none;">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div id="like-it-list-div" class="panel margin-bottom-small">
								<div class="padding-normal" data-bind="<%= role.schedule_import ? 0 : 1 %>" data-bind-target="visibility">
									<button id="rate-all-button" class="btn btn-defaut">Add all to Like It List</button>
									<span class="text-primary"><a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/like-it-list" href="">You have <span data-bind="<%= role.likeitlist.total %>"></span> in your like it list.</a></span>
								</div>
								<div class="padding-normal" data-bind="<%= role.schedule_import ? 1 : 0 %>" data-bind-target="visibility">
									<span class="text-primary" data-bind="Adding <%= role.schedule_import ? role.schedule_import.count_done : 0 %> of <%= role.schedule_import ? role.schedule_import.count_total : 0 %> talents to Like It List. <%= role.schedule_import ? role.schedule_import.estimated_time : '' %>"></span>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="float-right">
								<div class="display-block margin-bottom-small">
									<span class="text-normal">There are</span>
									<span data-bind="<%= role.matches.total %>"></span>
									<span class="text-normal"> matches for role </span>
									<span data-bind="<%= role.name %>"></span>.
								</div>
								<div id="matches-pagination">
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid clearfix" id="role-match-result">
						@include('components.talent', [ 'databind' => [ 'template' => '#role-match-result', 'value' => 'role.matches.data' ], 'class' => 'col-lg-4 col-md-6 col-sm-6 col-xs-12' ])
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>
	</div>

	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')
	@include('components.modals.invite-to-audition')
	@include('components.modals.talent-add-note')
	@include('components.modals.talent-edit-note')

@stop
