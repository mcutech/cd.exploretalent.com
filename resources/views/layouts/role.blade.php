@extends('layouts.project', [ 'active' => isset($active) ? $active : '', 'pages' => isset($pages) ? $pages :  [ [ 'name' => 'My Projects', 'url' => '/projects', 'active' => true ] ] ])

@section('project.body')
	<div class="row-fluid clearfix">
		<div id="project-roles" class="col-md-4 form-inline project-select-option">
			<label >Role :</label>
			<select id="roles-list" class="select-roles form-control">
				<option data-bind-template="#roles-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : role_id, value : name + ' (' + role_id + ')' }) %>"></option>
			</select>
		</div>
	</div>
	<div class="row margin-top-small margin-bottom-small clearfix">
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
		<div id="project-links" class="col-md-12 margin-bottom-small">
			<div class="col-md-10 padding-left-zero margin-left-zero">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/find-talents" class="btn btn-{{ isset($active) && $active == 'find-talents' ? 'success' : 'default' }}"> Role Matches </a>
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/submissions" class="btn btn-{{ isset($active) && $active == 'submissions' ? 'success' : 'default' }}"> Submissions </a>
			</div>
			<div class="col-md-2 margin-right-zero padding-right-zero">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role_id %>/like-it-list" class="pull-right btn btn-{{ isset($active) && $active == 'like-it-list' ? 'success' : 'default' }}"> Like it List </a>
			</div>
		</div>
	</div>
	@yield('role.body')
@stop
