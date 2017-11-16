@extends('layouts.role', [ 'active' => 'like-it-list', 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project Overview', 'url' => '../.././' ], [ 'name' => 'Like It List', 'url' => './like-it-list', 'active' => true ] ] , 'likeitlist' => false , 'matches' => true,'likeitlistList' => true])

@section('sidebar.page-header')
	<i class="fa fa-th-list page-header-icon"></i> Like It Lists - <b data-bind="<%= name + ' ' + '(' + casting_id + ')' %>"></b>
@stop

@section('role.body')
<div class="role-item margin-top-medium">
	<div class="row-fluid clearfix">
		<div class="talents-wrapper">
			<div class="talents-search-filter-content">
				<div class="row clearfix">
					@include('project.components.filter')
				</div>
				<div class="row margin-bottom-normal like-it-list-only hide">
					<div class="col-md-12 margin-bottom-normal">
						<span>Check the talents in the like it list that you want to remove.</span>
					</div>
					<div class="col-md-6">
						<button id="mark-all-talents-as-checked-btn" class="btn btn-default">Check All</button>
						<button id="mark-all-talents-as-unchecked-btn" class="btn btn-default hide">Uncheck All</button>
						<button id="remove-all-checked-talents-btn-disabled" class="btn btn-danger" disabled>Remove All Checked</button>
					</div>
					{{-- <div class="col-md-4 font-size-normal-medium margin-top-small">
						You have <span id="checked-talents-counter" class="text-bold">0</span> talents checked.
					</div> --}}
					<div class="col-md-6 text-align-right float-right">
						<button id="remove-all-like-it-list" class="btn btn-danger">Clear Like it List</button>
					</div>
				</div>
				<div class="talents-search-result" id="role-matches-result">
					<div class="row" id="role-matches">
						@include('components.talent4', [ 'databind' => [ 'template' => '#role-matches', 'value' => 'data' ], 'ratings' => false, 'default_btn' => true, 'notes' => false, 'favorites_notes' => true, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
					</div>
				</div>
				<div class="row-fluid clearfix">
		            <div class="col-xs-12">
		                <div id="no-likeitlist-found" class="padding-normal text-align-center hide padding-top-normal-zz-xs">
		                    <i class="fa fa-exclamation-triangle fa-5x text-danger"></i>
		                     	<div class="padding-zero">
			                      <span class="margin-zero text-danger">You currently have no talents in your like it list, talents in your like it list are the ones you wish to invite to auditions. </span><br>
			                     <span class="margin-zero text-danger">Please add them from the <a href="find-talents"><u>Role Matches</u></a> or <a href="submissions"><u>Submissions page</u></a>.</span>
								</div>
		                </div>
		            </div>
		        </div>
				<div id="search-loader" class="text-center padding-top-large">
					<h3>Loading Talents</h3>
					<h1><i class="fa fa-spinner fa-spin"></i></h1>
				</div>
			</div>

			<div class="talents-content">
				@include('components.modals.talent-add-to-like-it-list')
				@include('components.modals.share-like-it-list')
				@include('components.modals.talent-view-photos')
				@include('components.modals.talent-resume')
				@include('components.modals.invite-to-audition')
				@include('components.modals.talent-add-note')
				@include('components.modals.talent-edit-note')
                @include('components.modals.role-expiry-note')
			</div>
		</div>
	</div>
</div>

<a href="javascript:" id="go-to-top-btn">
	<i class="fa fa-chevron-up"></i>
</a>
@stop

