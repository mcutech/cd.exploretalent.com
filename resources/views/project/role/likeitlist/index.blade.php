@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Like it List', 'url' => '/roles/1/likeitlist', 'active' => true] ] ])

@section('sidebar.page-header')
	<div class="text-semibold">Like it List</div>
	<div class="display-block-inline">
		<h5 class="text-normal margin-top-zero-small margin-bottom-small">Casting: <span data-bind="<%= name %>"></span></h5>
		<h5 class="text-normal margin-zero">Role: <span data-bind="<%= role.name %>"></span></h5>
	</div>
@stop

@section('sidebar.page-extra')
<div class="row-fluid clearfix">
	<div class="col-md-6 float-right">
		<div class="panel margin-bottom-zero display-block-inline">
			<div class="padding-sm">
				<h5 class="text-primary"><i class="fa fa-thumbs-o-up"></i> Like It List for this Role: <b><span data-bind="<%= role.getLikeItList().length %>"></span></b></h5>
				<a href="" class="btn btn-default btn-xs">View Lists & Contact Talent</a>
				<a href="" class="btn btn-default btn-xs">Remove All</a>
			</div>
		</div>
	</div>
</div>
@stop


@section('sidebar.body')
	<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">

		<div class="talents-search-filter-content">

			<div class="row-fluid clearfix">
				<div class="col-md-6">
					<ul class="nav nav-tabs negate-padding border-zero">
						<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Pre-Submissions</a>
						</li>
						<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Self Submissions</a>
						</li>
						<li role="presentation" class="active font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Like It List</a>
						</li>
					</ul>
				</div>
				<div class="col-md-6">
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

				<div class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div class="padding-top-small">
							</div>
						</div>
						<div class="col-md-6 text-align-right">
							<a href="#share-like-it-list" class="btn btn-primary" data-toggle="modal">Share Like It List</a>
							<a href="" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Invite to Audition</a>
						</div>
					</div>

					<div class="row-fluid clearfix" id="like-it-list">
						@include('components.talent2', [ 'databind' => [ 'template' => '#like-it-list', 'value' => 'data' ] ])
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">

		</div>

	</div>

	@include('components.modals.share-like-it-list')
	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')

@stop
