@extends('layouts.project', ['pages' => [ [ 'name' => 'My Projects', 'url' => '/projects' ], [ 'name' => 'Quick Post', 'url' => '/projects/create', 'active' => true ] ] ])

@section('sidebar.page-header')
<i class="fa fa-bolt "></i> Quick Post
@stop

@section('project.body')
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12 alert alert-success">
				Don't have time to post your casting, we will post it for you. Just paste the info of the casting into the textbox below.
			</div>
		</div>
		<div class="row">
			<div class="panel">
				<div class="panel-body">
					<div class="container-fluid">
						<div class="row-fluid">
							<form id="booking-form">
								<div class="col-md-12">
								  <div class="form-group">
									<label for="exampleInputEmail1">Casting Name:</label>
									<input name="name" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-md-12">
									<label for="">Casting Details:</label>
								</div>
								<div class="col-md-12 margin-bottom-small">
									<textarea name="body" class="form-control" rows="5" style="resize:vertical;"></textarea>
								</div>
							</form>
							<div class="col-md-12">
								<button id="btn-send-to-booking" type="button" class="btn btn-success pull-right">Send to booking department</button>
							</div>

							<div id="success-div" class="col-md-12 hide">
								<p class="text-success text-right">Quick Post has been successfully submitted.</p>
							</div>


						</div> {{-- row-fluid --}}
					</div> {{-- container-fluid --}}
				</div> {{-- panel-body --}}
			</div> {{-- panel --}}
		</div>
	</div>
@stop

