
@extends('layouts.unsubscribe-header')

@section('sidebar.page-header')
 <i class="fa fa-envelope-o" aria-hidden="true"></i> Unsubscribe Email
@stop

@section('sidebar.body')

<div>
	<label>
		<input type="checkbox" id="emailchck" value="1" name="chckbox"> I would like to stop receiving emails from exploretalent.com
		<br>
		<input type="checkbox" id="smschck" value="1" name="chckbox"> I would like to stop receiving SMS from exploretalent.com
	</label>
</div>

<div>
	<button class="btn btn-default" id="savebtn"> Save Changes </button>
	<button class="btn btn-default" id="cancelbtn"> Cancel </button>
@stop
