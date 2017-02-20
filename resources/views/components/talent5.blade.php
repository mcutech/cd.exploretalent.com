<div class="{{ $class or 'col-md-2' }} talent-item-container" data-bind-template="{{ $databind['template'] or '' }}" data-bind-value="{{ $databind['value'] or '' }}">
	<div class="talent-item">
		<div class="talent-photo-and-note-container">
			<a onclick="window.open(this.href, 'mywin', 'left=0,top=0,width=769,height=650,toolbar=1,resizable=0'); return false;" data-bind="/talents/<%= talentnum %>" class="talent-function-icon profile">
				<div class="view-profile-text">
					<h4>View Profile</h4>
				</div>
				<div class="talent-info">
					<h5 class="margin-zero text-default"><b><span data-bind="<%= fname %>"></span></b>, <span data-bind="<%= getAge() %>"></span></h5>
				</div>
				<div class="talent-photo-v2">
					<div class="photo-user-container">
						<img data-bind="<%= getPrimaryPhoto() %>" class="img-responsive" />
					</div>
				</div>
			</a>
		</div>

		<div class="talent-info-like-list-container border-bottom-width-zero">
			<div class="like-it-list-parent row-fluid clearfix">
				<div class="col-md-12 col-sm-12 padding-zero">
					<div class="like-it-list-container">
						<div class="btn-group talent-function display-block-zz-xs display-flex-sm display-block-md">
							<button id="contact-talent-btn" data-toggle="modal" data-target="#ghost-onboarding-modal" class="btn btn-outline btn-success btn-lg function-item btn-block border-top-width-zero-sm-lg"><span class=""><b>Contact talent</b></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div> {{-- talent item container --}}

