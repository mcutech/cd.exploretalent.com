@extends('layouts.sidebar')

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> My Projects
<div class="margin-top-normal form-inline">
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


@section('sidebar.body')
	<div id="projects-pagination" class="text-right"></div>
	<div class="panel padding-xs-vr col-md-12 margin-bottom-small text-left">
		<div class="col-md-2"><strong>Title</strong></div>
		<div class="col-md-3"><strong>Type</strong></div>
		<div class="col-md-2"><strong>Submission</strong></div>
		<div class="col-md-2"><strong>Posted/ Modified</strong></div>
		<div class="col-md-1"><strong>Deadline</strong></div>
		<div class="col-md-2"><strong>Status</strong></div>
	</div>
	<div class="projects-wrapper">
		<div class="panel-group panel-group-primary project-item" id="projects-list">
			<div class="div-table-stripe-item" data-bind-template="#projects-list" data-bind-value="data">
				<div class="row-fluid clearfix" data-bind="<%= parseInt(status) ? 'panel-active' : 'panel-inactive' %>" data-bind-target="class">
					<a class="col-md-12 text-left padding-xs-vr" data-bind="projects/<%= casting_id %>">
						<div class="col-md-2" data-bind="<%= name %>"></div>
						<div class="col-md-3" data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></div>
						<div class="col-md-2" data-bind="<%= (snr == 2) ? 'Open Call' : 'Self Response' %>"></div>
						<div class="col-md-2" data-bind="<%= moment((last_modified || date_created)  * 1000).format('MM-DD-YYYY') %>"></div>
						<div class="col-md-1" data-bind="<%= asap ? moment(asap * 1000).format('MM-DD-YYYY') : 'N/A' %>"></div>
						<div class="col-md-2 label" data-bind="<%= parseInt(status) ? 'label-success' : 'label-warning' %>" data-bind-target="class">
							<span data-bind="<%= parseInt(status) ? 'Project Overview' : 'Pending Review' %>"></span>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div id="projects-pagination2" class="text-right"></div>
	</div>
@stop
