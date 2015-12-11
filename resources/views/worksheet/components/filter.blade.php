<form id="filter-form">
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
									<select name="" id="projects-list" class="form-control">
										<option data-bind-template="#projects-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name }) %>"></option>
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
									<select name="role" id="roles-list" class="form-control">
										<option data-bind-template="#roles-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>"></option>
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
						<button id="filter-button" type="button" class="btn btn-success btn-block">Filter</button>
					</div>
					<div class="col-md-6 padding-right-zero">
						<button id="talent-clear-search-button" type="button" class="btn btn-default btn-block">Clear</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</form>