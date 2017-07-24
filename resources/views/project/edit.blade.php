@extends('layouts.sidebar', ['pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Edit Project', 'url' => '/projects/'.$projectId.'/edit', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-file-text"></i> Edit Project
@stop

@section('sidebar.body')
<div class="edit-project-wrapper">
	<div class="projects-content">
		<div class="panel">
			<div class="panel-body">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Project Name <span class="text-success">*</span></label>
								<input type="text" class="form-control" id="project-name" placeholder="Enter Project Name" data-bind="<%= project %>" maxlength="40">
								<div class="alert alert-page alert-danger project-name-error-five" style="display:none;">This field must be at least 5 characters.</div>
								<div class="alert alert-page alert-danger project-name-error-required" style="display:none;">This field is required.</div>
							</div>

                            <div class="form-group">
                                <label class="control-label">Submission Deadline <span class="text-success">*</span></label>
                                <div class="input-group date">
                                    <input type="text" id="bs-datepicker-submissiondeadline" class="form-control calendar-input" style="cursor: pointer; background-color: #fff" data-bind="<%= asap ? moment(asap * 1000).format('YYYY-MM-DD') : 'N/A' %>">

                                    <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="alert alert-page alert-danger submission-deadline-error-required" style="display:none;">This field is required.</div>
                            </div>

                            <div class="form-group col-md-6 padding-left-zero-md-lg">
                                <label class="control-label">Audition Date</label>
                                <div class="input-group date">
                                    <input type="text" id="bs-datepicker-audition" class="form-control calendar-input" style="cursor: pointer; background-color: #fff" data-bind="<%= aud_timestamp ? moment(aud_timestamp * 1000).format('YYYY-MM-DD') : 'N/A' %>">
                                    <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="alert alert-page alert-danger audition-date-error-invalid" style="display:none;">Audition date should be after or on the same day as submission deadline.</div>
                            </div>

                            <div class="form-group col-md-6 padding-right-zero-md-lg">
                                <label class="control-label">Shoot Date</label>
                                <div class="input-group date">
                                    <input type="text" id="bs-datepicker-shootdate" class="form-control calendar-input" style="cursor: pointer; background-color: #fff" data-bind="<%= shoot_timestamp ? moment(shoot_timestamp * 1000).format('YYYY-MM-DD') : 'N/A' %>">
                                    <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="alert alert-page alert-danger shoot-date-error-invalid" style="display:none;">Shoot date should be after audition date.</div>
                            </div>

                        </div> {{-- col-md-6 --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Category <span class="text-success">*</span></label>
                                <select class="form-control" id="project-category" name="cat" data-bind="<%= cat %>">
                                    <optgroup label="Acting">
                                        <option value="1" selected="">Commercials</option>
                                        <option value="9">Feature Film - SAG</option>
                                        <option value="14">Feature Film - Independent</option>
                                        <option value="11">Student Films</option>
                                        <option value="12">Short Film</option>
                                        <option value="13">Documentaries</option>
                                        <option value="59">Reality TV</option>
                                        <option value="22">Theatre - Equity (Union)</option>
                                        <option value="23">Theatre - Non-Equity</option>
                                        <option value="26">Voice-Over</option>
                                        <option value="27">Internet</option>
                                        <option value="17">Industrial/Training Films</option>
                                        <option value="43">Acrobatics/Stunts</option>
                                        <option value="41">Comedy/Clown</option>
                                    {{--    <option value="61">Other</option>
                                        <option value="42">Variety Acts</option> --}}
                                    </optgroup>
                                    <optgroup label="Modeling">
                                        <option value="18">Runway</option>
                                        <option value="19">Hair/Cosmetics</option>
                                        <option value="20">Print</option>
                                        <option value="24">Trade Shows/Live Events/Promo Model</option>
                                    </optgroup>
                                    <optgroup label="Dance">
                                        <option value="3">Ballet/Classic</option>
                                        <option value="56">Choreography</option>
                                        <option value="54">Club/Gogo</option>
                                        <option value="53">HipHop</option>
                                        <option value="4">Modern/Jazz</option>
                                        <option value="58">Other/General</option>
                                        <option value="57">Teacher</option>
                                        <option value="55">Traditional/Latin</option>
                                    </optgroup>
                                    <optgroup label="Music">
                                        <option value="21">Music Videos</option>
                                        <option value="44">Band</option>
                                        <option value="45">DJ/Sound</option>
                                        <option value="30">Horns</option>
                                        <option value="32">Drums</option>
                                        <option value="31">Keyboards</option>
                                        <option value="33">Other</option>
                                        <option value="29">Strings</option>
                                        <option value="46">Teacher</option>
                                        <option value="28">Vocals</option>
                                    </optgroup>
                                    <optgroup label="Crew">
                                        <option value="16">Assistant &amp; Entry Level</option>
                                        <option value="49">Accounting/Payroll/HR</option>
                                        <option value="35">Camera/Editor</option>
                                        <option value="48">Graphic/Web/Animate</option>
                                        <option value="34">Lighting/Sound</option>
                                        <option value="37">Make Up/Stylist</option>
                                        <option value="51">Management</option>
                                        <option value="25">Marketing / PR</option>
                                        <option value="38">Other</option>
                                        <option value="36">Producer/Director</option>
                                        <option value="40">Showbiz Internship</option>
                                        {{-- <option value="52">Crew - Talent/Casting Mgmt</option> --}}
                                        <option value="50">Technology/MIS</option>
                                        <option value="47">TV/Radio</option>
                                        <option value="39">Writing/Script/Edit</option>
                                    </optgroup>
                                    {{-- <option value="5">Episodic TV - Pilots</option>
                                    <option value="6">Episodic TV - SAG</option>
                                    <option value="7">Episodic TV - AFTRA</option>
                                    <option value="8">Episodic TV - Non-Union</option>
                                    <option value="60">Extras</option>
                                    <option value="10">Feature Film - Non-SAG</option>
                                    <option value="15">Infomercials</option> --}}
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group margin-bottom-medium">
                                    <label class="control-label">Submission Type<span class="text-success">*</span></label>
                                    <label class="radio checkbox-inline">
                                        <input type="radio" name="radioSubmissionType" id="self-submission-option" value="1" class="px">
                                        <span class="lbl">Self Submission</span>
                                    </label>
                                    <label class="radio checkbox-inline">
                                        <input type="radio" name="radioSubmissionType" id="open-call-option" value="2" class="px">
                                        <span class="lbl">Open Call</span>
                                    </label>
                                </div>
                                <div class=""><strong><span class="control-label" id="project-type-title" data-bind="<%= (snr == '2') ? 'Open Call Details:' : 'Self Submission Details:' %>"></span></strong></div>
                                <div class="panel display-none" id="self-submissions-option-content">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="control-label"><i class="fa fa-envelope"></i> Please enter email address for talent submissions</label>
                                            <input type="text" id="self-sub-email" class="form-control" placeholder="Enter Email Address" data-bind="<%= (snr_email) ? snr_email : '' %>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">and / or postal address</label>
                                            <textarea id="self-sub-address" class="form-control" rows="5" placeholder="Address" style="resize: none;" data-bind="<%= (srn_address) ? srn_address : '' %>"></textarea>
                                            <div class="alert alert-page alert-danger self-sub-error-required" style="display:none;">This field is required.</div>
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
                                                    <input type="checkbox" id="appointment-only-checkbox" class="px" name="by_app_only" data-bind="<%= by_app_only %>"> <span class="lbl">If Appointment only, check</span>
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">General Audition Info / Storyline / Synopsis / Logline <span class="text-success">*</span></label>
                                <textarea id="audition-description" class="form-control" rows="4" cols="50" placeholder="Message" style="resize:vertical; box-sizzing: border-box;" data-bind="<%= des %>"></textarea>
                                <div class="alert alert-page alert-danger audition-description-error-required" style="display:none;">This field is required.</div>
                            </div>
                        </div>
                    </div>

                    {{-- upload image for casting --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input id="photo-uploader" type="file" name="file" accept="image/*" class="hide"/>
                                <label class="control-label">Upload Casting Image<span class="text-success">*</span></label>
                                <div class="casting-upload-image " id="main-casting-image-div">
                                    <div class="img-width">
                                        <div class="img-holder" id="image-holder">
                                            <div class="img-preview-container">
                                                <img src="blank" id="preview" >
                                                <div class="default">
                                                    <div class="item text-align-center">
                                                        <div><i class="fa fa-picture-o fa-5x"></i></div>
                                                        <div>Click here to Upload Casting Image</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="change-image-btn" id="remove-button">
                                            <button class="btn btn-default btn-lg btn-block border-radius-zero">
                                                <i class="fa fa-times"></i> Remove Casting Image
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                            <div class="col-md-6 padding-top-normal">
                                <div class="form-group margin-bottom-small">
                                    <label class="control-label">What area would you like to accept talents from? <span class="text-success">*</span></label>
                                <label class="checkbox-inline margin-left-normal" title="Mark as nationwide casting">
                                    <input class="px" type="checkbox" name="nationwide-market-checkbox" id="nationwide-market-checkbox" value="0">
                                    <span class="lbl">All of United States</span>
                                </label>
                                <div class="input-group hide-if-nationwide">
                                    <input type="text" id="zip-code" class="form-control" placeholder="Enter Zip Code" data-bind="<%= zip %>">
                                    <span class="input-group-btn">
                                        <button id="find-markets-btn" class="btn" type="button">Auto Select Markets</button>
                                    </span>
                                </div>
                                <div class="input-group auto-markets-div margin-top-normal hide-if-nationwide">
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
                            <div class="col-md-12 input-group margin-top-small hide-if-nationwide">
                                <label for="manual-markets-div" class="padding-left-normal">
                                    or <a href="" id="toggle-manual-markets-div" style="text-decoration: underline;">Manually select markets</a>
                                    <a class="btn btn-default btn-sm hide" href="" id="toggle-all-markets-checked" style="display: none;">Select All Markets</a>
                                </label>
                            </div>
                            <div class="manual-markets-div display-none hide-if-nationwide">
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_albany_ny"> <span class="lbl">Albany, NY</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_albuquerque_nm"> <span class="lbl">Albuquerque, NM</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_atlanta_ga"> <span class="lbl">Atlanta, GA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_augusta_me"> <span class="lbl">Augusta, ME</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_baltimore_md"> <span class="lbl">Baltimore, MD</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_billings_mt"> <span class="lbl">Billings, MT</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_birmingham_al"> <span class="lbl">Birmingham, AL</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_boise_id"> <span class="lbl">Boise, ID</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_boston_ma"> <span class="lbl">Boston, MA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_buffalo_ny"> <span class="lbl">Buffalo, NY</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_charleston_sc"> <span class="lbl">Charleston, SC</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_charleston_wv"> <span class="lbl">Charleston, WV</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_charlotte_nc"> <span class="lbl">Charlotte, NC</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_chicago_il"> <span class="lbl">Chicago, IL</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_cleveland_oh"> <span class="lbl">Cleveland, OH</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_columbia_sc"> <span class="lbl">Columbia, SC</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_columbus_oh"> <span class="lbl">Columbus, OH</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_dallas_tx"> <span class="lbl">Dallas, TX</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_denver_co"> <span class="lbl">Denver, CO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_des_moines_ia"> <span class="lbl">Des Moines, IA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_detroit_mi"> <span class="lbl">Detroit, MI</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_el_paso_tx"> <span class="lbl">El Paso, TX</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_fargo_nd"> <span class="lbl">Fargo, ND</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_grand_junct_co"> <span class="lbl">Grand Junct, CO</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_hartford_ct"> <span class="lbl">Hartford, CT</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_honolulu_hi"> <span class="lbl">Honolulu, HI</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_houston_tx"> <span class="lbl">Houston, TX</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_indianapolis_in"> <span class="lbl">Indianapolis, IN</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_jackson_ms"> <span class="lbl">Jackson, MS</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_jacksonville_fl"> <span class="lbl">Jacksonville, FL</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_kansas_city_ks"> <span class="lbl">Kansas City, KS</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_kansas_city_mo"> <span class="lbl">Kansas City, MO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_las_vegas_nv"> <span class="lbl">Las Vegas, NV</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_little_rock_ar"> <span class="lbl">Little Rock, AR</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_los_angeles_ca"> <span class="lbl">Los Angeles, CA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_louisville_ky"> <span class="lbl">Louisville, KY</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_memphis_tn"> <span class="lbl">Memphis, TN</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_miami_fl"> <span class="lbl">Miami, FL</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_milwaukee_wi"> <span class="lbl">Milwaukee, WI</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_minneapolis_mn"> <span class="lbl">Minneapolis, MN</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_nashville_tn"> <span class="lbl">Nashville, TN</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_new_orleans_la"> <span class="lbl">New Orleans, LA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_new_york_city_ny"> <span class="lbl">New York City, NY</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_norfolk_va"> <span class="lbl">Norfolk, VA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_oklahoma_city_ok"> <span class="lbl">Oklahoma City, OK</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_omaha_ne"> <span class="lbl">Omaha, NE</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_orlando_fl"> <span class="lbl">Orlando, FL</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_philadelphia_pa"> <span class="lbl">Philadelphia, PA</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_phoenix_az"> <span class="lbl">Phoenix, AZ</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_pittsburgh_pa"> <span class="lbl">Pittsburgh, PA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_portland_me"> <span class="lbl">Portland, ME</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_portland_or"> <span class="lbl">Portland, OR</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_raleigh_nc"> <span class="lbl">Raleigh, NC</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_rapid_city_sd"> <span class="lbl">Rapid City, SD</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_reno_nv"> <span class="lbl">Reno, NV</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_saint_louis_mo"> <span class="lbl">Saint Louis, MO</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_salt_lake_city_ut"> <span class="lbl">Salt Lake City, UT</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_san_antonio_tx"> <span class="lbl">San Antonio, TX</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_san_diego_ca"> <span class="lbl">San Diego, CA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_san_francisco_ca"> <span class="lbl">San Francisco, CA</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_seattle_wa"> <span class="lbl">Seattle, WA</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_tampa_fl"> <span class="lbl">Tampa, FL</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_washington_dc"> <span class="lbl">Washington, DC</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_wichita_ks"> <span class="lbl">Wichita, KS</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_all_markets"> <span class="lbl">All Markets</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_calgary_edm_ab"> <span class="lbl">Calgary-Edm, AB</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_ottawa_on"> <span class="lbl">Ottawa, ON</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_montreal_qc"> <span class="lbl">Montreal, QC</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_toronto_on"> <span class="lbl">Toronto, ON</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="manual-market-checkbox" id="market_vancouver_bc"> <span class="lbl">Vancouver, BC</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                      <div class="modal fade" id="confirmUpdateModal" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Confirm Update</h4>
                            </div>
                            <div class="modal-body">
                              <p>Pending review, normally reviewed within 6-12 business hours.</p>
                            </div>
                            <div class="modal-footer">
                              <button href="#" id="update-project-btn" class="btn btn-success" data-dismiss="modal">Continue Update</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                          </div>

                        </div>
                      </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a href="#" data-toggle="modal" data-target="#confirmUpdateModal" class="btn btn-success btn-lg">Update</a>
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
