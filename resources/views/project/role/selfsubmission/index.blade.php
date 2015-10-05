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
							<div class="panel margin-bottom-small">
								<div class="padding-normal">
									<h5 class="margin-top-zero display-inline-block margin-right-small"><span class="text-normal">Self Submissions for Role:</span> <span data-bind="<%= role.name %>"></span></h5>
									<button id="rate-all-button" class="btn btn-defaut">Add all to Like It List</button>
								</div>
							</div>
						</div>
						<div class="col-md-6 padding-left-zero">
							<div id="self-submissions-pagination">
							</div>
						</div>
					</div>
					<div class="row-fluid clearfix" id="self-submissions-results">
						@include('components.talent2', [ 'databind' => [ 'template' => '#self-submissions-results', 'value' => 'role.selfsubmissions.data' ], 'class' => 'col-lg-4 col-md-6 col-sm-6 col-xs-12' ])
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>
	</div>

	@include('components.modals.share-like-it-list')
	@include('components.modals.talent-message')
	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')
	@include('components.modals.invite-to-audition')
	@include('components.modals.talent-add-note')
	@include('components.modals.talent-edit-note')

@stop
