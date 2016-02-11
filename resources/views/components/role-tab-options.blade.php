<div class="row-fluid clearfix">
	<div class="col-md-12">
		<ul id="submissions-sub-menu" class="nav nav-tabs negate-padding border-zero">
			<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs matches-link">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/matches">Matches</a>
			</li>
			<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs self-submissions-link">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/self-submissions">Self Submissions 
					<span id="self-submissions-counter" class="label label-danger"></span>
				</a>
			</li>
			<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs like-it-list-link hide">
				<a data-bind="/projects/<%= casting_id %>/roles/<%= role.role_id %>/like-it-list" href="">Like It List</a>
			</li>
			<li role="presentation" class="font-size-small-normal-zz font-size-small-normal-xs auditions-worksheet-link hide">
				<a data-bind="/audition-worksheet" href="">Audition Worksheet</a>
			</li>
			<a id="view-like-it-list-btn" data-bind="/projects/<%= casting_id
			%>/roles/<%= role.role_id %>/like-it-list" class="btn btn-success
			pull-right hide ">View Like it List & Contact Talent (<span data-bind="<%= role.likeitlist.total %>"></span>)</a>
			<div id="utility-buttons-div" class="text-align-right hide">
				<a data-toggle="modal" data-target="#share-like-it-list" class="btn btn-primary">Share Like It List</a>
				<a id="invitetoauditionbutton" data-toggle="modal" data-target="#invite-to-audition-modal" class="btn btn-success"><i class="fa fa-envelope-o"></i> Invite to Audition</a>
			</div>
			<div id="invitetoaudition-text" class="text-right margin-top-small"></div>
		</ul>
	</div>
	{{-- <div class="col-md-5">
		<div class="form-group margin-bottom-zero row-fluid">
			<label for="select-role" class="col-md-3 margin-top-small control-label text-align-right">
				Select Role
			</label>
			<div class="col-md-9 padding-left-zero">
				<select id="roles-list" class="form-control">
					<option data-bind-template="#roles-list" data-bind-value="bam_roles" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>"></option>
				</select>
			</div>
		</div>
	</div> --}}
	<div class="col-md-12">
		<div class="margin-bottom-normal padding-bottom-normal bordered no-border-hr no-border-t"></div>
	</div>
	<div id="check-and-remove-all-div" class="col-md-12 hide">
		<button id="check-all-likeitlist" class="btn btn-default">Check All</button>
		<button id="remove-all-checked-likeitlist" class="btn btn-default">Remove all Checked</button>
		<button id="remove-all-likeitlist" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Remove All</button>
	</div>
</div>