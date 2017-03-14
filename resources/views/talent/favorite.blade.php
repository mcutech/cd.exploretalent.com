@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Favorite Talents', 'url' => '/favoritetalents', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-star"></i> Favorite Talents
@stop


@section('sidebar.body')

	<div class="favorite-talents-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid">
				<div class="col-md-12 talents-search-result padding-zero">
					<div class="row-fluid clearfix" id="favorite-result">
						@include('components.talent4', [ 'databind' => [ 'template' => '#favorite-result', 'value' => 'data' ], 'ratings' => true, 'default_btn' => true, 'favorites_notes' => false ])
					</div>
				</div> {{-- talents-search-results --}}
				<div id="search-loader" class="text-center padding-top-large">
					<h3>Loading Talents</h3>
					<h1><i class="fa fa-spinner fa-spin"></i></h1>
				</div>
				<div class="row-fluid clearfix">
	             <div class="col-xs-12">
		                <div id="no-favorite-talent" class="padding-normal hide text-align-center padding-top-normal-zz-xs">
		                    <i class="fa fa-exclamation-triangle fa-4x text-danger"></i>
		                     	<div class="padding-zero">
			                      <span class="margin-zero text-danger"><h5>You have no favorite talents.</h5></span>
								</div>
		                </div>
		            </div>
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
