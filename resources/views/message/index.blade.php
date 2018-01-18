@extends('layouts.no-breadcrumb')

@section('sidebar.body')
<div class="message2-content-wrapper">
    <div class="messages-header">
        <div class="messages-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="personal-message-menu active"><a href="#personal-message" aria-controls="settings" role="tab" data-toggle="tab">Personal Message</a></li>
                <li class="casting-invitation-menu"><a href="#casting-invitations" aria-controls="settings" role="tab" data-toggle="tab" id="casting-list">Casting Invitations</a></li>
            </ul>
        </div>
        <div class="message-functions">
            <div class="btn-group">
                <button type="button" class="btn btn-outline dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></button>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-times"></i> Remove from messages</a></li>
                    <li><a href="#"><i class="fa fa-ban"></i> Report Abuse</a></li>
                </ul>
            </div>
        </div>
        <div class="personal-message-functions">
            <div class="btn-container">
                <button type="button" class="btn btn-outline" data-toggle="modal" data-target="#add-like-it-list-modal"><i class="fa fa-plus"></i> Add to Like it List</button>
            </div>
        </div>
        <div class="casting-invitation-functions hidden">
            <div class="form-horizontal">
                <div class="display-inline-block" >
                    <div class="row" >
                        <label class="control-label col-sm-5 padding-right-zero text-sm">Project:</label>
                        <div class="col-sm-7 padding-right-zero">
                            <select style="width: 200px" data-select class="form-control" id="projects-list">
                              <option data-bind-template="#projects-list" data-bind-value="data" data-bind="<%= JSON.stringify({key : casting_id, value : name}) %>"></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="display-inline-block margin-left-large">
                    <div class="row">
                        <label class="control-label col-sm-5 padding-right-zero text-sm">Role:</label>
                        <div class="col-sm-7 padding-right-zero">
                            <select style="width: 200px" data-select class="form-control" id="roles-list">
                              <option data-bind-template="#roles-list" data-bind-value="data" data-bind="<%= JSON.stringify({key : role_id, value : name}) %>"></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default margin-zero inbox-container" id="messages-panel">
        <div class="panel-body padding-zero tab-content">
            <div class="row-fluid clearfix tab-pane active" id="personal-message" role="tabpanel">
                <div class="col-sm-4 talents-list-content">
                    <div class="search-talent-container">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for talent...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="talent-item-container" id="personal-messages">
                        <div class="talent-item new-message" data-bind-template="#personal-messages" data-bind-value="personal.data">
                            <div class="photo">
                                <div class="photo-holder">
                                  <i class="img-item" data-bind="background-image: url(<%= pic %>);" data-bind-target="style"></i>
                                </div>
                            </div>
                            <div class="message-info">
                                <div class="name-and-age">
                                  <b data-bind="<%= name %>">Name</b>
                                </div>
                                <div class="location" data-bind="<%= location %>">Location</div>
                                <div class="project text-muted">
                                </div>
                                <div class="role text-muted">
                                </div>
                                <div class="message-notification" data-bind="<%= unread_count > 0 %>" data-bind-target="visibility">
                                  <span data-bind="<%= unread_count %>">#</span> New Message/s
                                </div>
                                <div class="time-log" data-bind="<%= moment(updated_at).format('MM/DD/YYYY') %>">Date</div>
                                <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 message-content">
                    <div class="messages-container">
                        <div class="user-message">I would like to Invite you to become as the batman baby role,  I am very excited to be a part of your project.</div>
                        <div class="recepient-message">Hello Casting Director I am Jake Zyrus a Talent on Explore Talent.</div>
                        <div class="recepient-message">Okay Thank you very much.</div>
                        <div class="user-message">Great your hired!.</div>
                        <div class="user-message">You will start starting monday, September 1, 2030</div>
                        <div class="recepient-message">Really? Thank You, I can't wait until 2030</div>
                        <div class="user-message">Good, Prepare yourself and Practice</div>
                        <div class="user-message">and Don't forget to Take a bath</div>
                        <div class="recepient-message">Thank you, I will take note of that</div>
                        <div class="user-message">Very Good Then, See you in 2030</div>
                        <div class="user-message">I am so glad I finally found someone for the role</div>
                        <div class="user-message">You are perfect</div>
                    </div>

                    <div class="message-box">
                        <textarea class="form-control" rows="3" placeholder="Enter a Message..."></textarea>
                    </div>
                </div>
            </div>

            <div class="row-fluid clearfix tab-pane" id="casting-invitations" role="tabpanel">
                <div class="col-sm-4 talents-list-content">
                    <div class="search-talent-container">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for talent...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="talent-item-container" id="personal-messages">
                        <div class="talent-item new-message" data-bind-template="#personal-messages" data-bind-value="personal.data">
                            <div class="photo">
                                <div class="photo-holder">
                                  <i class="img-item" data-bind="background-image: url(<%= pic %>);" data-bind-target="style"></i>
                                </div>
                            </div>
                            <div class="message-info">
                                <div class="name-and-age">
                                  <b data-bind="<%= name %>">Name</b>
                                </div>
                                <div class="location" data-bind="<%= location %>">Location</div>
                                <div class="project text-muted">
                                </div>
                                <div class="role text-muted">
                                </div>
                                <div class="message-notification" data-bind="<%= unread_count > 0 %>" data-bind-target="visibility">
                                  <span data-bind="<%= unread_count %>">#</span> New Message/s
                                </div>
                                <div class="time-log" data-bind="<%= moment(updated_at).format('MM/DD/YYYY') %>">Date</div>
                                <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 message-content">
                    <div class="messages-container">
                        <div class="user-message">I would like to Invite you to become as the batman baby role,  I am very excited to be a part of your project.</div>
                        <div class="recepient-message">Hello Casting Director I am Jake Zyrus a Talent on Explore Talent.</div>
                        <div class="recepient-message">Okay Thank you very much.</div>
                        <div class="user-message">Great your hired!.</div>
                        <div class="user-message">You will start starting monday, September 1, 2030</div>
                        <div class="recepient-message">Really? Thank You, I can't wait until 2030</div>
                        <div class="user-message">Good, Prepare yourself and Practice</div>
                        <div class="user-message">and Don't forget to Take a bath</div>
                        <div class="recepient-message">Thank you, I will take note of that</div>
                        <div class="user-message">Very Good Then, See you in 2030</div>
                        <div class="user-message">I am so glad I finally found someone for the role</div>
                        <div class="user-message">You are perfect</div>
                    </div>

                    <div class="message-box">
                        <textarea class="form-control" rows="3" placeholder="Enter a Message..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="talents-content">
    @include('components.modals.talent-add-to-like-it-list')
</div>
@stop
