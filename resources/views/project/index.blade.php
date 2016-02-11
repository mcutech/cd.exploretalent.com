@extends('layouts.project')

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> My Projects
<div class="row margin-top-normal form-inline">
	<div class="col-md-5 input-group">
		<input type="text" class="form-control" id="project-name" name="project" placeholder="Search for Project">
		<span id="project-search-btn" class="input-group-addon" style="cursor: pointer;" type="submit">
			<span class="glyphicon glyphicon-search"></span>
		</span>
	</div>
	<div class="col-md-3 input-group">
		<select class="form-control" name="status" id="project-status">
			<option value="">All</option>
			<option value="0">Pending Review</option>
			<option value="1">Active</option>
		</select>
	</div>
</div>
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

		<div class="panel-group panel-group-primary project-item" id="accordion-castings">
			<div class="panel hide" data-bind-template="#accordion-castings" data-bind-value="data" data-bind="project-<%= casting_id %>" data-bind-target="id">
				<div class="panel-heading panel-active" data-bind="<%= (status == '1') ? '1' : '0' %>" data-bind-target="visibility">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-bind="#jobs-collapse-<%= casting_id %>">
						<span data-bind="<%= name %>"></span><span class="label label-info margin-left-small">Active</span>
						<span data-bind="project_<%= casting_id %>" data-bind-target="id" class="project-overview-btn label label-success font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs pull-right">
							Project Overview
						</span>
					</a>

				</div>
				<div class="panel-heading panel-inactive" data-bind="<%= (status == '0') ? '1' : '0' %>" data-bind-target="visibility">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-bind="#jobs-collapse-<%= casting_id %>">
						<span data-bind="<%= name %>"></span><span class="label label-warning margin-left-small">Pending Review</span>
						<span data-bind="project_<%= casting_id %>" data-bind-target="id" class="project-overview-btn label label-success font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs pull-right">
							Project Overview
						</span>
					</a>

				</div>
				<div class="panel-collapse collapse" data-bind="jobs-collapse-<%= casting_id %>" data-bind-target="id" aria-expanded="true" style="">
					<div class="panel-body padding-left-zero-zz-xs padding-right-zero-zz-xs">
						{{-- 	<div class="row-fluid clearfix margin-bottom-normal">
							<div class="col-md-6">

							</div>
							<div class="col-md-6">
								<div class="float-right">
									<a data-bind="/projects/<%= casting_id %>" class="btn btn-outline btn-sm font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs">
										Project Overview
									</a>
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
						</div>  --}}
						<div class="row-fluid col-no-padding clearfix project-details-container">
							<div class="col-sm-12 col-md-6">
								<ul class="list-unstyled additional-details margin-zero">
									<li><div class="title">Project ID:</div><span data-bind="<%= casting_id %>"></span></li>
									<li><div class="title">Project Type:</div><span data-bind="<%= (cat) ? getCategory().split(' ',1) : 'N/A' %>"></span></li>
									<li><div class="title">Location:</div><span data-bind="<%= location %>"></span></li>
									<li><div class="title">Rate/Pay:</div>$<span data-bind="<%= rate %>"></span> <span data-bind="<%= (rate_des) ? 'per ' + getRate() : '' %>"></span></li>
									<li><div class="title">Audition Date:</div><span data-bind="<%= (!aud_timestamp1) ? 'N/A' : date.formatMDY(parseInt(aud_timestamp)) %>"></span></li>
								</ul>
							</div>

							<div class="col-sm-12 col-md-6">
								<ul class="list-unstyled additional-details margin-zero">
									<li><div class="title">Submission Type:</div><span data-bind="<%= (project_type == 8) ? 'Open Call' : 'Self Response' %>"></span></li>
									<li><div class="title">Union:</div><span data-bind="<%= (union2 == 0) ? 'Non-union' : 'Union' %>"></span></li>
									<li><div class="title">Release Date:</div><span data-bind="<%= date.formatMDY(parseInt(sub_timestamp)) %>"></span></li>
									<li><div class="title">Deadline:</div><span id="text-date-type"><span data-bind="<%= (!asap) ? 'N/A' : date.formatMDY(parseInt(asap)) %>"></span></span></li>
									<li><div class="title">Casting Category:</div><span data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></span></li>
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
								<a class="btn btn-lg btn-success font-size-normal padding-small-zz" data-bind="/projects/<%= casting_id %>/roles/create">
									<i class="fa fa-plus"></i>
									Add Role
								</a>
								<a class="btn btn-lg btn-outline font-size-normal padding-small-zz" data-bind="/projects/<%= casting_id %>/edit">
									<i class="fa fa-pencil"></i>
									Edit Project
								</a>

								<!-- <a class="btn btn&#45;lg btn&#45;outline font&#45;size&#45;normal padding&#45;small&#45;zz project&#45;item&#45;delete" data&#45;bind="delete_<%= casting_id %>" data&#45;bind&#45;target="id"> -->
								<!-- 	<i class="fa fa&#45;close"></i> -->
								<!-- 	Delete Project -->
								<!-- </a> -->
							</div>
						</div>

						<div class="row-fluid clearfix margin-top-normal">
							<div class="col-md-12">
								<div class="alert alert-success margin-bottom-zero">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong><span data-bind="<%= bam_roles.length %>"></span> role(s)</strong> found for this casting.
									<span class="" data-bind="<%=
									(bam_roles.length < 1 ) ? 1 : 0 %>"
									data-bind-target="visibility">
										<a class="padding-left-large
										text-success" data-bind="/projects/<%=
										casting_id %>/roles/create">Please
										Add Role to continue </a>
									</span>
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

														<!-- <a class="btn btn&#45;lg btn&#45;outline font&#45;size&#45;normal delete&#45;role" href="#" data&#45;bind="<%= role_id %>" data&#45;bind&#45;target="id"> -->
														<!-- 	<i class="fa fa&#45;trash&#45;o"></i> Delete -->
														<!-- </a> -->

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
			</div>
		</div> {{-- panel 1 --}}

		{{-- project listing --}}

		<div id="projects-pagination" class="text-center"></div>
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
