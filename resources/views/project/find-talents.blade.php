@extends('layouts.project', [ 'active' => 'find-talents' ])

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Find Talents
@stop

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
	<div class="col-md-12 margin-bottom-small">
		<div class="col-md-10 padding-left-zero margin-left-zero">
			<button class="btn btn-success"> Role Matches </button>
			<button class="btn btn-default"> Submissions </button>
		</div>
		<div class="col-md-2 margin-right-zero padding-right-zero">
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

