@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Browse Talents', 'url' => '/talents', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-search"></i> Browse Talents
@stop


@section('sidebar.body')

	<div class="talents-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid clearfix">
				@include('components.talent-filter2')

				<div id="talent-search-loader" class="text-center padding-top-large">
					<h3>Loading Talents</h3>
					<h1><i class="fa fa-spinner fa-spin"></i></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 talents-search-result" id="talent-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-12">
							<div class="float-right">
								<div id="talents-pagination">
								</div>
							</div>
						</div>
					</div>
					<div class="row" id="talent-result">
						@include('components.talent4', [ 'databind' => [ 'template' => '#talent-result', 'value' => 'data' ], 'ratings' => true, 'notes' => false, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">
			@include('components.modals.talent-add-to-like-it-list')
			@include('components.modals.share-like-it-list')
			@include('components.modals.talent-photos')
			@include('components.modals.talent-view-photos')
			@include('components.modals.talent-resume')
			@include('components.modals.invite-to-audition')

		</div>

	</div>

@stop
