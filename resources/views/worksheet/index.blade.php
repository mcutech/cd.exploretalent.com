@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Manage Auditions', 'url' => '/audition-worksheet', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-tasks page-header-icon"></i> Manage Auditions
@stop

@section('sidebar.body')
<div class="audition-worksheet-list-wrapper row">
	<div class="col-md-12 panel-body">
		<label>Filter Invites</label>
		<select id="status-list" class="form-control">
			<option value="any">Any</option>
			<option value="0">Pending</option>
			<option value="1">Approved</option>
			<option value="-1">Rejected</option>
		</select>
	</div>
	<div class="col-md-12 panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th> Casting </th>
					<th> Status </th>
					<th> Num Talents </th>
					<th> Date Submitted </th>
					<th></th>
				</tr>
			</thead>
			<tbody id="campaigns-list">
				<tr data-bind-template="#campaigns-list" data-bind-value="data">
					<td>
						<p data-bind="<%= bam_role.bam_casting.name + ' (#' + bam_role.bam_casting.casting_id + ')' %>"></p>
						<p class="margin-left-large" data-bind="- <%= bam_role.name + ' (#' + bam_role.role_id + ')' %>"></p>
					</td>
					<td data-bind="<%= status <= 0 ? 'text-warning' : (status = 1 ? 'text-success' : 'text-danger') %>" data-bind-target="class">
						<b><span data-bind="<%= status == 0 ? 'Pending' : (status >= 1 ? 'Approved' : 'Rejected') %>"></span></b>
					</td>
					<td><span data-bind="<%= bam_role.schedules.length %>"></span></td>
					<td><span data-bind="<%= created_at %>"></span></td>
					<td><a class="btn btn-primary btn-xs" data-bind="/audition-worksheet/<%= id %>"> manage</a>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@stop
