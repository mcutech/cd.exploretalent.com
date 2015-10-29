@extends('layouts.sidebar', [ 'pages' => [ [ 'name' => 'Browse Talents', 'url' => '/messages', 'active' => true] ] ])
@section('sidebar.page-header')
 Messaging Center 
@stop
@section('sidebar.body')

<!-- <div id="message-body"  class="row">
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
<input type="hidden" id="current-conversation"/> -->
<div class="message-wrapper">
	<div class="panel">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<label>Select Project:</label> 
					<div class="btn-group">
						<span class="btn dropdown-toggle" type="button" data-toggle="dropdown">
						Select Projects &nbsp;<i class="fa fa-caret-down"></i></span>
						<ul class="dropdown-menu">
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<label> Select Role:</label>
					<div class="btn-group">
						<span class="btn dropdown-toggle" type="button" data-toggle="dropdown">
						Select Projects &nbsp;<i class="fa fa-caret-down"></i></span>
						<ul class="dropdown-menu">
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
							<li><a href="#"></a></li>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</div>

	<div id="message-body"  class="row message-body-wrapper">
		<div id="conversations" class="col-sm-4">
			<?php for($i=0; $i<5; $i++) { ?>
			<div class="panel margin-zero border-bottom-width-zero">
				<div class="panel-body msg-conversation-list">
					<div class="image-convo">
						<div class="col-md-4">
							<img src="http://i.ebayimg.com/00/s/NTAwWDUwMA==/z/3F0AAOxyaTxTVkPs/$_3.JPG?set_id=2">
						</div>
						<div class="col-md-8">
						<label class="margin-top-normal">Robert Patinson</label>
						<p class="">2 hours Ago</p>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
		<div class="col-md-8" id="" >
			<div class="row bg-primary">
				<div class="heading-image">
					<div clss="col-md-3">
						<span class="title-heading"><img src="http://i.ebayimg.com/00/s/NTAwWDUwMA==/z/3F0AAOxyaTxTVkPs/$_3.JPG?set_id=2"></span>
						<label>John Smith</label>
						<i><span>Los, Angeles</span></i>
					</div>
				</div>
			</div>
		</div>
		<div id="messages" class="col-md-8" style="height:500px; overflow-y:scroll;">
			
			<?php for ($i=0;$i<10; $i++) { ?>
			<div class="panel-body conversation-box">
				<div class="row"> 
					<div class="message-name col-md-6">
						<label>John Smith</label>
					</div>
					<div class="message-time">
						<span class""><i class="fa fa-clock-o"></i> 2 hours Ago</span>	
					</div>
				</div>	
				<div class="message-content">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				</div>
			</div>
			<?php } ?>
		</div>
			
		<div class="input-group col-md-8 " id="message-input" >
			<textarea id="message-text" row="3"
			class="form-control chatText" placeholder="Enter your message...."></textarea>
			<span class="input-group-btn">
				<button id="send-btn" class="btn btn-flat margin-left-normal btn-xs" type="button">Send</button>
			</span>
		</div>
	</div>

@stop

<!-- <div data-bind-template="#messages" data-bind-value="data">
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
			</div> -->