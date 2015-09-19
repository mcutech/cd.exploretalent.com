@extends('layouts.project')

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> My Projects
@stop

@section('sidebar.page-extra')
<div class="row">
	<hr class="visible-xs no-grid-gutter-h">
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="/projects/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>
			Create Project
		</a>
	</div>
</div>
@stop

@section('project.body')
	<div class="projects-wrapper">
		<div id="project-listing">

			<div class="panel-group panel-group-primary project-item panel-blue" id="accordion-castings">
			  	<div class="panel hide" data-bind-template="#accordion-castings" data-bind-value="data" data-bind="project-<%= casting_id %>" data-bind-target="id">
			  		<div class="panel-heading">
			  			<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-castings" data-bind="#jobs-collapse-<%= casting_id %>">
			  			<span data-bind="<%= name %>"></span>
			  			</a>
			  		</div>

			  		<div class="panel-collapse collapse in" data-bind="jobs-collapse-<%= casting_id %>" data-bind-target="id" aria-expanded="false" style="height: 0px;">
			  			<div class="panel-body padding-left-zero-zz-xs padding-right-zero-zz-xs">
			  				<div class="row-fluid clearfix margin-bottom-normal">
			  					<div class="col-md-6">
			  						<strong>Project ID# <span data-bind="<%= casting_id %>"></span></strong>
			  					</div>
			  					<div class="col-md-6">
			  						<div class="float-right">
										<a data-bind="/projects/<%= casting_id %>" class="btn btn-outline btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
			  								Project Overview
			  							</a>
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
			  						</div>
			  					</div>
			  				</div>
			  				<div class="row-fluid col-no-padding clearfix project-details-container">
			  					<div class="col-sm-12 col-md-6">
			  						<ul class="list-unstyled additional-details margin-zero">
			  							<li><div class="title">Project Type:</div><span data-bind="<%= (cat) ? getCategory().split(' ',1) : 'N/A' %>"></span></li>
			  							<li><div class="title">Location:</div><span data-bind="<%= location %>"></span></li>
			  							<li><div class="title">Rate/Pay:</div>$<span data-bind="<%= rate %>"></span> <span data-bind="<%= (rate_des) ? 'per ' + getRate() : '' %>"></span></li>
			  							<li><div class="title">Audition Date:</div><span data-bind="<%= (aud_timestamp == 0) ? 'N/A' : date.formatYMD(aud_timestamp) %>"></span></li>
			  							<li><div class="title">Casting Category:</div><span data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></span></li>
			  							<li><div class="title">Market In:</div><span data-bind="<%= (market) ? market : 'N/A' %>"></span></li>
			  						</ul>
			  					</div>

			  					<div class="col-sm-12 col-md-6">
			  						<ul class="list-unstyled additional-details margin-zero">
			  							<li><div class="title">Submission Type:</div><span data-bind="<%= (project_type == 8) ? 'Open Call' : 'Self Response' %>"></span></li>
			  							<li><div class="title">Union:</div><span data-bind="<%= (union2 == 0) ? 'Non-union' : 'Union' %>"></span></li>
			  							<li><div class="title">Release Date:</div><span data-bind="<%= date.formatYMD(parseInt(sub_timestamp)) %>"></span></li>
			  							<li><div class="title">Deadline:</div><span id="text-date-type"><span data-bind="<%= asap1 %>"></span></span></li>
			  						</ul>
			  					</div>

			  					<div class="col-md-12">
			  						<ul class="list-unstyled description">
			  							<li><div class="title">Description:</div><span data-bind="<%= (des) ? des : 'N/A' %>"></span></li>
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
				  									<div class="col-md-6 text-bold">
				  										<span>Role ID#<span data-bind="<%= role_id %>"></span></span> - <span><span data-bind="<%= (name) ? name : 'N/A' %>"></span></span>
				  										<ul class="list-unstyled description">
				  											<li><div class="title">Description:</div> <span data-bind="<%= (des) ? des : 'N/A' %>"></span>.</li>
				  										</ul>
				  									</div>
				  									<div class="col-md-6">
				  										<div class="float-right" data-bind="<%= casting_id %>" data-bind-target="id">
				  											<a class="btn btn-lg btn-outline font-size-normal" data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/edit">
				  												<i class="fa fa-pencil"></i> Edit
				  											</a>

				  											<a class="btn btn-lg btn-outline font-size-normal" href="#">
				  												<i class="fa fa-trash-o"></i> Delete
				  											</a>

				  											<a class="btn btn-success padding-small-normal view-role-matches" data-bind="<%= role_id %>" data-bind-target="id">View matches</a>
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
			  	</div>
			  </div> {{-- panel 1 --}}


			<!-- <div class="panel-group panel-group-primary project-item panel-blue" id="accordion-jobs">
				<div class="panel" data-bind-value="data" data-bind="casting_<%= casting_id %>" data-bind-target="id">
					<div class="panel-heading">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-jobs" data-bind="#find-jobs-collapse-<%= casting_id %>">

						</a>
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-target="#project-item-1497936" aria-expanded="false">
			  				Tralalala
			  			</a>
					</div>
				</div>
			</div> -->



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
