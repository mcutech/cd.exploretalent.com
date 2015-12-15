<div class="{{ $class or 'col-md-3' }} talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
	<ul class="nav nav-tabs">
		<li class="active">
			<a data-bind="#talent-body-<%= invitee.bam_talentnum %>" href="#talent-body" data-toggle="tab">Photo</a>
		</li>
		<li>
			<a data-bind="#like-it-note-<%= invitee.bam_talentnum %>" data-toggle="tab">My Notes</a>
		</li>
		@if (isset($unrate) && $unrate)
		<a class="btn btn-outline btn-xs pull-right unrate-button" type="button" data-bind="<%= id %>" data-bind-target="data-id"><i class="fa fa-times"></i></a>
		@endif
		@if (isset($remove) && $remove)
		<label class="checkbox-inline pull-right" style="margin-top: -10px;">
			<input type="checkbox" name="likeitlist-checkbox" class="px" data-bind="<%= id %>" data-bind-target="data-id">
			<span class="lbl"></span>
		</label>
		@endif
	</ul>
	<div class="panel margin-bottom-zero">
		<div class="panel-body">
			<div class="row-fluid clearfix">
				<div class="tab-content padding-top-zero padding-bottom-small">
					<div class="talent-tab tab-pane fade active in" data-bind="talent-body-<%= invitee.bam_talentnum %>" data-bind-target="id">
						<div class="head-area padding-zero padding-bottom-zero display-inline-block col-md-12">
							<div class="talent-name font-size-normal text-semibold float-left"><span data-bind="<%= invitee.bam_talentci.getFullName() %>"></span>, <span data-bind="<%= invitee.bam_talentci.getAge() %>" class="age-area"></span><br><span data-bind="ID: <%= invitee.bam_talentnum %>"></span></div>
							<div class="favorite-indicator float-right">
								<button class="btn-link fav-btn">
									<i class="fa fa-star-o font-size-medium-large text-light-gray" data-bind="favorite-<%= invitee.id %>" data-bind-target="id"></i>
								</button>
							</div>
						</div>
						<div class="row-fluid clearfix">
							<div class="talent-photo col-lg-6 col-md-12 col-sm-6 col-xs-12">
								<div class="photo-user-container">
									<a href="" data-toggle="modal" data-bind="<%= invitee.bam_talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-photos-modal"><img data-bind="<%= invitee.bam_talentci.getPrimaryPhoto() %>" class="img-responsive" /></a>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-right-zero talent-information padding-top-small">
								<div class="talent-location">
									<div class="photo-user-container">
									<i class="fa fa-map-marker"></i> <span data-bind="<%= invitee.bam_talentci.stateText() %>"></span>
									</div>
								</div>

								<ul class="list-unstyled talents-list-details">
									<li><span data-bind="<%= invitee.bam_talentci.heightText() %>"></span></li>
									<li><span data-bind="<%= invitee.bam_talentci.bam_talentinfo1.weightpounds %>"></span> lbs.</li>
									<li><span data-bind="<%= invitee.bam_talentci.bam_talentinfo2.ethnicity %>"></span></li>
									<li><span data-bind="<%= invitee.bam_talentci.bam_talentinfo1.build %>"></span></li>
									<li><span data-bind="<%= invitee.bam_talentci.bam_talentinfo1.eyecolor %>"></span></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" data-bind="like-it-note-<%= invitee.bam_talentnum %>" data-bind-target="id">
						<div class="tab-pane">
							<div class="note-item-container-holder">
								<div id="schedule-notes" class="talent-item note-item-container padding-small">
									<div class="note-item" data-bind-template="#schedule-notes" data-bind-value="schedule_notes">
										<div class="name-date">
											<div class="name" data-bind="<%= user.bam_cd_user.getFullName() %>"></div>
											<div class="date" data-bind="<%= created_at %>"></div>
										</div>
										<div class="note-body" data-bind="<%= body %>">
										</div>
										<a data-toggle="modal" data-target="#talent-edit-note-modal" class="edit-note-link" data-bind="edit-note_<%= schedule_id + '_' + id %>" data-bind-target="id"><i class="fa fa-pencil"></i> Edit this note</a>
									</div>
								</div>
							</div>
							<a data-toggle="modal" data-target="#talent-add-note-modal" class="add-casting-note padding-small font-size-normal btn-block btn btn-outline" data-bind="add-casting-note_<%= id %>" data-bind-target="id"><i class="fa fa-plus"></i> Add Casting Note</a>
						</div>
					</div>

				</div>
			</div>
			<div class="row-fluid clearfix">
				<div class="col-md-12 col-sm-12 padding-zero">
					<div class="like-it-list-container">
						<div class="display-block title"> Add to like list </div>
						<div class="btn-group talent-function" data-bind="<%= id ? 'schedule-' + id : 'user-' + inviter_id %>" data-bind-target="data-id">
							<button class="btn btn-xs btn-danger rating-button function-item" data-bind="<%= parseInt(rating) == 1 ? 'active' : '' %>" data-bind-target="class">1</button>
							<button class="btn btn-xs btn-warning rating-button function-item" data-bind="<%= parseInt(rating) == 2 ? 'active' : '' %>" data-bind-target="class">2</button>
							<button class="btn btn-xs btn-info rating-button function-item" data-bind="<%= parseInt(rating) == 3 ? 'active' : '' %>" data-bind-target="class">3</button>
							<button class="btn btn-xs btn-primary rating-button function-item" data-bind="<%= parseInt(rating) == 4 ? 'active' : '' %>" data-bind-target="class">4</button>
							<button class="btn btn-xs btn-success rating-button function-item" data-bind="<%= parseInt(rating) == 5 ? 'active' : '' %>" data-bind-target="class">5</button>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 padding-zero margin-top-small">
					<div class="like-it-list-container">
						<div class="btn-group talent-function">
							<a data-toggle="modal" data-bind="<%= invitee.bam_talentnum %>" data-bind-target="data-id" id="talent-resume" data-target="#talent-resume-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-file-text-o"></span></a>
							<a data-toggle="modal" data-bind="<%= invitee.bam_talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-photos-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-picture-o"></span></a>
							<a data-toggle="modal" data-target="#" class="btn btn-xs btn-outline function-item"><span class="fa fa-calendar"></span></a>
							<a data-toggle="modal" data-target="#talent-message-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-envelope-o"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> {{-- talent item container --}}
