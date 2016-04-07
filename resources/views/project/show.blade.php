@extends('layouts.project')

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Find Talents
@stop

@section('project.body')
<div class="find-talents-wrapper">
	<div class="row header-functions-container margin-bottom-normal">
		<div class="col-md-4 project-select-option">
			<select id="casting-list-by-this-user" class="form-control">
				<option data-bind-template="#casting-list-by-this-user" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name }) %>"></option>
			</select>
		</div>
		<div class="col-md-8 project-tab-options">
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
					<ul class="list-unstyled margin-zero">
						<li><div class="title">Project ID:</div> <span data-bind="<%= casting_id %>"></span></li>
						<li><div class="title">Project Type:</div> <span data-bind="<%= (project_type || project_type == 0) ? getProjectType() : 'N/A' %>"></span></li>
						<li><div class="title">Location:</div> <span data-bind="<%= location %>"></span></li>
						<li><div class="title">Rate/Pay:</div> <span data-bind="$<%= rate %>"></span> <span data-bind="<%= (rate_des) ? 'per ' + getRate() : '' %>"></span></li>
						<li><div class="title">Audition Date:</div> <span data-bind="<%= (!aud_timestamp1) ? 'N/A' : date.formatMDY(parseInt(aud_timestamp)) %>"></span></li>
					</ul>
				</div>
				<div class="col-sm-12 col-md-6">
					<ul class="list-unstyled margin-zero">
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
						<div id="casting-details-markets" class="title">Market In:
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

	<div id="casting-roles-div">
		<div class="panel role-item hide" data-bind-template="#casting-roles-div" data-bind-value="bam_roles" data-bind="casting-role-<%= role_id %>" data-bind-target="id">
			<div class="panel-body">
				<div class="row-fluid clearfix">
					<div class="col-md-2">
						<ul class="list-unstyled margin-zero">
							<li><div class="title">Role ID:</div> <span data-bind="<%= role_id %>"></span></li>
							<li><div class="title">Role:</div> <span data-bind="<%= name %>"></span></li>
							<li><div class="title">Gender:</div> <span data-bind="<%= (gender_female == 0 && gender_male == 1) ? '1' : '' %>" data-bind-target="visibility">Male</span><span data-bind="<%= (gender_female == 1 && gender_male == 0) ? '1' : '' %>" data-bind-target="visibility">Female</span><span data-bind="<%= ((gender_female == 1 && gender_male == 1)||(gender_female == 0 && gender_male == 0)) ? '1' : '' %>" data-bind-target="visibility">Any</span></li>
							<li><div class="title">Age:</div> <span data-bind="<%= (age_min) ? age_min : '0' %>"></span> to <span data-bind="<%= (age_max) ? age_max : '0' %>"></span></li>
							<li><div class="title">Height:</div> <span data-bind="<%= getHeightMinText() %>"></span> to <span data-bind="<%= getHeightMaxText() %>"></span></li>
						</ul>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small">
							<a href="#role-find-talents" data-toggle="modal"><div><i class="fa fa-user fa-2x"></i></div>
							<div>Find Talent</div>
							<b><div class="text-bg">1457</div></b></a>
						</div>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small">
							<a href="#role-find-talents-likeitlist" data-toggle="modal"><div><i class="fa fa-thumbs-up fa-2x"></i></div>
							<div>Like it List</div>
							<b><div class="text-bg">125</div></b></a>
						</div>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small">
							<a href="#role-find-talents-scheduled" data-toggle="modal"><div><i class="fa fa-calendar fa-2x"></i></div>
							<div>Scheduled</div>
							<b><div class="text-bg">69</div></b></a>
						</div>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small">
							<a href="#role-find-talents-callbacks" data-toggle="modal"><div><i class="fa fa-check-square fa-2x"></i></div>
							<div>Call Backs</div>
							<b><div class="text-bg">18</div></b></a>
						</div>
					</div>
					<div class="col-md-2 text-center button-function">
						<div class="bordered padding-small">
							<a href="#role-find-talents-hired" data-toggle="modal"><div><i class="fa fa-star-o fa-2x"></i></div>
							<div>Hired</div>
							<b><div class="text-bg">1</div></b></a>
						</div>
					</div>
				</div>
				<div class="row-fluid clearfix">
					<div class="col-md-12">
						<ul class="list-unstyled margin-zero long-description">
							<li class=""><div class="title">Body Type:</div>
								<span class="body-type-label" data-bind="<%= (built_athletic == 1) ? '1' : '' %>" data-bind-target="visibility">Athletic</span>
								<span class="body-type-label" data-bind="<%= (built_bb == 1) ? '1' : '' %>" data-bind-target="visibility">Body Builder</span>
								<span class="body-type-label" data-bind="<%= (built_xlarge == 1) ? '1' : '' %>" data-bind-target="visibility">Full Figured</span>
								<span class="body-type-label" data-bind="<%= (built_large == 1) ? '1' : '' %>" data-bind-target="visibility">Large</span>
								<span class="body-type-label" data-bind="<%= (built_lm == 1) ? '1' : '' %>" data-bind-target="visibility">Lean Muscle</span>
								<span class="body-type-label" data-bind="<%= (built_thin == 1) ? '1' : '' %>" data-bind-target="visibility">Slim</span>
								<span class="body-type-label" data-bind="<%= (built_petite == 1) ? '1' : '' %>" data-bind-target="visibility">Petite</span>
								<span class="body-type-label" data-bind="<%= (built_average == 1) ? '1' : '' %>" data-bind-target="visibility">Average</span>
								<span class="body-type-label" data-bind="<%= (built_medium == 1) ? '1' : '' %>" data-bind-target="visibility">Medium</span>
								<span class="body-type-label" data-bind="<%= (built_athletic == 0 && built_bb == 0 && built_xlarge == 0 && built_large == 0 && built_lm == 0 && built_thin == 0 && built_petite == 0 && built_average == 0 && built_medium == 0) ? '1' : '' %>" data-bind-target="visibility">Any</span>
							</li>
							<li class=""><div class="title">Ethnicity:</div>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_african == 1) ? '1' : '' %>" data-bind-target="visibility">African</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_african_am == 1) ? '1' : '' %>" data-bind-target="visibility">African American</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_asian == 1) ? '1' : '' %>" data-bind-target="visibility">Asian</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_caribbian == 1) ? '1' : '' %>" data-bind-target="visibility">Carribean</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_caucasian == 1) ? '1' : '' %>" data-bind-target="visibility">Caucasian</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_hispanic == 1) ? '1' : '' %>" data-bind-target="visibility">Hispanic</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_mediterranean == 1) ? '1' : '' %>" data-bind-target="visibility">Mediterranean</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_middle_est == 1) ? '1' : '' %>" data-bind-target="visibility">Middle Eastern</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_american_in == 1) ? '1' : '' %>" data-bind-target="visibility">American Indian</span>
								<span class="ethnicity-label" data-bind="<%= (ethnicity_african == 0 && ethnicity_african_am == 0 && ethnicity_asian == 0 && ethnicity_caribbian == 0 && ethnicity_caucasian == 0 && ethnicity_hispanic == 0 && ethnicity_mediterranean == 0 && ethnicity_middle_est == 0 && ethnicity_american_in == 0) ? '1' : '' %>" data-bind-target="visibility">Any</span>
							</li>
							<li class=""><div class="title">Hair Color:</div>
								<span class="hair-color-label" data-bind="<%= (hair_auburn == 1) ? '1' : '' %>" data-bind-target="visibility">Auburn</span>
								<span class="hair-color-label" data-bind="<%= (hair_black == 1) ? '1' : '' %>" data-bind-target="visibility">Black</span>
								<span class="hair-color-label" data-bind="<%= (hair_blonde == 1) ? '1' : '' %>" data-bind-target="visibility">Blonde</span>
								<span class="hair-color-label" data-bind="<%= (hair_brown == 1) ? '1' : '' %>" data-bind-target="visibility">Brown</span>
								<span class="hair-color-label" data-bind="<%= (hair_chestnut == 1) ? '1' : '' %>" data-bind-target="visibility">Chestnut</span>
								<span class="hair-color-label" data-bind="<%= (hair_dark_brown == 1) ? '1' : '' %>" data-bind-target="visibility">Dark Brown</span>
								<span class="hair-color-label" data-bind="<%= (hair_grey == 1) ? '1' : '' %>" data-bind-target="visibility">Grey</span>
								<span class="hair-color-label" data-bind="<%= (hair_red == 1) ? '1' : '' %>" data-bind-target="visibility">Red</span>
								<span class="hair-color-label" data-bind="<%= (hair_white == 1) ? '1' : '' %>" data-bind-target="visibility">White</span>
								<span class="hair-color-label" data-bind="<%= (hair_salt_paper == 1) ? '1' : '' %>" data-bind-target="visibility">Salt & Pepper</span>
								<span class="hair-color-label" data-bind="<%= (hair_auburn == 0 && hair_black == 0 && hair_blonde == 0 && hair_brown == 0 && hair_chestnut == 0 && hair_dark_brown == 0 && hair_grey == 0 && hair_red == 0 && hair_white == 0 && hair_salt_paper == 0) ? '1' : '' %>" data-bind-target="visibility">Any</span>
							</li>
						</ul>
					</div>
				</div>
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

