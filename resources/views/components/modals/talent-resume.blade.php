<div id="talent-resume-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Talents Resume</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label>Talent Name:</label>
						<span data-bind="<%= fname %>"></span>
						<span data-bind="<%= lname %>"></span>
					</div>
					<div class="col-md-12">
						<label>Talent ID:</label>
						<span data-bind="<%= talentnum %>"></span>
					</div>
				<div class="col-md-3">
					<div class="">
						<img data-bind="<%= getPrimaryPhoto() %>" class="margin-top-large" width="100%">
						<a class="btn btn-primary btn-xs btn-block mt-5 margin-top-small" data-bind="http://www.exploretalent.com/<%= talentlogin %>" target="_blank">View Full Profile</a>
						<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="view-resume-photos" data-target="#talent-view-photos-modal" class="btn btn-default btn-xs btn-block mt-5"><span>View Photos</span></a>
						{{-- <button class="btn btn-default btn-xs btn-block mt-5 view-photos">View Photos</button> --}}
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel-body">
						<ul id="uidemo-tabs-default-demo" class="nav nav-tabs">
							<li class="active">
								<a href="#uidemo-tabs-default-demo-acting-modeling" data-toggle="tab">Acting/Modeling</a>
							</li>
							<li class="" data-bind="<%= (bam_talent_music[0].genre && bam_talent_music[0].des_1 && bam_talent_music[0].music_role && bam_talent_music[0].searching_gig_des && bam_talent_music[0].major_influence ) ? 1 : 0 %>" >
									<a href="#uidemo-tabs-default-demo-musician" data-toggle="tab">Musician</a>
							</li>
							<li class="" data-bind="<%= (bam_talent_dance[0].dance_style_1 && bam_talent_dance[0].dancer_background && bam_talent_dance[0].influences && bam_talent_dance[0].searching_gig_des) ? 1 : 0 %>" >
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
									<div data-bind="<%= (bam_talentinfo2.special_skills) ? '1' : '' %>" data-bind-target="visibility">
										<div class="col-md-12 margin-top-normal-medium">
											<h4>About</h4>
										</div>
										<div class="col-md-12 border-t">
											<p data-bind="<%= bam_talentinfo2.special_skills%>" class="margin-top-large"></p>
										</div>
									</div>
									<div data-bind="<%= (bam_talentinfo2.special_skills) ? '1' : '' %>" data-bind-target="visibility">
										<div class="col-md-12 margin-top-large">
											<h4>Short Resume</h4>
										</div>
										<div class="col-md-12 border-t">
											<p data-bind="<%= bam_talentinfo2.experience %>"class="margin-top-normal-medium"></p>
										</div>
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
											<span data-bind="<%= bam_talent_music[0].music_role %>"></span>
										</div>
										<div class="col-md-4 col-xs-3">
											<label>Performances</label>
										</div>
										<div class="col-md-2 col-xs-3">
											<span data-bind="<%= bam_talent_music[0].number_of_gigs %>"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Genres</label>
										</div>
										<div class="col-md-2 col-xs-3">
											<span data-bind="<%= bam_talent_music[0].genre %>"> </span>
										</div>
										<div class="col-md-4 col-xs-3">
											<label> Intruments</label>
										</div>
										<div class="col-md-2 col-xs-3">
											<span data-bind="<%= bam_talent_music[0].music_instruments %>"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Experience</label>
										</div>
										<div class="col-md-8 col-xs-3">
											<span data-bind="<%= bam_talent_music[0].years_experience %>"></span>
										</div>
									</div>
									<div class="row">
										<div data-bind="<%= (bam_talent_music[0].des_1) ? 1 : 0 %>" data-bind-target="visibility">
											<div class="col-md-12 margin-top-normal-medium">
												<h4>Musician Information</h4>
											</div>
											<div class="col-md-12 border-t">
												<p class="margin-top-large main" data-bind="<%= (bam_talent_music[0].des_1.length > 145) ? bam_talent_music[0].des_1.substr(0, 145) + '...' : bam_talent_music[0].des_1 %>">
												</p>
												<p class="margin-top-large extended hide" data-bind="<%= bam_talent_music[0].des_1 %>">
												</p>
												<a href="" class="show-more-btn" data-bind="<%= (bam_talent_music[0].des_1.length > 145) ? 1 : 0 %>" data-bind-target="visibility">Show more...</a>
											</div>
										</div>
										<div data-bind="<%= (bam_talent_music[0].searching_gig_des) ? 1 : 0 %>" data-bind-target="visibility">
											<div class="col-md-12 margin-top-large">
												<h4>Looking for this kind of gig</h4>
											</div>
											<div class="col-md-12 border-t">
												<p class="margin-top-normal-medium main" data-bind="<%= (bam_talent_music[0].searching_gig_des.length > 145) ? bam_talent_music[0].searching_gig_des.substr(0, 145) + '...' : bam_talent_music[0].searching_gig_des %>">
												</p>
												<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_music[0].searching_gig_des %>">
												</p>
												<a class="show-more-btn" href="" data-bind="<%= (bam_talent_music[0].searching_gig_des.length > 145) ? 1 : 0 %>" data-bind-target="visibility">Show more...</a>
											</div>
										</div>
										<div data-bind="<%= (bam_talent_music[0].major_influence) ? 1 : 0 %>" data-bind-target="visibility">
											<div class="col-md-12 margin-top-large">
												<h4>Musical Influences</h4>
											</div>
											<div class="col-md-12 border-t">
												<p class="margin-top-normal-medium main" data-bind="<%= (bam_talent_music[0].major_influence.length > 145) ? bam_talent_music[0].major_influence.substr(0, 145) + '...' : bam_talent_music[0].major_influence.length %>">
												</p>
												<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_music[0].major_influence %>">
												</p>
												<a class="show-more-btn" href="" data-bind="<%= (bam_talent_music[0].major_influence.length > 145) ? 1 : 0 %>" data-bind-target="visibility">Show more...</a>
											</div>
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
											<span data-bind="<%= bam_talent_dance[0].dance_style_1 %>"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Experience</label>
										</div>
										<div class="col-md-6 col-xs-3">
											<span data-bind="<%= bam_talent_dance[0].years_experience %>"></span>
										</div>

									</div>
									<div class="row">
										<div class="col-md-4 col-xs-3">
											<label style="width=20px;">Performance</label>
										</div>
										<div class="col-md-8 col-xs-3">
											<span data-bind="<%= bam_talent_dance[0].num_of_perfom %>"></span>
										</div>
									</div>
									<div class="row">
										<div data-bind="<%= (bam_talent_dance[0].dancer_background) ? 1 : 0%>" data-bind-target="visibility">
											<div class="col-md-12 margin-top-normal-medium">
												<h4>Dancer Background</h4>
											</div>
											<div class="col-md-12 border-t">
												<p class="margin-top-large main" data-bind="<%= (bam_talent_dance[0].dancer_background.length > 145) ? bam_talent_dance[0].dancer_background.substr(0, 145) + '...' : bam_talent_dance[0].dancer_background %>">
												</p>
												<p class="margin-top-large extended hide" data-bind="<%= bam_talent_dance[0].dancer_background %>">
												</p>
												<a href="" class="show-more-btn">Show more...</a>
											</div>
										</div>
										<div data-bind="<%= (bam_talent_dance[0].influences) ? 1 : 0 %>" data-bind-target="visibility">
											<div class="col-md-12 margin-top-large">
												<h4>Influences</h4>
											</div>
											<div class="col-md-12 border-t">
												<p class="margin-top-normal-medium main" data-bind="<%= (bam_talent_dance[0].influences.length > 145) ? bam_talent_dance[0].influences.substr(0, 145) + '...' : bam_talent_dance[0].influences %>">
												</p>
												<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_dance[0].influences %>">
												</p>
												<a href="" class="show-more-btn">Show more...</a>
											</div>
										</div>
										<div data-bind="<%= (bam_talent_dance[0].searching_gig_des) ? 1 : 0 %>" data-bind-target="visibility">
											<div class="col-md-12 margin-top-large">
												<h4>Gig Description</h4>
											</div>
											<div class="col-md-12 border-t">
												<p class="margin-top-normal-medium main" data-bind="<%= (bam_talent_dance[0].searching_gig_des.length > 145) ? bam_talent_dance[0].searching_gig_des.substr(0, 145) + '...' : bam_talent_dance[0].searching_gig_des %>">
												</p>
												<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_dance[0].searching_gig_des %>">
												</p>
												<a href="" class="show-more-btn">Show more...</a>
											</div>
										</div>
									</div>
									<!-- Dance -->
								</div>

							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div> <!-- / .modal-content -->
				</div>
			</div> <!-- / .modal-dialog -->
		</div> <!-- / .modal -->
	</div>
</div>
