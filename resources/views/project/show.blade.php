@extends('layouts.project', [ 'active' => 'overview', 'project_details' => true, 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => '', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Project Overview
@stop

@section('project.body')
<div class="find-talents-wrapper">
	<div class="margin-bottom-normal">
		<a href="#" data-bind="<%=casting_id%>/roles/create" class="btn btn-success active" role="button"><i class="fa fa-plus"></i> Add Role</a>
		<a href="#" data-bind="<%=casting_id%>/edit" class="btn btn-default active" role="button"><i class="fa fa-plus"></i> Edit Project</a>
	</div>

	<div class="alert alert-success">
		<span data-bind="<%= (bam_roles.length) ? 1 : 0 %>" data-bind-target="visibility">
			<strong><span data-bind="<%= bam_roles.length %>"></span> role(s)</strong>
			<span>found for this casting</span>
		</span>
		<span data-bind="<%= (bam_roles.length) ? 0 : 1 %>" data-bind-target="visibility">
		It seems you have no roles for this project. Please
			<a data-bind="<%= casting_id %>/roles/create" class="text-success" ><strong>Add Role </strong></a>
			to continue.
		</span>
	</div>

	<div id="roles-list">
		<div class="panel role-item hide" data-bind-template="#roles-list" data-bind-value="bam_roles" data-bind="casting-role-<%= role_id %>" data-bind-target="id">
			<div class="panel-body">
				<div class="col-md-12 margin-bottom-normal">
					<div col-md-2>
						<strong>Role : </strong><strong><span data-bind="<%= name %>"></span><span data-bind=" (<%= role_id %>)"></span></strong>
						<a href="#" data-bind="/projects/<%=casting_id%>/roles/<%=role_id%>/edit" class="btn btn-default btn-sm active margin-left-normal" role="button"><i class="fa fa-plus"></i> Edit Role</a>
					</div>
				</div>
				<div class="row-fluid clearfix">
					<div class="col-md-3 text-center button-function ">
						<div class="bordered padding-medium fixedheight alert alert-success">
							<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/find-talents"><div><i class="fa fa-user fa-2x"></i></div>
							<div>Find Talent for this role</div>
							<b><div class="text-bg"></div></b></a>
						</div>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small fixedheight">
							<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/like-it-list"><div><i class="fa fa-thumbs-up fa-2x"></i></div>
							<div>View like it List</div>
							<b><div class="text-bg" data-bind="<%= likeitlist.total %>"></div></b></a>
						</div>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small fixedheight">
							<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/worksheet"><div><i class="fa fa-calendar fa-2x"></i></div>
							<div>Auditions Worksheet</div>
							<b><div class="text-bg" data-bind="<%= campaign ? likeitlist.total : 0 %>"></div></b></a>
						</div>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small fixedheight">
							<a href="#role-find-talents-callbacks" data-toggle="modal" data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/callbacks"><div><i class="fa fa-check-square fa-2x"></i></div>
							<div>Select your callbacks</div>
							<b><div class="text-bg" data-bind="<%= campaign ? callbacks.total : 0 %>"></div></b></a>
						</div>
					</div>
					<div class="col-md-3 text-center button-function">
						<div class="bordered padding-small fixedheight">
							<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/booked"><div><i class="fa fa-star-o fa-2x"></i></div>
							<div>Booked Talents</div>
							<b>

							<div class ="text-bg" data-bind="<%= campaign ? booked.total : 0 %>"></div>

							</b>
							</a>
						</div>
					</div>

				</div>

				<div class="row-fluid clearfix">
					<div class="col-md-3 details-label-container">
						<div class="details-label">
							<span>Gender : </span>
							<span data-bind="<%= getGenders().lenght > 1 ? 'All' : getGenders() %>"></span>
						</div>
					</div>
					<div class="col-md-3 details-label-container">
						<div class="details-label">
							<span>Age : </span><span data-bind="<%= age_min %>"></span> to <span data-bind="<%= age_max %>"></span>
						</div>
					</div>
					<div class="col-md-3 details-label-container">
						<div class="details-label">
							<span>Height : </span><span data-bind="<%= getHeightMinText() %>"></span> to <span data-bind="<%= getHeightMaxText() %>"></span>
						</div>
					</div>
					<div class="col-md-3 details-label-container">
						<div class="details-label">
							<span>Talents Needed : </span><span class="hair-color-label" data-bind="<%=number_of_people %>"></span>
						</div>
					</div>
				</div>

				<div class="row-fluid clearfix">
					<div class="col-md-8">
						<ul class="list-unstyled margin-zero long-description">
							<li class=""><div class="title">Body Type:</div>
								<span class="body-type-label" data-bind="<%= getBuilds().length == 0 || getBuilds().length == 9 ? 'Any' : getBuilds().join(', ') %>"></span>
							</li>
							<li class=""><div class="title">Ethnicity:</div>
								<span class="ethnicity-label" data-bind="<%= getEthnicities().length == 0 || getEthnicities().length == 12 ? 'Any' : getEthnicities().join(', ') %>"></span>
							</li>
							<li class=""><div class="title">Hair Color:</div>
								<span class="hair-color-label" data-bind="<%= getHairColors().length == 0 || getHairColors().length == 10 ? 'Any' : getHairColors().join(', ') %>">
							</li>
							<li><div class="title">Description</div><p data-bind="<%= des %>"></p></li>

						</ul>
					</div>
					<div class="col-md-4">
						<ul class="list-unstyled margin-zero long-description">
							<li class="hide-if-null"><div class="title hide-if-null">Expiry Date:</div>
                                <span class="role-expiry hide-if-null" data-bind="<%= expiration_timestamp ? moment(expiration_timestamp * 1000).format('MM-DD-YYYY') : 'N/A' %>"></span>
							</li>
							<li class="hide-if-null"><div class="title hide-if-null">Audition Date:</div>
                                <span class="role-expiry hide-if-null" data-bind="<%= audition_timestamp ? moment(audition_timestamp * 1000).format('MM-DD-YYYY') : 'N/A' %>"></span>
							</li>
							<li class="hide-if-null"><div class="title hide-if-null">Shoot Date:</div>
                                <span class="role-expiry hide-if-null" data-bind="<%= shoot_timestamp ? moment(shoot_timestamp * 1000).format('MM-DD-YYYY') : 'N/A' %>"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="rows clearfix">
		<a href="#" data-bind="<%=casting_id%>/roles/create" class="btn btn-success active" role="button"><i class="fa fa-plus"></i> Add Role</a>
	</div>
</div>
@stop

