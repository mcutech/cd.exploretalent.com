<div class="audition-worksheet-wrapper audition-worksheet-talents-wrapper">
	<div class="row-fluid clearfix">
		<div class="col-md-3 talents-search-filter-content">
			<form id="talent-filter-form">
			<div class="panel panel-talents-search">
				<div class="panel-heading">
					<span class="panel-title talents-refine-title">Filter Search</span>
					<div class="panel-heading-controls">
						<div class="panel-heading-icon"><i class="fa fa-chevron-left"></i></div>
					</div>
				</div>
				<div class="panel-body">
					<div class="location">
						<div class="panel panel-transparent margin-bottom-normal">
							<div class="panel-body padding-small no-border-hr no-padding-hr">
								<input type="text" class="form-control" name="zip" placeholder="Enter Talent Name" id="talent-name-search-input" max="5" maxlength="5">
							</div>
						</div> <!--talent name input-->

						<div class="panel panel-transparent">
							<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
								<div class="panel-title text-uppercase"><strong>Projects</strong></div>
							</div>
							<div class="panel-body padding-small no-border-hr no-padding-hr">
								<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
									<div class="tab-pane fade active in">
										<div class="display-block margin-bottom-small talent-role">
											<select name="" id="" class="form-control">
												<option value="1">All Projects</option>
												<option value="2">Role 1</option>
												<option value="3">Role 2</option>
												<option value="4">Role 3</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-transparent">
							<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
								<div class="panel-title text-uppercase"><strong>Roles</strong></div>
							</div>
							<div class="panel-body padding-small no-border-hr no-padding-hr">
								<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
									<div class="tab-pane fade active in">
										<div class="display-block margin-bottom-small talent-role">
											<select name="" id="" class="form-control">
												<option value="1">All Roles</option>
												<option value="2">Role 1</option>
												<option value="3">Role 2</option>
												<option value="4">Role 3</option>
											</select>
										</div>
										<div class="display-block role-status">
											<select name="" id="" class="form-control">
												<option value="1">All Role Statuses</option>
												<option value="2">Call Back Selected</option>
												<option value="3">Booked</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div> <!--Roles-->

						<div class="panel panel-transparent">
							<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
								<div class="panel-title text-uppercase"><strong>Schedules</strong></div>
							</div>
							<div class="panel-body padding-small no-border-hr no-padding-hr">
								<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
									<div class="tab-pane fade active in">
										<div class="display-block margin-bottom-small scheduled-talent">
											<select name="" id="" class="form-control">
												<option value="1">All Scheduled Talent</option>
												<option value="2">No Schedule Filter</option>
												<option value="3">May 31 - Room 1</option>
											</select>
										</div>
										<div class="display-block margin-bottom-small talent-status">
											<select name="" id="" class="form-control">
												<option value="1">All Statuses</option>
												<option value="2">Pending</option>
												<option value="3">Confirmed</option>
												<option value="4">Declined</option>
												<option value="5">Rescheduled</option>
											</select>
										</div>
										<div class="display-block margin-bottom-small talent-status">
											<select name="" id="" class="form-control">
												<option value="1">No Message Filter</option>
												<option value="2">Pending</option>
												<option value="3">Any with all messages</option>
												<option value="4">Any with new messages</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div> <!--Schedules-->

						<div class="panel panel-transparent margin-zero">
							<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
								<div class="panel-title text-uppercase"><strong>Notes</strong></div>
							</div>
							<div class="panel-body padding-small no-border-hr no-padding-hr">
								<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
									<div class="tab-pane fade active in">
										<div class="display-block margin-bottom-small scheduled-talent">
											<input type="text" class="form-control" name="zip" placeholder="Enter Notes" id="talent-notes-input" max="5" maxlength="5">
										</div>
									</div>
								</div>
							</div>
						</div> <!--notes-->

						<div class="row-fluid clearfix">
							<div class="col-md-6 padding-left-zero">
								<button id="talent-filter-search-button" type="button" class="btn btn-success btn-block">Filter</button>
							</div>
							<div class="col-md-6 padding-right-zero">
								<button id="talent-clear-search-button" type="button" class="btn btn-default btn-block">Clear</button>
							</div>
						</div>

					</div>
				</div>
			</div>
			</form>
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
				<div class="panel talent-item margin-bottom-small" data-bind-template="#schedules" data-bind-value="data">
					<div class="panel-body">
						<div class="row-fluid clearfix">
							<div class="col-md-2 talent-content margin-bottom">
								<div class="talent-name" data-bind="<%= getTalent().bam_talentci.getFullName() %>">
								</div>
								<div class="talent-photo">
									<img data-bind="<%= getTalent().bam_talentci.getPrimaryPhoto() %>" alt="" class="img-responsive">
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
										<button type="button" class="btn btn-sm btn-success" data-bind="<%= invitee_accepted == 1 ? 'btn-success' : 'btn-outline' %>" data-bind-target="class"><i class="fa fa-check"></i> Confirmed</button>
										<button type="button" class="btn btn-sm btn-outline"><i class="fa fa-times"></i> Declined</button>
										<button type="button" class="btn btn-sm btn-outline"><i class="fa fa-clock-o"></i> Reschedule</button>
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