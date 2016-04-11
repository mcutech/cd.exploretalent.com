@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Roles', 'url' => '/settings' ], [ 'name' => 'Create Role', 'url' => '/settings', 'active' => true] ] ])

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

@section('sidebar.body')

<div class="row-fluid clearfix project-details-div">
	<div class="col-md-12">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Project Details</div>
		  <div class="panel-body">
			<div class="project-details-container">
				<div class="panel-group panel-group-primary project-item panel-blue">
					<div class="row-fluid clearfix margin-bottom-normal">
						<div class="col-md-6">
							<strong><p data-bind="<%= name %>"></p></strong>
							<strong>Project ID# <span data-bind="<%= casting_id %>"></span></strong>
						</div>
					</div>
					<div class="row-fluid col-no-padding clearfix project-details-container">
						<div class="col-sm-12 col-md-6">
							<ul class="list-unstyled additional-details margin-zero">
								<li><div class="title">Project Type:</div><span data-bind="<%= (cat) ? getCategory().split(' ',1) : 'N/A' %>"></span></li>
								<li><div class="title">Location:</div><span data-bind="<%= (location) ? location : 'Not Specified' %>"></span></li>
								<li><div class="title">Rate/Pay:</div><span data-bind="$<%= rate %>"></span><span data-bind="<%= (rate_des != 0) ? ' per ' + rate_des : '' %>"></span></li>	
								<li><div class="title">Audition Date:</div><span data-bind="<%= (aud_timestamp) ? date.formatYMD(aud_timestamp) : 'Not Specified' %>"></span></li>
								<li><div class="title">Casting Category:</div><span data-bind="<%= (cat) ? getCategory() : 'N/A' %>"></span></li>
								<li><div class="title">Market In:</div><span data-bind="<%= (market) ? market : 'Not Specified' %>"></span></li>	
							</ul>
						</div>

						<div class="col-sm-12 col-md-6">
							<ul class="list-unstyled additional-details margin-zero">
								<li><div class="title">Submission Type:</div><span data-bind="<%= (project_type == 8) ? 'Open Call' : 'Self Response' %>"></span></li>	
								<li><div class="title">Union:</div><span data-bind="<%= (union2 == 0) ? 'Non-Union' : 'Union' %>"></span></li>
								<li><div class="title">Release Date:</div><span data-bind="<%= date.formatYMD(parseInt(sub_timestamp)) %>"></span></li>
								<li><div class="title">Deadline:</div><span class="text-danger" data-bind="<%= asap1 %>"></span></li>
							</ul>
						</div>

						<div class="col-md-10">
							<ul class="list-unstyled description">
								<li><div class="title">Description:</div><span data-bind="<%= des %>"></span></li>		
							</ul>
						</div>
					</div>								
				</div>
			</div>
		  </div>
		</div>
	</div>
</div>

<div id="create-role-div" class="row-fluid clearfix">
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
			
			<div class="col-md-4 margin-top-normal">
				<label for="">Age Range: </label><span id="age-range-min"> 0</span> to <span id="age-range-max">100</span> y.o.
				<div class="ui-slider-age-range"></div>
			</div>

			<div class="col-md-4 margin-top-normal">
				<label for="">Height Range: </label>
				<span id="height-span">< 2 ft 0 in to 8 ft 0 in</span>
				<input name="height" id="heightinches" class="display-none" value="22,96">
                <div class="ui-slider-height-range"></div>
			</div>		

			<div class="col-md-12 margin-top-large">
				<label>Ethnicity:</label>
			</div>
		    <div class="col-md-12">	    
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="ethnicity" id="ethnicity-any" value="0">
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
				  <input class="px" type="checkbox" name="built" id="built-any" value="0">
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
				  <input class="px" type="checkbox" name="hair-color" id="hair-any" value="0">
				  <span class="lbl">Any</span>
				</label>
				<label class="checkbox-inline margin-bottom-normal">
				  <input class="px" type="checkbox" name="hair-color " id="hair-auburn" value="0">
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
		<div class="form-group margin-top-normal">
			<a data-bind="/projects/<%= casting_id %>" id="save-role-btn" class="btn btn-primary">Save</a>
			<button id="save-and-add-role-btn" class="btn btn-success margin-left-small" type="submit">Save and Add a New Role</button>
			<a href="/projects" id="cancel-role-btn" class="btn btn-default margin-left-small">Cancel</a>
			<span class="text-success margin-left-normal role-saved-success" style="display: none;">New role has been saved.</span>
		</div>			
	</div>
</div>




@stop
