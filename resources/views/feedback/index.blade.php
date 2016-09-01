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
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <span>At Exploretalent, we value our customers and appreciate your feedback. We want to hear from you if you have comments or suggestions as to how we can improve our service. If you have a complaint or feedback, please let us know by clicking on the Add Feedback button at the top of this page. We'll do what we can to cater to your needs.</span>
	</div>
	<div id="all-feedbacks-div" class="feedback-wrapper">
		<div class="panel-group panel-group-primary project-item" data-bind="accordion-feedback-<%= id %>" data-bind-target="id" data-bind-template="#all-feedbacks-div" data-bind-value="data">
			<div class="panel">
				<div class="panel-heading panel-active">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-bind="#feedback_<%= id %>">
						<b><span data-bind="Left feedback on <%= moment(created_at).format('MMMM DD, YYYY, hh:MM:SS a') %>"></span></b>
						{{-- <span class="label label-success font-size-small-normal-zz padding-small-zz margin-top-small-zz-xs pull-right" data-bind="<%= date.formatDateTime(created_at) %>"></span> --}}
					</a>
				</div>
				<div data-bind="feedback_<%= id %>" data-bind-target="id" class="panel-collapse collapse" aria-expanded="true">
					<div class="panel-body">
						<p data-bind="<%= body %>"></p>
						<label class="text-success" data-bind="<%= (attachment) ? 1 : 0 %>" data-bind-target="visibility">Attached (1) file</label>
						{{-- <p data-bind="https://etdownload.s3.amazonaws.com/<%= attachment_path_full %>"></p> --}}
					</div>
				</div>
			</div>
		</div>
	</div> {{-- feedback-wrapper --}}
@include('feedback.modals.add-feedback')
@stop
