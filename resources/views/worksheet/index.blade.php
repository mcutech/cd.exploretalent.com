@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Worksheet', 'url' => '/worksheet', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-tasks page-header-icon"></i> Audition Worksheet
@stop

@section('sidebar.body')
	<div class="audition-worksheet-wrapper audition-worksheet-talents-wrapper">
		<div class="row-fluid clearfix">
			<div class="col-md-3 talents-search-filter-content">
				@include('worksheet.components.filter')
			</div> {{-- filter-search-sidebar --}}


			<div class="col-md-9 audition-worksheet-talent-item">


				<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
					<div class="col-md-6 padding-zero">
						<div class="">
							<a href="#" class="label border-radius-zero">Confirmed <i class="fa fa-times"></i></a>
						</div>
					</div>

					<div class="col-md-6 padding-left-zero">
						<div class="float-right">
							<div class="margin-right-small display-inline-block valign-top">
								<label class="checkbox-inline">
									<input class="px" type="checkbox" checked=""> Notes
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" checked=""> Photos
								</label>
							</div>
							<ul class="pagination pagination-xs display-inline-block valign-bottom">
								<li class="disabled"><a href="#">«</a></li>
								<li><a href="#">»</a></li>
							</ul>
							<div class="results-counter display-inline-block">1 to 25 of 300</div>
						</div>
					</div>
				</div>

				<div class="margin-bottom-small header-talent-item">
					<div class="padding-normal padding-top-small padding-bottom-small">
						<div class="row-fluid clearfix">
							<div class="col-md-2">Talent</div>
							<div class="col-md-5">Role / Schedules</div>
							<div class="col-md-3">Notes</div>
							<div class="col-md-2">Actions</div>
						</div>
					</div>
				</div>
				<div id="schedules">
					<div class="panel schedule margin-bottom-small" data-bind-template="#schedules" data-bind-value="data" data-bind="<%= id %>" data-bind-target="data-id">
						<div class="panel-body">
							<div class="row-fluid clearfix">
								<div class="col-md-2 talent-content margin-bottom">
									<div class="talent-name" data-bind="<%= invitee.bam_talentci.getFullName() %>">
									</div>
									<div class="talent-photo">
										<img data-bind="<%= invitee.bam_talentci.getPrimaryPhoto() %>" alt="" class="img-responsive">
									</div>
									<div class="talent-button-functions margin-top-small">
										<div class="col-md-12 padding-zero margin-bottom-small">
											<a href="" class="btn btn-default btn-sm btn-outline btn-block border-radius-zero">
												<i class="fa fa-file-text-o"></i> Resume
											</a>
										</div>
										<div class="col-md-12 padding-zero">
											<a href="" class="btn btn-default btn-sm btn-outline btn-block border-radius-zero">
												<i class="fa fa-camera"></i> Photos
											</a>
										</div>
									</div>
								</div> <!--/talent-content-->

								<div class="col-md-5 role-schedule-content">
									<div class="role-name margin-bottom-small">
										<span class="text-semibold">Role: </span><a data-bind="/projects/<%= bam_role.casting_id %>/roles/<%= bam_role.role_id %>" ><span data-bind="<%= bam_role.name %>"></span></a>
									</div>
									<div class="submission-note-container margin-bottom-small">
										<div class="panel margin-zero">
											<div class="padding-small">
												<div class="text-semibold note-title">Submission Note</div>
												<div class="note-description">I am perfect lorem ipsum dolor sit amit siako. Curabitur aliquet quam id dui posuere rolama blandit.Mauris blandit aliquet elit dui posuere blandit. Donec rutrum conguerias. Vestibulum ac diam sit amet quam vehicula.<a href="" class="padding-left-small"><i class="fa fa-question-circle font-size-normal"></i> See more</a></div>
											</div>
										</div>
									</div>
									<div class="schedule-log margin-bottom-small padding-small">
										<span class="text-semibold">Schedule: </span>10:00 AM - September 22, 2015
									</div>
									<div class="btn-functions">
										<div class="btn-group">
											<button type="button" class="btn btn-sm accept-button" data-bind="<%= invitee_status == 2 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-check"></i> Confirmed</button>
											<button type="button" class="btn btn-sm decline-button" data-bind="<%= invitee_status == 3 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-times"></i> Declined</button>
											<button type="button" class="btn btn-sm reschedule-button" data-bind="<%= invitee_status == 4 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-clock-o"></i> Reschedule</button>
										</div>
									</div>
								</div><!--/role-schedule-content-->

								<div class="col-md-3 notes-content">
									<div class="margin-bottom-medium">

									</div>
									<div class="notes-container margin-bottom-small">
										Reschedule due to personal reasons.
									</div>
									<div class="notes-action">
										<a href="#" class="btn btn-outline btn-sm"><i class="fa fa-pencil"></i>  Edit Note</a>
									</div>
								</div>

								<div class="col-md-2 actions-content">
									<button type="button" class="btn btn-sm btn-outline btn-block margin-bottom-small"><i class="fa fa-clock-o"></i> Callback</button>
									<button type="button" class="btn btn-sm btn-outline btn-block margin-bottom-small"><i class="fa fa-thumbs-o-up"></i> Hired</button>
									<button type="button" class="btn btn-sm btn-outline btn-block"><i class="fa fa-envelope-o"></i> Message</button>
								</div><!--/actions-content-->
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
@stop
