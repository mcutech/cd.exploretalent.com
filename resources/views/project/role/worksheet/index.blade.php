@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => './' ], [ 'name' => 'Manage Auditions', 'url' => '/projects/0/worksheet', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-tasks page-header-icon"></i> Manage Auditions
@stop

@section('sidebar.body')
<div class="audition-worksheet-list-wrapper">
	<div class="row clearfix form-horizontal margin-bottom-normal">
		<div class="col-md-6">
			<div class="form-group margin-zero">
				<label class="control-label col-md-4 padding-right-zero">Project Name:</label>
				<div class="col-md-8">
					<select id="projects-list" class="form-control" data-select="Select Project">
						<option data-bind-template="#projects-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name + ' (' + casting_id + ')' }) %>" value="">Any</option>
					</select>
				</div>
			</div>
		</div>
		<div id="role-div" class="hide col-md-6">
			<div class="form-group margin-zero">
				<label class="control-label col-md-4 padding-right-zero">Role Name:</label>
				<div class="col-md-8">
					<select  id="roles-list" data-select data-placeholder="Select Role" class="form-control">
						<option data-bind-template="#roles-list" data-bind-value="bam_roles" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>" value="">Any</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6 margin-top-normal-zz-xs">
			<div id="worksheet-pagination" class="text-right"></div>
		</div>
	</div>
</div>

<div id="no-casting-div" class="col-md-12 padding-right-zero padding-left-zero hide">
	<div class="alert alert-success">
		You have no worksheets available.
		<strong><a data-bind="<%= current_role_id ? '/projects/'+ current_project_id + '/roles/'+ current_role_id +'/like-it-list' : (current_project_id ? '/projects/' + current_project_id : '/projects')  %>" class="text-success">Click here to go to your like it list and send an Audition Invite.</a></strong> If you have recently sent an Audition invite please wait for your invitation to be reviewed and sent, thank you.
	</div>
</div>

<div class="audition-worksheet-list-wrapper row-fluid">
{{--	<div class="panel">
		<div class="panel-body padding-zero-zz-xs">
 			<table class="table table-striped">
				<thead>
					<tr>
						<th>Casting </th>
						<th>Status </th>
						<th>Num Talents </th>
						<th>Date Submitted </th>
						<th></th> </tr>
				</thead>
				<tbody id="campaigns-list">
					<tr data-bind-template="#campaigns-list" data-bind-value="data">
						<td>
							<div class="text-bold">
								<a data-bind="/projects/<%= bam_role.bam_casting.casting_id %>/roles/<%= bam_role_id %>/find-talents" data-bind-target="href"><span data-bind="<%= bam_role.bam_casting.name + ' (#' + bam_role.bam_casting.casting_id + ')' %>"></span></a>
							</div>
							<div data-bind="<%= bam_role.name + ' (#' + bam_role.role_id + ')' %>"></div>
						</td>
						<td data-bind="<%= status == 0 ? 'text-warning' : (status >= 1 ? 'text-success' : 'text-danger') %>" data-bind-target="class">
							<b><span data-bind="<%= status == 0 ? 'Pending' : (status >= 1 ? 'Approved' : 'Rejected') %>"></span></b>
						</td>
						<td><span data-bind="<%= bam_role.likeitlist.total %>"></span></td>
						<td><span data-bind="<%= created_at %>"></span></td>
						<td>
							<a class="btn btn-default btn-xs display-none-zz-xs" data-bind="/projects/<%= bam_role.casting_id %>/roles/<%= bam_role.role_id %>/worksheet"> Manage Worksheet
							<a class="btn btn-default btn-xs display-none-sm-lg" data-bind="/projects/<%= bam_role.casting_id %>/roles/<%= bam_role.role_id %>/worksheet"> Manage</a>
							<a class="hide btn btn-success btn-xs" href="#">Send Times</a>
						</td>
					</tr>
				</tbody>
			</table> 
		</div> 
		</div> --}}
		<div class="display-none-zz-xs panel padding-xs-vr padding-xs-hr margin-bottom-zero text-left border-bottom-width-zero row-fluid clearfix">
			<div class="col-sm-3"><b>Casting</b></div>
			<div class="col-sm-2"><b>Status</b></div>
			<div class="col-sm-2"><b>Num Talents</b></div>
			<div class="col-sm-2"><b>Date Submitted</b></div>
			<div class="col-sm-2"></div>
		</div>
		<div class="display-none-sm-lg text-align-center">
			<h4>Castings</h4>
		</div>

		<div class="panel default-table-responsive">
			<div class="panel-group panel-group-primary table-body">
				<div id="campaigns-list" class="">
					<div class="row-fluid clearfix padding-xs-vr table-row" data-bind-template="#campaigns-list" data-bind-value="data">
						<div class="col-xs-12 col-sm-3">
							<div class="text-bold">
								<a data-bind="/projects/<%= bam_role.bam_casting.casting_id %>/roles/<%= bam_role_id %>/find-talents" data-bind-target="href"><span data-bind="<%= bam_role.bam_casting.name + ' (#' + bam_role.bam_casting.casting_id + ')' %>"></span></a>
							</div>
							<div data-bind="<%= bam_role.name + ' (#' + bam_role.role_id + ')' %>"></div>
						</div>

						<div class="col-xs-12 col-sm-2">
							<span class="display-none-sm-lg"><b>Status:</b> </span><b data-bind="<%= status == 0 ? 'text-warning' : (status >= 1 ? 'text-success' : 'text-danger') %>" data-bind-target="class"><span data-bind="<%= status == 0 ? 'Pending' : (status >= 1 ? 'Approved' : 'Rejected') %>"></span></b>
						</div>

						<div class="col-xs-12 col-sm-2">
							<span class="display-none-sm-lg"><b>Num Talents:</b> </span><span data-bind="<%= bam_role.likeitlist.total %>"></span>
						</div>

						<div class="col-xs-12 col-sm-3">
							<span class="display-none-sm-lg"><b>Date Submitted:</b> </span><span data-bind="<%= created_at %>"></span>
						</div>

						<div class="col-xs-12 col-sm-2">
							<a class="btn btn-default btn-block btn-xs display-none-zz-xs padding-top-normal-zz-xs padding-bottom-normal-zz-xs" data-bind="/projects/<%= bam_role.casting_id %>/roles/<%= bam_role.role_id %>/worksheet"> Manage Worksheet
							<a class="btn btn-default btn-xs display-none-sm-lg btn-block padding-top-normal-zz-xs padding-bottom-normal-zz-xs" data-bind="/projects/<%= bam_role.casting_id %>/roles/<%= bam_role.role_id %>/worksheet"> Manage</a>
							<a class="hide btn btn-success btn-xs btn-block padding-top-normal-zz-xs padding-bottom-normal-zz-xs" href="#">Send Times</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	
</div>
<div id="worksheet-pagination2" class="text-right"></div>
@stop
