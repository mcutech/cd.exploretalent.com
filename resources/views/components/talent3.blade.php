<div class="{{ $class or 'col-md-3' }} talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
	<ul class="nav nav-tabs">
		<li class="active">
			<a data-bind="#talent-body-<%= talentnum %>" href="#talent-body" data-toggle="tab">Photo</a>
		</li>
		@if (isset($notes) && $notes)
		<li>
			<a data-bind="#like-it-note-<%= talentnum %>" data-toggle="tab">My Notes</a>
		</li>
		@endif
	</ul>

	<div class="panel">
		<div class="panel-body">
			<div class="row-fluid clearfix">
				<div class="tab-content padding-top-zero padding-bottom-small">
					<div class="talent-tab tab-pane fade active in" data-bind="talent-body-<%= talentnum %>" data-bind-target="id">
						<div class="head-area padding-zero padding-bottom-zero col-md-12">
							<div class="talent-name font-size-normal text-semibold float-left text-succes"><span data-bind="<%= getFullName() %>"></span>, <span data-bind="<%= getAge() %>" class="age-area"></span><br><span data-bind="ID: <%= talentnum %>"></span></div>
							<div class="favorite-indicator float-right">
								<button class="btn-link fav-btn" data-bind="<%= (favorite) ? 'favorite-' + favorite.id : 'talentnum-' + talentnum %>" data-bind-target="data-id">
									<i class="fa fa-star-o font-size-medium-large" data-bind="<%= (favorite) ? 'text-warning' : 'text-light-gray' %>" data-bind-target="class"></i>
								</button>
							</div>
						</div>
						<div class="row-fluid clearfix">
							<div class="talent-photo col-lg-6 col-md-12 col-sm-4 col-xs-12">
								<div class="photo-user-container">
									<img data-bind="<%= getPrimaryPhoto() %>" class="img-responsive" />
								</div>
							</div>

							<div class="col-lg-6 col-md-12 col-sm-6 padding-right-zero talent-information padding-top-small">
								<div class="talent-location">
									<i class="fa fa-map-marker"></i> <span data-bind="<%= getState() %>"></span>
								</div>

								<ul class="list-unstyled talents-list-details">
									<li><span data-bind="<%= getHeight() %>"></span></li>
									<li><span data-bind="<%= weightpounds %>"></span> lbs.</li>
									<li><span data-bind="<%= ethnicity %>"></span></li>
									<li><span data-bind="<%= build %>"></span></li>
									<li><span data-bind="<%= eyecolor %>"></span></li>
								</ul>
							</div>
						</div>
					</div>
					@if (isset($notes) && $notes)
					<div class="tab-pane fade" data-bind="like-it-note-<%= talentnum %>" data-bind-target="id">
						<div class="tab-pane" id="tab-content-2">
							<div class="item-container-holder">
								<div id="schedule-notes" class="talent-item note-item-container padding-small">
									<div class="note-item" data-bind-template="#schedule-notes" data-bind-value="schedule_notes">
										<div class="note-header">
											<div class="photo"></div>
											<div class="name-date">
												<div class="name" data-bind="<%= user.bam_cd_user.getFullName() %>"></div>
												<div class="date" data-bind="<%= created_at %>"></div>
											</div>
											<div class="note-body" data-bind="<%= body %>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<a href="#"><div class="add-casting-note padding-top-small padding-bottom-small bordered text-align-center"><i class="fa fa-plus"></i> Add Casting Note</div></a>
						</div>
					</div>
					@endif
				</div>
			</div>
			<div class="row-fluid clearfix">
				@if (isset($ratings) && $ratings)
				<div class="col-md-6 padding-zero">
					<div class="like-it-list-container">
						<div class="text-left">
						<div>
							<div class="display-block title"> Add to like list </div>
								<div class="btn-group btn-group-xs" data-bind="<%= (schedule && schedule.id) ? 'schedule-' + schedule.id : 'user-' + user.id %>" data-bind-target="data-id">
									<button class="btn btn-xs btn-danger rating-button"  data-bind="<%= schedule && schedule.id && parseInt(schedule.rating) == 1 ? 'active' : '' %>" data-bind-target="class">1</button>
									<button class="btn btn-xs btn-warning rating-button" data-bind="<%= schedule && schedule.id && parseInt(schedule.rating) == 2 ? 'active' : '' %>" data-bind-target="class">2</button>
									<button class="btn btn-xs btn-info rating-button" 	 data-bind="<%= schedule && schedule.id && parseInt(schedule.rating) == 3 ? 'active' : '' %>" data-bind-target="class">3</button>
									<button class="btn btn-xs btn-primary rating-button" data-bind="<%= schedule && schedule.id && parseInt(schedule.rating) == 4 ? 'active' : '' %>" data-bind-target="class">4</button>
									<button class="btn btn-xs btn-success rating-button" data-bind="<%= schedule && schedule.id && parseInt(schedule.rating) == 5 ? 'active' : '' %>" data-bind-target="class">5</button>
								</div>
						</div>
						</div>
					</div>
				</div>
				@endif
				<div class="col-md-6 padding-zero">
					<div class="like-it-list-container">
						<div class="float-right-md-lg">
							<div class="display-block title">&nbsp;</div>
							<div class="btn-group btn-group-xs">
								<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-resume" data-target="#talent-resume-modal" class="btn btn-xs btn-default"><span class="fa fa-file-text-o"></span></a>
								<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-photos-modal" class="btn btn-xs btn-default"><span class="fa fa-picture-o"></span></a>
								<a data-toggle="modal" data-target="#" class="btn btn-xs btn-default"><span class="fa fa-calendar"></span></a>
								<a data-toggle="modal" data-target="#talent-message-modal" class="btn btn-xs btn-default"><span class="fa fa-envelope-o"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> {{-- talent item container --}}
