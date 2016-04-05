<div class="col-md-12 refine-search-sidebar">
	<form id="talent-filter-form">
	<div class="panel panel-talents-search">
		<div class="panel-heading border-bottom-width-zero">
			<span class="panel-title talents-refine-title">Refine Search</span>
		</div>

		<div class="panel-body form-horizontal">
			<div class="row-fluid clearfix">
				<label class="control-label pull-left"><a href="">United States</a> <span class="padding-left-small">or</span></label>
				<div class="col-md-3">
					<input class="form-control" placeholder="Select Market or Zip Code">
				</div>
				<div class="col-md-2">
					<select class="form-control">
						<option>25 miles</option>
					</select>
				</div>
				<div class="col-md-2">
					<a href="" class="btn btn-primary btn-block">Search</a>
				</div>
			</div>

			<div class="row">
				<div class="margin-top-small margin-bottom-small">
					<label class="checkbox-inline display-none"></label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">Albany, NY</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">Buffalo, NY</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">New York City, NY</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">Dallas, TX</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">El Paso, TX</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">Houston, TX</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">San ANtonio, NY</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">Albany, NY</span>
					</label>
					<label class="checkbox-inline margin-right-small">
						<input type="checkbox" name="market-checks" class="px check-markets"> <span class="lbl">Buffalo, NY</span>
					</label>
				</div>
			</div>
			
			<hr class="panel-wide margin-top-small-normal margin-bottom-small-normal">
			<div class="row margin-bottom-large">
				<div class="col-md-3">
					<label class="text-bold margin-bottom-zero">Age Range: <span id="age-min-text" data-bind="<%= age_min || 0 %>" class="text-normal">0</span> - <span id="age-max-text" data-bind="<%= age_max || 100 %>" class="text-normal">100</span></label>
					<div class="padding-right-small">
					<div class="padding-small">
						<div data-range="true" data-values="[0, 100]" data-min="0" data-max="100" data-bind="[<%= age_min || 0 %>, <%= age_max || 100 %>]" data-type="age" data-slider></div>
						<input type="hidden" name="age_min" data-bind="<%= age_min %>" />
						<input type="hidden" name="age_max" data-bind="<%= age_max %>" />
					</div>
					</div>	
				</div>
				<div class="col-md-3">
					<select class="form-control margin-top-normal">
						<option>Gender - Both</option>
						<option>Male</option>
						<option>Female</option>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control margin-top-normal">
						<option>Picture - All</option>
						<option>No Picture</option>
						<option>With Picture</option>
					</select>
				</div>
				<div class="col-md-3">
					<input class="form-control margin-top-normal" placeholder="Keyword..."></input>
				</div>
			</div>

			<div class="row margin-bottom-large">
				<div class="col-md-3">
					<label class="text-bold margin-bottom-zero">Height Range: <span id="height-min-text" class="text-normal" data-bind="<%= height_min ||'< 2\'0&quot;' %>">< 2'0"</span> -
						<span id="height-max-text" class="text-normal" data-bind="<%= height_max || '8\'0&quot;' %>">8'0"</span>
					</label>
					<div class="padding-right-small">
					<div class="padding-small">
						<div class="ui-slider-range-height" data-slider data-range="true" data-min="22" data-max="96" data-values="[22,96]" data-type="height" data-bind="[<%= height_min ? height_min : 22 %>, <%= height_max ? height_max : 96 %>]"></div>
						<input type="hidden" name="height_min" data-bind="<%= height_min %>" />
						<input type="hidden" name="height_max" data-bind="<%= height_max %>" />
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<select class="form-control margin-top-normal">
						<option>Body Type - All</option>
						<option></option>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control margin-top-normal">
						<option>Ethnicty - All</option>
						<option>Caucasian</option>
						<option>Hispanic</option>
						<option>African American</option>
						<option>Asian</option>
						<option>Middle Eastern</option>
						<option>American Indian</option>
						<option>African</option>
						<option>East Indian</option>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control margin-top-normal">
						<option>Last Active - 1 month</option>
						<option>Last Active - 3 months</option>
						<option>Last Active - 6 months</option>
						<option>Last Active - 1 year</option>
					</select>
				</div>
			</div>
			

			<!-- old refine search -->
			<div hidden>
				<div class="row">
					<div class="col-md-3">
						<div class="padding-small">
						<label class="checkbox-inline" title="Mark as nationwide casting">
							<input class="px" type="checkbox" name="nationwide-market-checkbox" id="nationwide-market-checkbox" value="0">
							<span class="lbl">Any Market / Nationwide</span>
						</label>
						</div>
					</div>

					<div class="col-md-5">
						<div class="tab-pane fade active in">
							<select id="jquery-select2-example" class="form-control">
									<option></option>
									<option value="Albany, NY">Albany, NY</option>
									<option value="Albuquerque, NM">Albuquerque, NM</option>
									<option value="Atlanta, GA">Atlanta, GA</option>
									<option value="Augusta, ME">Augusta, ME</option>
									<option value="Baltimore, MD">Baltimore, MD</option>
									<option value="Billings, MT">Billings, MT</option>
									<option value="Birmingham, AL">Birmingham, AL</option>
									<option value="Boise, ID">Boise, ID</option>
									<option value="Boston, MA">Boston, MA</option>
									<option value="Buffalo, NY">Buffalo, NY</option>
									<option value="Charleston, SC">Charleston, SC</option>
									<option value="Charleston, WV">Charleston, WV</option>
									<option value="Charlotte, NC">Charlotte, NC</option>
									<option value="Chicago, IL">Chicago, IL</option>
									<option value="Cleveland, OH">Cleveland, OH</option>
									<option value="Columbia, SC">Columbia, SC</option>
									<option value="Columbus, OH">Columbus, OH</option>
									<option value="Dallas, TX">Dallas, TX</option>
									<option value="Denver, CO">Denver, CO</option>
									<option value="Des Moines, IA">Des Moines, IA</option>
									<option value="Detroit, MI">Detroit, MI</option>
									<option value="El Paso, TX">El Paso, TX</option>
									<option value="Fargo, ND">Fargo, ND</option>
									<option value="Grand Junct, CO">Grand Junct, CO</option>
									<option value="Harford, CT">Harford, CT</option>
									<option value="Honolulu, HI">Honolulu, HI</option>
									<option value="Houston, TX">Houston, TX</option>
									<option value="Indianapolis, IN">Indianapolis, IN</option>
									<option value="Jackson, MS">Jackson, MS</option>
									<option value="Jacksonville, FL">Jacksonville, FL</option>
									<option value="Kansas City, KS">Kansas City, KS</option>
									<option value="Kansas City, MO">Kansas City, MO</option>
									<option value="Las Vegas, NV">Las Vegas, NV</option>
									<option value="Little Rock, AR">Little Rock, AR</option>
									<option value="Los Angeles, CA">Los Angeles, CA</option>
									<option value="Louisville, KY">Louisville, KY</option>
									<option value="Memphis, TN">Memphis, TN</option>
									<option value="Miami, FL">Miami, FL</option>
									<option value="Milwaukee, WI">Milwaukee, WI</option>
									<option value="Minneapolis, MN">Minneapolis, MN</option>
									<option value="Nashville, TN">Nashville, TN</option>
									<option value="New Orleans, LA">New Orleans, LA</option>
									<option value="New York City, NY">New York City, NY</option>
									<option value="Norfolk, VA">Norfolk, VA</option>
									<option value="Oklahoma City, OK">Oklahoma City, OK</option>
									<option value="Omaha, NE">Omaha, NE</option>
									<option value="Orlando, FL">Orlando, FL</option>
									<option value="Philadelphia, PA">Philadelphia, PA</option>
									<option value="Phoenix, AZ">Phoenix, AZ</option>
									<option value="Pittsburgh, PA">Pittsburgh, PA</option>
									<option value="Portland, ME">Portland, ME</option>
									<option value="Portland, OR">Portland, OR</option>
									<option value="Raleigh, NC">Raleigh, NC</option>
									<option value="Rapid City, SD">Rapid City, SD</option>
									<option value="Reno, NV">Reno, NV</option>
									<option value="St Louis, MO">St Louis, MO</option>
									<option value="Salt Lake City, UT">Salt Lake City, UT</option>
									<option value="San Antonio, TX">San Antonio, TX</option>
									<option value="San Diego, CA">San Diego, CA</option>
									<option value="San Francisco, CA">San Francisco, CA</option>
									<option value="Seattle, WA">Seattle, WA</option>
									<option value="Tampa, FL">Tampa, FL</option>
									<option value="Washington, DC">Washington, DC</option>
									<option value="Wichita, KS">Wichita, KS</option>
									<option value="All Markets">All Markets</option>
									<option value="Calgary-Edm, AB">Calgary-Edm, AB</option>
									<option value="Ottawa, ON">Ottawa, ON</option>
									<option value="Montreal, QC">Montreal, QC</option>
									<option value="Toronto, ON">Toronto, ON</option>
									<option value="Vancouver, BC">Vancouver, BC</option>
							</select>
						</div>				
					</div> <!-- search market -->

					<div class="col-md-4">
						<div class="panel panel-transparent margin-bottom-zero input-group">
							<input type="text" class="form-control" id="search-talent-input" placeholder="Search Talent Manually">
							<span id="search-talent-btn" class="input-group-addon" style="cursor: pointer;">
					            <span class="glyphicon glyphicon-search"></span>
					        </span>
						</div>					
					</div> <!-- search talent manually -->
				</div>

				<div class="row">
					<div class="margin-top-small margin-bottom-small" id="markets_checks">
						<label class="checkbox-inline margin-right-small" data-bind-template="#markets_checks" data-bind-value="market_checks" data-bind="<%= name.replace(/\s/g, '').replace(/,/g, '') %>" data-bind-target="id">
							<input type="checkbox" name="market-checks" class="px check-markets" data-bind="<%= (check == 'check') ? 1 : 0  %>"> <span class="lbl" data-bind="<%= name %>"></span>
						</label>
					</div>
				</div> <!-- markets list -->				
				
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-transparent margin-bottom-zero margin-top-small">

							<div class="row">
								<div class="panel panel-transparent margin-bottom-small col-md-12">
									<div class="no-padding-hr padding-bottom-zero-small padding-top-zero">
										<div class="panel-title text-uppercase"><strong class="text-muted"><i class="fa fa-user"></i> Appearance</strong></div>
									</div>

									<div class="padding-small padding-top-zero">
									
										<div class="padding-zero padding-vr-sm no-border-hr col-md-3">
											<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
												<div class="tab-pane fade active in">
													<label class="text-bold margin-bottom-zero">Age Range: <span id="age-min-text" data-bind="<%= age_min || 0 %>" class="text-normal">0</span> - <span id="age-max-text" data-bind="<%= age_max || 100 %>" class="text-normal">100</span></label>
													<div class="padding-right-small">
													<div class="padding-small">
														<div data-range="true" data-values="[0, 100]" data-min="0" data-max="100" data-bind="[<%= age_min || 0 %>, <%= age_max || 100 %>]" data-type="age" data-slider></div>
														<input type="hidden" name="age_min" data-bind="<%= age_min %>" />
														<input type="hidden" name="age_max" data-bind="<%= age_max %>" />
													</div>
													</div>
												</div>
											</div>
										</div> <!-- ./panel-body age range-->

										<div class="padding-zero padding-vr-sm no-border-hr col-md-3">
											<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
												<div class="tab-pane fade active in">
													<label class="text-bold margin-bottom-zero">Height Range: <span id="height-min-text" class="text-normal" data-bind="<%= height_min ||'< 2\'0&quot;' %>">< 2'0"</span> -
														<span id="height-max-text" class="text-normal" data-bind="<%= height_max || '8\'0&quot;' %>">8'0"</span>
													</label>
													<div class="padding-right-small">
													<div class="padding-small">
														<div class="ui-slider-range-height" data-slider data-range="true" data-min="22" data-max="96" data-values="[22,96]" data-type="height" data-bind="[<%= height_min ? height_min : 22 %>, <%= height_max ? height_max : 96 %>]"></div>
														<input type="hidden" name="height_min" data-bind="<%= height_min %>" />
														<input type="hidden" name="height_max" data-bind="<%= height_max %>" />
													</div>
													</div>
												</div>
											</div>
										</div> <!-- ./panel-body height-->

										<div class="panel-body padding-small no-border-hr no-padding-hr col-md-3">
											<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
												<div class="tab-pane fade active in">
													<div class="col-md-12">
														<label class="text-bold margin-bottom-zero">Gender: </label>
														<label class="checkbox-inline">
															<input type="checkbox" name="sex" value="Male" class="px" data-bind="<%= sex == 'Male' %>"> <span class="lbl">Male</span>
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="sex" value="Female" class="px" data-bind="<%= sex == 'Female' %>"> <span class="lbl">Female</span>
														</label>
													</div>
												</div>
											</div>
										</div> <!-- ./panel-body gender-->

										<div class="panel-body padding-small no-border-hr no-padding-hr col-md-3">
											<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
												<div class="tab-pane fade active in">
													<label class="text-bold margin-bottom-zero">Picture: </label>
													<label class="checkbox-inline">
														<input type="checkbox" name="has_photo" value="1" class="px" data-bind="<%= has_photo === 1 %>" data-class="switcher-success" /> <span class="lbl">Has Photo</span>
													</label>
													<label class="checkbox-inline">
														<input type="checkbox" name="has_photo" value="0" class="px" data-bind="<%= has_photo === 0 %>" data-class="switcher-success" /> <span class="lbl">No Photo</span>
													</label>
												</div>
											</div>
										</div> <!-- ./panel-body picture-->

										<div class="panel-body padding-small no-border-hr no-padding-hr padding-bottom-zero col-md-12">
											<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
												<div class="tab-pane fade active in">
													<label class="text-bold margin-bottom-zero">Body Type:</label>
													<div class="row">
														<div class="col-md-12 body-type-checkbox">
															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Average" class="px" data-bind="<%= build == 'Average' || build.indexOf('Average') > -1 %>"> <span class="lbl">Average</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Athletic" class="px" data-bind="<%= build == 'Athletic' || build.indexOf('Athletic') > -1 %>"> <span class="lbl">Athletic</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Muscular" class="px" data-bind="<%= build == 'Muscular' || build.indexOf('Muscular') > -1 %>"> <span class="lbl">Muscular</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Extra Large" class="px" data-bind="<%= build == 'Extra Large' || build.indexOf('Extra Large') > -1 %>"> <span class="lbl">Extra-Large</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Large" class="px" data-bind="<%= build == 'Large' || build.indexOf('Large') > -1 %>"> <span class="lbl">Large</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Lean Muscle" class="px" data-bind="<%= build == 'Lean Muscle' || build.indexOf('Lean Muscle') > -1 %>"> <span class="lbl">Lean-Muscle</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Medium" class="px" data-bind="<%= build == 'Medium' || build.indexOf('Medium') > -1 %>"> <span class="lbl">Medium</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Petite" class="px" data-bind="<%= build == 'Petite' || build.indexOf('Petite') > -1 %>"> <span class="lbl">Petite</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="build" value="Slim" class="px" data-bind="<%= build == 'Slim' || build.indexOf('Slim') > -1 %>"> <span class="lbl">Slim</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div> <!-- ./panel-body body type-->

										<div class="panel-body padding-small no-border-hr no-padding-hr padding-bottom-zero col-md-12">
											<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
												<div class="tab-pane fade active in">
													<label class="text-bold margin-bottom-zero">Ethnic Appearance:</label>
													<div class="row">
														<div class="col-md-12 ethnnicity-checkbox">
															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="African" class="px" data-bind="<%= ethnicity == 'African' || ethnicity.indexOf('African') > -1 %>"> <span class="lbl">African</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="African American" class="px" data-bind="<%= ethnicity == 'African American' || ethnicity.indexOf('African American') > -1 %>"> <span class="lbl">African American</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="American Indian" class="px" data-bind="<%= ethnicity == 'American Indian' || ethnicity.indexOf('American Indian') > -1 %>"> <span class="lbl">American Indian</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="Asian" class="px" data-bind="<%= ethnicity == 'Asian' || ethnicity.indexOf('Asian') > -1 %>"> <span class="lbl">Asian</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="Caucasian" class="px" data-bind="<%= ethnicity == 'Caucasian' || ethnicity.indexOf('Caucasian') > -1 %>"> <span class="lbl">Caucasian</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="Eastern Indian" class="px" data-bind="<%= ethnicity == 'Eastern Indian' || ethnicity.indexOf('Eastern Indian') > -1 %>"> <span class="lbl">East Indian</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="Hispanic" class="px" data-bind="<%= ethnicity == 'Hispanic' || ethnicity.indexOf('Hispanic') > -1 %>"> <span class="lbl">Hispanic</span>
															</label>

															<label class="checkbox-inline">
																<input type="checkbox" name="ethnicity" value="Middle Eastern" class="px" data-bind="<%= ethnicity == 'Middle Eastern' || ethnicity.indexOf('Middle Eastern') > -1 %>"> <span class="lbl">Middle Eastern</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div> <!-- ./panel-body ethnic appearance-->

									</div>

								</div>
							</div>{{-- panel appearance --}}

							<div class="row">
								<div class="panel margin-zero panel-transparent col-md-12">
									<div class="no-padding-hr padding-bottom-zero-small padding-top-zero">
										<div class="panel-title text-uppercase"><strong class="text-muted"><i class="fa fa-star"></i> Membership</strong></div>
									</div>
									<div class="padding-small padding-top-zero">
										<div class="no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<div class="row">
													<div class="col-md-12 member-checkbox">
														<label class="checkbox-inline">
															<input type="checkbox" name="join_status" value="5" data-bind="<%= join_status === 5 %>" class="px"> <span class="lbl">Pro Member</span>
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="join_status" value="0" data-bind="<%= join_status === 0 %>" class="px"> <span class="lbl">Amateur Member</span>
														</label>
													</div>
												</div>
											</div>
										</div>
										</div> <!-- ./panel-body gender-->
									</div>
								</div> {{-- panel appearance --}}					
							</div> <!-- membership -->

							<div class="row-fluid clearfix">
								<div class="col-md-12 padding-zero">
									<button id="talent-filter-button" type="button" class="btn btn-success btn-block">Search</button>
								</div>
							</div> <!-- search btn -->

						</div> 					
					</div> <!-- appearance and membership -->
				</div>	
			</div>

	</form>
</div> {{-- refine-search-sidebar --}}
