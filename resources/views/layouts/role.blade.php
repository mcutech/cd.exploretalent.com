@extends('layouts.sidebar')

@section('sidebar.page-header')
	<div class="row">
		<div class="col-md-6">
			<div class="text-semibold">@yield('header.title')</div>
		</div>
		<div class="col-md-6">
			<div class="margin-bottom-zero">
				<label for="select-role" class="col-md-3 margin-top-small control-label text-sm padding-left-zero">
					Select Role
				</label>
				<div class="col-md-8 padding-left-zero">
					<select id="roles-list" class="form-control">
						<option data-bind-template="#roles-list" data-bind-value="bam_roles" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>"></option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="display-block-inline">
		<div class="row">
			<div class="col-md-6">
				<h5 class="text-normal margin-top-zero-small margin-bottom-small">Project ID: <span data-bind="<%= casting_id %>"></span></h5>
			</div>
			<div class="col-md-6">
				<h5 class="text-normal margin-top-zero-small margin-bottom-small">Casting: <span data-bind="<%= name %>"></span></h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h5 class="text-normal margin-zero">Role ID: <span data-bind="<%= role.role_id %>"></span></h5>
			</div>
			<div class="col-md-6">
				<h5 class="text-normal margin-zero">Role: <span data-bind="<%= role.name %>"></span></h5>
			</div>
		</div>
	</div>
	<div class="display-block project-roles-info">
		<div class="row-fluid clearfix">
			<div class="col-md-4 padding-zero">
				<span class="text-slim">Gender: <span data-bind="<%= ((role.gender_female === 1) && (role.gender_male === 1)) ? 'Male and Female' : (role.gender_female === 1) ? 'Female' : 'Male' %>" class="text-normal"></span></span>
			</div>
			<div class="col-md-4 padding-zero">
				<span class="text-slim">Age Range: <span class="text-normal"><span data-bind="<%= role.age_min %>"></span> to <span data-bind="<%= role.age_max %>"></span></span></span>
			</div>
			<div class="col-md-4 padding-zero">
				<span class="text-slim">Height Range: <span class="text-normal"><span data-bind="<%= role.getHeightMinText() %>"></span> to <span data-bind="<%= role.getHeightMaxText() %>"></span></span></span>
			</div>
			<div class="col-md-12 padding-zero">
				<span class="text-slim">Body Type: <span data-bind = "<%=role.getBuilds().join(', ') %>" class="text-normal"></span></span>
			</div>
			<div class="col-md-12 padding-zero">
				<span class="text-slim">Ethnicity: <span data-bind="<%=role.getEthnicities().join(', ') %>" class="text-normal"></span></span>
			</div>
			<div class="col-md-12 padding-zero">
				<span class="text-slim">Hair Color: <span data-bind = "<%=role.getHairColors().join(', ') %>" class="text-normal"></span></span>
			</div>
		</div>
	</div>
@stop

@section('sidebar.page-extra')
<div class="row-fluid clearfix hide">
	<div class="panel margin-bottom-zero display-block-inline">
		<div class="padding-medium">
			<h5 class="text-primary"><i class="fa fa-thumbs-o-up"></i> Like It List for this Role: <b><span data-bind="<%= role.likeitlist.total %>"></span></b></h5>
			<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/like-it-list" class="btn btn-default">View Lists & Contact Talent</a>
			<button id="remove-all-likeitlist" class="btn btn-danger margin-top-small"><i class="fa fa-times"></i> Remove All</button>
		</div>
	</div>
</div>
@stop

@section('sidebar.body')
	@include('components.role-tab-options')
@stop

