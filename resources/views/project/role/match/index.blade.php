@extends('layouts.role', [ 'pages' => [ [ 'name' => 'Pre-Submissions', 'url' => '/roles/1/matches', 'active' => true] ] ])

@section('header.title', 'Pre Submissions')

@section('sidebar.body')

	<div class="role-matches-wrapper role-matches-talent-view-wrapper">

		<div class="talents-search-filter-content">
			@parent
			<div class="row-fluid clearfix">

				@include('components.talent-filter')

				<div class="col-md-9 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div class="padding-top-small">
								<h5 class="margin-zero"><span class="text-normal">Matches for Role:</span> Name of Role Display Here</h5>
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
					<div class="row-fluid clearfix" id="matches-list">
						@include('components.talent', [ 'databind' => [ 'template' => '#matches-list', 'value' => 'data' ] ])
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>
	</div>

	@include('components.modals.share-like-it-list')
	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')

@stop
