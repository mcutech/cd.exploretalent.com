<div class="role-find-talents-scheduled-wrapper">
	<div class="row">
		<div class="col-md-5 call-back-audition-container">
			<div class="panel panel-dark margin-zero">
				<div class="panel-heading panel-heading-dark">
					<div class="display-block margin-bottom-normal">
						<div class="display-inline-block valign-middle"><h5 class="margin-zero"><b>Audition</b> <span class="text-muted">02/20/2016</span> <span class="text-muted">, Room One</span></h5></div>
						<div class="display-inline-block float-right">
							<div class="btn-group btn-group-sm">
								<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"><i class="fa fa-outdent"></i> Change View <i class="fa fa-caret-down"></i></button>
								<ul class="dropdown-menu" id="scheduled-change-view-option-1">
									<li><a href="#" id="scheduled-photo-view-1">Photo View</a></li>
									<li><a href="#" id="scheduled-confirmation-view-1">Confirmation View</a></li>
									<li><a href="#" id="scheduled-submission-note-view-1">Submission Note View</a></li>
									<li><a href="#" id="scheduled-casting-note-view-1">Casting Note View</a></li>
									<li><a href="#" id="scheduled-list-view-1">List View</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="display-block">
						<div class="display-inline-block">
							<div class="btn-group btn-group-sm">
								<button type="button" class="btn btn-dark-outline dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus"></i> Add <i class="fa fa-caret-down"></i></button>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
								</ul>
							</div>
						</div>
						<div class="display-inline-block">
							<div class="btn-group btn-group-sm">
								<button type="button" class="btn btn-dark-outline dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil"></i> Edit Schedule <i class="fa fa-caret-down"></i></button>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
								</ul>
							</div>
						</div>
						<div class="display-inline-block">
							<div class="btn-group btn-group-sm">
								<button type="button" class="btn btn-dark-outline dropdown-toggle" data-toggle="dropdown"><i class="fa fa-repeat"></i> Go to... <i class="fa fa-caret-down"></i></button>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
								</ul>
							</div>
						</div>
						<div class="display-inline-block float-right">
							<button type="button" class="btn btn-primary btn-sm text-xs">Build Timeframe</button>
						</div>
					</div>
				</div>
				<div class="panel-body padding-zero">
					<div class="schedule-notification"></div>
					<div class="panel-group" id="schedule-time-container">
						<div class="panel schedule-time-item">
							<div class="panel-heading schedule-time-header">
								<a class="accordion-toggle display-block" data-toggle="collapse" data-parent="#schedule-time-container" href="#scheduled-time-1">
									<div class="display-inline-block"><span class="text-bold">9:30 AM - 6:30 PM every 10 minutes</span></div>
									<div class="display-inline-block float-right"><button class="btn btn-dark btn-xs btn-xxs text-right"><i class="fa fa-pencil"></i> Edit</button></div>
									<div class="text-default role-name">Male Cheft Host <span class="text-bold">(2)</span></div>
								</a>
							</div>
							<div id="scheduled-time-1" class="schedule-time-body panel-collapse in">
								<div class="row-fluid clearfix time-item">
									<div class="col-md-2 time">9:30am</div>
									<div class="col-md-10 talent">
										<div class="role-list-body">
										{{-- README: Different classes for change view of talents (.talent-photo-view, .talent-confirmation-view, .submission-note-view, .casting-note-view, .list-view)--}}
										@for ($i=0; $i < 6 ; $i++) 
										<div class="view-container list-view">
											<div class="image-like-list-container">
												<div class="image-holder">
													<img src="/../images/talents-sample-image.jpg" class="img-responsive">
												</div>
												<div class="talent-like-it-list-number margin-top-small">
													<div class="like-it-list-container">
														<div class="btn-group talent-function" data-bind-target="data-id" data-id="schedule-615535">
															<button class="btn btn-xs btn-danger rating-button function-item" data-bind-target="class">1</button>
															<button class="btn btn-xs btn-warning rating-button function-item" data-bind-target="class">2</button>
															<button class="btn btn-xs btn-info rating-button function-item" data-bind-target="class">3</button>
															<button class="btn btn-xs btn-primary rating-button function-item" data-bind-target="class">4</button>
															<button class="btn btn-xs btn-success rating-button function-item active" data-bind-target="class">5</button>
														</div>
													</div>
												</div>
											</div>
											<div class="talent-stats">
												<div class="talent-name">Brent Taylor</div>
												<div class="talent-info">
													<ul class="list-inline">
														<li class="text-bold">Height:</li>
														<li>5' 5"</li>
														<li class="text-bold">Weight:</li>
														<li>135 lbs.</li>
														<li class="text-bold">Age:</li>
														<li>20</li>
													</ul>
												</div>
												<div class="talent-agency">
													<ul class="list-inline">
														<li class="text-bold">Agency:</li>
														<li>Public Submission</li>
													</ul>
												</div>
												<div class="role-and-confirmation">
													<div class="talent-role">
														<ul class="list-inline">
															<li>Male Chef Host</li>
														</ul>
													</div>
													<div class="talent-confirmation-status">
														<div class="confirmation btn-group">
															<button class="btn btn-default btn-success btn-xs tip" data-original-title="Confirmed" data-confirm="confirmed"><i class="fa fa-check"></i> <span class="confirm-label">Confirmed</span></button>
															<button class="btn btn-default btn-xs tip" data-original-title="Declined" data-confirm="declined"><i class="fa fa-times"></i></button>
															<button class="btn btn-default btn-xs tip" data-original-title="Rescheduled" data-confirm="reschedule"><i class="fa fa-clock-o"></i></button>
														</div>
													</div>
													<div class="submission-note">
														<div class="">
															<label class="form-label">Submission Note:</label>
															<textarea class="form-control" disabled>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</textarea>
														</div>
													</div>
													<div class="casting-note">
														<div class="">
															<label class="form-label">Casting Note:</label>
															<textarea class="form-control" disabled>Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
														</div>
														<div class="margin-top-small float-right"><a href="#" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Add/Edit Casting Note</a></div>
													</div>
												</div>
											</div>
										</div>
										@endfor
										</div> {{-- role list body --}}
									</div> {{-- col-md-10 --}}
								</div>
								<div class="row-fluid clearfix time-item">
									<div class="col-md-2 time">9:30am</div>
									<div class="col-md-10 talent">test</div>
								</div>
								<div class="row-fluid clearfix time-item">
									<div class="col-md-2 time">9:40am</div>
									<div class="col-md-10 talent">test</div>
								</div>
								<div class="row-fluid clearfix time-item">
									<div class="col-md-2 time">9:50am</div>
									<div class="col-md-10 talent">test</div>
								</div>
								<div class="row-fluid clearfix time-item">
									<div class="col-md-2 time">9:60am</div>
									<div class="col-md-10 talent">test</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> {{-- call-back-audition-container --}}
		<div class="col-md-7 available-talent-container padding-left-zero">
			<div class="panel panel-dark margin-zero">
				<div class="panel-heading panel-heading-dark">
					<div class="display-block margin-bottom-normal">
						<div class="display-inline-block valign-middle"><h5 class="margin-zero"><b>Available Talent</b></h5></div>
						<div class="display-inline-block float-right">
							<div class="btn-group btn-group-sm">
								<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> Settings <i class="fa fa-caret-down"></i></button>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
								</ul>
							</div>
							<div class="btn-group btn-group-sm">
								<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"><i class="fa fa-outdent"></i> Change View <i class="fa fa-caret-down"></i></button>
								<ul class="dropdown-menu" id="scheduled-change-view-option-2">
									<li><a href="#" id="scheduled-photo-view-2">Photo View</a></li>
									<li><a href="#" id="scheduled-confirmation-view-2">Confirmation View</a></li>
									<li><a href="#" id="scheduled-submission-note-view-2">Submission Note View</a></li>
									<li><a href="#" id="scheduled-casting-note-view-2">Casting Note View</a></li>
									<li><a href="#" id="scheduled-list-view-2">List View</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="display-block">
						<div class="display-inline-block">
							<div class="btn-group btn-group-sm">
								<div class="form-group form-inline margin-zero">
									<label class="label-control text-white">Role</label>
									<select class="form-control input-xs">
										<option>All</option>
										<option>Female Chef Host</option>
										<option>Male Chef Host</option>
									</select>
								</div>
							</div>
						</div>
						<div class="display-inline-block">
							<div class="btn-group btn-group-sm margin-left-normal">
								<div class="form-group form-inline margin-zero">
									<label class="label-control text-white">Priority:</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="" value="option1" class="px"> <span class="lbl"><span class="text-white">1</span></span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="" value="option2" class="px"> <span class="lbl"><span class="text-white">2</span></span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="" value="option3" class="px"> <span class="lbl"><span class="text-white">3</span></span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="" value="option4" class="px"> <span class="lbl"><span class="text-white">4</span></span>
									</label>
									<label class="checkbox-inline">
										<input type="checkbox" id="" value="option5" class="px"> <span class="lbl"><span class="text-white">5</span></span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body padding-zero">
					<div class="schedule-notification"></div>
					<div class="panel-group" id="role-list-container">
						<div class="panel schedule-time-item">
							<div class="panel-heading role-list-header">
								<a class="accordion-toggle display-block" data-toggle="collapse" data-parent="#role-list-container" href="#role-list-1">
									<div class="display-inline-block"><span class="text-bold">Female Chef Host</span></div>
									<div class="text-default role-reference text-bold">Female / Principal / All Ethnicities / 18 - 45</div>
									<div class="text-default role-details">Female Host for Parody Cooking show. Experience in improve comedy, as a host and cooking is a plus but not required.</div>
								</a>
							</div>
							<div id="role-list-1" class="role-list-body panel-collapse in">
							@for ($i=0; $i < 8; $i++)
								{{-- README: Different classes for change view of talents (.talent-photo-view, .talent-confirmation-view, .submission-note-view, .casting-note-view, .list-view)--}}
								<div class="view-container talent-confirmation-view">
									<div class="image-like-list-container">
										<div class="image-holder">
											<img src="/../images/talents-sample-image.jpg" class="img-responsive">
										</div>
										<div class="talent-like-it-list-number margin-top-small">
											<div class="like-it-list-container">
												<div class="btn-group talent-function" data-bind-target="data-id" data-id="schedule-615535">
													<button class="btn btn-xs btn-danger rating-button function-item" data-bind-target="class">1</button>
													<button class="btn btn-xs btn-warning rating-button function-item" data-bind-target="class">2</button>
													<button class="btn btn-xs btn-info rating-button function-item" data-bind-target="class">3</button>
													<button class="btn btn-xs btn-primary rating-button function-item" data-bind-target="class">4</button>
													<button class="btn btn-xs btn-success rating-button function-item active" data-bind-target="class">5</button>
												</div>
											</div>
										</div>
									</div>
									<div class="talent-stats">
										<div class="talent-name">Brent Taylor</div>
										<div class="talent-info">
											<ul class="list-inline">
												<li class="text-bold">Height:</li>
												<li>5' 5"</li>
												<li class="text-bold">Weight:</li>
												<li>135 lbs.</li>
												<li class="text-bold">Age:</li>
												<li>20</li>
											</ul>
										</div>
										<div class="talent-agency">
											<ul class="list-inline">
												<li class="text-bold">Agency:</li>
												<li>Public Submission</li>
											</ul>
										</div>
										<div class="role-and-confirmation">
											<div class="talent-role">
												<ul class="list-inline">
													<li>Male Chef Host</li>
												</ul>
											</div>
											<div class="talent-confirmation-status">
												<div class="confirmation btn-group">
													<button class="btn btn-default btn-success btn-xs tip" data-original-title="Confirmed" data-confirm="confirmed"><i class="fa fa-check"></i> <span class="confirm-label">Confirmed</span></button>
													<button class="btn btn-default btn-xs tip" data-original-title="Declined" data-confirm="declined"><i class="fa fa-times"></i></button>
													<button class="btn btn-default btn-xs tip" data-original-title="Rescheduled" data-confirm="reschedule"><i class="fa fa-clock-o"></i></button>
												</div>
											</div>
											<div class="submission-note">
												<div class="">
													<label class="form-label">Submission Note:</label>
													<textarea class="form-control" disabled>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</textarea>
												</div>
											</div>
											<div class="casting-note">
												<div class="">
													<label class="form-label">Casting Note:</label>
													<textarea class="form-control" disabled>Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
												</div>
												<div class="margin-top-small float-right"><a href="#" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Add/Edit Casting Note</a></div>
											</div>
										</div>
									</div>
								</div>
							@endfor
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> {{-- available-talent-container --}}		
	</div>
</div>