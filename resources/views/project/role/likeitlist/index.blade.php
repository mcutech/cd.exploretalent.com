@extends('layouts.role', [ 'pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Project', 'url' => '/projects/' . $projectId ], [ 'name' => 'Like it List', 'url' => '/projects/' . $projectId . '/roles/' . $roleId . '/likeitlist', 'active' => true] ] ])

@section('header.title', 'Like It List')

@section('sidebar.body')
	<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">
		<div class="talents-search-filter-content">
			@parent
			<div class="row-fluid clearfix">

				<div id="like-it-list" class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div id="like-it-list-pagination">
							</div>
						</div>
						<div class="col-md-6 text-align-right">
							<a data-toggle="modal" data-target="#share-like-it-list" class="btn btn-primary">Share Like It List</a>
							<a data-toggle="modal" data-target="#invite-to-audition-modal" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Invite to Audition</a>
						</div>
					</div>
					<div id="loading-div">
						<div class="f_circleG" id="frotateG_01"></div>
						<div class="f_circleG" id="frotateG_02"></div>
						<div class="f_circleG" id="frotateG_03"></div>
						<div class="f_circleG" id="frotateG_04"></div>
						<div class="f_circleG" id="frotateG_05"></div>
						<div class="f_circleG" id="frotateG_06"></div>
						<div class="f_circleG" id="frotateG_07"></div>
						<div class="f_circleG" id="frotateG_08"></div>
					</div>
					<div class="row-fluid clearfix" id="like-it-list-results">
						@include('components.talent2', [ 'databind' => [ 'template' => '#like-it-list-results', 'value' => 'role.likeitlist.data' ], 'unrate' => true, 'class' => 'col-lg-3 col-md-4 col-sm-6 col-xs-12 talent-item-container' ])
					</div>

				</div> {{-- talents-search-results --}}
			</div>
		</div>
	</div>

	@include('components.modals.talent-message')
	@include('components.modals.talent-add-note')
	@include('components.modals.talent-edit-note')
	@include('components.modals.share-like-it-list')
	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')
	@include('components.modals.invite-to-audition')

@stop
