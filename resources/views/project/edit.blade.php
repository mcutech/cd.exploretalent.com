@extends('layouts.project', ['pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Edit Project', 'url' => '/projects/'.$projectId.'/edit', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-file-text"></i> Edit Project
@stop

@section('project.body')
<div class="edit-project-wrapper">
	<div class="projects-content">
		<div class="panel">
			<div class="panel-body">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Project Name <span class="text-success">*</span></label>
								<input type="text" class="form-control" id="project-name" placeholder="Enter Project Name" data-bind="<%= project %>">
								<div class="alert alert-page alert-danger project-name-error-five" style="display:none;">This field must be at least 5 characters.</div>
								<div class="alert alert-page alert-danger project-name-error-required" style="display:none;">This field is required.</div>
							</div>

							<div class="form-group">
								<label class="control-label">Submission Deadline <span class="text-success">*</span></label>
								<div class="input-group date">
									<input type="text" id="bs-datepicker-submissiondeadline" class="form-control" readonly="true" style="cursor: pointer; background-color: #fff" data-bind="<%= date.formatYMD(asap) %>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
								<div class="alert alert-page alert-danger submission-deadline-error-required" style="display:none;">This field is required.</div>
							</div>

							<div class="form-group col-md-6 padding-left-zero-md-lg">
								<label class="control-label">Audition Date</label>
								<div class="input-group date">
									<input type="text" id="bs-datepicker-audition" class="form-control" readonly="true" style="cursor: pointer; background-color: #fff" data-bind="<%= date.formatYMD(aud_timestamp) %>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>

							<div class="form-group col-md-6 padding-right-zero-md-lg">
								<label class="control-label">Shoot Date</label>
								<div class="input-group date">
									<input type="text" id="bs-datepicker-shootdate" class="form-control" readonly="true" style="cursor: pointer; background-color: #fff" data-bind="<%= date.formatYMD(shoot_timestamp) %>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>

						</div> {{-- col-md-6 --}}
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Category <span class="text-success">*</span></label>
								<select class="form-control" id="project-category" name="cat" data-bind="<%= cat %>">
									<option value="43">Acting - Acrobatics/Stunts</option>
									<option value="41">Acting - Comedy/Clown</option>
									<option value="61">Acting - Other</option>
									<option value="42">Acting - Variety Acts</option>
									<option value="1" selected="">Commercials</option>
									<option value="16">Crew - Assistant &amp; Entry Level</option>
									<option value="49">Crew - Acounting/Payroll/HR</option>
									<option value="35">Crew - Camera/Editor</option>
									<option value="48">Crew - Graphic/Web/Animate</option>
									<option value="34">Crew - Lighting/Sound</option>
									<option value="37">Crew - Make Up/ Stylist</option>
									<option value="51">Crew - Management</option>
									<option value="25">Crew - Marketing / PR</option>
									<option value="38">Crew - Other</option>
									<option value="36">Crew - Producer/Director</option>
									<option value="40">Crew - Showbiz Internship</option>
									<option value="52">Crew - Talent/Casting Mgmt</option>
									<option value="50">Crew - Technology/MIS</option>
									<option value="47">Crew - TV/Radio</option>
									<option value="39">Crew - Writing/Script/Edit</option>
									<option value="3">Dance - Ballet/Classic</option>
									<option value="56">Dance - Choreography</option>
									<option value="54">Dance - Club/Gogo</option>
									<option value="53">Dance - HipHop</option>
									<option value="4">Dance - Modern/Jazz</option>
									<option value="58">Dance - Other/General</option>
									<option value="57">Dance - Teacher</option>
									<option value="55">Dance - Traditional/Latin</option>
									<option value="5">Episodic TV - Pilots</option>
									<option value="6">Episodic TV - SAG</option>
									<option value="7">Episodic TV - AFTRA</option>
									<option value="8">Episodic TV - Non-Union</option>
									<option value="60">Extras</option>
									<option value="9">Feature Film - SAG</option>
									<option value="10">Feature Film - Non-SAG</option>
									<option value="11">Feature Film - Student Films</option>
									<option value="12">Feature Film - Short Film</option>
									<option value="13">Feature Film - Documentaries</option>
									<option value="14">Feature Film - Low Budget/Independent</option>
									<option value="15">Infomercials</option>
									<option value="17">Industrial/Traning Films</option>
									<option value="27">Internet</option>
									<option value="18">Modeling - Runway</option>
									<option value="19">Modeling - Hair/Cosmetics</option>
									<option value="20">Modeling - Print</option>
									<option value="21">Music Videos</option>
									<option value="44">Music - Band</option>
									<option value="45">Music - DJ/Sound</option>
									<option value="30">Music - Horns</option>
									<option value="32">Music - Drums</option>
									<option value="31">Music - Keyboards</option>
									<option value="33">Music - Other</option>
									<option value="29">Music - Strings</option>
									<option value="46">Music - Teacher</option>
									<option value="28">Music - Vocals</option>
									<option value="59">Reality TV</option>
									<option value="22">Theatre - Equity (Union)</option>
									<option value="23">Theatre - Non-Equity</option>
									<option value="24">Trade Shows/Live Events/Promo Model</option>
									<option value="26">Voice-Over</option>
								</select>
								<div class="alert alert-page alert-danger category-error-required" style="display:none;">This field is required.</div>
							</div>

							<div class="form-group">
								<label class="control-label">Rate <span class="text-success">*</span></label>
								<form class="form-inline">
									<div class="form-group">
										<span class="display-inline font-size-normal">$</span>
										<input type="text" id="project-rate" class="form-control" data-bind="<%= rate %>">
										<span class="padding-left-small padding-right-small">per</span>
										<select name="" id="project-rate-desc" class="form-control" data-bind="<%= rate_des %>">
											<option value="0">n/a</option>
											<option value="1">event</option>
											<option value="2">hour</option>
											<option value="3">day</option>
											<option value="4">week</option>
											<option value="5">month</option>
										</select>
										<div class="alert alert-page alert-danger rate-error-required" style="display:none;">This field is required.</div>
									</div>
								</form>
							</div>

							<div class="form-group">
								<label class="control-label">Union <span class="text-success">*</span></label>
								<div class="margin-bottom-small-normal form-inline">
									<label class="radio checkbox-inline">
										<input type="radio" name="radioUnion" value="0" class="px" data-bind="<%= (union2 == '0') ? '1' : '0' %>">
										<span class="lbl">No</span>
									</label>
									<label class="radio checkbox-inline">
										<input type="radio" name="radioUnion" value="1" class="px" data-bind="<%= (union2 == '1') ? '1' : '0' %>">
										<span class="lbl">Yes</span>
									</label>
								</div>
							</div>

						</div> {{-- col-md-6 --}}
					</div> {{-- row-fluid --}}

					<div class="row-fluid">
						<div class="col-md-12">
							<div class="form-group">
								<strong><p class="control-label" data-bind="<%= (project_type == '8') ? 'Open Call Details' : 'Self Submission Details' %>"></p></strong>
								<div class="panel display-none" id="self-submissions-option-content">
									<div class="panel-body">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Email Address</label>
												<input type="text" id="self-sub-email" class="form-control" placeholder="Enter Email Address" data-bind="<%= (snr_email) ? snr_email : '' %>">
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label">and / or postal address <span class="text-success">*</span></label>
												<textarea id="self-sub-address" class="form-control" rows="5" placeholder="Address" style="resize: none;" data-bind="<%= (srn_address) ? srn_address : '' %>"></textarea>
												<div class="alert alert-page alert-danger self-sub-error-required" style="display:none;">This field is required.</div>
											</div>
										</div>
									</div>
								</div> {{-- self-submission-option-content --}}

								<div class="panel display-none" id="open-call-option-content">
									<div class="panel-body">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Date and Time of Open Call <span class="text-success">*</span></label>
												<textarea id="open-call-details" class="form-control" rows="5" placeholder="Details" style="resize: none;" data-bind="<%= (app_date_time) ? app_date_time : '' %>"></textarea>
												<div class="alert alert-page alert-danger open-call-date-error-required" style="display:none;">This field is required.</div>
											</div>
											<div class="form-group">
												<label class="checkbox-inline">
													<input type="checkbox" id="inlineCheckbox3" value="option3" class="px"> <span class="lbl">If Appointment only, check</span>
												</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label">Enter location(s) & telephone(s) <span class="text-success">*</span></label>
												<textarea id="open-call-location" class="form-control" rows="5" placeholder="Address & Telephone" style="resize: none;" data-bind="<%= (app_loc) ? app_loc : '' %>"></textarea>
												<div class="alert alert-page alert-danger open-call-location-error-required" style="display:none;">This field is required.</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> {{-- row-fluid --}}

					<div class="row-fluid">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Audition Location <span class="text-success">*</span></label>
								<div class="input-group">
									<input type="text" id="zip-code" class="form-control" placeholder="Enter Zip Code" data-bind="<%= zip %>">
									<span class="input-group-btn">
										<button class="btn" type="button">Auto Select Markets</button>
									</span>
								</div>
								<div class="alert alert-page alert-danger zipcode-error-required" style="display:none;">This field is required.</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">General Audition Info / Storyline / Synopsis / Logline <span class="text-success">*</span></label>
								<textarea id="audition-description" class="form-control" rows="5" placeholder="Message" style="resize: none;" data-bind="<%= des %>"></textarea>
								<div class="alert alert-page alert-danger audition-description-error-required" style="display:none;">This field is required.</div>
							</div>
						</div>
					</div>

					<div class="row-fluid">
						<div class="col-md-12">
							<div class="pull-right">
								<a href="#" id="update-project-btn" class="btn btn-success btn-lg">Update</a>
							</div>
							<div id="update-profile-success-text" class="pull-right margin-right-normal margin-top-normal" style="display: none;">
								<span class="text-success">Profile details updated.</span>
							</div>
						</div>
					</div>
				</div> {{-- container-fluid --}}
			</div> {{-- panel-body --}}
		</div> {{-- panel --}}
	</div>
</div>
@stop
