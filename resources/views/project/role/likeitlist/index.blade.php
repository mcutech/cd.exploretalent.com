@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Like it List', 'url' => '/roles/1/likeitlist', 'active' => true] ] ])

@section('sidebar.page-header')
	<div class="text-semibold">Like it List</div>
	<div class="display-block-inline">
		<h5 class="text-normal margin-top-zero-small margin-bottom-small">Casting: <span data-bind="<%= name %>"></span></h5>
		<h5 class="text-normal margin-zero">Role: <span data-bind="<%= role.name %>"></span></h5>
	</div>
@stop

@section('sidebar.page-extra')
<div class="row-fluid clearfix">
	<div class="col-md-6 float-right">
		<div class="panel margin-bottom-zero display-block-inline">
			<div class="padding-sm">
				<h5 class="text-primary"><i class="fa fa-thumbs-o-up"></i> Like It List for this Role: <b>64</b></h5>
				<a href="" class="btn btn-default btn-xs">View Lists & Contact Talent</a>
				<a href="" class="btn btn-default btn-xs">Remove All</a>
			</div>
		</div>
	</div>
</div>
@stop


@section('sidebar.body')
	<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">

		<div class="talents-search-filter-content">

			<div class="row-fluid clearfix">
				<div class="col-md-6">
					<ul class="nav nav-tabs negate-padding border-zero">
						<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Pre-Submissions</a>
						</li>
						<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Self Submissions</a>
						</li>
						<li role="presentation" class="active font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Like It List</a>
						</li>
					</ul>
				</div>
				<div class="col-md-6">
					<div class="form-group margin-bottom-zero row-fluid">
						<label for="select-role" class="col-md-3 margin-top-small control-label text-align-right">
							Select Role
						</label>
						<div class="col-md-9 padding-left-zero">
							<select class="form-control">
								<option value="1">Select Role 1</option>
								<option value="2">Select Role 2</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="margin-bottom-normal padding-bottom-normal bordered no-border-hr no-border-t"></div>
				</div>
			</div>

			<div class="row-fluid clearfix">

				<div class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div class="padding-top-small">
								<h5 class="margin-zero"><span class="text-normal">Matches for Role:</span> Name of Role Display Here</h5>
							</div>
						</div>
						<div class="col-md-6 text-align-right">
							<a href="" class="btn btn-primary">Share Like It List</a>
							<a href="" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Invite to Audition</a>
						</div>
					</div>

					<div class="row-fluid clearfix">
						<?php for($x=1; $x<12; $x++) { ?>
						<div class="col-md-3 talent-item-container">
							<!-- <div class="col-md-12"> -->
								<a href="" class="btn btn-default btn-outline btn-xs pull-right" type="button"><i class="fa fa-times"></i></a>
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
										<div class="tab-content padding-top-zero padding-bottom-small">
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
									<div class="row-fluid clearfix margin-top-small">
										<div class="col-md-12 padding-zero">
											<a href="" class="btn btn-default btn-block btn-outline"><i class="fa fa-envelope-o"></i> Send Message</a>
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

@stop
