@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Like it List', 'url' => '/roles/1/likeitlist', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-search"></i> Like it List
@stop


@section('sidebar.body')
	<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid">
				
				<div class="col-md-9 talents-search-result">
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
					<div class="row clearfix">
						<div class="col-md-4 talent-item-container">
							<!-- <div class="col-md-12"> -->
								<button class="btn btn-danger btn-xs pull-right" type="button"><i class="fa fa-times"></i></button>
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#talent-body" data-toggle="tab">Photo</a>
									</li>
									<li>
										<a href="#like-it-note" data-toggle="tab">My Notes</a>
									</li>	
								</ul>
							<!-- </div>	 -->
								
							<div class="panel">
								<div class="panel-body">
									<div class="row-fluid clearfix">
										<div class="tab-content padding-top-zero">
											<div class="tab-pane fade active in" id="talent-body">
												<div class="head-area padding-zero padding-bottom-zero col-md-12">
													<div class="talent-name font-size-normal text-semibold float-left text-succes">Angelique Augusto <span class="age-area">, 22</span></div>
														<div class="favorite-indicator float-right">
														<i class="fa fa-star-o font-size-medium-large text-light-gray"></i>
													</div>
												</div>
												<div class="row-fluid clearfix">
													<div class="talent-photo col-lg-6 col-md-12 col-sm-12">
														<img src="../../images/talents-sample-image.jpg" alt="" class="img-responsive">
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
											</div>
											<div class="tab-pane fade" id="like-it-note">
												<div class="tab-pane" id="tab-content-2">
													<div class="item-container-holder">
														<div class="talent-item note-item-container padding-small">
															<div class="note-item">
																<div class="note-header">
																	<div class="photo"></div>
																	<div class="name-date">
																		<div class="name">John Snow</div>
																		<div class="date">09/20/2015</div>
																	</div>
																</div>
																<div class="note-body">
																	Donec rutrum congue leo eget malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.Donec rutrum congue leo eget malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.
																</div>
															</div>
															<div class="note-item">
																<div class="note-header">
																	<div class="photo"></div>
																		<div class="name-date">
																			<div class="name">Arya Stark</div>
																			<div class="date">010/05/2015</div>
																		</div>
																</div>
																<div class="note-body">
																	Quisque velit nisi, pretium ut lacinia in, elementum id enim. Proin eget tortor risus. Nulla porttitor accumsan tincidunt.
																</div>
															</div>
														</div>
														
													</div>
													<a href="#"><div class="add-casting-note padding-top-small padding-bottom-small bordered text-align-center"><i class="fa fa-plus"></i> Add Casting Note</div></a>
												</div>
											</div>
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
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">

		</div>

	</div>
@stop

@stop
