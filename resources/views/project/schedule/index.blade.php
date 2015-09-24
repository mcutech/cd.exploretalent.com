@extends('layouts.project', ['pages' => [ [ 'name' => 'Project Name', 'url' => '/projects' ], [ 'name' => 'Project Name', 'url' => '/projects/Overview', 'active' => true ] ] ])

<!-- Javascript tool tip on schedules -->
	<script>
		init.push(function () {
			$('#tooltip-schedule-status .tooltip-schedule-item').tooltip();
		});
	</script>
<!-- / Javascript tool tip on schedules-->

@section('sidebar.page-header')
	<div class="text-semibold margin-bottom-small">Project Name</div>
	<div class="display-inline-block">
		<ul class="nav nav-tabs negate-padding border-zero">
			<li role="presentation" class="font-size-small-normal submissions-link">
				<a href="" class="no-border-radius text-normal">Overview</a>
			</li>
			<li role="presentation" class="active font-size-small-normal submissions-link">
				<a href="" class="no-border-radius text-normal">Schedules</a>
			</li>
			<li class="margin-left-normal">
				<button type="button" href="" class="btn-link font-size-small-normal"><i class="fa fa-plus margin-right-small"></i>New Schedule</button>
			</li>
		</ul>
	</div>
@stop

@section('project.body')
	<div class="project-schedules-wrapper">
		<div class="margin-bottom-small header-schedules-item">
			<div class="padding-normal padding-top-small padding-bottom-small">
				<div class="row-fluid clearfix">
					<div class="col-md-4">Schedule Details</div>
					<div class="col-md-3">Project / Union</div>
					<div class="col-md-2">
						<div class="row-fluid clearfix" id="tooltip-schedule-status">
							<div class="col-md-3">
								<i class="fa fa-check text-success tooltip-schedule-item" data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top"></i>
							</div>
							<div class="col-md-3">
								<i class="fa fa-times text-danger tooltip-schedule-item" data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top"></i>
							</div>
							<div class="col-md-3">
								<i class="fa fa-clock-o tooltip-schedule-item" data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top"></i>
							</div>
							<div class="col-md-3">
								<i class="fa fa-question tooltip-schedule-item" data-toggle="tooltip" data-placement="top" data-original-title="Tooltip on top"></i>
							</div>
						</div>
					</div>
					<div class="col-md-3">Actions</div>
				</div>
			</div>
		</div>
		<div class="body-schedules-container">
			<?php for($x=0; $x<10; $x++) {?>
			<div class="body-schedules-item">
				<div class="padding-normal">
					<div class="row-fluid clearfix">
						<div class="col-md-4 schedule-detail-content">
							<a href="#" class="display-block text-bold">9/20/2015 AUdition</a>
							<div class="">Wednesday, 9:30am - 6:30pm, Room 1</div>
						</div>
						<div class="col-md-3 project-union-content">
							<a href="#" class="display-block text-bold">Lorem Ipsum Dolor Sit Amet</a>
							<span class="display-block">Non-Union</span>
						</div>
						<div class="col-md-2 schedule-status-content">
							<div class="row-fluid clearfix">
								<div class="col-md-3">10</div>
								<div class="col-md-3">0</div>
								<div class="col-md-3">0</div>
								<div class="col-md-3">0</div>
							</div>
						</div>
						<div class="col-md-3 actions-content">
							<div class="row-fluid clearfix">
								<div class="col-md-12 padding-zero margin-bottom-small">
									<a href="#" class="btn-block btn btn-success border-radius-zero"><i class="fa fa-clock-o"></i> Send Schedules to Talents</a>
								</div>
								<div class="col-md-6 padding-left-zero padding-right-zero-small">
									<a href="#" class="btn-block btn btn-outline border-radius-zero"><i class="fa fa-pencil"></i> Edit</a>
								</div>
								<div class="col-md-6 padding-right-zero padding-left-zero-small">
									<a href="#" class="btn-block btn btn-outline border-radius-zero"><i class="fa fa-trash-o"></i> Delete</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> {{-- /body-schedules-item --}}
			<?php } ?>
		</div>
	</div>
@stop
