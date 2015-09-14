@extends('layouts.sidebar')

@section('sidebar.body')
	<ul class="breadcrumb breadcrumb-page">
		<li><a href="/cd/projects">Home</a></li>
			<li class="active">
			<a href="/cd/#"> My Projects</a>
		</li>
	</ul>

	<div class="projects-wrapper">
		<div class="page-header">
			<div class="row">
				<!-- Page header, center on small screens -->
				<h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
						<i class="fa fa-th-list page-header-icon"></i> Add Roles
				</h1>
				<div class="col-xs-12 col-sm-8">
					<div class="row">
						<hr class="visible-xs no-grid-gutter-h">
						<div class="pull-right col-xs-12 col-sm-auto">
							<a href="/projects/create" class="btn btn-primary btn-labeled" style="width: 100%;">
								<span class="btn-label icon fa fa-plus"></span>
								Create Project
							</a>
						</div>

					</div>
				</div>
			</div>
		</div> <!-- / .page-header -->
	</div>

	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Project Details</div>
	  <div class="panel-body">
		<div class="project-details-container">
			<div class="panel-group panel-group-primary project-item panel-blue" data-casting-id="1497936">

					<div class="row-fluid clearfix margin-bottom-normal">
						<div class="col-md-6">
							<strong>Project ID# 1497936</strong>
						</div>
					</div>
					<div class="row-fluid col-no-padding clearfix project-details-container">
						<div class="col-sm-12 col-md-6">
							<ul class="list-unstyled additional-details margin-zero">
								<li><div class="title">Project Type:</div>Print</li>
								<li><div class="title">Location:</div>Beverly Hills, CA</li>
								<li><div class="title">Rate/Pay:</div>$7,500 per day</li>	
								<li><div class="title">Audition Date:</div>09-23-2015</li>
								<li><div class="title">Casting Category:</div>Modeling - Print</li>
								<li><div class="title">Market In:</div>Los Angeles, California</li>	
							</ul>
						</div>

						<div class="col-sm-12 col-md-6">
							<ul class="list-unstyled additional-details margin-zero">
								<li><div class="title">Submission Type:</div>Self Response</li>	
								<li><div class="title">Union:</div>Commercials, Non-Union</li>
								<li><div class="title">Release Date:</div>01-07-2015</li>
								<li><div class="title">Deadline:</div><span class="text-danger">02-15-15</span></li>						
							</ul>
						</div>

						<div class="col-md-12">
							<ul class="list-unstyled description">
								<li><div class="title">Description:</div>Male Models for Runway Fashion Show</li>		
							</ul>
						</div>
					</div>								
			</div>  {{-- panel 1 --}}
		</div>
	  </div>
	</div>

	<div class="panel panel-default">
	  <div class="panel-body">
	    <div class="col-md-8">
			<div class="form-group">
			    <label for="exampleInputEmail1">Role Name</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
		  	</div>	    	
	    </div>
	    <div class="col-md-4">
			<div class="form-group">
			    <label for="exampleInputEmail1">Name of Talent</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
		  	</div>	    	
	    </div>
	    <div class="col-md-12">
	    	<div class="form-group">
			    <label for="exampleInputEmail1">Role Description</label>
			    <textarea class="form-control" rows="3"></textarea>
		  	</div>
	    </div>
		<div class="col-md-12 margin-top-large">
			<label>Gender:</label>
		</div>	    
		<div class="col-md-4">
			<label class="checkbox-inline margin-right-">
			  <input class="px" type="checkbox" id="inlineCheckbox1" value="option1"> Male
			</label>
			<label class="checkbox-inline margin-right-">
			  <input type="checkbox" id="inlineCheckbox2" value="option2"> Female
			</label>			
		</div>

		<script>
			// var range_sliders_options = {
			// 	'range': true,
			// 	'min': 0,
			// 	'max': 500,
			// 	'values': [ 125, 300 ]
			// };
			// $('.ui-slider-range-demo').slider(range_sliders_options);
			// $('.ui-v-slider-range-demo').slider($.extend({ orientation: 'vertical' }, range_sliders_options));
		</script>	
		<script>
			// var range_sliders_options = {
			// 	'range': true,
			// 	'min': 0,
			// 	'max': 500,
			// 	'values': [ 125, 300 ]
			// };
			// $('.ui-slider-range-demo').slider(range_sliders_options);
			// $('.ui-v-slider-range-demo').slider($.extend({ orientation: 'vertical' }, range_sliders_options));
		</script>

		<div class="col-md-4">
			<label for="">Age Range *  25 - 50 y.o.</label>
			<div class="ui-slider-range-demo"></div>
		</div>

		<div class="col-md-4">
			<label for="">Height Range:  5' 0" - 8' 0"</label>
			<div class="ui-slider-range-demo"></div>
		</div>		

		<div class="col-md-12 margin-top-large">
			<label>Ethnicity:</label>
		</div>
	    <div class="col-md-12">	    
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Any
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox2" value="option2"> African
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> African American
			</label>	  
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Asian
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Caribbean
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Caucasian
			</label>						
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox2" value="option2"> Hispanic
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Mediterranean
			</label>	
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Middle Eastern
			</label>	
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> American Indian
			</label>																					  	
	    </div>

		<div class="col-md-12 margin-top-large">
			<label>Body Type:</label>
		</div>
	    <div class="col-md-12">	    
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Any
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox2" value="option2"> Medium
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Athletic
			</label>	  
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Body Builder
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox2" value="option2"> Full Figured
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Large
			</label>	
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Petite
			</label>	
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Thin
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Lean Muscle
			</label>																								  	
	    </div>	
		<div class="col-md-12 margin-top-large">
			<label>Hair Color:</label>
		</div>
	    <div class="col-md-12">	    
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Any
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox2" value="option2"> Aubum
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Black
			</label>	  
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox1" value="option1"> Blonde
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox2" value="option2"> Brown
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Chestnut
			</label>	
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Dark Brown
			</label>	
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Gray
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Red
			</label>		
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> Salt & Pepper
			</label>
			<label class="checkbox-inline-no-margin">
			  <input type="checkbox" id="inlineCheckbox3" value="option3"> White
			</label>																												  	
	    </div>		        
	  </div>	  
	</div>
	<div class="form-group margin-top-medium">
		<a class="btn btn-success" id="save">Save &amp; Add another Role</a>
		<button class="btn btn-primary" type="submit">Save</button>
		<a href="/cd/projects" class="btn btn-default margin-left-small">Cancel</a>
	</div>



@stop
