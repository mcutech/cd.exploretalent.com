@extends('layouts.master')

@section('master.body')
<div class="container public-view-like-it-list padding-top-large padding-bottom-large">
	<div class="row-fluid clearfix padding-left-normal padding-right-normal">
		<div class="col-md-12 clearfix">
			<div class="row-fluid clearfix">
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">
							<img src="/images/logo-home.png" alt="" width="120px">
						</span>
					</div>
					<div class="panel-body padding-top-normal padding-bottom-normal" id="project-details">
						<div class="row">
							<div class="col-md-5 col-xs-12 col-sm-6">
								<h5><span class="text-normal">Project:</span> <span  data-bind="<%= bam_casting.name %>"></span></h5>
								<h5> Role: <span data-bind="<%= name %>"></span></h5>
							</div>
							<div class="col-md-7 col-xs-12 col-sm-6 mt-5">
								<h5><span class="text-600">Company:</span> <span data-bind="<%= bam_casting.bam_cd_user.company %>"></span></h5>
								<h5><span class="text-normal">Casting Director:</span> <span data-bind="<%= bam_casting.bam_cd_user.fname +' '+ bam_casting.bam_cd_user.lname  %>"></span> </h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">
		<div class="talents-search-filter-content">
			<div class="row-fluid clearfix">
				<div class="col-md-12">
					@include('project.components.filter')
				</div>
				<div id="role-matches-result" class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix" id="role-matches">
						@include('components.talent4', [ 'databind' => [ 'template' => '#role-matches', 'value' => 'data' ], 'ratings' => false, 'notes' => false, 'favorites_notes' => true, 'default_btn' => false, 'producers_pick_btn' => true, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-6'  ])
					</div>
				</div>
			</div>
			<div id="search-loader" class="text-center padding-top-large">
				<h3>Loading Talents</h3>
				<h1><i class="fa fa-spinner fa-spin"></i></h1>
			</div>
		</div>
	</div>
</div>
	@include('components.modals.talent-add-to-like-it-list')
	@include('components.modals.talent-view-photos')
	@include('components.modals.talent-resume')
	@include('components.modals.talent-add-note')
	@include('components.modals.talent-edit-note')

<a href="javascript:" id="go-to-top-btn">
	<i class="fa fa-chevron-up"></i>
</a>	
@stop
