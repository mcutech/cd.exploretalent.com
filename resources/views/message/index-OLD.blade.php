@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Messages', 'url' => '/messages', 'active' => true] ] ])

@section('sidebar.page-header')
 Messaging Center
@stop

@section('sidebar.body')
<div class="message-wrapper">
	<div class="panel">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<label>Select Project: </label>
					<div class="btn-group">
						<select id="projects-list" class="form-control">
							<option value="" data-bind-template="#projects-list" data-bind-value="data" data-bind="<%= JSON.stringify({ key : casting_id, value : name }) %>">Select Project</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<label> Select Role:</label>
					<div class="btn-group">
						<select id="roles-list" class="form-control">
							<option value="" data-bind-template="#roles-list" data-bind-value="bam_roles" data-bind="<%= JSON.stringify({ key : role_id, value : name }) %>">Select Role</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="message-body"  class="row message-body-wrapper">
		<div id="conversations-list" class="col-sm-4">
			<div data-bind-template="#conversations-list" data-bind-value="data" class="panel margin-zero border-bottom-width-zero">
				<a href="#" class="conversation-item" data-bind="<%= conversation.id %>" data-bind-target="data-id">
					<div class="panel-body msg-conversation-list">
						<div class="image-convo">
							<div class="col-md-4">
								<img data-bind="<%= conversation.talent.bam_talentci.getPrimaryPhoto() %>" />
							</div>
							<div class="col-md-8">
								<label class="margin-top-small"><span data-bind="<%= conversation.talent.bam_talentci.getFullName() %>"></span></label>
								<p class=""><span data-bind="<%= _.last(conversation.messages) ? _.last(conversation.messages).body.substring(0, 30) + (_.last(conversation.messages).body.length > 30 ? '...' : '') : '' %>"></span></p>
								<p class=""><span data-bind="<%= _.last(conversation.messages) ? _.last(conversation.messages).created_at : '' %>"></span></p>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div id="messages-container" class="col-md-8" >
			<div class="row bg-primary">
				<div class="heading-image">
					<div clss="col-md-3">
						<span class="title-heading"><img data-bind="<%= conversation.talent.bam_talentci.getPrimaryPhoto() %>"></span>
						<label><span data-bind="<%= conversation.talent.bam_talentci.getFullName() %>"></span></label>
						<i><span data-bind="<%= conversation.talent.bam_talentci.city %>"></span></i>
					</div>
				</div>
			</div>
			<div id="messages" style="height:500px; overflow-y:scroll;" class="row">
				<div data-bind-template="#messages" data-bind-value="conversation.messages" class="panel-body conversation-box">
					<div class="row">
						<div class="message-name col-md-6">
							<label><span data-bind="<%= user.bam_talentci ? user.bam_talentci.getFullName() : user.bam_cd_user.getFullName() %>"></span></label>
						</div>
						<div class="message-time">
							<span class""><i class="fa fa-clock-o"></i> <span data-bind="<%= created_at %>"></span></span>
						</div>
					</div>
					<div class="message-content">
						<p data-bind="<%= body %>"></p>
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
	</div>

@stop

