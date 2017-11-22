@extends('layouts.project', ['project_details' => true, 'pages' => [ [ 'name' => 'Project Overview', 'url' => '/projects/'.$projectId ], [ 'name' => 'Add Role', 'url' => '/projects/'.$projectId.'/roles/create', 'active' => true] ] ])

@section('sidebar.page-header')
<div class="col-md-12">
	<i class="fa fa-th-list page-header-icon"></i> Add Roles
</div>
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

<div id="create-role-div" class="clearfix">
	<div class="col-md-12">
		<div class=" alert alert-success">
			<span> Please add your role details here. We match talents to your roles through these role details, specific role details result to specific role matches.</span>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-default">
		  <div class="panel-body">
		    <div class="col-md-8">
				<div class="form-group">
				    <label>Role Name</label>
				    <input type="text" class="form-control" id="role-name-text" placeholder="" data-validate="required" data-validate-error="This field is required.">
			  	</div>
		    </div>
		    <div class="col-md-4">
				<div class="form-group">
				    <label>Number of Talents</label>
				    <input type="text" class="form-control" id="role-number-text" placeholder="" data-validate="required" data-validate-error="This field is required.">
			  	</div>
		    </div>
		    <div class="col-md-12">
		    	<div class="form-group">
				    <label>Role Description</label>
				    <textarea id="role-description-text" class="form-control" rows="3" style="resize: none;" data-validate="required" data-validate-error="This field is required."></textarea>
			  	</div>
		    </div>
            {{-- Role Expiry --}}
            <div class="col-md-4">
                <label>Expiry Date:</label><span class="text-success">*</span>
                    <div class="input-group date">
                        <input type="text" id="datepicker-role-expiryDate" class="form-control calendar-input" style="cursor: pointer; background-color: #fff">
                        <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                    </div>
                    {{-- <div class="alert alert-page alert-danger deadline-error-required" style="display:none;">This field is required.</div> --}}
            </div>
            <div class="col-md-4">
                <label>Audition Date:</label>
                    <div class="input-group date">
                        <input type="text" id="datepicker-role-auditionDate" class="form-control calendar-input" style="cursor: pointer; background-color: #fff">
                        <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                    </div>
            </div>
            <div class="col-md-4">
                <label>Shoot Date:</label>
                    <div class="input-group date">
                        <input type="text" id="datepicker-role-shootDate" class="form-control calendar-input" style="cursor: pointer; background-color: #fff">
                        <span class="input-group-addon calendar-btn"><i class="fa fa-calendar"></i></span>
                    </div>
            </div>
			<div class="col-md-3 margin-top-normal">
				<label>Gender:</label>
				<div>
					<label class="checkbox-inline margin-bottom-normal">
					  <input class="px" type="checkbox" name="gender" id="gender-male-checkbox" value="0">
					  <span class="lbl">Male</span>
					</label>
					<label class="checkbox-inline margin-bottom-normal">
					  <input class="px" type="checkbox" name="gender" id="gender-female-checkbox" value="0">
					   <span class="lbl">Female</span>
					</label>
					<div class="alert alert-page alert-danger gender-error-required" style="display: none;">This field is required.</div>
				</div>
			</div>

			<!-- <div class="col-md-4 margin-top-normal">
				<label for="">Age Range: </label><span id="age-range-min"> 0</span> to <span id="age-range-max">100</span> y.o.
				<div class="ui-slider-age-range"></div>
			</div> -->

			<div class="col-md-4 margin-top-normal">
					<label class="text-bold margin-bottom-zero">Age Range: <span class="text-normal">from</span>
						<input id="age-min-input" class="text-normal" style="width: 30px;" value="<3">
						<span class="text-normal">to</span>
						<input id="age-max-input" class="text-normal" style="width: 30px;" value="70+">
						<span class="text-normal">years</span>
					</label>
					<div class="padding-right-small">
						<div class="padding-small">
							<div id="age-range-slider" data-range="true" data-values="[2, 71]" data-min="2" data-max="71" data-type="age" data-slider></div>
							<input type="hidden" name="age_min" />
							<input type="hidden" name="age_max" />
						</div>
					</div>
			</div>

			<!-- <div class="col-md-4 margin-top-normal">
				<label for="">Height Range: </label>
				<span id="height-span">< 2 ft 0 in to 8 ft 0 in</span>
				<input name="height" id="heightinches" class="display-none" value="22,96">
                <div class="ui-slider-height-range"></div>
			</div> -->

			<div class="col-md-4 margin-top-normal">
					<label class="text-bold margin-bottom-zero">Height Range:
						<select id="height-min-dropdown">
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
						<select id="height-max-dropdown">
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
						<div id="height-range-slider" class="ui-slider-range-height" data-slider data-range="true" data-min="22" data-max="96" data-values="[22,96]" data-type="height"></div>
						<input type="hidden" name="height_min" id ="height_min" />
						<input type="hidden" name="height_max" id ="height_max" />
					</div>
					</div>
			</div>

			<div class="col-md-12 margin-top-large">
				<label>Ethnicity:</label>
			</div>
		    <div class="col-md-12">
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px ethnicity-any-checkbox" type="checkbox" name="ethnicity" id="ethnicity-any" value="0">
				  <span class="lbl">Any</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-african" value="0">
				  <span class="lbl">African</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-african-am" value="0">
				  <span class="lbl">African American</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-asian" value="0">
				  <span class="lbl">Asian</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-caribbian" value="0">
				  <span class="lbl">Caribbean</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-caucasian" value="0">
				  <span class="lbl">Caucasian</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-hispanic" value="0">
				  <span class="lbl">Hispanic</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-mediterranean" value="0">
				  <span class="lbl">Mediterranean</span>
				</label>
		    	<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-middle-est" value="0">
				  <span class="lbl">Middle Eastern</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-american-in" value="0">
				  <span class="lbl">American Indian</span>
				</label>
				<div class="alert alert-page alert-danger ethnicity-error-required" style="display: none;">This field is required.</div>
		    </div>


			<div class="col-md-12 margin-top-large">
				<label>Body Type:</label>
			</div>
		    <div class="col-md-12">
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px built-any-checkbox" type="checkbox" name="built" id="built-any" value="0">
				  <span class="lbl">Any</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-medium" value="0">
				  <span class="lbl">Medium</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-athletic" value="0">
				  <span class="lbl">Athletic</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-bb" value="0">
				  <span class="lbl">Body Builder</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-xlarge" value="0">
				  <span class="lbl">Full Figured</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-large" value="0">
				  <span class="lbl">Large</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-petite" value="0">
				  <span class="lbl">Petite</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-thin" value="0">
				  <span class="lbl">Thin</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="built" id="built-lm" value="0">
				  <span class="lbl">Lean Muscle</span>
				</label>
				<div class="alert alert-page alert-danger built-error-required" style="display: none;">This field is required.</div>
		    </div>
			<div class="col-md-12 margin-top-large">
				<label>Hair Color:</label>
			</div>
		    <div class="col-md-10">
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px hair-any-checkbox" type="checkbox" name="hair-color" id="hair-any" value="0">
				  <span class="lbl">Any</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-auburn" value="0">
				  <span class="lbl">Auburn</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-black" value="0">
				  <span class="lbl">Black</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-blonde" value="0">
				  <span class="lbl">Blonde</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-brown" value="0">
				  <span class="lbl">Brown</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-chestnut" value="0">
				  <span class="lbl">Chestnut</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-dark-brown" value="0">
				  <span class="lbl">Dark Brown</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-grey" value="0">
				  <span class="lbl">Gray</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-red" value="0">
				  <span class="lbl">Red</span>
				</label>
		    	<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-salt-paper" value="0">
				  <span class="lbl">Salt & Pepper</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color" id="hair-white" value="0">
				  <span class="lbl">White</span>
				</label>
				<div class="alert alert-page alert-danger hair-color-error-required" style="display: none;">This field is required.</div>
		    </div>
		  </div>
		</div>
	</div>
</div>

<div class="row-fluid clearfix action-buttons-div">
	<div class="col-md-12">
		<div id="project-overview-link" class="form-group margin-top-normal">
			<a id="save-role-btn" class="btn btn-primary">Save and View Matched Talents</a>
			<button id="save-and-add-role-btn" class="btn btn-success margin-left-small" type="submit">Save and Add a New Role   <i class="fa" id="loading_role"></i></button>
			<a data-bind="/projects/<%= casting_id %>" id="cancel-role-btn" class="btn btn-default margin-left-small">Cancel</a>
			<span class="text-success margin-left-normal role-saved-success" style="display: none;">New role has been saved.</span>
		</div>
	</div>
</div>




@stop
