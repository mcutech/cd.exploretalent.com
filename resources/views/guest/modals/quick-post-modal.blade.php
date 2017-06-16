<div class="modal fade" id="quick-post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Quick Post</h4>
      </div>
      <form id="quick-post">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 margin-bottom-normal">
            <div class="form-group">
              <label for="">Project Name</label>
              <input type="text" name="name"  class="form-control input-sm" autofocus data-required>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12 margin-bottom-normal">
            <div class="form-group">
             <strong>Enter the description or casting or a job</strong>
              
        
              <p class="help-block">
              (Please enter as much information as you can on your project including role details, you must include your name, contact information and email, we will contact you with your contact information when we post it on our website. Thank You!)
              </p>
          
              <textarea name="body" style="resize:none" class="form-control" id ="desc" rows="8"></textarea>
            </div>
         </div>
      </div>

        </div>
      </div>
      </form>
      <div class="modal-footer">
       <div id="success-div" class="col-md-4 text-left hide">
          <span class="alert alert-success padding-small">Post Submitted!</span>
      </div>
        <button id="send-casting" type="button" class="btn btn-primary">Send Casting</button>

      </div>


    </div>
  </div>
</div>