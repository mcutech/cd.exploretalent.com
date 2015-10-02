<div id="talent-resume-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Talents Resume</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-3">
					<div class="">
						<img data-bind="<%= getPrimaryPhoto() %>" class="margin-top-large"	src="data:image/jpeg;base64,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" width="100%">
						<button class="btn btn-primary btn-xs btn-block mt-5 margin-top-small">View Full Profile</button>
						<button class="btn btn-default btn-xs btn-block mt-5 view-photos">View Photos</button>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel-body">
						<ul id="uidemo-tabs-default-demo" class="nav nav-tabs">
							<li class="active">
								<a href="#uidemo-tabs-default-demo-acting-modeling" data-toggle="tab">Acting/Modeling</a>
							</li>
							<li class="">
								<a href="#uidemo-tabs-default-demo-musician" data-toggle="tab">Musician</a>
							</li>
							<li class="">
								<a href="#uidemo-tabs-default-demo-dance" data-toggle="tab">Dance</a>
							</li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane fade active in" id="uidemo-tabs-default-demo-acting-modeling">
							<!-- Acting/Modeling -->
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3 col-xs-3">
											<label>Height</label>
										</div>
										<div class="col-md-3 col-xs-3">
											<span data-bind="<%= heightText() %>" >5'15"</span>
										</div>
										<div class="col-md-3 col-xs-3">
											<label>Ethnicity</label>
										</div>
										<div class="col-md-3 col-xs-3">
											<span data-bind="<%= bam_talentinfo2.ethnicity %>" > Cucasian</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 col-xs-3">
											<label>Weight</label>
										</div>
										<div class="col-md-3 col-xs-3">
											<span data-bind="<%= bam_talentinfo1.weightpounds %>">120lbs</span>
										</div>
										<div class="col-md-3 col-xs-3">
											<label>Hair Color</label>
										</div>
										<div class="col-md-3 col-xs-3">
											<span data-bind="<%= bam_talentinfo1.haircolor %>"> Blonde</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 col-xs-3">
											<label>Body Type</label>
										</div>
										<div class="col-md-3 col-xs-3">
											<span data-bind="<%= bam_talentinfo1.build %>">Athletic</span>
										</div>
										<div class="col-md-3 col-xs-3">
											<label>Eye Color</label>
										</div>
										<div class="col-md-3 col-xs-3">
											<span data-bind="<%= bam_talentinfo1.eyecolor %>">Hazel</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 margin-top-normal-medium">
											<h4>About</h4>
										</div>
										<div class="col-md-12 border-t">
											<p data-bind="<%= bam_talentinfo2.special_skills%>" class="margin-top-large">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
										</div>
										<div class="col-md-12 margin-top-large">
											<h4>Short Resume</h4>
										</div>
										<div class="col-md-12 border-t">
											<p data-bind="<%= bam_talentinfo2.experience %>"class="margin-top-normal-medium">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
										</div>
									</div>
								</div>
								<!-- Acting/Modeling -->
							</div>
							<div class="tab-pane fade" id="uidemo-tabs-default-demo-musician">
							<!-- Musician -->
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Primary Role</label>
										</div>
										<div class="col-md-2 col-xs-3">
											<span>Singer</span>
										</div>
										<div class="col-md-4 col-xs-3">
											<label>Performances</label>
										</div>
										<div class="col-md-2 col-xs-3">
											<span>20</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Genres</label>
										</div>
										<div class="col-md-2 col-xs-3">
											<span> Rock</span>
										</div>
										<div class="col-md-4 col-xs-3">
											<label> Intruments</label>
										</div>
										<div class="col-md-2 col-xs-3">
											<span>Guitar</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Experience</label>
										</div>
										<div class="col-md-8 col-xs-3">
											<span>1-2 years</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 margin-top-normal-medium">
											<h4>Musician Information</h4>
										</div>
										<div class="col-md-12 border-t">
											<p class="margin-top-large">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
											<a href="">Show more...</a>
										</div>
										<div class="col-md-12 margin-top-large">
											<h4>Looking for this kind of gig</h4>
										</div>
										<div class="col-md-12 border-t">
											<p class="margin-top-normal-medium">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
											<a href="#">Show more...</a>
										</div>
										<div class="col-md-12 margin-top-large">
											<h4>Musical Influences</h4>
										</div>
										<div class="col-md-12 border-t">
											<p class="margin-top-normal-medium">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
											<a href="#">Show more...</a>
										</div>
									</div>
									<!-- Musician -->
								</div>
							</div>
							<div class="tab-pane fade" id="uidemo-tabs-default-demo-dance">
							<!-- Dance -->
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Primary Style</label>
										</div>
										<div class="col-md-6 col-xs-3">
											<span>House</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Experience</label>
										</div>
										<div class="col-md-6 col-xs-3">
											<span> 1-2 years</span>
										</div>

									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Performance</label>
										</div>
										<div class="col-md-8 col-xs-3">
											<span>5 years</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 margin-top-normal-medium">
											<h4>Dancer Background</h4>
										</div>
										<div class="col-md-12 border-t">
											<p class="margin-top-large">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
											<a href="">Show more...</a>
										</div>
										<div class="col-md-12 margin-top-large">
											<h4>Influences</h4>
										</div>
										<div class="col-md-12 border-t">
											<p class="margin-top-normal-medium">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
											<a href="">Show more...</a>
										</div>
										<div class="col-md-12 margin-top-large">
											<h4>Gig Description</h4>
										</div>
										<div class="col-md-12 border-t">
											<p class="margin-top-normal-medium">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor elementum felis, ac sagittis ligula aliquet quis. Aenean faucibus nisl ac eros tempus, ac tempus lectus volutpat.
											</p>
											<a href="">Show more...</a>
										</div>
									</div>
									<!-- Dance -->
								</div>

							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div> <!-- / .modal-content -->
			</div> <!-- / .modal-dialog -->
		</div> <!-- / .modal -->
	</div>
</div>
