
<div id="share-like-it-list" class="modal fade modal-blur" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-medium">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Share Like it List</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<form class="form-horizontal" role="form">
						<div class="form-group">
			    			<label class="control-label col-xs-12 col-sm-2">
			    				Share Link:
			    			</label>
			    			<div class="col-md-9">
								<input id="share-like-list-link" class="form-control"
						data-bind="<%=window.location.href.replace(window.location.pathname, '')%>/login?<%=$.param(data)%>&redirect=<%=encodeURIComponent(window.location.href.replace(/like-it-list/, ''))%>public-like-it-list"/>
			    			</div>
			    			<div class="clearfix"></div>
			    		</div>
		    		</form>
					<!-- <div class="col-md-2">
						<label for="">Share Link:</label>
					</div>
					<div class="col-md-10">
						<input id="share-like-list-link" class="form-control"
						data-bind="<%=window.location.href.replace(window.location.pathname, '')%>/login?<%=$.param(data)%>&redirect=<%=encodeURIComponent(window.location.href.replace(/like-it-list/, ''))%>public-like-it-list"/>
					</div> -->
				</div>

				<div class="row hide">
					<div class="col-md-10 col-md-offset-2 send-v-email">
						<label for="">or</label>
						<button type="button" id="send-via-email" class="btn-link">Send via Email</button>
					</div>
				</div>

				<div class="row margin-top-large" id="send-email-form" style="display: none;">
					<form class="form-horizontal" role="form">
			    		<div class="form-group">
			    			<label class="control-label col-xs-12 col-sm-2">
			    				Email:
			    			</label>
			    			<div class="col-md-9">
								<input type="text"  data-role="tagsinput" />
			    			</div>
			    			<div class="clearfix"></div>
			    		</div>
			    		<div class="form-group">
			    			<label class="control-label col-xs-12 col-sm-2">
			    				Message:
			    			</label>
			    			<div class="col-md-9">
			    				<textarea class="form-control" placeholder="Optional" rows="5"></textarea>
			    			</div>
			    			<div class="clearfix"></div>
			    		</div>
			    		<div class="col-md-offset-10 col-xs-offset-10">
			    			<button class="btn btn-success margin-right-large" type="button" class="btn btn-default">Send</button>
			    		</div>
				    </form>
				</div>

			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
