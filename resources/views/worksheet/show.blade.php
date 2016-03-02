@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Audition Worksheet', 'url' => '/audition-worksheet', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-tasks page-header-icon"></i> Manage Auditions
@stop

@section('sidebar.body')
	<div class="audition-worksheet-wrapper audition-worksheet-talents-wrapper">
		<div class="row-fluid clearfix">
			<div id="campaign-details" class="col-md-12">
				<div class="panel">
					<div class="panel-body">
						<h4 class="margin-bottom-zero-small" data-bind="Project: <%= bam_role.bam_casting.name + ' (#' + bam_role.bam_casting.casting_id + ')' %>"></h4>
						<div data-bind="Role: <%= bam_role.name + ' (#' + bam_role.role_id + ')' %>"></div>
						<div data-bind="Status: <%= status == 0 ? 'Pending' : (status >= 1 ? 'Approved' : 'Rejected') %>"></div>
						<div data-bind="Message: <%= description %>"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row-fluid clearfix">
			<div class="col-md-3 talents-search-filter-content">
				@include('worksheet.components.filter')
			</div> {{-- filter-search-sidebar --}}


			<div class="col-md-9 audition-worksheet-talent-item">

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
									<div class="talent-photo photo-user-container">
										<img data-bind="<%= invitee.bam_talentci.getPrimaryPhoto() %>" alt="" class="img-responsive">
									</div>
									<div class="talent-button-functions margin-top-small">
										<div class="col-md-12 padding-zero margin-bottom-small">
											<a class="btn btn-default btn-sm btn-outline btn-block border-radius-zero" data-toggle="modal" data-bind="<%= invitee.bam_talentnum %>" data-bind-target="data-id" id="talent-resume" data-target="#talent-resume-modal">
												<i class="fa fa-file-text-o"></i> Resume
											</a>
										</div>
										<div class="col-md-12 padding-zero">
											<a class="btn btn-default btn-sm btn-outline btn-block border-radius-zero" data-toggle="modal" data-bind="<%= invitee.bam_talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-photos-modal" >
												<i class="fa fa-camera"></i> Photos
											</a>
										</div>
									</div>
								</div> <!--/talent-content-->

								<div class="col-md-5 role-schedule-content">
									<div class="role-name margin-bottom-small">
										<span class="text-semibold">Role: </span><a data-bind="/projects/<%= bam_role.casting_id %>/roles/<%= bam_role.role_id %>/edit" ><span data-bind="<%= bam_role.name %>"></span></a>
									</div>
									<div class="submission-note-container margin-bottom-small" >
										<div class="panel margin-zero">
											<div class="padding-small">
												<div class="text-xs">
													<span data-bind="<%= submission ? 'Self Submitted on ' : 'Added to Like It List on ' %>"></span>
													<span data-bind="<%= moment(created_at).utcOffset(-480).format('MM-DD-YY hh:mm A') %>"></span>
												</div>
												<div>
													<span data-bind="<%= campaign.description %>" data-bind-target="html"></span>
												</div>
												<div class="note-description" id="messages">
													<div class="message row" data-bind-template="#messages" data-bind-value="conversation.messages">
														<div class="col-md-12">
															<span data-bind="<%= user.bam_talentci ? user.bam_talentci.getFullName() : 'Me'  %>"></span>
															<span class="pull-right" data-bind="<%= moment(created_at).utcOffset(-480).fromNow() %>"></span>
														</div>
														<div class="col-md-12">
															<span data-bind="<%= body %>"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="schedule-log margin-bottom-small padding-small" data-bind="<%= invitee_status == 4 ? 1 : 0 %>" data-bind-target="visibility">
										<span class="text-semibold">Schedule: </span><span data-bind="<%= when %>"></span>
									</div>
									<div class="btn-functions">
										<div class="btn-group">
											<button type="button" class="btn btn-sm accept-button" data-bind="<%= invitee_status == 2 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-check"></i> Confirmed</button>
											<button type="button" class="btn btn-sm decline-button" data-bind="<%= invitee_status == 3 ? 'btn-danger' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-times"></i> Declined</button>
											<!--
											<button type="button" class="btn btn-sm reschedule-button" data-bind="<%= invitee_status == 4 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class" data-toggle="modal" data-target="#reschedule-modal"><i class="fa fa-clock-o"></i> Reschedule</button>
											-->
										</div>
									</div>
								</div><!--/role-schedule-content-->

								<div class="col-md-3 notes-content">
									<div id="notes">
										<div class="notes-container margin-bottom-small" data-bind-template="#notes" data-bind-value="schedule_notes" data-bind="<%= body %>">
										</div>
									</div>
									<div class="notes-action">
										<button data-target="#add-note-modal" data-toggle="modal" class="btn btn-outline btn-sm add-note-button"><i class="fa fa-pencil"></i>  Add Note</button>
									</div>
								</div>

								<div class="col-md-2 actions-content">
									<button type="button" class="btn btn-sm btn-block margin-bottom-small callback-button" data-bind="<%= status == 2 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-clock-o"></i> Callback</button>
									<button type="button" class="btn btn-sm btn-block margin-bottom-small hired-button" data-bind="<%= status == 3 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-thumbs-o-up"></i> Hired</button>
									<button type="button" class="btn btn-sm btn-outline btn-block message-button" data-toggle="modal" data-target="#message-modal"><i class="fa fa-envelope-o"></i> Message</button>
								</div><!--/actions-content-->
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
@include('worksheet.modals.reschedule')
@include('worksheet.modals.add-note')
@include('worksheet.modals.message')
@include('components.modals.talent-photos')
@include('components.modals.talent-resume')
@stop
