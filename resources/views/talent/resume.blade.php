@extends('layouts.master')
@section('master.body')
<div id="talent-resume-div" class="row-fluid clearfix">
	<div class="col-md-12" >
		<div class="col-md-12">
			<div class="col-md-6">
				<h3 class="">
					<span data-bind="<%= getFullName() %>"></span>
					, <span data-bind="<%= getAge() %>"></span>
				</h3>
			</div>
			<div class="text-right margin-top-large col-md-6">
				<a href="#acting-modeling">Acting/Modeling</a>
				<a href="#musician">Musician</a>
				<a href="#dance">Dance</a>
			</div>
		</div>
		<div class="col-md-3">
			<div class="col-md-12">
				<img data-bind="<%= getPrimaryPhoto() %>" class="margin-top-large" width="100%">
			</div>
			<div class="col-md-12">
				<div class="col-md-6 padding-right-zero padding-left-zero">
					<img data-bind="<%= getPrimaryPhoto() %>" class="margin-top-small" width="100%">
				</div>
				<div class="col-md-6 padding-right-zero padding-left-zero">
					<img data-bind="<%= getPrimaryPhoto() %>" class="margin-top-small" width="100%">
				</div>
			</div>
			<div class="col-md-12">
				<img data-bind="<%= getPrimaryPhoto() %>" class="margin-top-small" width="100%">
			</div>
			<div class="col-md-12">
				<a data-toggle="modal" data-bind="<%= talentnum %>" data-bind-target="data-id" id="view-resume-photos" data-target="#talent-view-photos-modal" class="btn btn-default btn-xs btn-block mt-5"><span>View Photos</span></a>
			</div>
		</div>
		<div class="col-md-9">
			<!-- Acting/Modeling -->
			<div id="acting-modeling" class="col-md-12">
				<h3>Acting/Modeling</h3>
				<div class="col-md-12 border-t"></div>
				<div class="row margin-top-medium">
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
						<div class="col-md-12 margin-top-small">
							<h4>About</h4>
						</div>
						<div class="col-md-12">
							<p data-bind="<%= bam_talentinfo2.special_skills%>" class="margin-top-zero"></p>
						</div>
					</div>
					<div data-bind="<%= (bam_talentinfo2.special_skills) ? '1' : '' %>" data-bind-target="visibility">
						<div class="col-md-12 margin-top-small">
							<h4>Short Resume</h4>
						</div>
						<div class="col-md-12">
							<p data-bind="<%= bam_talentinfo2.experience %>"class="margin-top-normal-zero"></p>
						</div>
					</div>
				</div>
			</div><!-- Acting/Modeling -->
			<!-- Musician -->
			<div id="musician" class="col-md-12">
				<h3>Musician</h3>
				<div class="col-md-12 border-t"></div>
				<div class="row margin-top-medium">
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
						<div class="col-md-12">
							<p class="margin-top-large main" data-bind="<%= bam_talent_music[0].des_1 %>">
							</p>
							<p class="margin-top-large extended hide" data-bind="<%= bam_talent_music[0].des_1 %>">
							</p>
						</div>
					</div>
					<div data-bind="<%= (bam_talent_music[0].searching_gig_des) ? 1 : 0 %>" data-bind-target="visibility">
						<div class="col-md-12 margin-top-large">
							<h4>Looking for this kind of gig</h4>
						</div>
						<div class="col-md-12">
							<p class="margin-top-normal-medium main" data-bind="<%= bam_talent_music[0].searching_gig_des %>">
							</p>
							<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_music[0].searching_gig_des %>">
							</p>
						</div>
					</div>
					<div data-bind="<%= (bam_talent_music[0].major_influence) ? 1 : 0 %>" data-bind-target="visibility">
						<div class="col-md-12 margin-top-large">
							<h4>Musical Influences</h4>
						</div>
						<div class="col-md-12">
							<p class="margin-top-normal-medium main" data-bind="<%= bam_talent_music[0].major_influence %>">
							</p>
							<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_music[0].major_influence %>">
							</p>
						</div>
					</div>
				</div>
			</div> <!-- Musician -->
			<!-- Dance -->
			<div id="dance" class="col-md-12">
				<h3>Dance</h3>
				<div class="col-md-12 border-t"></div>
				<div class="row margin-top-medium">
					<div class="col-md-4 col-xs-3">
						<label style="width=20px;">Primary Style</label>
					</div>
					<div class="col-md-2 col-xs-3">
						<span data-bind="<%= bam_talent_dance[0].dance_style_1 %>"></span>
					</div>
					<div class="col-md-4 col-xs-3">
						<label style="width=20px;">Performance</label>
					</div>
					<div class="col-md-2 col-xs-3">
						<span data-bind="<%= bam_talent_dance[0].num_of_perfom %>"></span>
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
					<div data-bind="<%= (bam_talent_dance[0].dancer_background) ? 1 : 0%>" data-bind-target="visibility">
						<div class="col-md-12 margin-top-normal-medium">
							<h4>Dancer Background</h4>
						</div>
						<div class="col-md-12">
							<p class="margin-top-large main" data-bind="<%=  bam_talent_dance[0].dancer_background %>">
							</p>
							<p class="margin-top-large extended hide" data-bind="<%= bam_talent_dance[0].dancer_background %>">
							</p>
						</div>
					</div>
					<div data-bind="<%= (bam_talent_dance[0].influences) ? 1 : 0 %>" data-bind-target="visibility">
						<div class="col-md-12 margin-top-large">
							<h4>Influences</h4>
						</div>
						<div class="col-md-12">
							<p class="margin-top-normal-medium main" data-bind="<%=  bam_talent_dance[0].influences %>">
							</p>
							<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_dance[0].influences %>">
							</p>
						</div>
					</div>
					<div data-bind="<%= (bam_talent_dance[0].searching_gig_des) ? 1 : 0 %>" data-bind-target="visibility">
						<div class="col-md-12 margin-top-large">
							<h4>Gig Description</h4>
						</div>
						<div class="col-md-12">
							<p class="margin-top-normal-medium main" data-bind="<%=  bam_talent_dance[0].searching_gig_des %>">
							</p>
							<p class="margin-top-normal-medium extended hide" data-bind="<%= bam_talent_dance[0].searching_gig_des %>">
							</p>
						</div>
					</div>
				</div>
			</div>	<!-- Dance -->
		</div> <!-- / .modal-content -->
	</div>
</div>
@include('components.modals.talent-view-photos')
@stop
