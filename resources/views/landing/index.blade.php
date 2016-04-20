@extends('layouts.fullpage')

@section('sidebar.page-header')
@stop

@section('sidebar.body')
	
	<div class="email-landing-container">
		<div class="alert alert-info border-radius-zero">
			<div class="padding-xs-vr">
				<h4 class="margin-zero display-inline-block"><b>Welcome to ET's New CD/Producer Interface!</b></h4> <h5 class="display-inline-block margin-zero">on this page you will find talents that are pre-matched to your project and role.</h5>
				<h5 class="margin-top-zero-small margin-bottom-zero">Click on any talent's photo to view profile and "Contact Talent" button to start Iniviting Talent to audition.</h5>
			</div>
		</div>

		<div class="role-item margin-top-medium">
			<div class="row-fluid clearfix">
				<div class="talents-wrapper">
					<div class="talents-search-filter-content">
						<div class="row">
							<div class="col-md-12 talents-search-result" id="role-matches-result">
								<div class="row" id="role-matches">
									@include('components.talent5', [ 'databind' => [ 'template' => '#role-matches', 'value' => 'data' ], 'ratings' => true, 'notes' => false, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
								</div>
							</div>
						</div>
					</div>
					<div class="talents-content">
						@include('components.modals.talent-resume')
					</div>
				</div>
			</div>
		</div>

		<div class="row-fluid clearfix">
			<div class="col-md-12">
				<div class="email-landing-filter-button">
					<a href="" class="btn btn-primary btn-flat text-bold btn-lg border-radius-zero">
						Filter
					</a>
				</div>
			</div>
		</div>

	</div>

@stop