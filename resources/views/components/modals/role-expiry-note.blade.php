<div id="role-expiry-modal" class="modal fade modal-blur" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-medium">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Role Expired</h4>
			</div>
			<div class="modal-body">
				<div class="row-fluid clearfix">
					<form class="form-horizontal" role="form">
						<div class="form-group">
                            <div class="col-md-12">
			    			<label>
                        This role has already expired, you can't send invitations to talents for expired roles. Please extend the role's expiration date to send invitations.
                        <a class="text-danger" href="#" data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/edit">Click here to edit role.</a>
			    			</label>
                            </div>
			    			<div class="clearfix"></div>
			    		</div>
		    		</form>
				</div>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->

