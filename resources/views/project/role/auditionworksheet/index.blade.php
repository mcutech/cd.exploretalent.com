@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Pre-Submissions', 'url' => '/roles/1/matches', 'active' => true] ] ])

@section('sidebar.page-header')
	<div class="text-semibold">Audition Worksheet</div>
	<div class="display-block-inline">
		<h5 class="text-normal margin-top-zero-small margin-bottom-small">Casting: Runway Fashion Show</h5>
		<h5 class="text-normal margin-zero">Role: Dragon Ball Models</h5>
	</div>	
@stop

@section('sidebar.page-extra')
<div class="row-fluid clearfix">
	<div class="col-md-6 float-right">
		<div class="panel margin-bottom-zero display-block-inline">
			<div class="padding-sm">
				<h5 class="text-primary"><i class="fa fa-thumbs-o-up"></i> Like It List for this Role: <b>64</b></h5>
				<a href="" class="btn btn-default btn-xs">View Lists & Contact Talent</a>
				<a href="" class="btn btn-default btn-xs">Remove All</a>
			</div>
		</div>
	</div>
</div>
@stop

@section('sidebar.body')
	<div class="audition-worksheet-wrapper">
		<div class="row-fluid clearfix">
			<div class="col-md-7">
				<ul class="nav nav-tabs negate-padding border-zero">
					<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
						<a href="">Pre-Submissions</a>
					</li>
					<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
						<a href="">Self Submissions</a>
					</li>
					<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
						<a href="">Like It List</a>
					</li>
					<li role="presentation" class="active font-size-small-normal-zz font-size-small-normal-xs submissions-link">
						<a href="">Audition Worksheet</a>
					</li>
				</ul>
			</div>
			<div class="col-md-5">
				<div class="form-group margin-bottom-zero row-fluid">
					<label for="select-role" class="col-md-3 margin-top-small control-label text-align-right">
						Select Role
					</label>
					<div class="col-md-9 padding-left-zero">
						<select id="roles-list" class="form-control" data-bind="<%= role.role_id %>">
							<option data-bind-template="#roles-list" data-bind-value="bam_roles" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>"></option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="margin-bottom-normal padding-bottom-normal bordered no-border-hr no-border-t"></div>
			</div>
		</div>

		<div class="row-fluid clearfix">
			<div class="col-md-3 audition-worksheet-search-sidebar">
				<div class="panel panel-talents-search">
					<div class="panel-heading">
						<span class="panel-title talents-refine-title">Refine Search</span>
						<div class="panel-heading-controls">
							<div class="panel-heading-icon"><i class="fa fa-chevron-left"></i></div>
						</div>
					</div>
					<div class="panel-body">
						
					</div>
				</div>
			</div> {{-- / audition-worksheet-search-sidebar --}}

			<div class="col-md-9 audition-worksheet-items">
				<div class="panel">
					<div class="panel-body">
						
					</div>
				</div>
			</div>

		</div>

	</div>
@stop
