@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Browse Talents', 'url' => '/talents', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-search"></i> Browse Talents
@stop


@section('sidebar.body')

	<div class="talents-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid">
				@include('components.talent-filter')

				<div class="col-md-9 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-12">
							<div class="float-right">
								<div id="talents-pagination">
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid clearfix" id="talent-result">
						@include('components.talent3', [ 'databind' => [ 'template' => '#talent-result', 'value' => 'data' ], 'ratings' => false, 'notes' => false, 'class' => 'col-md-4'  ])
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">
			@include('components.modals.share-like-it-list')
			@include('components.modals.talent-photos')
			@include('components.modals.talent-resume')
			@include('components.modals.invite-to-audition')

		</div>

	</div>

@stop
