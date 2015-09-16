@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Browse Talents', 'url' => '/talents', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-search"></i> Browse Talents
@stop


@section('sidebar.body')

	<div class="talents-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid">
				@include('components.talent-filter')

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
					<div class="row-fluid clearfix" id="talent-list">
						<div class="hide" data-bind-template="#talent-list" data-bind-value="data">
							
							<div class="col-md-4 talent-item-container">
							 	<div class="panel">
							 		<div class="panel-body">
							 			<div class="row-fluid clearfix">
							 				<div class="head-area padding-zero padding-bottom-small col-md-12">
							 					<div class="talent-name font-size-normal text-semibold float-left text-succes"><span data-bind="<%= getFullName() %>"></span> <span class="age-area">, <span data-bind="<%= getAge() %>"></span></span></div>
							 
							 					<div class="favorite-indicator float-right">
							 						<i class="fa fa-star-o font-size-medium-large text-light-gray"></i>
							 					</div>
							 				</div>
							 			</div>
							 			
							 			<div class="row-fluid clearfix">
							 				<div class="talent-photo col-lg-6 col-md-12 col-sm-12">
							 					<img data-bind="<%= getPrimaryPhoto() %>" alt="" class="img-responsive">
							 				</div>
							 				
							 				<div class="col-lg-6 col-md-12 col-sm-12 padding-right-zero talent-information padding-top-small">
							 					<div class="talent-location">
							 						<i class="fa fa-map-marker"></i> <span data-bind="<%= (city || state) ? city + ', ' + state : 'N/A' %>"></span>
							 					</div>
							 				
							 					<ul class="list-unstyled talents-list-details">
							 						<li><span data-bind="<%= heightText() %>"></span></li>
							 						<li><span data-bind="<%= (bam_talentinfo1.weightpounds > 0 || bam_talentinfo1.weightpounds) ? bam_talentinfo1.weightpounds + ' lbs.' : 'N/A' %>"></span></li>
							 						<li><span data-bind="<%= (bam_talentinfo2.ethnicity) ? bam_talentinfo2.ethnicity : 'N/A' %>"></span></li>
							 						<li><span data-bind="<%= (bam_talentinfo1.build) ? bam_talentinfo1.build + ' body' : 'N/A' %>"></span></li>
							 						<li><span data-bind="<%= (bam_talentinfo1.eyecolor) ? bam_talentinfo1.eyecolor + ' eyes' : 'N/A' %>"></span></li>
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
							 </div>  {{-- talent item container --}}
							
						</div>
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">

		</div>

	</div>
@stop
