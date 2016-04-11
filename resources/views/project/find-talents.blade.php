@extends('layouts.project')

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Find Talents
@stop

@section('project.body')
<div id="project-details" class="find-talents-wrapper">
	<div class="row header-functions-container margin-bottom-normal">
		<div class="col-md-12 project-tab-options">
			<ul class="nav nav-tabs nav-justified nav-tabs-sm">
				<li class="active">
					<a href="#" data-toggle="tab">Project Overview</a>
				</li>
				<li class="">
					<a href="#" data-toggle="tab">Find Talents</a>
				</li>
				<li class="">
					<a href="#" data-toggle="tab">Schedules</a>
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
						<i class="fa fa-suitcase">
							<strong data-bind=" <%= project %>"></strong>
						</i>
					</h4>
				</div>
				<div class="col-sm-12 col-md-6">
					<ul class="list-unstyled additional-details margin-zero">
						<li><div class="title">Project ID:</div> <span data-bind="<%= casting_id %>"></span></li>
						<li><div class="title">Project Type:</div> <span data-bind="<%= (project_type || project_type == 0) ? getProjectType() : 'N/A' %>"></span></li>
						<li><div class="title">Location:</div> <span data-bind="<%= location %>"></span></li>
						<li><div class="title">Rate/Pay:</div> <span data-bind="$<%= rate %>"></span> <span data-bind="<%= (rate_des) ? 'per ' + getRate() : '' %>"></span></li>
						<li><div class="title">Audition Date:</div> <span data-bind="<%= (!aud_timestamp1) ? 'N/A' : date.formatMDY(parseInt(aud_timestamp)) %>"></span></li>
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
						<li>
							<div class="title margin-top-small-normal">Description:</div>
							<span data-bind="<%= (des) ? des : 'N/A' %>"></span>
						</li>
						<li>
							<div id="casting-details-markets" class="title margin-top-small-normal">Markets:
								<span class="hide" data-bind-template="#casting-details-markets" data-bind-value="markets.data">
									<span class="label" data-bind="<%= (name) ? name : 'Nationwide' %>"></span>
								</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid clearfix">
	<div id="project-roles" class="col-md-4 form-inline project-select-option">
		<label >Role :</label>
		<select id="select-role" class="select-roles form-control">
			<option data-bind-template=".select-roles" data-bind-value="data" data-bind="<%= JSON.stringify({ key : role_id, value : name + ' (' + role_id + ')' }) %>"></option>
		</select>
	</div>
</div>
<div class="row-fluid margin-top-small margin-bottom-small clearfix">
	<div class="col-md-12 margin-bottom-small">
		<div class="col-md-5 alert alert-success margin-bottom-zero">
			<button type="button" class="close" data-dismiss="alert">×</button>
			Find Talents by looking through your Role Matches or through the Submissions and add them to your like it list by clicking on the "Add to Like it List" button under each talent.
		</div>
		<div class="col-md-4 alert alert-success margin-bottom-zero pull-right">
			<button type="button" class="close" data-dismiss="alert">×</button>
			Here are the list of talents that you've chosen to invite to your audition. Click here to view them.
		</div>
	</div>
	<div class="col-md-12 margin-bottom-small">
		<div class="col-md-10">
			<button class="btn btn-success"> Role Matches </button>
			<button class="btn btn-default"> Submissions </button>
		</div>
		<div class="col-md-2">
			<button class="pull-right btn btn-default"> Like it List </button>
		</div>
	</div>
</div>

<div class="panel role-item margin-top-medium">
	<div class="row-fluid clearfix">
		<div class="talents-wrapper">
			<div class="talents-search-filter-content">
				<div class="row clearfix">
					@include('project.components.filter')
				</div>
				<div class="row">
					<div class="col-md-12 talents-search-result" id="talent-search-result">
						<div class="row" id="talent-result">
							@include('components.talent4', [ 'databind' => [ 'template' => '#talent-result', 'value' => 'data' ], 'ratings' => true, 'notes' => false, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
						</div>
					</div> {{-- talents-search-results --}}
				</div>
				<div id="talent-search-loader" class="text-center padding-top-large">
					<h3>Loading Talents</h3>
					<h1><i class="fa fa-spinner fa-spin"></i></h1>
				</div>
			</div>

			<div class="talents-content">
				@include('components.modals.talent-add-to-like-it-list')
				@include('components.modals.share-like-it-list')
				@include('components.modals.talent-photos')
				@include('components.modals.talent-view-photos')
				@include('components.modals.talent-resume')
				@include('components.modals.invite-to-audition')

			</div>

		</div>
	</div>
</div>


@include('components.modals.role-find-talents')
@include('components.modals.role-find-talents-likeitlist')
@include('components.modals.role-find-talents-callbacks')
@include('components.modals.role-find-talents-hired')
@include('components.modals.role-find-talents-scheduled')

@stop

