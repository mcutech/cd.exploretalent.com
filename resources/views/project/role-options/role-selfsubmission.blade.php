<div class="self-submissions-wrapper self-submissions-talent-view-wrapper self-submissions-notes-view-wrapper">
	<div class="talents-search-filter-content">
		@parent
		<div class="row-fluid clearfix"> @include('components.talent-filter')

			<div id="self-submissions" class="col-md-9 talents-search-result">
				<div class="row-fluid clearfix top-results-heading margin-bottom-normal">
					<div class="col-md-6">
						<div id="like-it-list-div" class="panel margin-bottom-small">
							<div class="padding-normal" data-bind="<%= role.schedule_import ? 0 : 1 %>" data-bind-target="visibility">
								<h5 class="margin-top-zero display-inline-block margin-right-small"><span class="text-normal">Self Submissions for Role:</span> <span data-bind="<%= role.name %>"></span></h5>
								<button id="rate-all-button" class="btn btn-defaut">Add all to Like It List</button>
								<span class="text-primary"><a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/like-it-list" href="">You have <span data-bind="<%= role.likeitlist.total %>"></span> in your like it list.</a></span>
							</div>
							<div class="padding-normal" data-bind="<%= role.schedule_import ? 1 : 0 %>" data-bind-target="visibility">
								<span class="text-primary" data-bind="Adding <%= role.schedule_import ? role.schedule_import.count_done : 0 %> of <%= role.schedule_import ? role.schedule_import.count_total : 0 %> talents to Like It List. <%= role.schedule_import ? role.schedule_import.estimated_time : '' %>"></span>
							</div>
						</div>
					</div>
					<div class="col-md-6 padding-left-zero">
						<div class="float-right">
							<div id="self-submissions-pagination">
							</div>
						</div>
					</div>
				</div>
				<div id="loading-div">
					<div class="f_circleG" id="frotateG_01"></div>
					<div class="f_circleG" id="frotateG_02"></div>
					<div class="f_circleG" id="frotateG_03"></div>
					<div class="f_circleG" id="frotateG_04"></div>
					<div class="f_circleG" id="frotateG_05"></div>
					<div class="f_circleG" id="frotateG_06"></div>
					<div class="f_circleG" id="frotateG_07"></div>
					<div class="f_circleG" id="frotateG_08"></div>
				</div>
				<div class="row-fluid clearfix" id="self-submissions-results">
					@include('components.talent2', [ 'databind' => [ 'template' => '#self-submissions-results', 'value' => 'role.selfsubmissions.data' ], 'class' => 'col-lg-4 col-md-6 col-sm-6 col-xs-12', 'selfsubmission_message' => true ])
				</div>
			</div> {{-- talents-search-results --}}
		</div>
	</div>
</div>

@include('components.modals.share-like-it-list')
@include('components.modals.talent-message')
@include('components.modals.talent-photos')
@include('components.modals.talent-resume')
@include('components.modals.invite-to-audition')
@include('components.modals.talent-add-note')
@include('components.modals.talent-edit-note')
