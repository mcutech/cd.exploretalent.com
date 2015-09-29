<div id="talent-photos-modal" class="modal fade modal-photos talent-photo-modal-wrapper" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Angelique Augustos's Photo</h4>
			</div>
			<div class="modal-body">
				<div class="photos-wrap text-center">
					<div class="row">
						<div id="talent-photos">
							<div data-bind-template="#talent-photos" data-bind-value="bam_talent_media2" class="col-md-3 margin-bottom-normal-medium image-container">
								<div class="photo-item">
									<div class="image-container">
										<img data-bind="https://etdownload.s3.amazonaws.com/<%= bam_media_path_full %>" class="img-responsive">
									</div>
								</div>
							</div>
						</div>
					</div>
			    </div>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
