@extends('layouts.master')

@section('master.body')
<div class="container public-view-like-it-list padding-top-large">
	<div class="row-fluid clearfix padding-left-normal padding-right-normal">
		<div class="col-md-12 clearfix">
			<div class="row-fluid clearfix">
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">
							<img src="../../../../../images/logo-home.png" alt="" width="120px">
						</span>
					</div>
					<div class="panel-body padding-top-normal padding-bottom-normal" id="header">
						<div class="row">
							<div class="col-md-5 col-xs-12 col-sm-6">
								<h5><span class="text-normal">Project:</span> <span  data-bind="<%= name %>"> Name 1</span></h5>
								<h5> Role: <span data-bind="<%= role.name %>"> Main Role</span></h5>
							</div>
							<div class="col-md-7 col-xs-12 col-sm-6 mt-5">
								<h5><span class="text-600">Company:</span> <span data-bind="<%= bam_cd_user.company %>"> Casting Company Name</span></h5>
								<h5><span class="text-normal">Casting Director:</span> <span data-bind="<%= bam_cd_user.fname +' '+ bam_cd_user.lname  %>"> Michael Smith</span> </h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">
		<div class="talents-search-filter-content">
			@parent
			<div class="row-fluid clearfix">
				<div id="like-it-list" class="col-md-12 talents-search-result">
					<div class="row-fluid clearfix" id="like-it-list-results">
						@include('components.talent2', [ 'databind' => [ 'template' => '#like-it-list-results', 'value' => 'role.likeitlist.data' ], 'unrate' => true, 'class' => 'col-md-3' ])

					</div>
				</div> {{-- talents-search-results --}}
				<div id="like-it-list-pagination" class="col-md-12">
				</div>
			</div>
		</div>
	</div>
</div>

	@include('components.modals.share-like-it-list')
	@include('components.modals.talent-photos')
	@include('components.modals.talent-resume')
	@include('components.modals.invite-to-audition')

@stop
