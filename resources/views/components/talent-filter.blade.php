<div class="col-md-3 refine-search-sidebar">
	<form id="talent-filter-form">
	<div class="panel panel-talents-search">
		<div class="panel-heading">
			<span class="panel-title talents-refine-title">Refine Search</span>
			<div class="panel-heading-controls">
				<div class="panel-heading-icon"><i class="fa fa-chevron-left"></i></div>
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
								<label class="text-semibold margin-bottom-zero">Enter Zip Code to Select Markets</label>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group">
											<input type="text" class="form-control" name="zip" placeholder="Enter Zip Code" id="zip-code" max="5" maxlength="5">
											<span class="input-group-btn">
												<button class="btn" type="button" id="auto-select-markets">
													<i class="fa fa-caret-right"></i>
												</button>
											</span>
										</div>
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
									<span id="height-min-text" class="text-normal" data-bind="<%= parseInt(role.height_min) ? role.getHeightMinText() : '2\'0&quot;' %>">2'0"</span> -
									<span id="height-max-text" class="text-normal" data-bind="<%= parseInt(role.height_max) ? role.getHeightMaxText() : '8\'0&quot;' %>">8'0"</span>
								</label>
								<div class="row">
									<div class="col-md-12">
										<div class="ui-slider-range-height" data-slider data-range="true" data-min="24" data-max="96" data-values="[24,96]" data-type="height" data-bind="[<%= parseInt(role.height_min) ? role.height_min : 24 %>, <%= parseInt(role.height_max) ? role.height_max : 96 %>]"></div>
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
