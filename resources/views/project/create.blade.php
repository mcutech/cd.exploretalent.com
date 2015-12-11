@extends('layouts.project', ['pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Create Project', 'url' => '/projects/create', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-file-text"></i> Create New Project
@stop

@section('project.body')
<div class="create-wrapper">
	<div class="projects-content">
		<div class="panel">
			<div class="panel-body">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Project Name <span class="text-success">*</span></label>
								<input type="text" class="form-control" id="project-name" placeholder="Enter Project Name">
								<div class="alert alert-page alert-danger project-name-error-five" style="display:none;">This field must be at least 5 characters.</div>
								<div class="alert alert-page alert-danger project-name-error-required" style="display:none;">This field is required.</div>
							</div>

							<div class="form-group">
								<label class="control-label">Submission Deadline <span class="text-success">*</span></label>
								<div class="input-group date">
									<input type="text" id="bs-datepicker-submissiondeadline" class="form-control" style="cursor: pointer; background-color: #fff"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
								<div class="alert alert-page alert-danger submission-deadline-error-required" style="display:none;">This field is required.</div>
							</div>

							<div class="form-group col-md-6 padding-left-zero-md-lg">
								<label class="control-label">Audition Date</label>
								<div class="input-group date">
									<input type="text" id="bs-datepicker-audition" class="form-control" style="cursor: pointer; background-color: #fff"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
								<div class="alert alert-page alert-danger audition-date-error-invalid" style="display:none;">Audition date should be after or on the same day as submission deadline.</div>
							</div>

							<div class="form-group col-md-6 padding-right-zero-md-lg">
								<label class="control-label">Shoot Date</label>
								<div class="input-group date">
									<input type="text" id="bs-datepicker-shootdate" class="form-control" style="cursor: pointer; background-color: #fff"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
								<div class="alert alert-page alert-danger shoot-date-error-invalid" style="display:none;">Shoot date should be after audition date.</div>
							</div>

						</div> {{-- col-md-6 --}}
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Category <span class="text-success">*</span></label>
								<select class="form-control" id="project-category" name="cat">
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
										<input type="text" id="project-rate" class="form-control">
										<span class="padding-left-small padding-right-small">per</span>
										<select name="" id="project-rate-desc" class="form-control">
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
										<input type="radio" name="radioUnion" value="0" class="px" checked="">
										<span class="lbl">No</span>
									</label>
									<label class="radio checkbox-inline">
										<input type="radio" name="radioUnion" value="1" class="px">
										<span class="lbl">Yes</span>
									</label>
								</div>
							</div>

						</div> {{-- col-md-6 --}}
					</div> {{-- row-fluid --}}

					<div class="row-fluid">
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Submission Type<span class="text-success">*</span></label>
								<label class="radio checkbox-inline">
									<input type="radio" name="radioSubmissionType" id="self-submission-option" value="3" class="px">
									<span class="lbl">Self Submission</span>
								</label>
								<label class="radio checkbox-inline">
									<input type="radio" name="radioSubmissionType" id="open-call-option" value="8" class="px">
									<span class="lbl">Open Call</span>
								</label>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<div class="panel" id="self-submissions-option-content">
									<div class="panel-body">
										<div class="form-group">
											<label class="control-label">Email Address</label>
											<input type="text" id="self-sub-email" class="form-control" placeholder="Enter Email Address" data-bind="<%= email %>">
										</div>
										<div class="form-group">
											<label class="control-label">and / or postal address</label>
											<textarea id="self-sub-address" class="form-control" rows="5" placeholder="Address" style="resize: none;"></textarea>
											<div class="alert alert-page alert-danger self-sub-error-required" style="display:none;">This field is required.</div>
										</div>
									</div>
								</div> {{-- self-submission-option-content --}}

								<div class="panel" id="open-call-option-content">
									<div class="panel-body">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Date and Time of Open Call <span class="text-success">*</span></label>
												<div class="input-group date">
													<input type="text" id="bs-datepicker-open-call" class="form-control" readonly="true" title="Date" style="cursor: pointer; background-color: #fff" placeholder="Date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
												<div class="alert alert-page alert-danger open-call-date-error-required" style="display:none;">This field is required.</div>
												<div class="input-group date margin-top-small">
													<input type="text" id="bs-timepicker-open-call-from" class="form-control" readonly="true" title="Time" style="cursor: pointer; background-color: #fff" placeholder="From"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
												</div>
												<div class="input-group date margin-top-small">
													<input type="text" id="bs-timepicker-open-call-to" class="form-control" readonly="true" title="Time" style="cursor: pointer; background-color: #fff" placeholder="To"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
												</div>
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
												<textarea id="open-call-location" class="form-control" rows="5" placeholder="Address & Telephone" style="resize: none;"></textarea>
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
									<input type="text" id="zip-code" class="form-control" placeholder="Enter Zip Code">
									<span class="input-group-btn">
										<button id="find-markets-btn" class="btn" type="button">Auto Select Markets</button>
									</span>
								</div>
								<div class="input-group auto-markets-div margin-top-normal">
									<div class="hide" data-bind-template=".auto-markets-div" data-bind-value="data">
										<label>
											<input type="checkbox" name="market-checkbox" checked="">
											<span class="lbl" data-bind="<%= city + ', ' +  state %>"></span>
										</label>
									</div>
								</div>
								<div class="alert alert-page alert-danger zipcode-error-required" style="display:none;">This field is required.</div>
								<div class="alert alert-page alert-danger zipcode-error-invalid" style="display:none;">Please enter a valid zip code.</div>
								<div class="alert alert-page alert-danger markets-error-required" style="display:none;">Please choose at least one market.</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">General Audition Info / Storyline / Synopsis / Logline <span class="text-success">*</span></label>
								<textarea id="audition-description" class="form-control" rows="5" placeholder="Message" style="resize: none;"></textarea>
								<div class="alert alert-page alert-danger audition-description-error-required" style="display:none;">This field is required.</div>
							</div>
						</div>
					</div>

					<div class="row-fluid">
						<div class="col-md-12 input-group margin-top-normal">
							<label for="manual-markets-div">
								or <a href="" id="toggle-manual-markets-div" style="text-decoration: underline;">Manually select markets</a>
								<a class="btn btn-default btn-sm" href="" id="toggle-all-markets-checked" style="display: none;">Select All Markets</a>
							</label>
							<div class="manual-markets-div display-none">
								<div class="col-md-2">
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Albany, NY</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Albuquerque, NM</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Atlanta, GA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Augusta, ME</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Baltimore, MD</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Billings, MT</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Birmingham, AL</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Boise, ID</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Boston, MA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Buffalo, NY</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Charleston, SC</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Charleston, WV</span>
									</label>
								</div>
								<div class="col-md-2">
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Charlotte, NC</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Chicago, IL</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Cleveland, OH</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Columbia, SC</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Columbus, OH</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Dallas, TX</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Denver, CO</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Des Moines, IA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Detroit, MI</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">El Paso, TX</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Fargo, ND</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Grand Junct, CO</span>
									</label>
								</div>
								<div class="col-md-2">
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Harford, CT</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Honolulu, HI</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Houston, TX</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Indianapolis, IN</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Jackson, MS</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Jacksonville, FL</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Kansas City, KS</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Kansas City, MO</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Las Vegas, NV</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Little Rock, AR</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Los Angeles, CA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Louisville, KY</span>
									</label>
								</div>
								<div class="col-md-2">
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Memphis, TN</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Miami, FL</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Milwaukee, WI</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Minneapolis, MN</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Nashville, TN</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">New Orleans, LA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">New York City, NY</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Norfolk, VA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Oklahoma City, OK</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Omaha, NE</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Orlando, FL</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Philadelphia, PA</span>
									</label>
								</div>
								<div class="col-md-2">
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Phoenix, AZ</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Pittsburgh, PA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Portland, ME</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Portland, OR</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Raleigh, NC</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Rapid City, SD</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Reno, NV</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">St Louis, MO</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Salt Lake City, UT</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">San Antonio, TX</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">San Diego, CA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">San Fransisco, CA</span>
									</label>
								</div>
								<div class="col-md-2">
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Seattle, WA</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Tampa, FL</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Washington, DC</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Wichita, KS</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">All Markets</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Calgary-Edm, AB</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Ottawa, ON</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Montreal, QC</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Toronto, ON</span>
									</label>
									<label>
										<input type="checkbox" name="manual-market-checkbox"> <span class="lbl">Vancouver, BC</span>
									</label>
								</div>
							</div>	
						</div>
					</div>

					<div class="row-fluid">
						<div class="col-md-12">
							<div class="pull-right">
								<a href="#" id="create-project-btn" class="btn btn-success btn-lg">Save</a>
							</div>
						</div>
					</div>
				</div> {{-- container-fluid --}}
			</div> {{-- panel-body --}}
		</div> {{-- panel --}}
	</div>
</div>
@stop
