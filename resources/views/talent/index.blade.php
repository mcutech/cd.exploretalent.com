@extends('layouts.sidebar')

@section('sidebar.body')

	{{-- Slider Style --}}
		<!-- css -->
		<style>
			.cd-range-slider { margin-bottom: 20px; }
		</style>
		<!-- / css -->

		<!-- Javascript -->
		<script>
			init.push(function () {
				var range_sliders_options = {
					'range': true,
					'min': 0,
					'max': 500,
					'values': [ 125, 300 ]
				};
				$('.cd-range-slider').slider(range_sliders_options);
		</script>
		<!-- / Javascript -->
	{{-- /Slider Style --}}
		<script>
			init.push(function () {
				$('#switchers-colors-default > input').switcher();
				$('#switchers-colors-square > input').switcher({ theme: 'square' });
				$('#switchers-colors-modern > input').switcher({ theme: 'modern' });
			});
		</script>
	{{-- Switcher Style --}}


	<ul class="breadcrumb breadcrumb-page">
		<li><a href="">Home</a></li>
		<li class="active">
			<a href=""> Browse Talents</a>
		</li>
	</ul>
	<div class="talents-wrapper">
		<div class="page-header">
			<div class="row">
				<h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
					<i class="fa fa-search"></i> Browse Talents
				</h1>
			</div>
		</div>

		<div class="talents-search-filter-content">
			<div class="row-fluid">
				<div class="col-md-3 refine-search-sidebar">
					<div class="panel panel-talents-search">
						<div class="panel-heading">
							<span class="panel-title talents-refine-title">Refine Search</span>
							<div class="panel-heading-controls">
								<div class="panel-heading-icon"><i class="fa fa-chevron-left"></i></div>
							</div>
						</div>
						<div class="panel-body">
							<div class="location">
								<div class="panel panel-transparent margin-bottom-normal">
									<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
										<div class="panel-title text-uppercase"><strong>Location</strong></div>
									</div>
									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-semibold margin-bottom-zero">Enter Zip Code to Select Markets</label>
												<div class="row">
													<div class="col-md-12">
														<div class="input-group">
															<input type="text" class="form-control" name="zip_code" placeholder="Enter Zip Code" id="zip-code" max="5" maxlength="5">
															<span class="input-group-btn">
																<button class="btn" type="button" id="auto-select-markets">
																	<i class="fa fa-caret-right"></i>
																</button>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body -->
								</div>

								<div class="panel panel-transparent no-margin-b">
									<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
										<div class="panel-title text-uppercase"><strong>Appearance</strong></div>
									</div>
									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-bold margin-bottom-zero">Age Range <span class="text-normal">1 - 100 y.o</span></label>
												<div class="row">
													<div class="col-md-12">
														<div class="ui-slider-range-demo"></div>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body age range-->

									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-bold margin-bottom-zero">Gender</label>
												<div class="row">
													<div class="col-md-12">
														<label class="checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Male</span>
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" id="inlineCheckbox2" value="option2" checked="" class="px"> <span class="lbl">Female</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body gender-->

									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-bold margin-bottom-zero">Has Picture</label>
												<div class="row">
													<div class="col-md-12">
														<input type="checkbox" data-class="switcher-success" checked="checked">
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body gender-->

									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-bold margin-bottom-zero">Height Range <span class="text-normal">1'0" - 8'0"</span></label>
												<div class="row">
													<div class="col-md-12">
														<div class="ui-slider-range-demo"></div>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body height-->

									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-bold margin-bottom-zero">Body Type</label>
												<div class="row">
													<div class="col-md-12">
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Average</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Athletic</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Muscular</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Extra-Large</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Large</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Lean-Muscle</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Medium</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Petite</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Slim</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body body type-->

									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-bold margin-bottom-zero">Ethnic Appearance</label>
												<div class="row">
													<div class="col-md-12">
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">African</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">African American</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Asian</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Caucasian</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">East Indian</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
															<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Hispanic</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Middle Eastern</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body ethnic appearance-->

								</div> {{-- panel appearance --}}

								<div class="panel panel-transparent no-margin-b">
									<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
										<div class="panel-title text-uppercase"><strong>Membership</strong></div>
									</div>

									<div class="panel-body padding-small no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<div class="row">
													<div class="col-md-12">
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox1" value="option1" class="px"> <span class="lbl">Pro Member</span>
															</label>
														</div>
														<div class="checkbox">
															<label>
																<input type="checkbox" id="inlineCheckbox2" value="option2" checked="" class="px"> <span class="lbl">Amateur Member</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- ./panel-body gender-->
								</div> {{-- panel appearance --}}	
								
								<div class="row-fluid clearfix">
									<div class="col-md-12 padding-zero">
										<a href="#" class="btn btn-success btn-block">Search</a>
									</div>
								</div>							

							</div> {{-- location --}}
						</div>
					</div>
				</div> {{-- refine-search-sidebar --}}
				<div class="col-md-9 talents-search-result">
					<div class="row-fluid clearfix">
						<div class="col-md-12">
							<div class="pull-right">Showing: 1 to 25 of 7862526</div>
						</div>
					</div>
					<div class="row-fluid clearfix">
						<div class="col-md-4 talent-item-container">
							<div class="panel">
								<div class="panel-body">
									<div class="head-area padding-zero padding-bottom-small col-md-12">
										<div class="talent-name font-size-normal-medium text-semibold float-left">Angelique Augusto <span class="age-area">, 22</span></div>

										<div class="favorite-indicator float-right">
											<i class="fa fa-star-o font-size-medium text-light-gray"></i>
										</div>
									</div>
									
									<div class="row-fluid clearfix">
										<div class="talent-photo col-lg-6 col-md-12 col-sm-12">
											<img src="images/talents-sample-image.jpg" alt="" class="img-responsive">
										</div>
										
										<div class="col-lg-6 col-md-12 col-sm-12 padding-right-zero talent-information">
											<div class="talent-location">
												<i class="fa fa-map-marker"></i> Los Angeles, CA
											</div>
										
											<ul class="list-unstyled">
												<li>H: 5' 10"</li>
												<li>W: 138 lbs.</li>
												<li>Caucasian</li>
												<li>Athletic Body</li>
												<li>Green Eyes</li>
											</ul>
											
										</div>
									</div>
									<div class="like-it-list-container col-lg-6 padding-zero">
										<div class="text-left">
											<div class="display-block"> Add To Like List </div>
											<div class="btn-group btn-group-xs like-it-buttons">
												<button class="btn btn-xs btn-danger " data-rating="1">1</button>
												<button class="btn btn-xs btn-warning " data-rating="2">2</button>
												<button class="btn btn-xs btn-info " data-rating="3">3</button>
												<button class="btn btn-xs btn-primary " data-rating="4">4</button>
												<button class="btn btn-xs btn-success " data-rating="5">5</button>
												<button class="btn btn-xs btn-default btn-close display-none">×</button>
											</div>
										</div>
									</div>
									<div class="col-lg-6 padding-zero">
										<div class="text-center col-xs-12">
											<button class="btn btn-default"><span class="fa fa-file-text-o"></span></button>
											<button class="btn btn-default"><span class="fa fa-picture-o"></span></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">

		</div>

	</div>
@stop
