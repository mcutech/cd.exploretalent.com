@extends('layouts.unsubscribe-header')

@section('sidebar.body')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<label for="">Unsubscribe</label>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<div id="talent-email">
					<label for=""><i class="fa fa-envelope-o " aria-hidden="true"></i> Unsubscribe all Emails:</label> <span data-bind="<%= email %>"></span>
				</div>
				<div class="col-md-12 checkbox" id="unsubscribe-emails">
					<div>
						<label>
							<input type="checkbox" id="emailchck"  name="chckbox" data-bind="<%= email %>"> I would like to stop receiving emails from exploretalent.com
						</label>
					</div>
					<div>
						<label>
							<input type="checkbox" id="smschck" name="chckbox" data-bind="<%= sms %>"> I would like to stop receiving SMS from exploretalent.com
						</label>
					</div>
				</div>
				<div class="margin-bottom-small"><strong>OR</strong></div>
				<div>
					<label for=""></i> Select which Emails to turn off:</label>
				</div>
				<div class="col-md-12 checkbox" id="notifications">
					<div>
						<label>
							<input type="checkbox" id="talentReply" value="1" data-bind="<%= data[0].value %>" > Send me an Email when a talent replies.
						</label>
					</div>
					<div>
						<label>
							<input type="checkbox" id="talentSubmit" value="1" data-bind="<%= data[1].value%>"> Send me an Email when a talent submits to a casting.
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-12 panel-footer margin-top-small">
				<button class="btn btn-success" id="savebtn"> Save Changes </button>
				<button class="btn btn-danger" id="cancelbtn"> Cancel </button>
			</div>
		</div>
	</div>
@stop
