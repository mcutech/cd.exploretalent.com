@extends('layouts.sidebar', isset($pages) ? ['pages' => $pages] : ['pages' => [ [ 'name' => 'My Projects', 'url' => '/projects', 'active' => true ] ] ])

@section('sidebar.body')
	<div class="find-talents-wrapper">
		<div class="row header-functions-container margin-bottom-normal">
			<div class="col-md-4 project-select-option hide">
				<select id="casting-list-by-this-user" class="form-control">
					<option data-bind-template="#casting-list-by-this-user" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name }) %>"></option>
				</select>
			</div>
			<div class="col-md-12 project-tab-options">
				<ul class="nav nav-tabs nav-justified nav-tabs-sm">
					<li class="active">
						<a href="#" data-toggle="tab">Project Overview</a>
					</li>
					<li class="">
						<a href="#" data-toggle="tab">Find Talents</a>
					</li>
					<li class="">
						<a href="#" data-toggle="tab">Like it List</a>
					</li>
					<li class="">
						<a href="#" data-toggle="tab">Worksheet</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="panel project-details-container" id="casting-details-div">
			<div class="panel-body">
				<div class="row-fluid clearfix">
					<div class="col-md-12">
						<h4 class="margin-top-zero" id="project-title-heading">
							<i class="fa fa-suitcase"></i><strong data-bind=" <%= project %>"></strong>
						</h4>
					</div>
					<div class="col-sm-12 col-md-6">
						<ul class="list-unstyled additional-details margin-zero">
							<li><div class="title">Project ID:</div> <span data-bind="<%= casting_id %>"></span></li>
							<li><div class="title">Project Type:</div> <span data-bind="<%= (project_type || project_type == 0) ? getProjectType() : 'N/A' %>"></span></li>
							<li><div class="title">Location:</div> <span data-bind="<%= location %>"></span></li>
							<li><div class="title">Rate/Pay:</div> <span data-bind="$<%= rate %>"></span> <span data-bind="<%= (rate_des) ? 'per ' + getRate() : '' %>"></span></li>
							<li><div class="title">Audition Date:</div> <span data-bind="<%= (!aud_timestamp1) ? 'N/A' : date.formatMDY(parseInt(aud_timestamp)) %>"></span></li>
							<li></li>
						</ul>
					</div>
					<div class="col-sm-12 col-md-6">
						<ul class="list-unstyled additional-details margin-zero">
							<li><div class="title">Submission Type:</div> <span data-bind="<%= (project_type == 8) ? 'Open Call' : 'Self Response' %>"></span></li>
							<li><div class="title">Union:</div> <span data-bind="<%= (union2 == 0) ? 'Non-union' : 'Union' %>"></span></li>
							<li><div class="title">Release Date:</div> <span data-bind="<%= date.formatMDY(parseInt(sub_timestamp)) %>"></span></li>
							<li><div class="title">Deadline:</div> <span data-bind="<%= (!asap) ? 'N/A' : date.formatMDY(parseInt(asap)) %>"></span></li>
							<li><div class="title">Casting Category:</div> <span data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></span></li>
						</ul>
					</div>
					<div class="col-md-12">
					<ul class="list-unstyled margin-zero">
						<li><div class="title">Description:</div> <span data-bind="<%= (des) ? des : 'N/A' %>"></span></li>
						<li>
							<div id="casting-details-markets" class="title margin-top-small-normal">Markets:
								<span class="hide" data-bind-template="#casting-details-markets" data-bind-value="markets.data">
									<span class="label" data-bind="<%= name %>"></span>
								</span>
							</div>
						</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	@yield('project.body')
@stop
