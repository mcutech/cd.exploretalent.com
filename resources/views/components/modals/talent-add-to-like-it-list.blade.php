<!-- Modal -->
<div class="modal fade" id="add-like-it-list-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add to like it list</h4>
      </div>

      <div class="modal-body">
      <div class = "row alert alert-success">
      To add Talent to Like it List, Please choose which Project and Role you would want to Add the Talent
      </div>
        <div class="row">

          <div id="casting-div" class="col-md-6">
            <div class="form-group">
              <label for="">Casting Name</label>
				<select  id="casting-list" name="" data-select data-placeholder="Select Casting" class="form-control">
					<option data-bind-template="#casting-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name }) %>"></option>
				</select>
            </div>
          </div>

          <div id="role-div" class="col-md-6">
            <div class="form-group">
              <label for="">Role Name</label>
				<select  id="role-list" name="" data-select data-placeholder="Select Role" class="form-control">
					<option data-bind-template="#role-list" data-bind-value="bam_roles" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>"></option>
				</select>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button id="add-like-it-list-button" type="button" class="btn btn-primary">Add to like it list</button>
      </div>
    </div>
  </div>
</div>
