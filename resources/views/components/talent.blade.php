<div class="{{ $class or 'col-md-3' }} talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
	<ul class="nav nav-tabs">
		<li class="active">
			<a data-bind="#talent-body-<%= talentnum %>" href="#talent-body" data-toggle="tab">Photo</a>
		</li>
		<li>
			<a data-bind="#like-it-note-<%= talentnum %>" data-toggle="tab">My Notes</a>
		</li>
	</ul>

	<div class="panel margin-bottom-zero">
		<div class="panel-body">
			<div class="row-fluid clearfix">
				<div class="tab-content padding-top-zero padding-bottom-small">
					<div class="talent-tab tab-pane fade active in" data-bind="talent-body-<%= talentnum %>" data-bind-target="id">
						<div class="head-area padding-zero padding-bottom-zero display-inline-block col-md-12">
							<div class="talent-name font-size-normal text-semibold float-left text-succes"><span data-bind="<%= getFullName() %>"></span>, <span data-bind="<%= getAge() %>" class="age-area"></span></div>
							<div class="favorite-indicator float-right">
								<button class="btn-link fav-btn" data-bind="<%= favorite ? favorite.id : '' %>" data-bind-target="data-id">
									<i class="fa fa-star-o font-size-medium-large" data-bind="<%= favorite ? 'text-warning' : 'text-light-gray' %>" data-bind-target="class"></i>
								</button>
							</div>
						</div>
						<div class="row-fluid clearfix">
							<div class="talent-photo col-lg-6 col-md-12 col-sm-6 col-xs-12">
								<div class="photo-user-container">
									<img data-bind="<%= getPrimaryPhoto() %>" class="img-responsive" />
								</div>
							</div>

							<div class="col-lg-6 col-md-12 col-sm-6 padding-right-zero talent-information padding-top-small">
								<div class="talent-location">
									<i class="fa fa-map-marker"></i> <span data-bind="<%= stateText() %>"></span>
								</div>

								<ul class="list-unstyled talents-list-details">
									<li><span data-bind="<%= heightText() %>"></span></li>
									<li><span data-bind="<%= bam_talentinfo1.weightpounds %>"></span> lbs.</li>
									<li><span data-bind="<%= bam_talentinfo2.ethnicity %>"></span></li>
									<li><span data-bind="<%= bam_talentinfo1.build %>"></span></li>
									<li><span data-bind="<%= bam_talentinfo1.eyecolor %>"></span></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" data-bind="like-it-note-<%= talentnum %>" data-bind-target="id">
						<div class="tab-pane" id="note-container" data-bind="<%= schedule.id ? 'schedule-' + schedule.id : 'user-' + user.id %>" data-bind-target="data-id">
							<div class="note-item-container-holder">
								<div id="schedule-notes" class="talent-item note-item-container padding-small">
									<div class="note-item" data-bind-template="#schedule-notes" data-bind-value="schedule.schedule_notes">
										<div class="note-header">
											<div class="photo"></div>
											<div class="name-date">
												<div class="name" data-bind="<%= user.bam_cd_user.getFullName() %>"></div>
												<div class="date" data-bind="<%= created_at %>"></div>
											</div>
											<div class="note-body" data-bind="<%= body %>">
											</div>
											<a data-toggle="modal" data-target="#talent-edit-note-modal" class="btn-link edit-note-link" data-bind="edit-note_<%= schedule_id + '_' + id %>" data-bind-target="id"><i class="fa fa-pencil"></i> Edit this note</a>
										</div>
									</div>
								</div>
							</div>
							<a data-toggle="modal" data-target="#talent-add-note-modal" class="add-casting-note btn btn-outline btn-default btn-block" data-bind="add-casting-note_<%= schedule.id ? 'schedule-' + schedule.id : 'user-' + user.id %>" data-bind-target="id"><i class="fa fa-plus"></i> Add Casting Note</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid clearfix">
				<div class="col-md-12 col-sm-12 padding-zero">
					<div class="like-it-list-container">
						<div class="display-block title"> Add to like list </div>
						<div class="btn-group talent-function" data-bind="<%= schedule ? 'schedule-' + schedule.id : 'user-' + user.id %>" data-bind-target="data-id">
							<button class="btn btn-xs btn-danger rating-button function-item"  data-bind="<%= schedule && parseInt(schedule.rating) == 1 ? 'active' : '' %>" data-bind-target="class">1</button>
							<button class="btn btn-xs btn-warning rating-button function-item" data-bind="<%= schedule && parseInt(schedule.rating) == 2 ? 'active' : '' %>" data-bind-target="class">2</button>
							<button class="btn btn-xs btn-info rating-button function-item" data-bind="<%= schedule && parseInt(schedule.rating) == 3 ? 'active' : '' %>" data-bind-target="class">3</button>
							<button class="btn btn-xs btn-primary rating-button function-item" data-bind="<%= schedule && parseInt(schedule.rating) == 4 ? 'active' : '' %>" data-bind-target="class">4</button>
							<button class="btn btn-xs btn-success rating-button function-item" data-bind="<%= schedule && parseInt(schedule.rating) == 5 ? 'active' : '' %>" data-bind-target="class">5</button>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 padding-zero margin-top-small">
					<div class="like-it-list-container">
						<div class="btn-group talent-function">
							<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-resume" data-target="#talent-resume-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-file-text-o"></span></a>
							<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-photos-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-picture-o"></span></a>
							<a data-toggle="modal" data-target="#" class="btn btn-xs btn-outline function-item"><span class="fa fa-calendar"></span></a>
							<a data-toggle="modal" data-target="#talent-message-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-envelope-o"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> {{-- talent item container --}}

