@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Pre Submissions', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/matches', 'active' => true] ] ])

@section('header.title', 'Pre Submissions')

@section('sidebar.body')

	<div class="role-matches-wrapper role-matches-talent-view-wrapper">

		<div class="talents-search-filter-content">
			@parent
			<div class="row-fluid clearfix">

				@include('components.talent-filter')

				<div id="role-match" class="col-md-9 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div class="padding-top-small">
								<span class="text-normal">There are</span>
								<span data-bind="<%= role.matches.total %>"></span>
								<span class="text-normal"> matches for role </span>
								<span data-bind="<%= role.name %>"></span>.
								<button id="rate-all-button" class="btn btn-defaut">Add all to Like It List</button>
							</div>
						</div>
						<div class="col-md-6">
							<div id="matches-pagination">
							</div>
						</div>
					</div>
					<div class="row-fluid clearfix" id="role-match-result">
						@include('components.talent', [ 'databind' => [ 'template' => '#role-match-result', 'value' => 'role.matches.data' ], 'class' => 'col-md-4' ])
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
