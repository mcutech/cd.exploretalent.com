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
					<div class="row-fluid clearfix">
						<?php for($x=0; $x<12; $x++ ) { ?>
						<div class="col-md-3 talent-item-container">
							<div class="panel">
								<div class="panel-body">
									<div class="row-fluid clearfix">
										<div class="head-area padding-zero padding-bottom-small col-md-12">
											<div class="talent-name font-size-normal text-semibold float-left text-succes">Angelique Augusto <span class="age-area">, 22</span></div>

											<div class="favorite-indicator float-right">
												<i class="fa fa-star-o font-size-medium-large text-warning text-bold"></i>
											</div>
										</div>
									</div>
									
									<div class="row-fluid clearfix">
										<div class="talent-photo col-lg-6 col-md-12 col-sm-12">
											<img src="images/talents-sample-image.jpg" alt="" class="img-responsive">
										</div>
										
										<div class="col-lg-6 col-md-12 col-sm-12 padding-right-zero talent-information padding-top-small">
											<div class="talent-location">
												<i class="fa fa-map-marker"></i> Los Angeles, CA
											</div>
										
											<ul class="list-unstyled talents-list-details">
												<li>5' 10"</li>
												<li>138 lbs.</li>
												<li>Caucasian</li>
												<li>Athletic Body</li>
												<li>Green Eyes</li>
											</ul>
											
										</div>
									</div>
									<div class="row-fluid clearfix">
										<div class="col-md-6 padding-zero">
											<div class="like-it-list-container">
												<div class="text-left">
													<div class="display-block title"> Add to like list </div>
													<div class="btn-group btn-group-xs">
														<button class="btn btn-xs btn-danger disabled" data-rating="1">1</button>
														<button class="btn btn-xs btn-warning disabled" data-rating="2">2</button>
														<button class="btn btn-xs btn-info disabled" data-rating="3">3</button>
														<button class="btn btn-xs btn-primary disabled" data-rating="4">4</button>
														<button class="btn btn-xs btn-success disabled" data-rating="5">5</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 padding-zero">
											<div class="like-it-list-container">
												<div class="float-right-md-lg">
													<div class="display-block title">&nbsp;</div>
													<div class="btn-group btn-group-xs">
														<button class="btn btn-xs btn-default " data-rating="1"><span class="fa fa-file-text-o"></span></button>
														<button class="btn btn-xs btn-default " data-rating="2"><span class="fa fa-picture-o"></span></button>
														<button class="btn btn-xs btn-default " data-rating="1"><span class="fa fa-calendar"></span></button>
														<button class="btn btn-xs btn-default " data-rating="2"><span class="fa fa-envelope-o"></span></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> {{-- talent item container --}}
						<?php } ?>
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">

		</div>

	</div>
@stop
