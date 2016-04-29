<div class="{{ $class or 'col-md-2' }} talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
	<div class="talent-item">
		<div class="talent-photo-and-note-container">
			<ul class="talent-functions-v2 list-unstyled">
				<li id="view-profile"><span class="text-function-label profile">View Profile</span><a onclick="window.open(this.href, 'mywin', 'left=0,top=0,width=769,height=650,toolbar=1,resizable=0'); return false;" data-bind="/talents/<%= talentnum %>?casting_id=<%= talent_project_id %>&role_id=<%= talent_role_id %>" class="talent-function-icon profile"><i class="fa fa-user"></i></a></li>
				<li data-bind="<%= (bam_talent_media2.length) ? '1' : '' %>" data-bind-target="visibility"><span class="text-function-label photos">View Photos</span><a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-view-photos-modal" class="talent-function-icon photos"><i class="fa fa-picture-o"></i></a></li>
				@if (isset($favorites_notes) && $favorites_notes)
					<li><span class="text-function-label notes">Add Notes</span><a class="talent-function-icon notes"><i class="fa fa-file-o"></i></a></li>
				@endif
			</ul>
			<div class="talent-photo-v2">
				<div class="photo-user-container">
					<a onclick="window.open(this.href, 'mywin', 'left=0,top=0,width=769,height=650,toolbar=1,resizable=0'); return false;" data-bind="/talents/<%= talentnum %>?role_id=<%= talent_role_id %>" class="talent-function-icon profile">
						<img data-bind="<%= getPrimaryPhoto() %>" class="img-responsive" />
					</a>
				</div>
			</div>
			<div class="talent-note-v2">
				<div class="back-add-note-container row-fluid clearfix">
					<a class="back-btn btn btn-outline border-radius-zero col-xs-2 padding-left-small padding-right-small border-width-zero"><span class="text-default"><i class="fa fa-chevron-left"></i></span></a>
					<a href="#" class="add-note-btn btn btn-outline border-radius-zero col-xs-10 padding-left-small padding-right-small border-width-zero"><span class="text-default"><i class="fa fa-plus"></i> Add Note</span></a>
				</div>
				<div class="note-item-container-holder">
					<div id="schedule-notes" class="talent-item note-item-container padding-small">
						<div class="note-item" data-bind-template="#schedule-notes" data-bind-value="schedule.schedule_notes">
							<div class="name-date">
								<div class="name" data-bind="<%= user.bam_cd_user.getFullName() %>"></div>
								<div class="date" data-bind="<%= moment(created_at).format('YY-MM-DD HH:mm') %>"></div>
							</div>
							<div class="note-body" data-bind="<%= body %>"></div>
							<a data-toggle="modal" data-target="#talent-edit-note-modal" class="edit-note-link" data-bind-target="id" id="edit-note_722724_108"><i class="fa fa-pencil"></i> Edit this note</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="talent-info-like-list-container border-bottom-width-zero">
			<div class="like-it-list-parent row-fluid clearfix">
				<div class="col-md-12 col-sm-12 padding-zero">
					<div class="like-it-list-container">
						<div class="btn-group talent-function display-block-zz-xs display-flex-sm display-block-md" data-bind-target="data-id" data-bind="<%= user.id + '-' + talent_role_id + '-' + talentnum %>">
							<button id="add-to-like-it-list" class="btn function-item btn-block border-top-width-zero-sm-lg" data-bind="<%= schedule && schedule.id ? 'btn-success' : 'btn-outline' %>" data-bind-target="class">
								<i class="fa fa-plus"></i>
								<span data-bind="<%= schedule && schedule.id ? 'Added Like it List' : 'Add Like it List' %>" ></span>
							</button>
							<button class="favorite-button btn function-item btn-block border-top-width-zero-sm border-left-width-zero-sm border-left-width-zero-lg border-top-width-zero-sm-lg" data-bind="<%= favorite ? 'btn-warning' : 'btn-outline' %>" data-bind-target="class">
								<i class="fa fa-star-o font-size-normal-medium" data-bind-target="class"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="talent-information-parent row-fluid clearfix" data-bind="talent-body-<%= talentnum %>" data-bind-target="id">
				<div class="col-md-12 padding-zero">
					<span class="name font-size-normal-zz-lg" data-bind="<%= getFullName() %>"></span>
					<span class="age font-size-normal-zz-lg"><i>,</i><span data-bind="<%= getAge() %>" class="age-area"></span></span>
					<div class="talent-additional-info">
						<div class="additional-info-item height">Height: <span data-bind="<%= getHeight() %>"></span></div>
						<div class="additional-info-item body-type">Body: <span>Athletic</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> {{-- talent item container --}}


