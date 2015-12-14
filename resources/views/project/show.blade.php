@extends('layouts.project', ['pages' => [ [ 'name' => 'Project Name', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => '/projects/Overview', 'active' => true ] ] ])

@section('sidebar.page-header')
<div class = "project-overview-wrapper">
	<i class="fa fa-file-text"></i> Project Overview - <span data-bind="<%=name%>"></span>
</div>
@stop

@section('sidebar.body')

<div class="project-overview-wrapper">
 	 <!--  <div class="panel-heading font-size-normal-medium"> Roles </div>
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
 				Rolename
 				<div class="col-md-2 role-name">
 					<ul class="list-unstyled">
 						<li><span class="font-size-normal-medium" data-bind="<%= name %>">Role Name 1</span></li>
 						<li>
 							<a class="btn btn-primary btn-xs edit-role" data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/edit">Edit</a>
 						  <button type="button" class="btn btn-default btn-xs btn-outline archive-role" data-bind="<%= role_id %>" data-bind-target="id">Archive</button>
 						</li>
 					</ul>
 				</div>
 
 				Summary1
 				<div class="col-md-2 summary">
 					<ul class="list-unstyled" data-bind="role-<%= role_id %>" data-bind-target="id">
 						<li class="">
 							<div class="text-right data-value">
 							</div>
 							<div class="data-name">
 								<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/matches" class="text-bold matches">
 									Role Matches
 								</a>
 							</div>
 						</li>
 						<li class="text-left">
 							<div class="text-right data-value">
 								<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/self-submissions" class="text-bold self-submissions">0</a>
 							</div>
 							<div class="data-name">
 								Self Submissions
 							</div>
 						</li>
 						<li class="text-left">
 							<div class="text-right data-value">
 								<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/like-it-list" class="text-bold like-it-list">0</a>
 							</div>
 							<div class="data-name">
 								Like it List
 							</div>
 						</li>
 					</ul>
 				</div>
 
 				Summary2
 				<div class="col-md-2 summary">
 					<ul class="list-unstyled">
 						<li><a href="#" class="text-bold">1</a> Callbacks</li>
 						<li><a href="#" class="text-bold">1</a> Booked</li>
 					</ul>
 				</div>
 
 				Details
 				<div class="col-md-6 details">
 					<dl class="">
 					  <dt>Preferences</dt>
 					  <dd><span data-bind="<%= gender %>"></span> / <span data-bind="<%= (ethnicity) ? ethnicity : 'Any' %>"></span> / <span data-bind="<%= age_min %> to <%= age_max %>"></span> / <span data-bind="<%= getHeightMinText() %> to <%= getHeightMaxText() %>"></span> / <span data-bind="<%= (build) ? build : 'Any' %>"></span></dd>
 					</dl>
 
 					<dl class="">
 					  <dt>Description</dt>
 					  <dd ><span data-bind="<%= des %>"> </span></dd>
 					</dl>
 				</div>
 			</div> roles item
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
 								<a class="btn btn-default btn-block btn-outline edit-project" data-bind="/projects/<%= casting_id %>/edit">Edit Project</a>
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
 
 							for open call
 							<div data-bind="<%= (project_type == 8) ? 1 : 0 %>" data-bind-target="visibility">
 								<div class="col-md-12 margin-top-large">
 									<span class="text-bold">Open Call Casting</span>
 									<div class="col-sm-12 col-md-12 margin-top-small padding-zero">
 										<div class="row-fluid clearfix bordered padding-small text-bold">
 											<div class="col-md-6">
 												Date/Time
 											</div>
 											<div class="col-md-6">
 												Address
 											</div>
 										</div>
 
 										<ul class="list-unstyled additional-details margin-zero">
 											<li>
 												<div class="row-fluid clearfix">
 													<div class="col-md-6">
 														<span data-bind="<%= date.formatYMD(parseInt(sub_timestamp)) %>"></span>
 													</div>
 													<div class="col-md-6">
 														<span data-bind="<%= (srn_address) ? srn_address : 'Not Set' %>"></span>
 													</div>
 												</div>
 											</li>
 										</ul>
 									</div>
 								</div>
 							</div>
 
 							for self submission
 							<div data-bind="<%= (project_type != 8) ? 1 : 0 %>" data-bind-target="visibility">
 								<div class="col-md-12 margin-top-large">
 									<span class="text-bold">Open Call Casting</span>
 									<div class="col-sm-12 col-md-12 margin-top-small padding-zero">
 										<div class="row-fluid clearfix bordered padding-small text-bold">
 											<div class="col-md-6">
 												Email Address
 											</div>
 											<div class="col-md-6">
 												Postal Address
 											</div>
 										</div>
 
 										<ul class="list-unstyled additional-details margin-zero">
 											<li>
 												<div class="row-fluid clearfix">
 													<div class="col-md-6">
 														<span data-bind="<%= snr_email %>"></span>
 													</div>
 													<div class="col-md-6">
 														<span data-bind="<%= (srn_address) ? srn_address : 'Not Set' %>"></span>
 													</div>
 												</div>
 											</li>
 										</ul>
 									</div>
 								</div>
 							</div>
 
 						</div>
 
 
 	  </div>
 </div> --> <!-- project-overview-wrapper -->
