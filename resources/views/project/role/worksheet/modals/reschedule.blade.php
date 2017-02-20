<div id="reschedule-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Reschedule</h4>
			</div>
			<div class="modal-body">
				<div class="row form-horizontal">
					<div class="col-md-12">
						<label class="control-label col-md-4">Select New Date: </label>
						<div class="col-md-8">
							<div class="input-group date">
								<input id="reschedule-date" type="text" class="form-control" placeholder="date" data-date-picker data-date-format="yy-mm-dd" name="when" data-bind="<%= date.formatYMD(when) %>" name="when" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-align-right">
						<button class="btn btn-primary" type="submit" id="reschedule-button" data-dismiss="modal">Reschedule</button>
					</div>
				</div>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
