<div id="talent-edit-note-modal" class="modal fade talent-add-note-wrapper" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit Casting Note</h4>
			</div>
			<div class="modal-body">
				<div class="row-fluid clearfix margin-bottom-small">
					<div class="col-md-6 text-align-left padding-zero">
					</div>
					<div class="col-md-6 text-align-right padding-zero">
						<span class="text-light-gray"><i class="fa fa-clock-o"><em><span id="note-created-at" data-bind="<%= created_at %>"></span></em></i></span>
					</div>
				</div>

				<textarea id="edit-note-body" data-bind="<%= body %>" class="form-control talent-note-body-edit" rows="7" placeholder="Enter Note for this talent..." style="resize: none;"></textarea>

				<div id="note-utility" class="row-fluid clearfix margin-top-small">
					<div class="col-md-12 padding-zero">
						<button id="edit-note-btn" class="edit-note-for-talent btn btn-success btn-lg">Update</button>
						<span id="edit-note-success" class="note-saved-success text-success margin-left-small display-none">Note has been updated.</span>
						<span id="edit-note-required" class="note-required text-danger margin-left-small display-none">This field is required.</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</div> <!-- / .modal -->
