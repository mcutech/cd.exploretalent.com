<div class="col-md-3 talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
	@if (isset($unrate) && $unrate)
	<a class="btn btn-danger btn-xs pull-right unrate-button" type="button" data-bind="<%= id %>" data-bind-target="data-id"><i class="fa fa-times"></i></a>
	@endif
	<ul class="nav nav-tabs" style="width:90%;">
		<li class="active">
			<a data-bind="#talent-body-<%= getTalent().bam_talentnum %>" href="#talent-body" data-toggle="tab">Photo</a>
		</li>
		<li>
			<a data-bind="#like-it-note-<%= getTalent().bam_talentnum %>" data-toggle="tab">My Notes</a>
		</li>
	</ul>

	<div class="panel">
		<div class="panel-body">
			<div class="row-fluid clearfix">
				<div class="tab-content padding-top-zero padding-bottom-small">
					<div class="tab-pane fade active in" data-bind="talent-body-<%= getTalent().bam_talentnum %>" data-bind-target="id">
						<div class="head-area padding-zero padding-bottom-zero col-md-12">
							<div class="talent-name font-size-normal text-semibold float-left text-succes"><span data-bind="<%= getTalent().bam_talentci.getFullName() %>"></span>, <span data-bind="<%= getTalent().bam_talentci.getAge() %>" class="age-area"></span></div>
							<div class="favorite-indicator float-right">
								<i class="fa fa-star-o font-size-medium-large text-light-gray"></i>
							</div>
						</div>
						<div class="row-fluid clearfix">
							<div class="talent-photo col-lg-6 col-md-12 col-sm-12">
								<img data-bind="<%= getTalent().bam_talentci.getPrimaryPhoto() %>" class="img-responsive" />
							</div>

							<div class="col-lg-6 col-md-12 col-sm-12 padding-right-zero talent-information padding-top-small">
								<div class="talent-location">
									<i class="fa fa-map-marker"></i> <span data-bind="<%= getTalent().bam_talentci.stateText() %>"></span>
								</div>

								<ul class="list-unstyled talents-list-details">
									<li><span data-bind="<%= getTalent().bam_talentci.heightText() %>"></span></li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo1.weightpounds %>"></span> lbs.</li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo2.ethnicity %>"></span></li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo1.build %>"></span></li>
									<li><span data-bind="<%= getTalent().bam_talentci.bam_talentinfo1.eyecolor %>"></span></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" data-bind="like-it-note-<%= getTalent().bam_talentnum %>" data-bind-target="id">
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
				</div>
			</div>
			<div class="row-fluid clearfix">
				<div class="col-md-6 padding-zero">
					<div class="like-it-list-container">
						<div class="text-left">
							<div class="display-block title"> Add to like list </div>
							<div class="btn-group btn-group-xs" data-bind="<%= id ? 'schedule-' + id : 'user-' + inviter_id %>" data-bind-target="data-id">
								<button class="btn btn-xs btn-danger rating-button" data-bind="<%= parseInt(rating) == 1 ? 'active' : '' %>" data-bind-target="class">1</button>
								<button class="btn btn-xs btn-warning rating-button" data-bind="<%= parseInt(rating) == 2 ? 'active' : '' %>" data-bind-target="class">2</button>
								<button class="btn btn-xs btn-info rating-button" data-bind="<%= parseInt(rating) == 3 ? 'active' : '' %>" data-bind-target="class">3</button>
								<button class="btn btn-xs btn-primary rating-button" data-bind="<%= parseInt(rating) == 4 ? 'active' : '' %>" data-bind-target="class">4</button>
								<button class="btn btn-xs btn-success rating-button" data-bind="<%= parseInt(rating) == 5 ? 'active' : '' %>" data-bind-target="class">5</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 padding-zero">
					<div class="like-it-list-container">
						<div class="float-right-md-lg">
							<div class="display-block title">&nbsp;</div>
							<div class="btn-group btn-group-xs">
								<button class="btn btn-xs btn-default " data-rating="1"><span class="fa fa-file-text-o"></span></button>
								<button class="btn btn-xs btn-default " data-rating="2"><span class="fa fa-picture-o"></span></button>
								<button class="btn btn-xs btn-default " data-rating="1"><span class="fa fa-calendar"></span></button>
								<button class="btn btn-xs btn-default " data-rating="2"><span class="fa fa-envelope-o"></span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> {{-- talent item container --}}

