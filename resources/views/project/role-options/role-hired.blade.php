<div class="like-it-list-talents-wrapper like-it-list-page-wrapper">
	<div class="talents-search-filter-content">
		<div class="row-fluid clearfix">
			<div id="like-it-list" class="col-md-12 talents-search-result">
				<div class="row-fluid clearfix" id="like-it-list-results">
					@for ($i=0; $i < 8; $i++) 
					<div class="col-md-3 talent-item-container">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#talent-body" data-toggle="tab">Photo</a>
							</li>
							<li>
								<a href="#like-it-note" data-toggle="tab">My Notes</a>
							</li>
						</ul>
						<div class="panel margin-bottom-zero">
							<div class="panel-body">
								<div class="row-fluid clearfix">
									<div class="tab-content padding-top-zero padding-bottom-small">
										<div class="talent-tab tab-pane fade active in" data-bind="talent-body-<%= invitee.bam_talentnum %>" data-bind-target="id">
											<div class="head-area padding-zero padding-bottom-zero display-inline-block col-md-12">
												<div class="talent-name font-size-normal text-semibold float-left"><span>John Smith</span>, <span class="age-area">18</span><br><span>ID: 9278821</span></div>
												<div class="favorite-indicator float-right">
													<button class="btn-link fav-btn">
														<i class="fa fa-star font-size-medium-large text-warning"></i>
													</button>
												</div>
											</div>
											<div class="row-fluid clearfix">
												<div class="talent-photo col-lg-6 col-md-12 col-sm-6 col-xs-12">
													<div class="photo-user-container">
														<a href="" data-toggle="modal" id="talent-photo" data-target="#talent-photos-modal"><img src="/../images/talents-sample-image.jpg" class="img-responsive" /></a>
													</div>
												</div>

												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-right-zero talent-information padding-top-small">
													<div class="talent-location">
														<div class="photo-user-container">
															<i class="fa fa-map-marker"></i> <span> Los Angeles, CA</span>
														</div>
													</div>

													<ul class="list-unstyled talents-list-details">
														<li><span>3' 1"</span></li>
														<li><span></span>40 lbs.</li>
														<li><span></span>African</li>
														<li><span></span>Medium</li>
														<li><span></span>Black</li>
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
												<button class="btn btn-xs rating-button disabled
												function-item" data-bind="<%= parseInt(rating) < 0 ?
												'background:#423434; border-color:#423434; color:white' : '' %>"
												data-bind-target="style"><strong>B</strong></button>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 padding-zero margin-top-small">
										<div class="like-it-list-container">
											<div class="btn-group talent-function">
												<a data-toggle="modal" data-bind="<%= invitee.bam_talentnum %>" data-bind-target="data-id" id="talent-resume" data-target="#talent-resume-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-file-text-o"></span></a>
												<a data-toggle="modal" data-bind="<%= invitee.bam_talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-photos-modal" class="btn btn-xs btn-outline function-item"><span class="fa fa-picture-o"></span></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> {{-- talent item container --}}
					@endfor
				</div>
			</div>
		</div>
	</div>
</div>