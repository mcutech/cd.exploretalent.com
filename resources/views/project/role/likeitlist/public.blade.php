@extends('layouts.master')

@section('master.body')
<div class="container public-view-like-it-list padding-top-large">
	<div class="row-fluid clearfix padding-left-normal padding-right-normal">		
		<div class="col-md-12 clearfix">
			<div class="row-fluid clearfix">
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">
							<img src="../../../../../images/logo-home.png" alt="" width="120px">
						</span>
					</div>
					<div class="panel-body padding-top-normal padding-bottom-normal">
						<div class="row">
							<div class="col-md-5 col-xs-12 col-sm-6">
								<h5><span class="text-normal">Project:</span> Name 1</h4>
								<h5>Role: Main Role</h4>
							</div>
							<div class="col-md-7 col-xs-12 col-sm-6 mt-5">
								<h5><span class="text-600">Company:</span> Casting Company Name</h4>
								<h5><span class="text-normal">Casting Director: Michael Smith</span> </h4>	
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">
		<div class="talents-search-filter-content">
			<div class="row-fluid clearfix">
				<div class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix">
						<?php for($x=1; $x<12; $x++) { ?>
						<div class="col-md-3 talent-item-container">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#talent-body" data-toggle="tab">Photo</a>
									</li>
									<li>
										<a href="#like-it-note" data-toggle="tab">My Notes</a>
									</li>	
								</ul>	
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
													<div class="">
														<div class="talent-photo col-lg-6 col-md-12 col-sm-12">
															<img src="../../../../images/talents-sample-image.jpg" alt="" class="img-responsive">
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
												<div class="row-fluid clearfix submission-note padding-top-small padding-bottom-small">
													<div class="sub-note"><strong>Submission Note</strong></div>
													<span class="short float-left">I am perfect for the role lorem sitam...</span>
													<a href="" class="padding-left-small"><i class="fa fa-question-circle font-size-medium"></i></a>
												</div>
												<div class="row-fluid clearfix">
													<div class="col-md-6 padding-left-zero padding-right-zero-small">
														<button class="btn btn-default btn-sm btn-outline btn-block"><i class="fa fa-file-text"></i> View Resume</button>
													</div>
													<div class="col-md-6 padding-right-zero padding-left-zero-small">
														<button class="btn btn-default btn-sm btn-outline btn-block view-all-modal"><i class="fa fa-camera"></i> View Photos</button>
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
								</div>
							</div>
						</div> 
						<?php } ?>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>

	@include('components.modals.view-all-photos')

@stop