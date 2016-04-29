@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Favorite Talents', 'url' => '/favoritetalents', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-star"></i> Favorite Talents
@stop


@section('sidebar.body')

	<div class="favorite-talents-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid">
				<div class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix" id="favorite-result">
						@include('components.talent4', [ 'databind' => [ 'template' => '#favorite-result', 'value' => 'data' ], 'ratings' => true, 'favorites_notes' => false ])
					</div>
				</div> {{-- talents-search-results --}}
				<div id="search-loader" class="text-center padding-top-large">
					<h3>Loading Talents</h3>
					<h1><i class="fa fa-spinner fa-spin"></i></h1>
				</div>
			</div>
		</div>

		<div class="talents-content">
		 	@include('components.modals.talent-add-to-like-it-list')
			@include('components.modals.share-like-it-list')
			@include('components.modals.talent-view-photos')
			@include('components.modals.talent-resume')
		</div>

	</div>
@stop
