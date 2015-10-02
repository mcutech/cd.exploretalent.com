<div id="talent-add-note-modal" class="modal fade talent-add-note-wrapper" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Add Casting Note</h4>
			</div>
			<div class="modal-body">
				<div class="row-fluid clearfix margin-bottom-small">
					<div class="col-md-12 text-align-left padding-zero">
						<div class="display-inline text-bold"><span id="cd-full-name-span" data-bind="<%= bam_cd_user.getFullName() %>"></span></div>
					</div>
				</div>

				<textarea class="form-control talent-note-body" rows="7" placeholder="Enter Note for this talent..." style="resize: none;"></textarea>

				<div id="utility-buttons" class="row-fluid clearfix margin-top-small">
					<div class="col-md-12 padding-zero">
						<a href="#" class="add-note-for-talent btn btn-success btn-lg" data-bind="add-note_<%= id %>" data-bind-target="id">Add Note</a>
						<span class="note-saved-success text-success margin-left-small display-none">Note has been saved.</span>
						<span class="note-required text-danger margin-left-small display-none">This field is required.</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</div> <!-- / .modal -->