@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Self Submissions', 'url' => '/roles/1/selfsubmissions', 'active' => true] ] ])

@section('sidebar.page-header')
	<div class="text-semibold">Self Submissions</div>
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

	<div class="self-submissions-wrapper self-submissions-talent-view-wrapper">

		<div class="talents-search-filter-content">
			<div class="row-fluid clearfix">
				<div class="col-md-6">
					<ul class="nav nav-tabs negate-padding border-zero">
						<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Pre-Submissions</a>
						</li>
						<li role="presentation" class="active font-size-small-normal-zz font-size-small-normal-xs submissions-link">
							<a href="">Self Submissions</a>
						</li>
						<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs submissions-link">
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
							<select class="form-control">
								<option value="1">Select Role 1</option>
								<option value="2">Select Role 2</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="margin-bottom-normal padding-bottom-normal bordered no-border-hr no-border-t"></div>
				</div>
			</div>
			<div class="row-fluid clearfix">
			
				@include('components.talent-filter')

				<div class="col-md-9 talents-search-result">
					<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
						<div class="col-md-6">
							<div class="padding-top-small">
								<h5 class="margin-zero"><span class="text-normal">Matches for Role:</span> Name of Role Display Here</h5>
							</div>
						</div>
						<div class="col-md-6 padding-left-zero">
							<div class="float-right">
								<ul class="pagination pagination-xs">
									<li class="disabled"><a href="#">«</a></li>
									<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">»</a></li>
								</ul>
								<div class="results-counter">Showing: 1 to 25 of 7,862,526</div>
							</div>
						</div>
					</div>
					<div class="row-fluid clearfix">
						<?php for($x=0; $x<12; $x++ ) { ?>
						@include('components.talent')
						<?php } ?>
					</div>
				</div> {{-- talents-search-results --}}
			</div>
		</div>

		<div class="talents-content">

		</div>

	</div>
@stop
