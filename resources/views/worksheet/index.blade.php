@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Manage Auditions', 'url' => '/audition-worksheet', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-tasks page-header-icon"></i> Manage Auditions
@stop

@section('sidebar.page-extra')
<div class="row">
	<hr class="visible-xs no-grid-gutter-h">
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="#" class="btn btn-primary btn-labeled btn-block">
			<i class="fa fa-plus"></i> Create New Schedule
		</a>
	</div>
</div>
@stop

@section('sidebar.body')

<div class="audition-worksheet-list-wrapper">
	<div class="row clearfix form-horizontal margin-bottom-normal">
		<div class="col-md-8">
			<div class="form-group margin-zero">
				<label class="control-label col-md-2 col-xs-4 padding-right-zero">Filter Invites:</label>
				<div class="col-md-5">
					<select id="status-list" class="form-control">
						<option value="any">Any</option>
						<option value="0">Pending</option>
						<option value="1">Approved</option>
						<option value="-1">Rejected</option>
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
						<th><span data-toggle="tooltip" data-placement="top" data-original-title="Confirms" class="tooltips-button"><i class="fa fa-check"></i></span></th>
						<th><span data-toggle="tooltip" data-placement="top" data-original-title="Declines" class="tooltips-button"><i class="fa fa-times"></i></span></th>
						<th><span data-toggle="tooltip" data-placement="top" data-original-title="Reschedules" class="tooltips-button"><i class="fa fa-clock-o"></i></th>
						<th><span data-toggle="tooltip" data-placement="top" data-original-title="Pending" class="tooltips-button"><i class="fa fa-question"></i></span></th>
						<th></th>
					</tr>
				</thead>
				<tbody id="campaigns-list">
					<tr data-bind-template="#campaigns-list" data-bind-value="data">
						<td>
							<div class="text-bold">
								<a data-bind="/projects/<%= bam_role.bam_casting.casting_id %>/find-talents" data-bind-target="href"><span data-bind="<%= bam_role.bam_casting.name + ' (#' + bam_role.bam_casting.casting_id + ')' %>"></span></a>
							</div>
							<div data-bind="<%= bam_role.name + ' (#' + bam_role.role_id + ')' %>"></div>
						</td>
						<td data-bind="<%= status == 0 ? 'text-warning' : (status >= 1 ? 'text-success' : 'text-danger') %>" data-bind-target="class">
							<b><span data-bind="<%= status == 0 ? 'Pending' : (status >= 1 ? 'Approved' : 'Rejected') %>"></span></b>
						</td>
						<td><span data-bind="<%= bam_role.schedules.length %>"></span></td>
						<td><span data-bind="<%= created_at %>"></span></td>
						<td><a href="#">0</a></td>
						<td><a href="#">1</a></td>
						<td><a href="#">0</a></td>
						<td><a href="#">2</a></td>
						<td>
							<a class="btn btn-default btn-xs" data-bind="/audition-worksheet/<%= id %>"> Manage Worksheet</a>
							<a class="btn btn-success btn-xs" href="#">Send Times</a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="text-align-right text-bold">Totals:</td>
						<td>0</td>
						<td>5</td>
						<td>0</td>
						<td>14</td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@stop
