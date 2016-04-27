@extends('layouts.fullpage')

@section('sidebar.page-header')
@stop

@section('sidebar.body')

	<div class="email-landing-container">
		<div class="alert alert-info border-radius-zero">
			<div class="padding-xs-vr text-align-center-zz-sm">
				<h4 class="margin-zero display-inline-block display-block-zz-sm font-size-normal-medium-zz-sm"><b>Welcome to ET's New CD/Producer Interface!</b></h4>
				<h5 class="display-inline-block display-inline-zz-sm margin-zero font-size-normal-zz-sm">On this page you will find talents that are pre-matched to your project and role.</h5>
				<h5 class="display-inline-zz-sm margin-top-zero-small margin-bottom-zero font-size-normal-zz-sm">Click on any talent's photo to view profile and "Contact Talent" button to start Inviting Talent to audition.</h5>
			</div>
		</div>

		<div class="role-item margin-top-medium">
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

		<div class="row-fluid clearfix">
			<div class="col-md-12">
				<div class="email-landing-filter-button">
					<button class="btn btn-primary btn-flat text-bold btn-lg border-radius-zero" data-toggle="modal" data-target="#filter-content-modal">Filter</button>
				</div>
			</div>
		</div>
	</div>


@stop
