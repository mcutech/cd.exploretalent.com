@extends('layouts.sidebar')

@section('sidebar.page-header')
	<div class="text-semibold">@yield('header.title')</div>
	<div class="display-block-inline">
		<h5 class="text-normal margin-top-zero-small margin-bottom-small">Casting: <span data-bind="<%= name %>"></span></h5>
		<h5 class="text-normal margin-zero">Role: <span data-bind="<%= role.name %>"></span></h5>
	</div>
	<div class="display-block project-roles-info">
		<div class="row-fluid clearfix font-size-small-normal">
			<div class="col-md-4 padding-zero">
				<ul class="list-unstyled margin-zero">
					<li>Gender: <span>Male or Female</span></li>
					<li>Age Range: <span>20 to 32</span></li>
				</ul>
			</div>
			<div class="col-md-4 padding-zero">
				<ul class="list-unstyled margin-zero">
					<li>Height Range: <span>4' 2" to 6' 2"</span></li>
					<li>Ethnicity: <span>Male or Female</span></li>
				</ul>				
			</div>
			<div class="col-md-4 padding-zero">
				<ul class="list-unstyled">
					<li>Body Type: <span>20 to 32</span></li>
					<li>Hair Color: <span>4' 2" to 6' 2"</span></li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('sidebar.page-extra')
<div class="row-fluid clearfix">
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
<div class="row-fluid clearfix">
	<div class="col-md-6">
		<ul id="submissions-sub-menu" class="nav nav-tabs negate-padding border-zero">
			<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs matches-link">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/matches">Pre-Submissions</a>
			</li>
			<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs self-submissions-link">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/self-submissions">Self Submissions</a>
			</li>
			<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs like-it-list-link">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/like-it-list" href="">Like It List</a>
			</li>
		</ul>
	</div>
	<div class="col-md-6">
		<div class="form-group margin-bottom-zero row-fluid">
			<label for="select-role" class="col-md-3 margin-top-small control-label text-align-right">
				Select Role
			</label>
			<div class="col-md-9 padding-left-zero">
				<select id="roles-list" class="form-control">
					<option data-bind-template="#roles-list" data-bind-value="bam_roles" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>"></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="margin-bottom-normal padding-bottom-normal bordered no-border-hr no-border-t"></div>
	</div>
</div>
@stop

