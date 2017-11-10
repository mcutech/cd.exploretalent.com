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
			@if (isset($likeitlistList) && $likeitlistList)
				<div class="col-md-4 alert alert-success margin-bottom-zero pull-right">
					<button type="button" class="close" data-dismiss="alert">×</button>
					Here are the list of talents that you've chosen to invite to your audition. Click here to send them a message.
				</div>
			@endif
			@if (isset($talentList) && $talentList)
				<div class="col-md-4 alert alert-success margin-bottom-zero pull-right">
					<button type="button" class="close" data-dismiss="alert">×</button>
					Here are the list of talents that you've chosen to invite to your audition. Click here to view them.
				</div>
			@endif
		</div>
		<div id="project-links" class="col-md-12 margin-bottom-small">
			@if (isset($matches) && $matches)
				<div id="invitetoaudition-text" class="row pull-right margin-right-small"></div>
			@endif
			<div class="col-md-6 padding-left-zero margin-left-zero">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/find-talents" class="btn btn-{{ isset($active) && $active == 'find-talents' ? 'success' : 'default' }}"> Role Matches </a>
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/submissions" class="btn btn-{{ isset($active) && $active == 'submissions' ? 'success' : 'default' }}"> Submissions <span data-bind="<%= role.submissions.total !== '' ? '(' + role.submissions.total + ')' : '' %>"></span></a>
			</div>
			@if (isset($likeitlist) && $likeitlist)
				<div class="col-md-2 pull-right margin-right-zero padding-right-zero">
					<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/like-it-list" class="pull-right btn btn-{{ isset($active) && $active == 'like-it-list' ? 'success' : 'default' }}">View Like it List and Contact Talent <span id="like-it-list-total" data-bind="<%= role.likeitlist.total  !== '' ? '(' + role.likeitlist.total + ')' : ''%>"></span></a>
				</div>
			@endif
			@if (isset($matches) && $matches)
				<div class="pull-right margin-right-zero padding-right-zero">
					<a data-toggle="modal" data-target="#share-like-it-list" class="btn btn-primary">Share Like It List</a>
					<a id="invitetoauditionbutton" data-toggle="modal" data-target="#invite-to-audition-modal" class="btn btn-success"><i class="fa fa-envelope-o"></i> Invite to Audition</a>
					<a data-toggle="modal" data-target="#role-expiry-modal" class="btn btn-danger"><i class="fa fa-envelope-o"></i> Role Expired</a>
				</div>
			@endif
		</div>
	</div>
	@yield('role.body')
@stop
