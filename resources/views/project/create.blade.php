@extends('layouts.project')

@section('project.body')


	<!-- Submission Type Javascript -->
	<script>
	$(document).ready(function(){
	    $("#self-submission-option").on('click', function(){
	       alert('test1');
	        $("self-submission-option-content").show();
	        $("open-call-option-content").hide();
	    });
	    $("#open-call-option").on('click', function(){
	    	alert('test');
	        $("open-call-option-content").show();
	        $("self-submission-option-content").hide();
	    });
	});
	</script>
	<!-- / Submission Type Javascript -->

	<!-- DatePicker Javascript -->
	<script>
		init.push(function () {
			var options = {
				todayBtn: "linked",
				orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto'
			}
			$('#bs-datepicker-example').datepicker(options);

			$('#bs-datepicker-component').datepicker();

			var options2 = {
				orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto'
			}
			$('#bs-datepicker-range').datepicker(options2);

			$('#bs-datepicker-inline').datepicker();
		});
	</script>
	<!-- / DatePicker Javascript -->

	<ul class="breadcrumb breadcrumb-page">
		<li><a href="">Home</a></li>
		<li class="active">
			<a href=""> Create New Project</a>
		</li>
	</ul>

	<div class="create-wrapper">
		<div class="page-header">
			<div class="row">
				<!-- Page header, center on small screens -->
				<h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
						<i class="fa fa-file-text"></i> Create New Project
				</h1>
			</div>
		</div> <!-- / .page-header -->
		
		<div class="projects-content">
			<div class="panel">
				<div class="panel-body">
					<div class="container-fluid">
						<div class="row-fluid">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Project Name <span class="text-success">*</span></label>
									<input type="text" class="form-control" id="inputDefault-4" placeholder="Enter Project Name">
								</div>

								<div class="form-group">
									<label class="control-label">Submission Deadline <span class="text-success">*</span></label>
									<div class="input-group date" id="bs-datepicker-component">
										<input type="text" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
								</div>

								<div class="form-group col-md-6 padding-left-zero-md-lg">
									<label class="control-label">Audition Date</label>
									<div class="input-group date" id="bs-datepicker-component">
										<input type="text" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
								</div>

								<div class="form-group col-md-6 padding-right-zero-md-lg">
									<label class="control-label">Shoot Date Date</label>
									<div class="input-group date" id="bs-datepicker-component">
										<input type="text" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
								</div>

							</div> {{-- col-md-6 --}}
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Project Name <span class="text-success">*</span></label>
									<select class="form-control" data-required="" name="cat">
										<option value="">Select Category</option>
										<option value="43">Acting - Acrobatics/Stunts</option>
										<option value="41">Acting - Comedy/Clown</option>
										<option value="61">Acting - Other</option>
										<option value="42">Acting - Variety Acts</option>
										<option value="1">Commercials</option>
										<option value="16">Crew - Assistant &amp; Entry Level</option>
										<option value="49">rew - Acounting/Payroll/HR</option>
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
									</select>
								</div>
								
								<div class="form-group">
									<label class="control-label">Rate <span class="text-success">*</span></label>
									<form class="form-inline">
										<div class="form-group">
											<span class="display-inline font-size-normal">$</span>
											<input type="text" class="form-control" placeholder="" value="21.00"> <span class="padding-left-small padding-right-small">per</span> 
											<select name="" id="" class="form-control">
												<option value="1">n/a</option>
												<option value="2">event</option>
											</select>
										</div>
									</form>
								</div>

								<div class="form-group">
									<label class="control-label">Union <span class="text-success">*</span></label>
									<div class="margin-bottom-small-normal form-inline">
										<label class="radio checkbox-inline">
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" class="px">
											<span class="lbl">No</span>
										</label>
										<label class="radio checkbox-inline">
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option2" checked="" class="px">
											<span class="lbl">Yes</span>
										</label>
										<select name="" id="" class="form-control margin-left-normal-md-lg">
											<option value="">Select Union</option>
											<option value="1">SAG</option>
											<option value="2">AFTRA</option>
										</select>
									</div>	
								</div>

							</div> {{-- col-md-6 --}}
						</div> {{-- row-fluid --}}

						<div class="row-fluid">
							<div class="col-md-12">
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Submission Type<span class="text-success">*</span></label>
									<label class="radio checkbox-inline">
										<input type="radio" name="optionsRadios" id="self-submission-option" value="option1" checked="" class="px" >
										<span class="lbl">Self Submission</span>
									</label>
									<label class="radio checkbox-inline">
										<input type="radio" name="optionsRadios" id="open-call-option" value="option2" class="px">
										<span class="lbl">Open Call</span>
									</label>
								</div>
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<div class="panel" id="self-submissions-option-content">
										<div class="panel-body">
											<div class="form-group">
												<label class="control-label">Email Address (For Self-Response castings enter email)</label>
												<input type="text" class="form-control" placeholder="Enter Project Name">
											</div>
											<div class="form-group">
												<label class="control-label">and / or postal address <span class="text-success">*</span></label>
												<textarea class="form-control" rows="5" placeholder="Message"></textarea>
											</div>
										</div>
									</div> {{-- self-submission-option-content --}}

									<div class="panel" id="open-call-option-content">
										<div class="panel-body">
											<div class="form-group">
												<label class="control-label">Email Address (For Self-Response castings enter email)</label>
												<input type="text" class="form-control" placeholder="Enter Project Name">
											</div>
											<div class="form-group">
												<label class="control-label">Enter location(s) & telephone(s)</label>
												<input type="text" class="form-control" placeholder="Enter Project Name">
											</div>
											<div class="form-group">
												<label class="checkbox-inline">
													<input type="checkbox" id="inlineCheckbox3" value="option3" class="px"> <span class="lbl">If Appointment only, check</span>
												</label>
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
										<input type="text" class="form-control" placeholder="Enter Zip Code">
										<span class="input-group-btn">
											<button class="btn" type="button">Auto Select Markets</button>
										</span>
									</div>
								</div>					
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">General Audition Info / Storyline / Synopsis / Logline</label>
									<textarea class="form-control" rows="5" placeholder="Message"></textarea>
								</div>	
							</div>
						</div>

						<div class="row-fluid">
							<div class="col-md-12">
								<div class="pull-right">
									<a href="#" class="btn btn-success btn-lg">Save</a>
								</div>
							</div>
						</div>
					</div> {{-- container-fluid --}}
				</div> {{-- panel-body --}}
			</div> {{-- panel --}}
			
			<div class="row clearfix margin-top-normal margin-bottom-normal">
				<div class="col-md-12">
					<div class="alert alert-success margin-bottom-zero">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>2 role(s)</strong> found for this casting.
					</div>
				</div>
			</div>

			<div class="roles-container">
				<?php for($x=0; $x<5; $x++) { ?>
				<div class="panel roles-item">
					<div class="padding-normal">
						<div class="row-fluid clearfix roles-header">
							<div class="col-md-6 text-bold">
								<span>Role ID#4556931</span> - <span>Male Models</span>
								<ul class="list-unstyled description">
									<li><div class="title">Description:</div> Male models with athletic body.</li>	
								</ul>
							</div>
							<div class="col-md-6">
								<div class="float-right">
									<a class="btn btn-lg btn-outline font-size-normal" href="#">
										<i class="fa fa-pencil"></i> Edit
									</a>

									<a class="btn btn-lg btn-outline font-size-normal" href="#">
										<i class="fa fa-trash-o"></i> Delete
									</a>

									<a href="#" class="btn btn-success padding-small-normal">View matches</a>
								</div>
							</div>
						</div> {{-- roles header --}}

						<div class="row-fluid clearfix">
							<div class="col-md-3 details-label-container">
								<div class="details-label"><span>Gender:</span> Male</div>
							</div>

							<div class="col-md-3 details-label-container">
								<div class="details-label"><span>Age:</span> 18 to 50</div>
							</div>

							<div class="col-md-3 details-label-container">
								<div class="details-label"><span>Height:</span> 5'5" to 7'10"</div>
							</div>

							<div class="col-md-3 details-label-container">
								<div class="details-label"><span>Talents:</span> 5</div>
							</div>

							{{-- <div class="col-md-3 details-label-container">
								<div class="details-label"><span>Ethnicity:</span> Any</div>
							</div>

							<div class="col-md-3 details-label-container">
								<div class="details-label"><span>Body Type:</span> Athletic</div>
							</div> --}}
						</div>
					</div>
				</div>{{-- roles-item --}}
				<?php } ?>
			</div>

		</div>
	</div>
@stop