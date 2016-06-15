@extends('layouts.sidebar', isset($pages) ? ['pages' => $pages] : ['pages' => [ [ 'name' => 'My Projects', 'url' => '/projects', 'active' => true ] ] ])

@section('sidebar.body')
	<div id="project-details">
		<div class="row header-functions-container margin-bottom-normal">
			<div class="col-md-12 project-tab-options">
				<ul class="nav nav-tabs nav-justified nav-tabs-sm">
					<li class="{{ isset($active) && $active == 'overview' ? 'active' : '' }}">
						<a href="#" data-bind="/projects/<%= casting_id %>">Project Overview</a>
					</li>
					<li data-bind="<%= (bam_roles.length) ? 1 : 0 %>" data-bind-target="visibility" id="find-talents-list" class="{{ isset($active) && $active == 'find-talents' ? 'active' : '' }}">
						<a href="#" data-bind="/projects/<%= casting_id %>/roles/<%= bam_roles.length ? _.first(bam_roles).role_id : 0 %>/find-talents">Find Talents</a>
					</li>
					<li data-bind="<%= (bam_roles.length) ? 1 : 0 %>" data-bind-target="visibility" class="{{ isset($active) && $active == 'like-it-list' ? 'active' : '' }}">
						<a href="#" data-bind="/projects/<%= casting_id %>/roles/<%= bam_roles.length ? _.first(bam_roles).role_id : 0 %>/like-it-list">Like it List</a>
					</li>
					<li data-bind="<%= (bam_roles.length) ? 1 : 0 %>" data-bind-target="visibility" class="">
						<a href="#" data-bind="/projects/<%= casting_id %>/worksheet">Worksheet</a>
					</li>
				</ul>
			</div>
		</div>
		@if (isset($project_details) && $project_details)
		<div class="panel project-details-container">
			<div class="panel-body">
				<div class="row-fluid clearfix">
					<div class="col-md-12">
						<h4 class="margin-top-zero" id="project-title-heading">
							<i class="fa fa-suitcase"></i><strong data-bind=" <%= name %>"></strong>
						</h4>
					</div>
					<div class="col-sm-12 col-md-6">
						<ul class="list-unstyled additional-details margin-zero">
							<li><div class="title">Project ID:</div> <span data-bind="<%= casting_id %>"></span></li>
							<li><div class="title">Project Type:</div> <span data-bind="<%= (project_type || project_type == 0) ? getProjectType() : 'N/A' %>"></span></li>
							<li><div class="title">Location:</div> <span data-bind="<%= location %>"></span></li>
							<li><div class="title">Rate/Pay:</div> <span data-bind="$<%= rate %>"></span> <span data-bind="<%= (rate_des) ? 'per ' + getRate() : '' %>"></span></li>
							<li><div class="title">Audition Date:</div> <span data-bind="<%= aud_timestamp ? moment(aud_timestamp * 1000).format('MM-DD-YYYY') : 'N/A' %>"></span></li>
							<li></li>
						</ul>
					</div>
					<div class="col-sm-12 col-md-6">
						<ul class="list-unstyled additional-details margin-zero">
							<li><div class="title">Submission Type:</div> <span data-bind="<%= (snr == 2) ? 'Open Call' : 'Self Response' %>"></span></li>
							<li><div class="title">Union:</div> <span data-bind="<%= (union2 == 0) ? 'Non-union' : 'Union' %>"></span></li>
							<li><div class="title">Release Date:</div> <span data-bind="<%= moment(date_created * 1000).format('MM-DD-YYYY') %>"></span></li>
							<li><div class="title">Deadline:</div> <span data-bind="<%= asap ? moment(asap * 1000).format('MM-DD-YYYY') : 'N/A' %>"></span></li>
							<li><div class="title">Casting Category:</div> <span data-bind="<%= cat ? getCategory() : 'N/A' %>"></span></li>
						</ul>
					</div>
					<div class="col-md-12">
					<ul class="list-unstyled margin-zero">
						<li><div class="title">Description:</div> <span data-bind="<%= des || 'N/A' %>"></span></li>
						<li>
							<div id="casting-details-markets" class="title margin-top-small-normal">Markets:
								<span data-bind-template="#casting-details-markets" data-bind-value="markets.data">
									<span class="label" data-bind="<%= name %>"></span>
								</span>
							</div>
						</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
	@yield('project.body')
@stop
