@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Quick Post', 'url' => '/project/quickpost', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-bolt "></i> Quick Post
@stop

@section('sidebar.body')
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12 alert alert-success">
				Don't have time to post your casting? We will post it for you.
				Just paste the general project description, submission deadline, role information and criteria into the textbox below.
				<p>Please allow 24-48 business hours for the review.</p>
			</div>

		</div>
		<div class="row">
			<div class="panel">
				<div class="panel-body">
					<div class="container-fluid">
						<div class="row-fluid">
							<form id="booking-form">
								<div class="col-md-12">
								  <div class="form-group" id="name-error">
									<label for="exampleInputEmail1">Casting Name:</label>
									<input name="name" class="form-control" placeholder="" required>
								  </div>
								</div>
								<div class="col-md-12">
									<label for="">Casting Details:</label>
								</div>
								<div class="col-md-12 margin-bottom-small" id="body-error">
									<textarea name="body" class="form-control" rows="5" style="resize:vertical;" required></textarea>
								</div>
								<div class="col-md-12">
									<button id="btn-send-to-booking" type="submit" class="btn btn-success pull-right">Send to booking department</button>
								</div>
							</form>

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

