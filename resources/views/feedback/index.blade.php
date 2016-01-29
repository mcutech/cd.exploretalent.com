@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Feedback', 'url' => '/feedback', 'active' => true] ] ])

@section('sidebar.page-header')
<i class="fa fa-comment page-header-icon"></i> Feedback
@stop

@section('sidebar.page-extra')
<div class="row">
	<hr class="visible-xs no-grid-gutter-h">
	<div class="pull-right col-xs-12 col-sm-auto">
		<a class="btn btn-primary btn-labeled" style="width: 100%;" data-toggle="modal" data-target="#add-feedback-modal">
			<span class="btn-label icon fa fa-plus"></span>Add Feedback
		</a>
	</div>
</div>
@stop

@section('sidebar.body')
	<div class="feedback-wrapper">
		<div class="panel-group panel-group-primary project-item" id="accordion-feedback">
			<div class="panel panel-dark">
				<div class="panel-heading panel-active">
					<a class="accordion-toggle collapsed" data-toggle="collapse" href="#feedback-1">
					<b>ID# 1456198</b>
					<span class="label label-success font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs pull-right">7:23AM 01-29-16</span></a>
				</div>
				<div id="feedback-1" class="panel-collapse collapse" aria-expanded="true">
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet ornare lorem. Donec vehicula tempor justo a venenatis. Suspendisse vehicula porta rhoncus. Ut accumsan massa in dui placerat pretium. Vivamus diam tellus, dapibus ut consequat eget, maximus vitae tortor. Ut maximus pellentesque molestie. In a risus elit. Proin eget sollicitudin libero, sed posuere eros. Ut vulputate, eros ut consequat porttitor, dui turpis cursus erat, quis gravida sem dui vel lectus. Sed augue sem, sagittis et condimentum vitae, ultricies in dui. Nullam ornare aliquam metus, in iaculis augue auctor nec. Vestibulum facilisis lacinia facilisis. In hac habitasse platea dictumst.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-group panel-group-primary project-item" id="accordion-feedback">
			<div class="panel panel-dark">
				<div class="panel-heading panel-active">
					<a class="accordion-toggle collapsed" data-toggle="collapse" href="#feedback-2">
					<b>ID# 12345678</b>
					<span class="label label-success font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs pull-right">9:18AM 02-01-16</span></a>
				</div>
				<div id="feedback-2" class="panel-collapse collapse" aria-expanded="true">
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet ornare lorem. Donec vehicula tempor justo a venenatis. Suspendisse vehicula porta rhoncus. Ut accumsan massa in dui placerat pretium. Vivamus diam tellus, dapibus ut consequat eget, maximus vitae tortor. Ut maximus pellentesque molestie. In a risus elit. Proin eget sollicitudin libero, sed posuere eros. Ut vulputate, eros ut consequat porttitor, dui turpis cursus erat, quis gravida sem dui vel lectus. Sed augue sem, sagittis et condimentum vitae, ultricies in dui. Nullam ornare aliquam metus, in iaculis augue auctor nec. Vestibulum facilisis lacinia facilisis. In hac habitasse platea dictumst.</p>
					</div>
				</div>
			</div>
		</div>
	</div> {{-- feedback-wrapper --}}
@include('feedback.modals.add-feedback')
@stop