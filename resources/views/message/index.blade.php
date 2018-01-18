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
            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message" data-bind-template="#personal-messages" data-bind-value="personal.data">
                <div class="show-conversation" data-bind="<%= id %>" data-bind-target="data-id" data-type="personal">
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
                    <div class="message-notification" data-bind="<%= unread_count > 0 ? 1 : 0 %>" data-bind-target="visibility">
                      <span data-bind="<%= unread_count %>">#</span> New Message/s
                    </div>
                    <div class="time-log" data-bind="<%= moment(updated_at).format('MM/DD/YYYY') %>">Date</div>
                    <div class="remove-talent" data-bind="<%= id %>" data-bind-target="data-id"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-8 message-content">
            <div class="messages-container">
              <div data-bind-target="visibility" data-bind="<%= loadingMessages ? 1 : 0 %>" hidden>
                <div class="alert alert-info text-align-center"><i class="fa fa-circle-o-notch fa-spin"></i> Loading messages...</div>
              </div>
              <div id="personal-inbox-messages" data-bind-target="visibility" data-bind="<%= loadingMessages ? 0 : 1 %>" hidden>
                <div data-bind-template="#personal-inbox-messages" data-bind-value="messages.personal.data">
                  <div data-bind="<%= mine ? 'user-message' : 'recepient-message' %>" data-bind-target="class">
                    <span data-bind="<%= body %>"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="message-box">
              <textarea class="form-control" rows="3" placeholder="Enter a Message..."></textarea>
            </div>
          </div>
        </div>

        <div class="row-fluid clearfix tab-pane" id="casting-invitations" role="tabpanel">
          <div class="col-sm-4 talents-list-content">
            <div class="talent-item-container" id="job-messages">
              <div class="talent-item new-message" data-bind-template="#job-messages" data-bind-value="job.data">
                <div class="show-conversation" data-bind="<%= id %>" data-bind-target="data-id" data-type="job">
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
                    <div class="message-notification" data-bind="<%= unread_count > 0 ? 1 : 0 %>" data-bind-target="visibility">
                      <span data-bind="<%= unread_count %>">#</span> New Message/s
                    </div>
                    <div class="time-log" data-bind="<%= moment(updated_at).format('MM/DD/YYYY') %>">Date</div>
                    <div class="remove-talent" data-bind="<%= id %>" data-bind-target="data-id"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-8 message-content">
            <div class="messages-container">
              <div id="job-inbox-messages">
                <div data-bind-template="#job-inbox-messages" data-bind-value="messages.job.data">
                  <div data-bind="<%= mine ? 'user-message' : 'recepient-message' %>" data-bind-target="class">
                    <span data-bind="<%= body %>"></span>
                  </div>
                </div>
              </div>
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
