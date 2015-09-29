@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Self Submissions', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/selfsubmissions', 'active' => true] ] ])

@section('header.title', 'Self Submissions')

@section('sidebar.body')

	<div class="self-submissions-wrapper self-submissions-talent-view-wrapper self-submissions-notes-view-wrapper">
		<div class="talents-search-filter-content">
			@parent
			<div class="row-fluid clearfix"> @include('components.talent-filter')

				<div id="self-submissions" class="col-md-9 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div class="padding-top-small">
								<h5 class="margin-zero"><span class="text-normal">Self Submissions for Role:</span> <span data-bind="<%= role.name %>"></span></h5>
							</div>
						</div>
						<div class="col-md-6 padding-left-zero">
							<div id="self-submissions-pagination">
							</div>
						</div>
					</div>
					<div class="row-fluid clearfix" id="self-submissions-results">
						@include('components.talent2', [ 'databind' => [ 'template' => '#self-submissions-results', 'value' => 'role.selfsubmissions.data' ] ])
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>
	</div>

	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')
	@include('components.modals.invite-to-audition')

@stop
