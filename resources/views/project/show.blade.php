@extends('layouts.project', ['pages' => [ [ 'name' => 'Project Name', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => '/projects/Overview', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-file-text"></i> Project Overview
@stop

@section('sidebar.body')

<div class="project-overview-wrapper">
	  <div class="panel-heading font-size-normal-medium"> Roles </div>
	  <div class="panel-body">		
		<div class="row-fluid clearfix margin-bottom-small">
	  		<div class="col-md-2">
	  			<label for="">Role Name</label>
	  		</div>
	  		<div class="col-md-2">
	  			<label for="">Summary</label>
	  		</div>
	  		<div class="col-md-2">
	  			<label for=""></label>
	  		</div>
	  		<div class="col-md-6">
	  			<label for="">Details</label>
	  		</div>				
		</div>
		
		<div id="role-list">
			<div data-bind-template="#role-list" data-bind-value="bam_roles" class="row-fluid clearfix border-t padding-top-normal roles-item">
				<!-- Rolename -->
				<div class="col-md-2 role-name">
					<ul class="list-unstyled">
						<li><span class="font-size-normal-medium" data-bind="<%= name %>">Role Name 1</span></li>
						<li>
						  <button type="button" class="btn btn-primary btn-xs">Edit</button>
						  <button type="button" class="btn btn-default btn-xs btn-outline">Archive</button>								
						</li>
					</ul>			
				</div>

				<!-- Summary1 -->
				<div class="col-md-2 summary">
					<ul class="list-unstyled">
						<li class="">
							<div class="text-right data-value">
								<a href="#" class="text-bold">10,000</a>
							</div>
							<div class="data-name">
								Matches
							</div>
						</li>
						<li class="text-left">
							<div class="text-right data-value">
								<a href="#" class="text-bold">1</a>
							</div>
							<div class="data-name">
								Self Submissions
							</div>
						</li>
						<li class="text-left">
							<div class="text-right data-value">
								<a href="#" class="text-bold">10</a>
							</div>
							<div class="data-name">
								Like it List
							</div>
						</li>
					</ul>
				</div>

				<!-- Summary2 -->
				<div class="col-md-2 summary">
					<ul class="list-unstyled">
						<li><a href="#" class="text-bold">100</a> Scheduled</li>
						<li><a href="#" class="text-bold">1</a> Callbacks</li>
						<li><a href="#" class="text-bold">1</a> Booked</li>
					</ul>	
				</div>

				<!-- Details -->
				<div class="col-md-6 details">
					<dl class="">
					  <dt>Preferences</dt>
					  <dd>Male / Lead / Asians, Mixed / 22 to 30 / 5'0" 6'0" / 200 to 300 lbs. / Muscular, Large</dd>
					</dl>

					<dl class="">
					  <dt>Description</dt>
					  <dd ><span data-bind="<%= des %>"> </span></dd>
					</dl>						
				</div>
			</div> <!-- roles item -->	
		</div>
																			
	  </div>

	  <div class="panel-heading font-size-normal-medium margin-top-large"> Project Details </div>
	  <div class="panel-body">		

						<div class="row-fluid clearfix margin-bottom-normal">
							<div class="col-md-6">
								<strong>Project ID# <span data-bind="<%= casting_id %>"></span></strong>
							</div>
						</div>
						<div class="row-fluid col-no-padding clearfix project-details-container">
							<div class="col-sm-12 col-md-4">
								<ul class="list-unstyled additional-details margin-zero">
									<li><div class="title">Category:</div><span data-bind="<%= getCategory() %>"></span></li>
									<li><div class="title">Union:</div><span data-bind="<%= (union2 == 0) ? 'Non-union' : 'Union' %>"></span></li>
									<li><div class="title">Rate:</div><span data-bind="<%= rate %>"></span></li>	
								</ul>
							</div>

							<div class="col-sm-12 col-md-4">
								<ul class="list-unstyled additional-details margin-zero">															
									<li><div class="title">Sub Deadline:</div><span data-bind="<%= (asap == 0) ? 'N/A' : date.formatYMD(asap) %>"></span></li>
									<li><div class="title">Audition Deadline:</div><span data-bind="<%= (aud_timestamp == 0) ? 'N/A' : date.formatYMD(aud_timestamp) %>"></span></li>
								</ul>
							</div>

							<div class="col-sm-12 col-md-4">
								<a href="#" class="btn btn-default btn-block btn-outline">Edit Project</a>
							</div>

							<div class="col-md-12 margin-top-large">
								<dl>
								  <dt>Description</dt>
								  <dd><p  data-bind="<%= des %>"> </p></dd>
								</dl>								
							</div>

							<div class="col-md-12 margin-top-large">
								<dl class="margin-zero">
								  <dt>Location</dt>
								  <dd><p data-bind="<%= location %>"></p></dd>
								</dl>								
							</div>


							<div class="col-md-12 margin-top-large">
								<span class="text-bold">Open Call Casting</span>
								<div class="col-sm-12 col-md-12 margin-top-small padding-zero">
									<div class="row-fluid clearfix bordered padding-small text-bold">
										<div class="col-md-4">
											Schedule
										</div>
										<div class="col-md-4">
											Location
										</div>
										<div class="col-md-4">
											Phone
										</div>
									</div>

									<ul class="list-unstyled additional-details margin-zero">
										<li>
											<div class="row-fluid clearfix">
												<div class="col-md-4">
													12:00 PM April 010, 2015
												</div>
												<div class="col-md-4">
													100th FLoor COC Building
												</div>
												<div class="col-md-4">
													123-456-1234
												</div>
											</div>
										</li>
										<li>
											<div class="row-fluid clearfix">
												<div class="col-md-4">
													11:00 PM April 010, 2015
												</div>
												<div class="col-md-4">
													101th FLoor COC Building
												</div>
												<div class="col-md-4">
													124-456-1234
												</div>
											</div>
										<li>
											<div class="row-fluid clearfix">
												<div class="col-md-4">
													1:00 PM April 010, 2015
												</div>
												<div class="col-md-4">
													200th FLoor COC Building
												</div>
												<div class="col-md-4">
													323-456-1234
												</div>
											</div>
										</li>	
									</ul>
								</div>	
							</div>											
						</div>			

																				
	  </div>	  
</div> <!-- project-overview-wrapper --> 
@stop
