<div id="add-feedback-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="fa fa-comment"></i> Add Feedback</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Message:</label>
							<textarea id="feedback-message" class="form-control" rows="5" data-validate="required" data-validate-error="This is a required field."></textarea>
						</div>
						<input type="file" id="upload-file-name" name="upload-file-name" />
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-align-right">
						<button class="btn btn-primary" type="submit" id="add-feedback-btn"><i class="fa fa-plus"></i> Add Feedback</button>
					</div>
				</div>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
