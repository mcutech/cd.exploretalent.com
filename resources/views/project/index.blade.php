@extends('layouts.project')

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


@section('sidebar.page-extra')
<!-- <div class="row">
	<hr class="visible-xs no-grid-gutter-h">
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="/projects/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>
			Create Project
		</a>
	</div>
</div> -->
@stop

@section('project.body')
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
	<div id="project-listing">

		<div  class="panel-group panel-group-primary project-item" id="accordion-castings">	
			<div class="hide div-table-stripe-item" data-bind-template="#accordion-castings" data-bind-value="data" data-bind="project-<%= casting_id %>" data-bind-target="id">
			
				<!-- <div class="panel-heading panel-active" data-bind="<%= (status == '1') ? '1' : '0' %>" data-bind-target="visibility">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-bind="#jobs-collapse-<%= casting_id %>">
						<span data-bind="<%= name %>"></span><span class="label label-info margin-left-small">Active</span>
						<span data-bind="project_<%= casting_id %>" data-bind-target="id" class="project-overview-btn label label-success font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs pull-right">
							Project Overview
						</span>
					</a>
				</div> -->

				<div  class="row-fluid clearfix panel-active" data-bind="<%= (status == '1') ? '1' : '0' %>" data-bind-target="visibility">
					<a class="col-md-12 text-left padding-xs-vr" href="#" data-bind="projects/<%= casting_id %>/find-talents">
						<div class="col-md-2" data-bind="<%= name %>"></div>
						<div class="col-md-3" data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></div>
						<div class="col-md-2" data-bind="<%= (snr == 2) ? 'Open Call' : 'Self Response' %>"></div>
						<div class="col-md-2" data-bind="<%= date.formatMDY(last_modified)%>"></div>
						<div class="col-md-1" data-bind="<%= (!asap) ? 'N/A' : date.formatMDY(parseInt(asap)) %>"></div>
						<div class="col-md-2 project-overview-btn label label-success font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs pull-right">Project Overview</div>						
					</a>						
				</div>

				<div  class="row-fluid clearfix panel-inactive" data-bind="<%= (status == '0') ? '1' : '0' %>" data-bind-target="visibility">
					<a class="col-md-12 text-left padding-xs-vr" href="#" data-bind="projects/<%= casting_id %>/find-talents">
						<div class="col-md-2" data-bind="<%= name %>"></div>
						<div class="col-md-3" data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></div>
						<div class="col-md-2" data-bind="<%= (snr == 2) ? 'Open Call' : 'Self Response' %>"></div>
						<div class="col-md-2" data-bind="<%= last_modified>0 ? date.formatMDY(last_modified) : date.formatMDY(date_created) %>"></div>
						<div class="col-md-1" data-bind="<%= (!asap) ? 'N/A' : date.formatMDY(parseInt(asap)) %>"></div>
						<div class="label label-warning col-md-2">Pending Review</div>						
					</a>						
				</div>

			</div>
		</div> {{-- panel 1 --}}

		{{-- project listing --}}

		<div id="projects-pagination2" class="text-right"></div>
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
