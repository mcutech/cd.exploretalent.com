@extends('layouts.no-breadcrumb')

@section('sidebar.body')
  <div class="message2-content-wrapper">
    <div class="messages-header">
      <div class="messages-tabs">
        <ul class="nav nav-tabs" role="tablist">
          <li class="personal-message-menu active"><a href="#personal-message" aria-controls="settings" role="tab" data-toggle="tab">Messages</a></li>
          <li class="casting-invitation-menu"><a href="#casting-invitations" aria-controls="settings" role="tab" data-toggle="tab" id="casting-list">Requests</a></li>
        </ul>
      </div>
      <div class="casting-invitation-functions">
        <div class="form-horizontal">
          <div class="display-inline-block" >
            <div class="row" >
              <label class="control-label col-sm-5 padding-right-zero text-sm">Project:</label>
              <div class="col-sm-7 padding-right-zero">
                <select style="width: 200px" data-select class="form-control" id="projects-list">
                  <option></option>
                </select>
              </div>
            </div>
          </div>
          <div class="display-inline-block margin-left-large">
            <div class="row">
              <label class="control-label col-sm-5 padding-right-zero text-sm">Role:</label>
              <div class="col-sm-7 padding-right-zero">
                <select style="width: 200px" data-select class="form-control" id="roles-list">
                  <option></option>
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
              <div class="input-group">
                 <input class="form-control" placeholder="search">
                 <span class="input-group-btn">
                     <button class="btn btn-default">
                         <i class="fa fa-search"></i>
                     </button>
                 </span>
              </div>
            <div class="talent-item-container from">
              <div class="talent-item new-message" data-bind-template=".from" data-bind-value="data">
                  <div class="show-conversation" data-bind="<%= id %>" data-bind-target="data-id">
                  <div class="photo">
                    <div class="photo-holder">
                        <img class="img-item" data-bind="<%= photo %>"/>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                        <span data-bind="<%= name %>"><b></b></span>
                    </div>
                    <div class="location"></div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted" data-bind="<%= message %>">
                    </div>
                    <div class="time-log" data-bind="<%= created_at.fromNow() %>">06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>


          </div>

          <div class="col-sm-8 message-content">
              <div class="alert alert-success">
                  <div class="clearfix">
                      Seeking for regular looking people as commercial young models young and old, glamorous, sport, mature business, lifestyle, any and all aspiring models for video interview on hopes, dreams and aspirations of modelling hopefuls of all types. Whether you would like to make a few extra bucks as a side hustle or spend your life in the fashion industry, this show wants to get your point of view. Let's make this a great project. Looking forward to meeting and working with some great talent.
                  </div>
              </div>
                <div class="messages-container" id="to">
                    <div data-bind-template="#to" data-bind-value="messages">
                        <div class="message-time-log clearfix">
                            <div class="time-log text-center" data-bind="<%= created_at %>"></div>
                            <div data-bind="<%= (user_id == self.me) ? 'user-message' : 'recepient-message' %>" class="messages" data-bind-target="class">
                                <div class="message-body" data-bind="<%= body %>"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-group message-box clearfix" id="reply">
                    <form id="message-reply">
                        <input hidden class="id" data-bind="<%= id %>" name="conversationId" data-bind-target="value">
                        <input class="form-control message-box" name="body" placeholder="Enter a Message...">
                    </form>
                     <div class="input-group-btn">
                         <button class="btn btn-success reply" data-toggle="tooltip" data-placement="top" title="Send">
                             Send
                         </button>
                         <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Confirmed Invitation Invite">
                             <i class="fa fa-check"></i>
                         </button>
                         <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Declined Invitation Invite">
                             <i class="fa fa-times"></i>
                         </button>
                         <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Reschedule">
                             <i class="fa fa-edit"></i>
                         </button>
                         <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Set for a Callback">
                             <i class="fa fa-clock-o"></i>
                         </button>
                         <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Set for a Callback">
                             <i class="fa fa-thumbs-up"></i>
                         </button>
                     </div>
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
