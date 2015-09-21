@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Self Submissions', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/selfsubmissions', 'active' => true] ] ])

@section('header.title', 'Self Submissions')

@section('sidebar.body')

	<div class="self-submissions-wrapper self-submissions-talent-view-wrapper self-submissions-notes-view-wrapper">
		<div class="talents-search-filter-content">
			@parent
			<div class="row-fluid clearfix">
				@include('components.talent-filter')

				<div id="self-submissions" class="col-md-9 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div class="padding-top-small">
								<h5 class="margin-zero"><span class="text-normal">Self Submissions for Role:</span> <span data-bind="<%= role.name %>"></span></h5>
							</div>
						</div>
						<div class="col-md-6 padding-left-zero">
							<div class="float-right">
								<ul class="pagination pagination-xs">
									<li class="disabled"><a href="#">«</a></li>
									<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">»</a></li>
								</ul>
								<div class="results-counter">Showing: 1 to 25 of 7,862,526</div>
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

	@include('components.modals.share-like-it-list')
	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')

@stop
