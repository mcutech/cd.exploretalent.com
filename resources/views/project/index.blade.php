@extends('layouts.project')

@section('project.body')
	<ul class="breadcrumb breadcrumb-page">
		<li><a href="/cd/projects">Home</a></li>
			<li class="active">
			<a href="/cd/#"> My Projects</a>
		</li>
	</ul>

	<div class="projects-wrapper">
		<div class="page-header">
			<div class="row">
				<!-- Page header, center on small screens -->
				<h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
						<i class="fa fa-th-list page-header-icon"></i> My Projects
				</h1>
				<div class="col-xs-12 col-sm-8">
					<div class="row">
						<hr class="visible-xs no-grid-gutter-h">
						<div class="pull-right col-xs-12 col-sm-auto">
							<a href="/projects/create" class="btn btn-primary btn-labeled" style="width: 100%;">
								<span class="btn-label icon fa fa-plus"></span>
								Create Project
							</a>
						</div>

					</div>
				</div>
			</div>
		</div> <!-- / .page-header -->

		<div id="project-listing">
			<div class="panel-group panel-group-primary project-item panel-blue" data-casting-id="1497936">
				<div class="panel">
					<div class="panel-heading">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-target="#project-item-1497936" aria-expanded="false">
							Tralalala
						</a>
					</div>
					<div class="panel-collapse collapse" id="project-item-1497936" aria-expanded="false" style="height: 0px;">
						<div class="panel-body padding-left-zero-zz-xs padding-right-zero-zz-xs">
							<div class="row-fluid clearfix margin-bottom-normal">
								<div class="col-md-6">
									<strong>Project ID# 1497936</strong>
								</div>
								<div class="col-md-6">
									<div class="float-right">
										<a href="/cd/projects/1497936/overview" class="btn btn-outline btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
											Project Overview
										</a>
										<a href="/cd/projects/1497936/selfsubmissions/4920223" class="btn btn-outline btn-sm font-size-small-normal-zz padding-small-zz btn-submissions margin-top-small-zz-xs">
											Submissions
										</a>
										<a href="/cd/projects/1497936/schedules/create" class="btn btn-outline btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
											<i class="fa fa-plus"></i>
											Create Schedule
										</a>
										<a href="/cd/projects/1497936/likeitlist" class="btn btn-success btn-sm font-size-small-normal-zz padding-small-zz">
											View Like it List
										</a>
									</div>
								</div>
							</div>
							<div class="row-fluid col-no-padding clearfix project-details-container">
								<div class="col-sm-12 col-md-6">
									<ul class="list-unstyled additional-details margin-zero">
										<li><div class="title">Project Type:</div>Print</li>
										<li><div class="title">Location:</div>Beverly Hills, CA</li>
										<li><div class="title">Rate/Pay:</div>$7,500 per day</li>	
										<li><div class="title">Audition Date:</div>09-23-2015</li>
										<li><div class="title">Casting Category:</div>Modeling - Print</li>
										<li><div class="title">Market In:</div>Los Angeles, California</li>	
									</ul>
								</div>

								<div class="col-sm-12 col-md-6">
									<ul class="list-unstyled additional-details margin-zero">
										<li><div class="title">Submission Type:</div>Self Response</li>	
										<li><div class="title">Union:</div>Commercials, Non-Union</li>
										<li><div class="title">Release Date:</div>01-07-2015</li>
										<li><div class="title">Deadline:</div><span class="text-danger">02-15-15</span></li>						
									</ul>
								</div>

								<div class="col-md-12">
									<ul class="list-unstyled description">
										<li><div class="title">Description:</div>Male Models for Runway Fashion Show</li>		
									</ul>
								</div>

								<div class="col-sm-12 margin-top-small">
									<a class="btn btn-lg btn-outline font-size-normal padding-small-zz" href="/cd/projects/1497936/jobs/create">
										<i class="fa fa-plus"></i>
										Add Role
									</a>
									<a class="btn btn-lg btn-outline font-size-normal padding-small-zz" href="/cd/projects/1497936/edit">
										<i class="fa fa-pencil"></i>
										Edit Project
									</a>

									<a class="btn btn-lg btn-outline font-size-normal padding-small-zz project-item-delete">
										<i class="fa fa-close"></i>
										Delete Project
									</a>
								</div>
							</div>
							
							<div class="row-fluid clearfix margin-top-normal">
								<div class="col-md-12">
									<div class="alert alert-success margin-bottom-zero">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>2 role(s)</strong> found for this casting.
									</div>
								</div>
							</div>

							<div class="roles-container" class="row-fluid col-no-padding clearfix margin-top-normal">
								<div class="col-md-12">
									
									<?php for($x=0; $x<5; $x++) { ?>
									<div class="panel roles-item">
										<div class="padding-normal">
											<div class="row-fluid clearfix roles-header">
												<div class="col-md-6 text-bold">
													<span>Role ID#4556931</span> - <span>Male Models</span>
													<ul class="list-unstyled description">
														<li><div class="title">Description:</div> Male models with athletic body.</li>	
													</ul>
												</div>
												<div class="col-md-6">
													<div class="float-right">
														<a class="btn btn-lg btn-outline font-size-normal" href="#">
															<i class="fa fa-pencil"></i> Edit
														</a>

														<a class="btn btn-lg btn-outline font-size-normal" href="#">
															<i class="fa fa-trash-o"></i> Delete
														</a>

														<a href="#" class="btn btn-success padding-small-normal">View matches</a>
													</div>
												</div>
											</div> {{-- roles header --}}

											<div class="row-fluid clearfix">
												<div class="col-md-3 details-label-container">
													<div class="details-label"><span>Gender:</span> Male</div>
												</div>

												<div class="col-md-3 details-label-container">
													<div class="details-label"><span>Age:</span> 18 to 50</div>
												</div>

												<div class="col-md-3 details-label-container">
													<div class="details-label"><span>Height:</span> 5'5" to 7'10"</div>
												</div>

												<div class="col-md-3 details-label-container">
													<div class="details-label"><span>Talents:</span> 5</div>
												</div>

												{{-- <div class="col-md-3 details-label-container">
													<div class="details-label"><span>Ethnicity:</span> Any</div>
												</div>

												<div class="col-md-3 details-label-container">
													<div class="details-label"><span>Body Type:</span> Athletic</div>
												</div> --}}
											</div>
										</div>
									</div>{{-- roles-item --}}
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>  {{-- panel 1 --}}
		
		</div>
		{{-- project listing --}}

		<div id="pagination" class="text-center">
		<nav>
			<ul class="pagination" id="pagination">
				<li class="active">
					<a href="http://stage-cd.exploretalent.com/cd/projects?pg=1&amp;per_pg=5">
						1
					</a>
				</li>
			
				<li class="">
					<a href="http://stage-cd.exploretalent.com/cd/projects?pg=2&amp;per_pg=5">
						2
					</a>
				</li>
			
				<li class="">
					<a href="http://stage-cd.exploretalent.com/cd/projects?pg=3&amp;per_pg=5">
						3
					</a>
				</li>
			
				<li class="">
					<a href="http://stage-cd.exploretalent.com/cd/projects?pg=4&amp;per_pg=5">
						4
					</a>
				</li>
		  	</ul>
		</nav>
	</div>

	<div class="modal fade confirm-modal" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<strong class="confirm-modal-title"></strong>
					<div class="pull-right">
						<i class="fa fa-close" data-dismiss="modal"></i>
					</div>
				</div>
				<div class="modal-body">
					<div class="confirm-modal-message"></div>
					<br>
					<div class="confirm-modal-buttons">
						<div class="btn btn-danger confirm-btn-yes">Yes</div>
						<div class="btn btn-primary confirm-btn-no">No</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop