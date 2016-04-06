<div class="{{ $class or 'col-md-2' }} talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
<!-- <ul class="nav nav-tabs">
	<li class="active">
		<a data-bind="#talent-body-<%= talentnum %>" href="#talent-body" data-toggle="tab">Photo</a>
	</li>
		@if (isset($notes) && $notes)
		<li>
			<a data-bind="#like-it-note-<%= talentnum %>" data-toggle="tab">My Notes</a>
		</li>
		@endif
</ul>
 -->

<div class="talent-item">
	<div class="talent-photo-and-note-container">
		<ul class="talent-functions-v2 list-unstyled">
			<li><span class="text-function-label profile">View Profile</span><a onclick="window.open(this.href, 'mywin', 'left=0,top=0,width=769,height=650,toolbar=1,resizable=0'); return false;" data-bind="/talents/<%= talentnum %>" class="talent-function-icon profile"><i class="fa fa-user"></i></a></li>
			<li><span class="text-function-label photos">View Photos</span><a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-view-photos-modal" class="talent-function-icon photos"><i class="fa fa-picture-o"></i></a></li>
			<li><span class="text-function-label notes">Add Notes</span><a class="talent-function-icon notes"><i class="fa fa-file-o"></i></a></li>
			<li><span class="text-function-label favorites">Add to Favorites</span><a class="talent-function-icon favorites" data-bind="<%= (favorite) ? 'favorite-' + favorite.id : 'talentnum-' + talentnum %>" data-bind-target="data-id"><i class="fa fa-star-o"></i></a></li>
			<li><span class="text-function-label add-role">Add to Role</span><a class="talent-function-icon add-role" href="#"><i class="fa fa-plus"></i></a></li>
		</ul>
		<div class="talent-photo-v2">
			<div class="photo-user-container">
				<img data-bind="<%= getPrimaryPhoto() %>" class="img-responsive" />
			</div>
		</div>
		<div class="talent-note-v2">
			<div class="back-add-note-container row-fluid clearfix">
				<a class="back-btn btn btn-outline border-radius-zero col-xs-2 padding-left-small padding-right-small border-width-zero"><span class="text-default"><i class="fa fa-chevron-left"></i></span></a>
				<a href="#" class="add-note-btn btn btn-outline border-radius-zero col-xs-10 padding-left-small padding-right-small border-width-zero"><span class="text-default"><i class="fa fa-plus"></i> Add Note</span></a>
			</div>
			<div class="note-item-container-holder">
				<div id="schedule-notes" class="talent-item note-item-container padding-small">
					<?php for($x=0; $x<=10; $x++) { ?>
					<div class="note-item">
						<div class="name-date">
							<div class="name">JohnTest CD</div>
							<div class="date">03-31-16</div>
						</div>
						<div class="note-body">note testing</div>
						<a data-toggle="modal" data-target="#talent-edit-note-modal" class="edit-note-link" data-bind-target="id" id="edit-note_722724_108"><i class="fa fa-pencil"></i> Edit this note</a>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<div class="talent-info-like-list-container margin-top-zero-small">
		<div class="like-it-list-parent row-fluid clearfix">
			@if (isset($ratings) && $ratings)
			<div class="col-md-12 col-sm-12 padding-zero">
				<div class="like-it-list-container">
					<div class="btn-group talent-function">
						<button data-value="1" class="btn btn-xs btn-danger rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">1</button>
						<button data-value="2" class="btn btn-xs btn-warning rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">2</button>
						<button data-value="3" class="btn btn-xs btn-info rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist"	>3</button>
						<button data-value="4" class="btn btn-xs btn-primary rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">4</button>
						<button data-value="5" class="btn btn-xs btn-success rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">5</button>
						<button data-value="6" class="btn btn-xs btn-default rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">CB</button>
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="talent-information-parent row-fluid clearfix" data-bind="talent-body-<%= talentnum %>" data-bind-target="id">
			<div class="col-md-12 padding-zero">
				<span class="name font-size-normal-zz-xs" data-bind="<%= getFullName() %>"></span>
				<span class="age"><i>,</i><span data-bind="<%= getAge() %>" class="age-area"></span></span>
				<div class="talent-additional-info">
					<div class="additional-info-item height"><span>Height: </span><span data-bind="<%= getHeight() %>"></span></div>
					<div class="additional-info-item body-type"><span>Body: Athletic</span></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel" hidden>
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
							<a href="#"><div class="add-casting-note padding-top-small padding-bottom-small bordered text-align-center"><i class="fa fa-plus"></i> Add Note</div></a>
						</div>
					</div>
					@endif
			</div>
		</div>
		<div class="row-fluid clearfix">
				@if (isset($ratings) && $ratings)
				<div class="col-md-12 col-sm-12 padding-zero">
					<div class="like-it-list-container">
						<div class="display-block title"> Add to like list </div>
						<div class="btn-group talent-function">
							<button data-value="1" class="btn btn-xs btn-danger rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">1</button>
							<button data-value="2" class="btn btn-xs btn-warning rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">2</button>
							<button data-value="3" class="btn btn-xs btn-info rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist"	>3</button>
							<button data-value="4" class="btn btn-xs btn-primary rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">4</button>
							<button data-value="5" class="btn btn-xs btn-success rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">5</button>
						</div>
					</div>
				</div>
				@endif
				<div class="col-md-12 col-sm-12 padding-zero margin-top-small">
					<div class="like-it-list-container">
						<div class="btn-group talent-function">
							<!-- <a data&#45;toggle="modal" data&#45;bind="<%= talentnum %>" data&#45;bind&#45;target="data&#45;id" id="talent&#45;resume1" data&#45;target="#talent&#45;resume&#45;modal" class="btn btn&#45;xs btn&#45;default"><span class="fa fa&#45;file&#45;text&#45;o"></span></a> -->
							<a target="_blank" data-bind="/talents/<%= talentnum %>" class="btn btn-xs btn-default function-item"> <span class="fa fa-file-text-o"></span></a>
							<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-photos-modal" class="btn btn-xs btn-default function-item"><span class="fa fa-picture-o"></span></a>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
</div> {{-- talent item container --}}

