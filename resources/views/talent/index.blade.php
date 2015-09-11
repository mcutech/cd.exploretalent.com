@extends('layouts.project')

@section('project.body')
	<ul class="breadcrumb breadcrumb-page">
		<li><a href="">Home</a></li>
		<li class="active">
			<a href=""> Browse Talents</a>
		</li>
	</ul>
	<div class="talents-wrapper">
		<div class="page-header">
			<div class="row">
				<h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
					<i class="fa fa-search"></i> Browse Talents
				</h1>
			</div>
		</div>
		<div class="talents-search-filter-content">
			<div class="row-fluid">
				<div class="col-md-3">
					<div class="panel panel-talents-search">
						<div class="panel-heading">
							<span class="panel-title">Refine Search</span>
							<div class="panel-heading-controls">
								<div class="panel-heading-icon"><i class="fa fa-chevron-left"></i></div>
							</div>
						</div>
						<div class="panel-body">
							<div class="location">
								<div class="panel panel-transparent no-margin-b">
									<div class="panel-heading no-padding-hr padding-bottom-zero-small">
										<div class="panel-title"><strong>Location</strong></div>
									</div>
									<div class="panel-body padding-normal no-border-hr no-padding-hr">
										<div class="tab-content no-padding-hr padding-top-zero-zz-lg no-padding-b">
											<div class="tab-pane fade active in">
												<label class="text-semibold">Enter Zip Code to Auto Select Markets</label>
												<div class="row">
													<div class="col-md-12">
														<div class="input-group">
															<input type="text" class="form-control" name="zip_code" placeholder="Enter Zip Code" id="zip-code" max="5" maxlength="5">
														</div>
													</div>
												</div>
											</div>
											
										</div> <!-- ./tab-content -->
									</div> <!-- ./panel-body -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
