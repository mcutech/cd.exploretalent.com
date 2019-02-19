@extends('layouts.project', ['project_details' => true, 'pages' => [ [ 'name' => 'Roles', 'url' => '/projects/'.$projectId ], [ 'name' => 'Edit Role', 'url' => '/projects/'.$projectId.'/roles/'.$roleId.'/edit', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-th-list page-header-icon"></i> Edit Roles
@stop

@section('sidebar.page-extra')
<div class="row display-none">
	<hr class="visible-xs no-grid-gutter-h">
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="/projects/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>
			Create Project
		</a>
	</div>
</div>
@stop

@section('project.body')
<div class="row">
<div id="edit-role-div" class="row-fluid clearfix">
	<div class="col-md-10">
		<div class="panel panel-default">
		  	<div class="panel-body">
			    <div class="col-md-8">
					<div class="form-group">
					    <label>Role Name</label>
					    <input type="text" class="form-control" id="role-name-text" placeholder="" data-bind="<%= name %>" data-validate="required" data-validate-error="This field is required.">
				  	</div>
			    </div>
			    <div class="col-md-4">
					<div class="form-group">
					    <label>Number of Talents</label>
					    <input type="text" class="form-control" id="role-number-text" placeholder="" data-bind="<%= number_of_people %>" data-validate="required" data-validate-error="This field is required.">
				  	</div>
			    </div>
			    <div class="col-md-12">
			    	<div class="form-group">
					    <label>Role Description</label>
					    <textarea id="role-description-text" class="form-control" rows="3" style="resize: none;" data-bind="<%= des %>" data-validate="required" data-validate-error="This field is required.">test test</textarea>
				  	</div>
			    </div>
                <div class="col-md-4">
                    <label>Expiry Date:</label><span class="text-success">*</span>
                        <div class="input-group date">
                            <input type="text" id="datepicker-role-expiryDate" class="form-control calendar-input" style="cursor: pointer; background-color: #fff" data-bind="<%= expiration_timestamp ? moment(expiration_timestamp * 1000).format('YYYY-MM-DD') : 'N/A' %>">
                            <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                        </div>
                        <div class="alert alert-page alert-danger deadline-error-required" style="display:none;">This field is required.</div>
                </div>
                <div class="col-md-4">
                    <label>Audition Date:</label>
                        <div class="input-group date">
                            <input type="text" id="datepicker-role-auditionDate" class="form-control calendar-input" style="cursor: pointer; background-color: #fff" data-bind="<%= audition_timestamp ? moment(audition_timestamp * 1000).format('YYYY-MM-DD') : 'N/A' %>">
                            <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                        </div>
                        <div class="alert alert-page alert-danger audition-date-error-invalid" style="display:none;">Audition date should be after or on the same day as submission deadline.</div>
                </div>
                <div class="col-md-4">
                    <label>Shoot Date:</label>
                        <div class="input-group date">
                            <input type="text" id="datepicker-role-shootDate" class="form-control calendar-input" style="cursor: pointer; background-color: #fff" data-bind="<%= shoot_timestamp ? moment(shoot_timestamp * 1000).format('YYYY-MM-DD') : 'N/A' %>">
                            <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                        </div>
                        <div class="alert alert-page alert-danger shoot-date-error-invalid" style="display:none;">Shoot date should be after audition date.</div>
                </div>
				<div class="col-md-3 margin-top-normal">
					<label>Gender:</label>
					<div>
						<label class="checkbox-inline margin-bottom-normal">
							<input class="px" type="checkbox" name="gender" id="gender-male-checkbox" value="0" data-bind="<%= gender_male %>">
							<span class="lbl">Male</span>
						</label>
						<label class="checkbox-inline margin-bottom-normal">
							<input class="px" type="checkbox" name="gender" id="gender-female-checkbox" value="0" data-bind="<%= gender_female %>">
							<span class="lbl">Female</span>
						</label>
						<div class="alert alert-page alert-danger gender-error-required" style="display: none;">This field is required.</div>
					</div>
				</div>

				<!-- <div class="col-md-3">
					<label class="text-bold margin-bottom-zero">Age Range: <span id="age-min-text" data-bind="<%= age_min || 0 %>" class="text-normal">0</span> - <span id="age-max-text" data-bind="<%= age_max || 100 %>" class="text-normal">100</span></label>
					<div class="padding-right-small">
					<div class="padding-small">
						<div data-range="true" data-values="[0, 100]" data-min="0" data-max="100" data-bind="[<%= age_min || 0 %>, <%= age_max || 100 %>]" data-type="age" data-slider></div>
						<input type="hidden" name="age_min" data-bind="<%= age_min || 0 %>" />
						<input type="hidden" name="age_max" data-bind="<%= age_max || 0 %>" />
					</div>
					</div>
				</div> -->

				<div class="col-md-4 margin-top-normal">
					<label class="text-bold margin-bottom-zero">Age Range: <span class="text-normal">from</span>
						<input id="age-min-input" class="text-normal" style="width: 30px;">
						<span class="text-normal">to</span>
						<input id="age-max-input" class="text-normal" style="width: 30px;">
						<span class="text-normal">years</span>
					</label>
					<div class="padding-right-small">
						<div class="padding-small">
							<div id="age-range-slider" data-range="true" data-values="[2, 71]" data-min="2" data-bind="[<%= age_min || 0 %>, <%= age_max || 71 %>]" data-max="71" data-type="age" data-slider></div>
							<input type="hidden" name="age_min" data-bind="<%= age_min || 0 %>" />
							<input type="hidden" name="age_max" data-bind="<%= age_max || 0 %>" />
						</div>
					</div>
				</div>

				<!-- <div class="col-md-3">
					<label class="text-bold margin-bottom-zero">Height Range: <span id="height-min-text" class="text-normal" data-bind="<%= getHeightMinText() ||'< 2\'0&quot;' %>">&lt; 2'0"</span> -
						<span id="height-max-text" class="text-normal" data-bind="<%= getHeightMaxText() || '8\'0&quot;' %>">8'0"</span>
					</label>
					<div class="padding-right-small">
					<div class="padding-small">
						<div class="ui-slider-range-height" data-slider data-range="true" data-min="22" data-max="96" data-values="[22,96]" data-type="height" data-bind="[<%= height_min ? height_min : 22 %>, <%= height_max ? height_max : 96 %>]"></div>
						<input type="hidden" name="height_min" data-bind="<%= height_min %>" />
						<input type="hidden" name="height_max" data-bind="<%= height_max %>" />
					</div>
					</div>
				</div> -->

				<div class="col-md-4 margin-top-normal">
					<label class="text-bold margin-bottom-zero">Height Range:
						<select id="height-min-dropdown" data-bind="<%= height_min %>">
							<?php
								$bool = false;
								for ($i = 22; $i <= 96; $i++) {
									$feet = floor($i / 12);
									$inches = $i % 12;

									if($i < 24) {
										if($bool == false) {
											echo "<option value=".$i."><2' 0\"</option>";
											$bool = true;
										}
									}
									else {
										echo "<option value=".$i.">".$feet."' ".$inches."\"</option>";
									}
								}
							?>
						</select>
						<span class="text-normal">to</span>
						<select id="height-max-dropdown" data-bind="<%= height_max %>">
							<?php
								$bool = false;
								for ($i = 22; $i <= 96; $i++) {
									$feet = floor($i / 12);
									$inches = $i % 12;

									if($i < 24) {
										if($bool == false) {
											echo "<option value=".$i."><2' 0\"</option>";
											$bool = true;
										}
									}
									else if($i == 96) {
										echo "<option value=".$i." selected>".$feet."' ".$inches."\"</option>";
									}
									else {
										echo "<option value=".$i.">".$feet."' ".$inches."\"</option>";
									}
								}
							?>
						</select>
					</label>
					<div class="padding-right-small">
					<div class="padding-small margin-top-small">
						<div id="height-range-slider" class="ui-slider-range-height" data-slider data-range="true" data-bind="[<%= height_min || 22 %>, <%= height_max || 96 %>]" data-min="22" data-max="96" data-values="[22,96]" data-type="height"></div>
						<input type="hidden" name="height_min" id ="height_min" data-bind="<%= height_min %>"/>
						<input type="hidden" name="height_max" id ="height_max" data-bind="<%= height_max %>" />
					</div>
					</div>
				</div>

				<div class="col-md-12 margin-top-large">
					<label>Ethnicity:</label>
				</div>
			    <div class="col-md-12">
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px ethnicity-any-checkbox" name="ethnicity" id="ethnicity-any" value="0" data-bind="<%= ethnicity_any %>">
					  <span class="lbl">Any</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-african" value="0" data-bind="<%= ethnicity_african %>">
					  <span class="lbl">African</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-african-am" value="0" data-bind="<%= ethnicity_african_am %>">
					  <span class="lbl">African American</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-asian" value="0" data-bind="<%= ethnicity_asian %>">
					  <span class="lbl">Asian</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-caribbian" value="0" data-bind="<%= ethnicity_caribbian %>">
					  <span class="lbl">Caribbean</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-caucasian" value="0" data-bind="<%= ethnicity_caucasian %>">
					  <span class="lbl">Caucasian</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-hispanic" value="0" data-bind="<%= ethnicity_hispanic %>">
					  <span class="lbl">Hispanic</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-mediterranean" value="0" data-bind="<%= ethnicity_mediterranean %>">
					  <span class="lbl">Mediterranean</span>
					</label>
			    </div>
			    <div class="col-md-12">
			    	<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-middle-est" value="0" data-bind="<%= ethnicity_middle_est %>">
					  <span class="lbl">Middle Eastern</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="ethnicity" id="ethnicity-american-in" value="0" data-bind="<%= ethnicity_native_am %>">
					  <span class="lbl">American Indian</span>
					</label>
					<div class="alert alert-page alert-danger ethnicity-error-required" style="display: none;">This field is required.</div>
			    </div>

				<div class="col-md-12 margin-top-large">
					<label>Body Type:</label>
				</div>
			    <div class="col-md-12">
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px built-any-checkbox" name="built" id="built-any" value="0" data-bind="<%= built_any %>">
					  <span class="lbl">Any</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-medium" value="0" data-bind="<%= built_medium %>">
					  <span class="lbl">Medium</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-athletic" value="0" data-bind="<%= built_athletic %>">
					  <span class="lbl">Athletic</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-bb" value="0" data-bind="<%= built_bb %>">
					  <span class="lbl">Body Builder</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-xlarge" value="0" data-bind="<%= built_xlarge %>">
					  <span class="lbl">Full Figured</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-large" value="0" data-bind="<%= built_large %>">
					  <span class="lbl">Large</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-petite" value="0" data-bind="<%= built_petite %>">
					  <span class="lbl">Petite</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-thin" value="0" data-bind="<%= built_thin %>">
					  <span class="lbl">Thin</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="built" id="built-lm" value="0" data-bind="<%= built_lm %>">
					  <span class="lbl">Lean Muscle</span>
					</label>
					<div class="alert alert-page alert-danger built-error-required" style="display: none;">This field is required.</div>
			    </div>
				<div class="col-md-12 margin-top-large">
					<label>Hair Color:</label>
				</div>
			    <div class="col-md-10">
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px hair-any-checkbox" name="hair-color" id="hair-any" value="0" data-bind="<%= hair_any %>">
					  <span class="lbl">Any</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-auburn" value="0" data-bind="<%= hair_auburn %>">
					  <span class="lbl">Auburn</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-black" value="0" data-bind="<%= hair_black %>">
					  <span class="lbl">Black</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-blonde" value="0" data-bind="<%= hair_blonde %>">
					  <span class="lbl">Blonde</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-brown" value="0" data-bind="<%= hair_brown %>">
					  <span class="lbl">Brown</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-chestnut" value="0" data-bind="<%= hair_chestnut %>">
					  <span class="lbl">Chestnut</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-dark-brown" value="0" data-bind="<%= hair_dark_brown %>">
					  <span class="lbl">Dark Brown</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-grey" value="0" data-bind="<%= hair_grey %>">
					  <span class="lbl">Gray</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-red" value="0" data-bind="<%= hair_red %>">
					  <span class="lbl">Red</span>
					</label>
			    </div>
			    <div class="col-md-12">
			    	<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-salt-paper" value="0" data-bind="<%= hair_salt_paper %>">
					  <span class="lbl">Salt &amp; Pepper</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input type="checkbox" class="px" name="hair-color" id="hair-white" value="0" data-bind="<%= hair_white %>">
					  <span class="lbl">White</span>
					</label>
					<div class="alert alert-page alert-danger hair-color-error-required" style="display: none;">This field is required.</div>
			    </div>
		  	</div>
		</div>
	</div>
</div>

</div>

<div class="row-fluid clearfix action-buttons-div">
	<div class="col-md-12">
		<div id="project-overview-link" class="form-group margin-top-normal">
			<button id="update-role-btn" class="btn btn-primary margin-left-small" type="submit">Update</button>
			<a data-bind="/projects/<%= casting_id %>" id="cancel-role-btn" class="btn btn-default margin-left-small">Cancel</a>
			<span class="text-success margin-left-normal role-updated-success" style="display: none;">Role has been updated.</span>
		</div>
	</div>
</div>




@stop