<div class="projects-wrapper">
		<div id="project-listing">

			<div class="panel-group panel-group-primary project-item" id="accordion-castings">
			  
			  		<div class="panel-heading panel-active hide">
			  			<a class="accordion-toggle" data-toggle="collapse" data-bind="#jobs-collapse-<%= casting_id %>">
			  			<span data-bind="<%= name %>"></span><span class="label label-info margin-left-small">Active</span>
			  			</a>
			  		</div>
			  		<div class="panel-heading panel-inactive hide">
				  		<a class="accordion-toggle" data-toggle="collapse" data-bind="#jobs-collapse-<%= casting_id %>">
			  			<span data-bind="<%= name %>"></span><span class="label label-warning margin-left-small">Pending Review</span>
			  			</a>
			  		</div>

			  		<div class="panel-collapse collapse in" data-bind="jobs-collapse-<%= casting_id %>" data-bind-target="id" aria-expanded="true" style="">
			  			<div class="panel-body padding-left-zero-zz-xs padding-right-zero-zz-xs">
			  				<div class="row-fluid clearfix margin-bottom-normal">
			  					<div class="col-md-6">
			  						<strong>Project ID# <span data-bind="<%= casting_id %>"></span></strong>
			  					</div>
			  					<div class="col-md-6">
			  						<div class="float-right">
			  							<span data-bind="<%= (bam_roles.length > 0) ? 1 : 0 %>" data-bind-target="visibility">
										<a data-bind="/projects/<%= casting_id %>/roles/<%= _.first(bam_roles) ? _.first(bam_roles).role_id : '' %>/self-submissions" class="btn btn-outline btn-sm font-size-small-normal-zz padding-small-zz btn-submissions margin-top-small-zz-xs">
			  								Submissions
			  							</a>
										<a data-bind="/projects/<%= casting_id %>/schedules/create" class="btn btn-outline btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
			  								<i class="fa fa-plus"></i>
			  								Create Schedule
			  							</a>
			  							<a data-bind="/projects/<%= casting_id %>/roles/<%= _.first(bam_roles) ? _.first(bam_roles).role_id : '' %>/like-it-list" class="btn btn-success btn-sm font-size-small-normal-zz padding-small-zz">
			  								View Like it List
			  							</a>
			  							</span>
			  						</div>
			  					</div>
			  				</div>
			  				<div class="row-fluid col-no-padding clearfix project-details-container">
			  					<div class="col-sm-12 col-md-6">
			  						<ul class="list-unstyled additional-details margin-zero">
			  							<li><div class="title">Project Type:</div><span data-bind="<%= (cat) ? getCategory().split(' ',1) : 'N/A' %>"></span></li>
			  							<li><div class="title">Location:</div><span data-bind="<%= location %>"></span></li>
			  							<li><div class="title">Rate/Pay:</div>$<span data-bind="<%= rate %>"></span> <span data-bind="<%= (rate_des) ? 'per ' + getRate() : '' %>"></span></li>
			  							<li><div class="title">Audition Date:</div><span data-bind="<%= (!aud_timestamp) ? 'N/A' : convertToFullDate(aud_timestamp) %>"></span></li>
			  							<li><div class="title">Casting Category:</div><span data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></span></li>
			  						</ul>
			  					</div>

			  					<div class="col-sm-12 col-md-6">
			  						<ul class="list-unstyled additional-details margin-zero">
			  							<li><div class="title">Submission Type:</div><span data-bind="<%= (project_type == 8) ? 'Open Call' : 'Self Response' %>"></span></li>
			  							<li><div class="title">Union:</div><span data-bind="<%= (union2 == 0) ? 'Non-union' : 'Union' %>"></span></li>
			  							<li><div class="title">Release Date:</div><span data-bind="<%= date.formatMDY(parseInt(sub_timestamp)) %>"></span></li>
			  							<li><div class="title">Deadline:</div><span id="text-date-type"><span data-bind="<%= (!asap) ? 'N/A' : date.formatMDY(parseInt(asap)) %>"></span></span></li>
			  						</ul>
			  					</div>

			  					<div class="col-md-12 margin-top-small">
			  						<ul class="list-unstyled additional-details market-description">
			  							<li class="display-none"></li>
			  							<li><div class="title display-block">Market In:</div><span data-bind="<%= (market) ? market : 'N/A' %>"></span></li>
			  							<li><div class="title display-block">Description:</div><span data-bind="<%= (des) ? des : 'N/A' %>"></span></li>
			  						</ul>
			  					</div>

			  					<div class="col-sm-12 margin-top-small">
			  						<a class="btn btn-lg btn-outline font-size-normal padding-small-zz" data-bind="/projects/<%= casting_id %>/roles/create">
			  							<i class="fa fa-plus"></i>
			  							Add Role
			  						</a>
			  						<a class="btn btn-lg btn-outline font-size-normal padding-small-zz" data-bind="/projects/<%= casting_id %>/edit">
			  							<i class="fa fa-pencil"></i>
			  							Edit Project
			  						</a>

			  						<a class="btn btn-lg btn-outline font-size-normal padding-small-zz project-item-delete" data-bind="delete_<%= casting_id %>" data-bind-target="id">
			  							<i class="fa fa-close"></i>
			  							Delete Project
			  						</a>
			  					</div>
			  				</div>

			  				<div class="row-fluid clearfix margin-top-normal">
			  					<div class="col-md-12">
			  						<div class="alert alert-success margin-bottom-zero">
			  							<button type="button" class="close" data-dismiss="alert">×</button>
			  							<strong><span data-bind="<%= bam_roles.length %>"></span> role(s)</strong> found for this casting.
			  						</div>
			  					</div>
			  				</div>

			  				<div id="casting-roles-preview" class="roles-container" class="row-fluid col-no-padding clearfix margin-top-normal">
			  					<div class="hide" data-bind-template="#casting-roles-preview" data-bind-value="bam_roles" data-bind="casting-role-<%= role_id %>" data-bind-target="id">
				  					<div class="col-md-12">


				  						<div class="panel roles-item">
				  							<div class="padding-normal">
				  								<div class="row-fluid clearfix roles-header">
				  									<div class="col-md-7 text-bold">
				  										<span>Role ID#<span data-bind="<%= role_id %>"></span></span> - <span><span data-bind="<%= (name) ? name : 'N/A' %>"></span></span>
				  										<ul class="list-unstyled description">
				  											<li><div class="title">Description:</div> <span data-bind="<%= (des) ? des : 'N/A' %>"></span>.</li>
				  										</ul>
				  									</div>
				  									<div class="col-md-5">
				  										<div class="float-right" data-bind="<%= casting_id %>" data-bind-target="id">
				  											<a class="btn btn-lg btn-outline font-size-normal" data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/edit">
				  												<i class="fa fa-pencil"></i> Edit
				  											</a>

				  											<a class="btn btn-lg btn-outline font-size-normal delete-role" href="#" data-bind="<%= role_id %>" data-bind-target="id">
				  												<i class="fa fa-trash-o"></i> Delete
				  											</a>

															<a class="btn btn-success padding-small-normal view-role-matches" data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/matches">Find talents for this role</a>
				  										</div>
				  									</div>
				  								</div> {{-- roles header --}}

				  								<div class="row-fluid clearfix">
				  									<div class="col-md-3 details-label-container">
				  										<div class="details-label"><span>Gender:</span> <span data-bind="<%= (gender_female == 0 && gender_male == 1) ? '1' : '' %>" data-bind-target="visibility">Male</span><span data-bind="<%= (gender_female == 1 && gender_male == 0) ? '1' : '' %>" data-bind-target="visibility">Female</span><span data-bind="<%= ((gender_female == 1 && gender_male == 1)||(gender_female == 0 && gender_male == 0)) ? '1' : '' %>" data-bind-target="visibility">Any</span></div>
				  									</div>

				  									<div class="col-md-3 details-label-container">
				  										<div class="details-label"><span>Age:</span> <span data-bind="<%= (age_min) ? age_min : '0' %>"></span> to <span data-bind="<%= (age_max) ? age_max : '0' %>"></span></div>
				  									</div>

				  									<div class="col-md-3 details-label-container">
				  										<div class="details-label"><span>Height:</span> <span data-bind="<%= getHeightMinText() %>"></span> to <span data-bind="<%= getHeightMaxText() %>"></span></div>
				  									</div>

				  									<div class="col-md-3 details-label-container">
				  										<div class="details-label"><span>Talents:</span> <span data-bind="<%= (number_of_people == 0) ? 'N/A' : number_of_people %>"></span></div>
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

				  					</div>
				  				</div>
			  				</div>
			  			</div>
			  		</div>
			  
			  </div> {{-- panel 1 --}}

		{{-- project listing --}}
	</div>
</div>
@stop
