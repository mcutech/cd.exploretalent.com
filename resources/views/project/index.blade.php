@extends('layouts.sidebar')

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> My Projects
@stop


@section('sidebar.body')
	<div class="margin-top-small margin-bottom-small row">
		<div class="col-xs-6 col-sm-2">
			<div class="input-group">
				<input type="text" class="form-control" id="project-name" name="project" placeholder="Search for Project">
				<span id="project-search-btn" class="input-group-addon" style="cursor: pointer;" type="submit">
					<span class="glyphicon glyphicon-search"></span>
				</span>
			</div>
		</div>
		<div class="col-xs-6 col-sm-2">
			<select class="form-control" name="status" id="project-status">
				<option value="">All</option>
				<option value="0">Pending Review</option>
				<option value="1">Active</option>
			</select>
		</div>
		<div class="col-xs-6 col-sm-2">
			<a href="projects/create"  class="btn btn-outline btn-block margin-top-normal-zz-xs" role="button"><i class="fa fa-plus"></i>
				Create Project
			</a>
		</div>
		<div class="col-xs-6 col-sm-2">
		<a href="projects/quickpost"  class="btn btn-outline btn-block margin-top-normal-zz-xs" role="button"><i class="fa fa-plus"></i>
				Quick Post
			</a>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div id="projects-pagination" class="pull-right margin-top-normal-zz-xs"></div>
		</div>
	</div>

	<div class="panel padding-xs-vr padding-xs-hr margin-bottom-zero text-left row-fluid clearfix">
		<div class="col-xs-5 col-sm-2"><strong>Title</strong></div>
		<div class="col-xs-4 col-sm-3"><strong>Type</strong></div>
		<div class="col-xs-2 col-sm-2 display-none-zz-xs"><strong>Submission</strong></div>
		<div class="col-xs-2 col-sm-2 display-none-zz-sm"><strong>Posted/ Modified</strong></div>
		<div class="col-xs-2 col-sm-2 col-md-1"><strong>Deadline</strong></div>
		<div class="col-xs-3 col-sm-2 display-none-zz-xs"><strong>Status</strong></div>
	</div>

	<div class="projects-wrapper panel border-zero">
		<div id="no-projects-found" class="panel padding-normal hide">
			<span>You have not created any projects yet. <a href="/projects/create" class="btn btn-primary btn-sm margin-left-normal">Click here to add a new project.</a></span>
		</div>
		<div class="panel-group panel-group-primary project-item" id="projects-list">
			<div class="div-table-stripe-item" data-bind-template="#projects-list" data-bind-value="data">
				<div class="row-fluid clearfix padding-xs-vr">
					<a class="col-md-12" data-bind="projects/<%= casting_id %>">
						<div class="row-fluid clearfix">
							<div class="col-xs-5 col-sm-2 text-bold" data-bind="<%= name %>"></div>
							<div class="col-xs-4 col-sm-3" data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></div>
							<div class="col-xs-2 display-none-zz-xs" data-bind="<%= (snr == 2) ? 'Open Call' : 'Self Response' %>"></div>
							<div class="col-xs-2 display-none-zz-sm" data-bind="<%= moment((last_modified || date_created)  * 1000).format('MM-DD-YYYY') %>"></div>
							<div class="col-xs-2 col-sm-2 col-md-1" data-bind="<%= asap ? moment(asap * 1000).format('MM-DD-YYYY') : 'N/A' %>"></div>
							<div class="col-xs-3 col-sm-2 display-none-zz-xs">
								<div class="label btn-block" data-bind="<%= parseInt(status) ? 'label-success' : 'label-danger' %>" data-bind-target="class">
									<span data-bind="<%= parseInt(status) ? 'Active' : 'Pending' %>"></span>
								</div>
							</div>
						</div>
					</a>
					<div class="col-md-12 text-default padding-zero-zz-sm">
						<a class="display-inline-block" data-bind="<%= bam_roles.length==0 ? 'projects/' + casting_id + '/roles/create' : 'projects/' + casting_id + '/roles/' + (_.first(bam_roles).role_id)  + '/find-talents'%>">
							<div class="row-fluid clearfix">
								<div class="col-xs-12" data-bind="<%= bam_roles.length==0 ? 'You have 0 roles for this project. Click here to add Role':'Find Talents' %>">
								</div>
							</div>
						</a>
					</div>

				</div>
			</div>
		</div>
		<div id="projects-pagination2" class="text-right"></div>
	</div>
@stop
