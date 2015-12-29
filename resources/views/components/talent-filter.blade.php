<div class="col-md-3 refine-search-sidebar">
	<form id="talent-filter-form">
	<div class="panel panel-talents-search">
		<div class="panel-heading">
			<span class="panel-title talents-refine-title">Refine Search</span>
			<div class="panel-heading-controls">
				<div class="panel-heading-icon"><i class="fa fa-search"></i></div>
			</div>
		</div>
		<div class="panel-body">
			<div class="location">
				<div class="panel panel-transparent margin-bottom-normal">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title text-uppercase"><strong>Location</strong></div>
					</div>
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<label class="text-semibold margin-bottom-zero">Select a Markets</label>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group col-md-12">
											<!-- <input type="text" class="form-control" name="zip" placeholder="Enter Zip Code" id="zip-code" data-bind="<%= zip || '' %>" max="5" maxlength="5">
											<span class="input-group-btn">
												<button class="btn" type="button" id="auto-select-markets">
													<i class="fa fa-caret-right"></i>
												</button>
											</span> -->
											<!-- <select name="select-boxes" class="col-md-12 select2-container">
																					</select> -->										
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
									</div>

								</div>
								<div class="row">
									<div class="col-md-12 margin-top-medium" id="markets_checks">
										<label class="checkbox" data-bind-template="#markets_checks" data-bind-value="market_checks" data-bind="<%= name.replace(/\s/g, '').replace(/,/g, '') %>" data-bind-target="id">
											<input type="checkbox" name="market-checks" class="px check-markets" data-bind="<%= (check == 'check') ? 1 : 0  %>"> <span class="lbl" data-bind="<%= name %>"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body -->
				</div>

				<div class="panel panel-transparent no-margin-b">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title text-uppercase"><strong>Appearance</strong></div>
					</div>
					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<label class="text-bold margin-bottom-zero">Age Range <span id="age-min-text" data-bind="<%= role.age_min %>" class="text-normal">0</span> - <span id="age-max-text" data-bind="<%= role.age_max %>" class="text-normal">100</span></label>
								<div class="row">
									<div class="col-md-12">
										<div data-range="true" data-values="[0, 100]" data-min="0" data-max="100" data-bind="[<%= role.age_min %>, <%= role.age_max %>]" data-type="age" data-slider></div>
										<input type="hidden" name="age_min" data-bind="<%= role.age_min %>" />
										<input type="hidden" name="age_max" data-bind="<%= role.age_max %>" />
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body age range-->

					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<label class="text-bold margin-bottom-zero">Gender</label>
								<div class="row">
									<div class="col-md-12">
										<label class="checkbox-inline">
											<input type="checkbox" name="sex" value="Male" class="px" data-bind="<%= role.getGenders().indexOf('Male') != -1 ? 1 : 0 %>"> <span class="lbl">Male</span>
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="sex" value="Female" class="px" data-bind="<%= role.getGenders().indexOf('Female') != -1 ? 1 : 0 %>"> <span class="lbl">Female</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body gender-->

					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<label class="text-bold margin-bottom-zero">Picture</label>
								<div class="row">
									<div class="col-md-12">
										<label class="checkbox-inline">
											<input type="checkbox" name="has_photo" value="1" class="px" data-class="switcher-success" /> <span class="lbl">Has Photo</span>
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" name="has_photo" value="0" class="px" data-class="switcher-success" /> <span class="lbl">No Photo</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body gender-->

					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<label class="text-bold margin-bottom-zero">Height Range
									<span id="height-min-text" class="text-normal" data-bind="<%= parseInt(role.height_min) ? role.getHeightMinText() : '< 2\'0&quot;' %>">< 2'0"</span> -
									<span id="height-max-text" class="text-normal" data-bind="<%= parseInt(role.height_max) ? role.getHeightMaxText() : '8\'0&quot;' %>">8'0"</span>
								</label>
								<div class="row">
									<div class="col-md-12">
										<div class="ui-slider-range-height" data-slider data-range="true" data-min="22" data-max="96" data-values="[22,96]" data-type="height" data-bind="[<%= parseInt(role.height_min) ? role.height_min : 22 %>, <%= parseInt(role.height_max) ? role.height_max : 96 %>]"></div>
										<input type="hidden" name="height_min" data-bind="<%= role.height_min %>" />
										<input type="hidden" name="height_max" data-bind="<%= role.height_max %>" />
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body height-->

					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<label class="text-bold margin-bottom-zero">Body Type</label>
								<div class="row">
									<div class="col-md-12 body-type-checkbox">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Average" class="px" data-bind="<%= role.getBuilds().indexOf('Average') != -1 ? 1 : 0 %>"> <span class="lbl">Average</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Athletic" class="px" data-bind="<%= role.getBuilds().indexOf('Athletic') != -1 ? 1 : 0 %>"> <span class="lbl">Athletic</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Muscular" class="px" data-bind="<%= role.getBuilds().indexOf('Muscular') != -1 ? 1 : 0 %>"> <span class="lbl">Muscular</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Extra Large" class="px" data-bind="<%= role.getBuilds().indexOf('Extra Large') != -1 ? 1 : 0 %>"> <span class="lbl">Extra-Large</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Large" class="px" data-bind="<%= role.getBuilds().indexOf('Large') != -1 ? 1 : 0 %>"> <span class="lbl">Large</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Lean Muscle" class="px" data-bind="<%= role.getBuilds().indexOf('Lean Muscle') != -1 ? 1 : 0 %>"> <span class="lbl">Lean-Muscle</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Medium" class="px" data-bind="<%= role.getBuilds().indexOf('Medium') != -1 ? 1 : 0 %>"> <span class="lbl">Medium</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Petite" class="px" data-bind="<%= role.getBuilds().indexOf('Petite') != -1 ? 1 : 0 %>"> <span class="lbl">Petite</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="build" value="Slim" class="px" data-bind="<%= role.getBuilds().indexOf('Slim') != -1 ? 1 : 0 %>"> <span class="lbl">Slim</span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body body type-->

					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<label class="text-bold margin-bottom-zero">Ethnic Appearance</label>
								<div class="row">
									<div class="col-md-12 ethnnicity-checkbox">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="African" class="px" data-bind="<%= role.getEthnicities().indexOf('African') != -1 ? 1 : 0 %>"> <span class="lbl">African</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="African American" class="px" data-bind="<%= role.getEthnicities().indexOf('African American') != -1 ? 1 : 0 %>"> <span class="lbl">African American</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="American Indian" class="px" data-bind="<%= role.getEthnicities().indexOf('American Indian') != -1 ? 1 : 0 %>"> <span class="lbl">American Indian</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="Asian" class="px" data-bind="<%= role.getEthnicities().indexOf('Asian') != -1 ? 1 : 0 %>"> <span class="lbl">Asian</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="Caucasian" class="px" data-bind="<%= role.getEthnicities().indexOf('Caucasian') != -1 ? 1 : 0 %>"> <span class="lbl">Caucasian</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="Eastern Indian" class="px" data-bind="<%= role.getEthnicities().indexOf('Eastern Indian') != -1 ? 1 : 0 %>"> <span class="lbl">East Indian</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="Hispanic" class="px" data-bind="<%= role.getEthnicities().indexOf('Hispanic') != -1 ? 1 : 0 %>"> <span class="lbl">Hispanic</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="ethnicity" value="Middle Eastern" class="px" data-bind="<%= role.getEthnicities().indexOf('Middle Eastern') != -1 ? 1 : 0 %>"> <span class="lbl">Middle Eastern</span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body ethnic appearance-->

				</div> {{-- panel appearance --}}

				<div class="panel panel-transparent no-margin-b">
					<div class="panel-heading no-padding-hr padding-bottom-zero-small padding-top-zero">
						<div class="panel-title text-uppercase"><strong>Membership</strong></div>
					</div>

					<div class="panel-body padding-small no-border-hr no-padding-hr">
						<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
							<div class="tab-pane fade active in">
								<div class="row">
									<div class="col-md-12 member-checkbox">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="join_status" value="5" class="px"> <span class="lbl">Pro Member</span>
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="join_status" value="0" class="px"> <span class="lbl">Amateur Member</span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- ./panel-body gender-->
				</div> {{-- panel appearance --}}

				<div class="row-fluid clearfix">
					<div class="col-md-12 padding-zero">
						<button id="talent-filter-button" type="button" class="btn btn-success btn-block">Search</button>
					</div>
				</div>

			</div> {{-- location --}}
		</div>
	</div>
	</form>
</div> {{-- refine-search-sidebar --}}