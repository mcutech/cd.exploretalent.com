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
							<div class="panel margin-bottom-small">
								<div class="padding-normal">
									<button id="rate-all-button" class="btn btn-defaut">Add all to Like It List</button>
									<span class="text-primary"><a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/like-it-list" href="">You have <span data-bind="<%= role.likeitlist.total %>"></span> in your like it list.</a></span>
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
					<div id="loading-div">
						<div class="f_circleG" id="frotateG_01"></div>
						<div class="f_circleG" id="frotateG_02"></div>
						<div class="f_circleG" id="frotateG_03"></div>
						<div class="f_circleG" id="frotateG_04"></div>
						<div class="f_circleG" id="frotateG_05"></div>
						<div class="f_circleG" id="frotateG_06"></div>
						<div class="f_circleG" id="frotateG_07"></div>
						<div class="f_circleG" id="frotateG_08"></div>
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
