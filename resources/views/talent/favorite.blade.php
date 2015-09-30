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
								<ul class="pagination pagination-xs">
									<li class="disabled"><a href="#">«</a></li>
									<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">»</a></li>
								</ul>
								<div class="results-counter">Showing: 1 to 25 of 7862526</div>
							</div>
						</div>
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
