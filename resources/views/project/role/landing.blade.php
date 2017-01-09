@extends('layouts.stationary-alert')

@section('sidebar.page-header')
@stop

@section('stationary.body')

<div class="email-landing-container">

	<div class="read-more-message-container">
		<div class="alert alert-info border-radius-zero margin-bottom-zero padding-small-zz-sm">
				<div class="display-block text-align-center-zz-sm">
				<h4 class="margin-zero display-inline-block font-size-normal-medium-zz-sm"><b>Welcome to <span class="display-none-zz-sm">ET's </span>New CD<span class="display-none-sm-lg">!</span><span class="display-none-zz-sm"> Interface!</span></b></h4>
				</div>

			<div id="read-more-message" class="panel-collapse" style="height: auto;">
				<h5 class="display-inline-zz-sm margin-top-zero-small margin-bottom-zero font-size-normal-zz-sm">Dear Casting Directore, on this page you will find talent pre-matched to your project with email submission, <span id="cd-email" data-bind="<%=snr_email%>"></span> and role. Click on any talent's photo to view profile and "Contact Talent" button to start Inviting Talent to audition.</h5>
				<div class="row margin-top-small">
					<div id="project-roles" class="col-md-12 form-inline project-select-option">
						<label class="text-default">Project :</label>
						<select id="projects-list" class="select-roles form-control margin-right-normal">
							<option data-bind-template="#projects-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name + ' (' + casting_id + ')' }) %>"></option>
						</select>
						<label class="text-default">Role :</label>
						<select id="roles-list" class="select-roles form-control">
							<option data-bind-template="#roles-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : role_id, value : name + ' (' + role_id + ')' }) %>"></option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="role-item margin-top-small">
		<div class="row-fluid clearfix">
			<div class="talents-wrapper">
				<div class="talents-search-filter-content">

					<!-- modal for filter -->
					<div id="filter-content-modal" class="modal fade" tabindex="1" role="dialog" aria-hidden="false">
						<div class="modal-dialog modal-lg" role="document">
							@include('project.components.filter')
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 talents-search-result" id="role-matches-result">
							<div class="row" id="role-matches">
								@include('components.talent5', [ 'databind' => [ 'template' => '#role-matches', 'value' => 'data' ], 'ratings' => true, 'notes' => false, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
							</div>
						</div>
					</div>
					<div id="search-loader" class="text-center padding-top-large">
						<h3>Loading Talents</h3>
						<h1><i class="fa fa-spinner fa-spin"></i></h1>
					</div>
				</div>
				<div class="talents-content">
					@include('components.modals.talent-resume')
					@include('components.modals.ghost-onboarding')
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid clearfix">
			<div class="col-md-12">
				<div class="email-landing-filter-button">
					<button class="btn btn-primary btn-block btn-flat text-bold btn-lg border-radius-zero" data-toggle="modal" data-target="#filter-content-modal">Filter</button>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="javascript:" id="go-to-top-btn" class="talents-page-goto-top-btn">
	<i class="fa fa-chevron-up"></i>
</a>

@stop
