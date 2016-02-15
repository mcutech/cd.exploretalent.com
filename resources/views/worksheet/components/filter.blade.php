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
				<div class="panel panel-transparent margin-zero">
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<input type="text" class="form-control" name="talentname" placeholder="Enter Talent Name / ID" />
					</div>
				</div>

				<div class="panel panel-transparent margin-zero">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title"><strong>Confirmation Status</strong></div>
					</div>
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<div class="display-block margin-bottom-small scheduled-talent">
									<select name="confirmation_status" id="" class="form-control">
										<option value="">Any</option>
										<option value="1">Pending</option>
										<option value="2">Confirmed</option>
										<option value="3">Declined</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-transparent margin-zero">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title"><strong>Callback Status</strong></div>
					</div>
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<div class="display-block margin-bottom-small scheduled-talent">
									<select name="callback_status" id="" class="form-control">
										<option value="">Any</option>
										<option value="1">Pending</option>
										<option value="2">Callback</option>
										<option value="3">Hired</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="hide panel panel-transparent margin-zero">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title"><strong>Message Status</strong></div>
					</div>
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<div class="display-block margin-bottom-small scheduled-talent">
									<select name="message_status" id="" class="form-control">
										<option value="1">Any</option>
										<option value="2">No Message</option>
										<option value="3">Any with Message</option>
										<option value="3">Any with New Message</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-transparent margin-zero">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title"><strong>Notes</strong></div>
					</div>
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<div class="display-block margin-bottom-small scheduled-talent">
									<input type="text" class="form-control" name="notes" placeholder="Enter Notes" id="talent-notes-input" >
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
						<button type="reset" class="btn btn-default btn-block">Clear</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</form>
