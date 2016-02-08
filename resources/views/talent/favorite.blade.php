@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Favorite Talents', 'url' => '/favoritetalents', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-star"></i> Favorite Talents
@stop


@section('sidebar.body')

	<div class="favorite-talents-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid">

				<div class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-12">
							<div class="float-right">
								<div id="favorite-pagination"></div>
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
					<div class="row-fluid clearfix" id="favorite-result">
						@include('components.talent', [ 'databind' => [ 'template' => '#favorite-result', 'value' => 'data' ] ])
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
