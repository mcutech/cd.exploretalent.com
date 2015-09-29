@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Browse Talents', 'url' => '/messages', 'active' => true] ] ])

@section('sidebar.body')

<div id="message-body"  class="row">
	<div id="conversations" class="col-sm-4">
		<div data-bind-template="#conversations" class="conversation"
		data-bind-value="data" data-bind="<%= id %>"
		data-bind-target="data-id" style="cursor:pointer;">
			<img class='message-pic' style="width:20%; height:100px; min-width:75px;" data-bind="<%=
			getOtherUser() ? getOtherUser().bam_talentci.getPrimaryPhoto() :
			'no photo to show'  %>" alt="no picture" />
			<span data-bind="<%= id %>"></span>
			<b><span data-bind="<%= getOtherUser() ?
				getOtherUser().bam_talentci.getFullName() : 'other user'
				%>"></span></b>
			<span data-bind="<%= created_at %>"></span>
		</div>
	</div>

	<div id="messages" class="col-md-8" style="height:500px; overflow-y:scroll;">
		<div data-bind-template="#messages" data-bind-value="data">
			<div id="message-list" data-bind="message-list-<%= id %>"
			data-bind-target="class" class="message-list" style="display:none">
				<div data-bind-template="#message-list"
				data-bind-value="messages" >
					<img data-bind="<%= user.bam_talentci ?
					user.bam_talentci.getPrimaryPhoto() : 'no photo' %>"  />
					<span data-bind="<%= user.bam_cd_user ?
					user.bam_cd_user.getFullName()
					: user.bam_talentci.getFullName() %>:"></span>
					<span data-bind="<%= body %>"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="input-group col-md-8 " id="message-input" >
		<textarea id="message-text" row="3"
		class="form-control chatText" placeholder="Enter your message...."></textarea>
		<span class="input-group-btn">
			<button id="send-btn" class="btn btn-flat margin-left-normal btn-xs" type="button">Send</button>
		</span>
	</div>
</div>
<input type="hidden" id="current-conversation"/>
@stop

