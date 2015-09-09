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
							<a href="/cd/projects/create" class="btn btn-primary btn-labeled" style="width: 100%;">
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
							<div class="row-fluid col-no-padding clearfix">
								<div class="col-sm-12 col-md-6">
									<div>
	                                    <strong>Project ID:</strong> 1497936
	                                    <hr>
										<strong>
											Commercials
										</strong>
										 | 
										<strong>
											Non-Union
										</strong>
									</div>
									<div>
										<strong>Created on:</strong>
										2015-09-09
									</div>

									<div>
										<strong>Submission date:</strong>
										1970-01-01
									</div>

									<div>
										<strong>Audition date:</strong>
										2015-09-09
									</div>
	                                
									<div>
										<strong>Shoot date:</strong>
										1970-01-01
									</div>

									<div>
										<strong>Filming in:</strong>
										90210
									</div>
								</div>
								<div class="col-sm-12 col-md-6 text-align-right-md-lg">
									<div class="margin-top-small-sm">
										<a href="/cd/projects/1497936/overview" class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
											Project Overview
										</a>
										<a href="/cd/projects/1497936/selfsubmissions/4920223" class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz btn-submissions margin-top-small-zz-xs">
											Submissions
										</a>
										<a href="/cd/projects/1497936/schedules/create" class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
											<i class="fa fa-plus"></i>
											Create Schedule
										</a>
										<a href="/cd/projects/1497936/likeitlist" class="btn btn-success btn-sm font-size-small-normal-zz padding-small-zz">
											View Like it List
										</a>
									</div>
								</div>

								<div class="col-sm-12 margin-top-small">
									<a class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz" href="/cd/projects/1497936/jobs/create">
										<i class="fa fa-plus"></i>
										Add Role
									</a>
									<a class="btn btn-info btn-sm font-size-small-normal-zz padding-small-zz" href="/cd/projects/1497936/edit">
										<i class="fa fa-pencil"></i>
										Edit Project
									</a>

									<a class="btn btn-default btn-sm font-size-small-normal-zz padding-small-zz project-item-delete">
										<i class="fa fa-close"></i>
										Delete Project
									</a>

								</div>
							</div>

							<div class="roles-table">
								<hr class="negate-padding display-none-zz-sm">

								<div class="row-fluid clearfix hidden-xs hidden-sm margin-top-small-normal margin-bottom-small-normal role-columns">
									<div class="col-md-6">Role</div>
									<div class="col-md-2">Like It List</div>
									<div class="col-md-4">&nbsp;</div>
								</div>

								<div class="margin-bottom-normal display-none-md-lg"></div>

								<div class="stripe-bg-default">

								
									<div class="row-fluid clearfix padding-top-zero padding-bottom-zero-small negate-padding-when-small stripe-bg-item-odd job-item" data-job-id="4920223">
										<div class="col-md-6 col-xs-12 col-sm-6">
											<strong class="display-none-md-lg">Role </strong>
											<strong>ID# 4920223</strong>: 
										</div>
										<div class="col-md-2 col-xs-12 col-sm-6">
											<strong class="display-none-md-lg">Like It List: </strong>
	                                        None
										</div>
										<div class="col-md-4 col-xs-12 padding-top-zero-small-zz-sm padding-bottom-zero-small-zz-sm text-center">
											<a class="btn btn-primary btn-xs font-size-small-normal padding-small-zz-xs" href="/cd/projects/1497936/rolematches/4920223">
												View Matches
											</a>
											<a class="font-size-small-normal margin-left-small font-size-small" href="/cd/projects/1497936/jobs/4920223/edit">
												 <i class="fa fa-pencil"></i>&nbsp;Edit
											</a>
											<a class="font-size-small-normal margin-left-small font-size-small job-item-delete" style="cursor: pointer">
												 <i class="fa fa-trash-o"></i>&nbsp;Remove
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>  {{-- panel 1 --}}
		
		
			<div class="panel-group panel-group-danger project-item" data-casting-id="1489590">
				<div class="panel">
					<div class="panel-heading">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-target="#project-item-1489590" aria-expanded="false">
							Dadada
						</a>
					</div>
					<div class="panel-collapse collapse" id="project-item-1489590" aria-expanded="false" style="height: 0px;">
						<div class="panel-body padding-left-zero-zz-xs padding-right-zero-zz-xs">

							<div class="row-fluid col-no-padding clearfix">
								<div class="col-sm-12 col-md-6">
									<div>
	                                    <strong>Project ID:</strong> 1489590
	                                    <hr>
										<strong>
											Commercials
										</strong>

										 | 

										<strong>
											SAG
										</strong>

									</div>

									<div>
										<strong>Created on:</strong>
										2015-06-17
									</div>

									<div>
										<strong>Submission date:</strong>
										2015-08-04
									</div>

									<div>
										<strong>Audition date:</strong>
										2015-07-04
									</div>
	                                
									<div>
										<strong>Shoot date:</strong>
										2015-09-04
									</div>

									<div>
										<strong>Filming in:</strong>
										Minglanilla
									</div>

								</div>

								<div class="col-sm-12 col-md-6 text-align-right-md-lg">
									<div class="margin-top-small-sm">
										<a href="/cd/projects/1489590/overview" class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
											Project Overview
										</a>
										<a href="/cd/projects/1489590/selfsubmissions/4813705" class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz btn-submissions margin-top-small-zz-xs">
											Submissions
										</a>
										<a href="/cd/projects/1489590/schedules/create" class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
											<i class="fa fa-plus"></i>
											Create Schedule
										</a>
										<a href="/cd/projects/1489590/likeitlist" class="btn btn-success btn-sm font-size-small-normal-zz padding-small-zz">
											View Like it List
										</a>
									</div>
								</div>

								<div class="col-sm-12 margin-top-small">
									<a class="btn btn-primary btn-sm font-size-small-normal-zz padding-small-zz" href="/cd/projects/1489590/jobs/create">
										<i class="fa fa-plus"></i>
										Add Role
									</a>
									<a class="btn btn-info btn-sm font-size-small-normal-zz padding-small-zz" href="/cd/projects/1489590/edit">
										<i class="fa fa-pencil"></i>
										Edit Project
									</a>

									<a class="btn btn-danger btn-sm font-size-small-normal-zz padding-small-zz project-item-delete">
										<i class="fa fa-close"></i>
										Delete Project
									</a>

								</div>
							</div>
	                        
							<div class="roles-table">
								<hr class="negate-padding display-none-zz-sm">

								<div class="row-fluid clearfix hidden-xs hidden-sm margin-top-small-normal margin-bottom-small-normal role-columns">
									<div class="col-md-6">Role</div>
									<div class="col-md-2">Like It List</div>
									<div class="col-md-4">&nbsp;</div>
								</div>

								<div class="margin-bottom-normal display-none-md-lg"></div>
								<div class="stripe-bg-default">
									<div class="row-fluid clearfix padding-top-zero padding-bottom-zero-small negate-padding-when-small stripe-bg-item-odd job-item" data-job-id="4813705">
										<div class="col-md-6 col-xs-12 col-sm-6">
											<strong class="display-none-md-lg">Role </strong>
											<strong>ID# 4813705</strong>: James Yaya
										</div>
										<div class="col-md-2 col-xs-12 col-sm-6">
											<strong class="display-none-md-lg">Like It List: </strong>
	                                        None
										</div>
										<div class="col-md-4 col-xs-12 padding-top-zero-small-zz-sm padding-bottom-zero-small-zz-sm text-center">
											<a class="btn btn-primary btn-xs font-size-small-normal padding-small-zz-xs" href="/cd/projects/1489590/rolematches/4813705">
												View Matches
											</a>
											<a class="font-size-small-normal margin-left-small font-size-small" href="/cd/projects/1489590/jobs/4813705/edit">
												 <i class="fa fa-pencil"></i>&nbsp;Edit
											</a>
											<a class="font-size-small-normal margin-left-small font-size-small job-item-delete" style="cursor: pointer">
												 <i class="fa fa-trash-o"></i>&nbsp;Remove
											</a>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div> {{-- panel 2 --}}
		</div>

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