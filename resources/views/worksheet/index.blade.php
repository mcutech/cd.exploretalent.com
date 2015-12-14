@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Audition Worksheet', 'url' => '/audition-worksheet', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-tasks page-header-icon"></i> Manage Auditions
@stop

@section('sidebar.body')
<div class="audition-worksheet-list-wrapper">
	<div class="col-md-3">
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title talents-refine-title">Filter Search</span>
				<div class="panel-heading-controls">
					<div class="panel-heading-icon"><i class="fa fa-chevron-left"></i></div>
				</div>
			</div>
			<div class="panel-body">
				<div class="panel panel-transparent">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title text-uppercase"><strong>Projects</strong></div>
					</div>
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<div class="display-block margin-bottom-small talent-role">
									<select name="project" id="projects-list" class="form-control">
										<option data-bind-template="#projects-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name }) %>"></option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<button id="filter-button" class="btn btn-success">Search</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9 panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th> Casting </th>
					<th> Role </th>
					<th> Num Talents </th>
					<th> Date Submitted </th>
					<th></th>
				</tr>
			</thead>
			<tbody id="campaigns-list">
				<tr data-bind-template="#campaigns-list" data-bind-value="data">
					<td><span data-bind="<%= bam_role.bam_casting.name + '(' + bam_role.bam_casting.casting_id + ')' %>"></span></td>
					<td><span data-bind="<%= bam_role.name + '(' + bam_role.role_id + ')' %>"></span></td>
					<td>0</td>
					<td><span data-bind="<%= created_at %>"></span></td>
					<td><a class="btn btn-primary btn-xs" data-bind="/audition-worksheet/<%= id %>"> manage</a>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@stop
