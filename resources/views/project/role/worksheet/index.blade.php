@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Manage Auditions', 'url' => '/audition-worksheet', 'active' => true] ] ])

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

	</div>
</div>

<div class="audition-worksheet-list-wrapper row-fluid">
	<div class="col-md-12 panel">
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Casting </th>
						<th>Status </th>
						<th>Num Talents </th>
						<th>Date Submitted </th>
						<th></th>
					</tr>
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
							<a class="btn btn-default btn-xs" data-bind="/projects/<%= bam_role.casting_id %>/roles/<%= bam_role.role_id %>/worksheet"> Manage Worksheet</a>
							<a class="hide btn btn-success btn-xs" href="#">Send Times</a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@stop
