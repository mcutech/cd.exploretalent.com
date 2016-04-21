<div class="{{ $class or 'col-md-2' }} talent-item-container">
	<div class="talent-item">
		<div class="talent-photo-and-note-container">
			<ul class="talent-functions-v2 list-unstyled">
				<li><span class="text-function-label profile">View Profile</span><a onclick="window.open(this.href, 'mywin', 'left=0,top=0,width=769,height=650,toolbar=1,resizable=0'); return false;" data-bind="/talents/<%= talentnum %>" class="talent-function-icon profile"><i class="fa fa-user"></i></a></li>
				<li><span class="text-function-label photos">View Photos</span><a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="talent-photo" data-target="#talent-view-photos-modal" class="talent-function-icon photos"><i class="fa fa-picture-o"></i></a></li>
				<li><span class="text-function-label notes">Add Notes</span><a class="talent-function-icon notes" data-bind="#like-it-note-<%= invitee.bam_talentnum %>" data-toggle="tab"><i class="fa fa-file-o"></i></a></li>
			</ul>
			<div class="talent-photo-v2">
				<div class="photo-user-container">
					<img src="/images/filler.jpg" class="img-responsive" />
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
		<div class="talent-info-like-list-container border-bottom-width-zero">
			<div class="like-it-list-parent row-fluid clearfix">
				
				<div class="col-md-12 col-sm-12 padding-zero">
					<div class="like-it-list-container">
						<div class="btn-group talent-function display-block-zz-xs display-flex-sm display-block-md">
							<!-- turns to green when added to like list and change text to added and change icon to check -->
							
							<!-- inactive -->
							<button class="btn btn-outline function-item btn-block border-top-width-zero-sm-lg"><i class="fa fa-plus text-success"></i> <span class="text-success">Add Like it List</span></button>
							<button class="btn btn-outline function-item btn-block border-top-width-zero-sm border-left-width-zero-sm border-left-width-zero-lg border-top-width-zero-sm-lg" rel="tooltip" title="Add to Favorites"><i class="fa fa-star-o font-size-normal-medium text-default"></i></button>
							
						</div>
					</div>
				</div>

			</div>
			<div class="talent-information-parent row-fluid clearfix" data-bind="talent-body-<%= talentnum %>" data-bind-target="id">
				<div class="col-md-12 padding-zero">
					<span class="name font-size-normal-zz-lg">Hairy Choe Ottem</span>
					<span class="age font-size-normal-zz-lg"><i>,</i> <span>23</span></span>
					<div class="talent-additional-info">
						<div class="additional-info-item height">Height: <span>5' 8"</span></div>
						<div class="additional-info-item body-type">Body: <span>150 lbs.</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div> {{-- talent item container --}}