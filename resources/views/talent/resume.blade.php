@extends('layouts.master')
@section('master.body')
<div class="talent-resume-wrapper">

	<!-- project/role and actions -->
	<div class="project-role-actions">
		<div class="row-fluid clearfix">
			<div class="col-md-5 col-sm-5 col-xs-8 margin-bottom-small-zz-xs">
				<div class="padding-top-zero-small">
					<label>Bad Chef Parody</label> <label class="text-muted">Male Chef Host</label>
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-4">
				<a href="" class="btn btn-outline btn-sm btn-block">CallBack</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-8 padding-left-zero-sm-lg">
				<div class="like-it-list-container">
					<div class="btn-group btn-group-justified talent-function">
						<a data-value="1" class="btn btn-sm btn-danger rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">1</a>
						<a data-value="2" class="btn btn-sm btn-warning rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">2</a>
						<a data-value="3" class="btn btn-sm btn-info rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist"	>3</a>
						<a data-value="4" class="btn btn-sm btn-primary rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">4</a>
						<a data-value="5" class="btn btn-sm btn-success rating-button function-item" data-toggle="modal" data-bind="<%= user.id %>" data-bind-target="data-id" data-target="#addtolist">5</a>
					</div>
				</div>
			</div>
			<div class="col-sm-1 col-xs-2 padding-left-zero">
				<a href="" class="btn btn-outline btn-sm btn-block"><i class="fa fa-chevron-left display-none-md-lg"></i><span class="display-none-zz-sm">Previous</span></a>
			</div>
			<div class="col-sm-1 col-xs-2 padding-left-zero">
				<a href="" class="btn btn-outline btn-sm btn-block"><i class="fa fa-chevron-right display-none-md-lg"></i><span class="display-none-zz-sm">Next</span></a>
			</div>
		</div>
	</div>
	
	<!-- name and occupation -->
	<div class="panel margin-zero">
		<div class="panel-body padding-normal" id="talent-resume-info">
			<div class="row-fluid clearfix">
				<div class="col-sm-12 padding-zero">
					<h3 class="margin-zero text-bold text-align-center-zz-xs">
						<span data-bind="<%= getFullName() %>"></span>
						,<span data-bind="<%= getAge() %>"></span>
					</h3>
					<div class="skills-link text-align-center-zz-xs">
						<a id="acting-modeling-link" href="#acting-modeling">Acting/Modeling</a>
						<a id="musician-link" href="#musician">Musician</a>
						<a id="dance-link" href="#dance">Dance</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- content info -->
	<div class="panel margin-normal">
		<div class="panel-body padding-small-zz-xs">
			<div class="row-fluid clearfix">
				<div class="col-sm-3 col-xs-4 padding-zero-zz-xs padding-right-small-zz-xs"> <!-- photos -->
					<div id="talent-primary-photo" class="col-sm-12 padding-zero">
						<img data-bind="<%= getPrimaryPhoto() %>" class="" width="100%">
					</div>
					<div class="col-sm-12 padding-zero">
						<div id="first-photo" class="col-sm-6 col-xs-6 padding-right-zero padding-left-zero">
							<img data-bind="https://etdownload.s3.amazonaws.com/<%= bam_media_path_full %>" class="margin-top-small" width="100%">
						</div>
						<div id="second-photo" class="col-sm-6 col-xs-6 padding-right-zero padding-left-zero">
							<img data-bind="https://etdownload.s3.amazonaws.com/<%= bam_media_path_full %>" class="margin-top-small" width="100%">
						</div>
					</div>
					<div id="third-photo" class="col-sm-12 col-xs-6 padding-zero">
						<img data-bind="https://etdownload.s3.amazonaws.com/<%= bam_media_path_full %>" class="margin-top-small" width="100%">
					</div>
					<div class="col-sm-12 col-xs-12 padding-zero">
						<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="view-resume-photos" data-target="#talent-view-photos-modal" class="btn btn-default btn-block margin-top-small"><span><span class="display-none-zz-xs">View</span> Photos</span></a>
					</div>
				</div> <!-- photos -->

				<div id="talent-resume-div" class="col-sm-9 col-xs-8 padding-zero-zz-xs margin-top-large"><!-- contents -->

					<div id="acting-modeling" class="col-sm-12 form-group">
						<div class="row">
							<h4 class="text-bold margin-top-zero margin-bottom-zero-small">Acting/Modeling</h4>
							<div class="col-sm-12 border-t"></div>
						</div>
						<div class="row resume-info">
							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= (heightText()) ? 1 : 0 %>" data-bind-target="visibility">
								<div >
									<div class="col-sm-6 col-xs-6">
										<label>Height:</label>
									</div>
									<div class="col-sm-6 col-xs-6">
										<span data-bind="<%= heightText() %>" >5'15"</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talentinfo2.ethnicity) ? 1 : 0 %>" data-bind-target="visibility">
								<div>
									<div class="col-sm-6 col-xs-6">
										<label>Ethnicity:</label>
									</div>
									<div class="col-sm-6 col-xs-6">
										<span data-bind="<%= bam_talentinfo2.ethnicity %>" > Cucasian</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talentinfo1.weightpounds) ? 1 : 0 %>" data-bind-target="visibility">
								<div>
									<div class="col-sm-6 col-xs-6">
										<label>Weight:</label>
									</div>
									<div class="col-sm-6 col-xs-3">
										<span data-bind="<%= bam_talentinfo1.weightpounds %>">120lbs</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talentinfo1.haircolor) ? 1 : 0 %>" data-bind-target="visibility">
								<div>
									<div class="col-sm-6 col-xs-6">
										<label>Hair Color:</label>
									</div>
									<div class="col-sm-6 col-xs-6">
										<span data-bind="<%= bam_talentinfo1.haircolor %>"> Blonde</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talentinfo1.build) ? 1 : 0 %>" data-bind-target="visibility">
								<div>
									<div class="col-sm-6 col-xs-6">
										<label>Body Type:</label>
									</div>
									<div class="col-sm-6 col-xs-6">
										<span data-bind="<%= bam_talentinfo1.build %>">Athletic</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talentinfo1.eyecolor) ? 1 : 0 %>" data-bind-target="visibility">
								<div>
									<div class="col-sm-6 col-xs-6">
										<label>Eye Color:</label>
									</div>
									<div class="col-sm-6 col-xs-6">
										<span data-bind="<%= bam_talentinfo1.eyecolor %>">Hazel</span>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Acting/Modeling -->
					
					<!-- about and short resume -->
					<div class="col-xs-12 padding-zero talent-info-item">
						<div data-bind="<%= (bam_talentinfo2.special_skills) ? '1' : '' %>" data-bind-target="visibility">
							<div class="col-sm-12 margin-top-small">
								<h5 class="margin-zero text-bold text-primary">About</h5>
							</div>
							<div class="col-sm-12">
								<p data-bind="<%= bam_talentinfo2.special_skills%>" class="margin-top-zero"></p>
							</div>
						</div>
						<div data-bind="<%= (bam_talentinfo2.special_skills) ? '1' : '' %>" data-bind-target="visibility">
							<div class="col-sm-12 margin-top-small">
								<h5 class="margin-zero text-bold text-primary">Short Resume</h5>
							</div>
							<div class="col-sm-12">
								<p data-bind="<%= bam_talentinfo2.experience %>"class="margin-top-normal-zero"></p>
							</div>
						</div>
					</div>

					<div id="musician" class="col-xs-12 form-group">
						<div class="row">
							<h4 class="text-bold margin-bottom-zero-small">Musician</h4>
							<div class="col-sm-12 border-t"></div>
						</div>
						<div class="row resume-info">
							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= bam_talent_music[0].music_role ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-6 col-xs-6">
									<label style="width=20px;">Primary Role</label>
								</div>
								<div class="col-sm-6 col-xs-6">
									<span data-bind="<%= bam_talent_music[0].music_role %>"></span>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= bam_talent_music[0].number_of_gigs ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-6 col-xs-6">
									<label>Performances</label>
								</div>
								<div class="col-sm-6 col-xs-6">
									<span data-bind="<%= bam_talent_music[0].number_of_gigs %>"></span>
								</div>
							</div>
						
							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= bam_talent_music[0].genre ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-6 col-xs-6">
									<label style="width=20px;">Genres</label>
								</div>
								<div class="col-sm-6 col-xs-6">
									<span data-bind="<%= bam_talent_music[0].genre %>"> </span>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= bam_talent_music[0].music_instruments ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-6 col-xs-6">
									<label> Intruments</label>
								</div>
								<div class="col-sm-6 col-xs-6">
									<span data-bind="<%= bam_talent_music[0].music_instruments %>"></span>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= bam_talent_music[0].years_experience ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-6 col-xs-6">
									<label style="width=20px;">Experience</label>
								</div>
								<div class="col-sm-6 col-xs-6">
									<span data-bind="<%= bam_talent_music[0].years_experience %>"></span>
								</div>
							</div>

							<div class="col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talent_music[0].des_1) ? 1 : 0 %>" data-bind-target="visibility">
								<div class="col-sm-12 margin-top-normal-medium">
									<h5 class="text-bold margin-zero text-primary">Musician Information</h5>
								</div>
								<div class="col-sm-12">
									<p class="main" data-bind="<%= bam_talent_music[0].des_1 %>">
									</p>
									<p class="extended hide" data-bind="<%= bam_talent_music[0].des_1 %>">
									</p>
								</div>
							</div>

							<div class="col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talent_music[0].searching_gig_des) ? 1 : 0 %>" data-bind-target="visibility">
								<div class="col-sm-12 margin-top-large">
									<h5 class="text-bold margin-zero text-primary">Looking for this kind of gig</h5>
								</div>
								<div class="col-sm-12">
									<p class="main" data-bind="<%= bam_talent_music[0].searching_gig_des %>">
									</p>
									<p class="extended hide" data-bind="<%= bam_talent_music[0].searching_gig_des %>">
									</p>
								</div>
							</div>

							<div class="col-sm-6 col-xs-12 padding-zero talent-info-item" data-bind="<%= (bam_talent_music[0].major_influence) ? 1 : 0 %>" data-bind-target="visibility">
								<div class="col-sm-12 margin-top-large">
									<h5 class="text-bold margin-zero text-primary">Musical Influences</h5>
								</div>
								<div class="col-sm-12">
									<p class="main" data-bind="<%= bam_talent_music[0].major_influence %>">
									</p>
									<p class="extended hide" data-bind="<%= bam_talent_music[0].major_influence %>">
									</p>
								</div>
							</div>
						</div>
					</div> <!-- Musician -->

					<div id="dance" class="col-sm-12 form-group">
						<div class="row">
							<h4 class="text-bold margin-bottom-zero-small">Dance</h4>
							<div class="col-sm-12 border-t"></div>
						</div>
						<div class="row">
							<div data-bind="<%= (bam_talent_dance[0].dance_style_1) ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-6 col-xs-6">
									<label style="width=20px;">Primary Style</label>
								</div>
								<div class="col-sm-6 col-xs-6">
									<span data-bind="<%= bam_talent_dance[0].dance_style_1 %>"></span>
								</div>
							</div>
							<div data-bind="<%= (bam_talent_dance[0].num_of_perfom) ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-3 col-xs-6">
									<label style="width=20px;">Performance</label>
								</div>
								<div class="col-sm-3 col-xs-6">
									<span data-bind="<%= bam_talent_dance[0].num_of_perfom %>"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div data-bind="<%= (bam_talent_dance[0].years_experience) ? '1' : '' %>" data-bind-target="visibility">
								<div class="col-sm-3 col-xs-6">
									<label style="width=20px;">Experience</label>
								</div>
								<div class="col-sm-3 col-xs-6">
									<span data-bind="<%= bam_talent_dance[0].years_experience %>"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div data-bind="<%= (bam_talent_dance[0].dancer_background) ? 1 : 0%>" data-bind-target="visibility">
								<div class="col-sm-12 margin-top-normal-medium">
									<h4>Dancer Background</h4>
								</div>
								<div class="col-sm-12">
									<p class="margin-top-large main" data-bind="<%=  bam_talent_dance[0].dancer_background %>">
									</p>
									<p class="margin-top-large extended hide" data-bind="<%= bam_talent_dance[0].dancer_background %>">
									</p>
								</div>
							</div>
							<div data-bind="<%= (bam_talent_dance[0].influences) ? 1 : 0 %>" data-bind-target="visibility">
								<div class="col-sm-12 margin-top-large">
									<h4>Influences</h4>
								</div>
								<div class="col-sm-12">
									<p class="margin-top-normal-medium main" data-bind="<%=  bam_talent_dance[0].influences %>">
									</p>
									<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_dance[0].influences %>">
									</p>
								</div>
							</div>
							<div data-bind="<%= (bam_talent_dance[0].searching_gig_des) ? 1 : 0 %>" data-bind-target="visibility">
								<div class="col-sm-12 margin-top-large">
									<h4>Gig Description</h4>
								</div>
								<div class="col-sm-12">
									<p class="margin-top-normal-medium main" data-bind="<%=  bam_talent_dance[0].searching_gig_des %>">
									</p>
									<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_dance[0].searching_gig_des %>">
									</p>
								</div>
							</div>
						</div>
					</div>	<!-- Dance -->

				</div> <!-- contents -->
			</div>
		</div>
	</div>

</div>
@include('components.modals.talent-view-photos')
@stop
