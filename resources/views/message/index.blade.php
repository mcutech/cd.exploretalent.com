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
              <div class="input-group">
                 <input class="form-control" placeholder="search">
                 <span class="input-group-btn">
                     <button class="btn btn-default">
                         <i class="fa fa-search"></i>
                     </button>
                 </span>
              </div>

            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro, 21</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">Casting : <span>Looking for the next Darna</span>
                    </div>
                    <div class="role text-muted">Role : <span>Darna</span>
                    </div>
                    <div class="time-log" >06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted">
                    </div>
                    <div class="time-log" >06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted">
                    </div>
                    <div class="time-log" >06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted">
                    </div>
                    <div class="time-log" >06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted">
                    </div>
                    <div class="time-log" >06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted">
                    </div>
                    <div class="time-log" >06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted">
                    </div>
                    <div class="time-log" >06/12/19</div>
                    <div class="remove-talent"><span class="text-label">Remove from messaging</span><i class="fa fa-times-circle fa-lg"></i></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="talent-item-container" id="personal-messages">
              <div class="talent-item new-message">
                <div class="show-conversation">
                  <div class="photo">
                    <div class="photo-holder">
                      <i class="img-item" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRD4jAvtHHrOAum617wZr5TxdjiFO11a243ntLOtI6LUCRHCCz') "></i>
                    </div>
                  </div>
                  <div class="message-info">
                    <div class="name-and-age">
                      <b>Aya Pro</b>
                    </div>
                    <div class="location">Los Angeles , CA</div>
                    <div class="project text-muted">
                    </div>
                    <div class="role text-muted">
                    </div>
                    <div class="time-log" >06/12/19</div>
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
                <div class="messages-container">
                    <div class="message-time-log clearfix">
                        <div class="time-log text-center">June 6, 2019 - 6:30 PM</div>
                        <div class="recepient-message">Hello Im interested how do I apply?</div>
                        <div class="user-message">Just follow the instructions on the invite</div>
                    </div>
                    <div class="message-time-log clearfix">
                        <div class="time-log text-center">Yesterday - 1:23 PM</div>
                        <div class="recepient-message">Great! How long I have to wait?</div>
                        <div class="recepient-message">Great! How long I have to wait?</div>
                        <div class="recepient-message">Great! How long I have to wait?</div>
                    </div>
                    <div class="message-time-log clearfix">
                        <div class="time-log text-center">Yesterday - 3:23 PM</div>
                        <div class="recepient-message">Great! How long I have to wait?</div>
                        <div class="recepient-message">Great! How long I have to wait?</div>
                        <div class="recepient-message">Great! How long I have to wait?</div>
                        <div class="user-message">Hi will contact you later.</div>
                    </div>
                    <div class="message-time-log clearfix">
                        <div class="time-log text-center">Today - 3:23 PM</div>
                        <div class="user-message">Hi congratulations you have chosen to get the role for Darna</div>
                        <div class="user-message">So how are feeling?</div>
                        <div class="recepient-message">Really, Im so glad to hear that</div>
                        <div class="recepient-message">I will do my best for this role, thank you so much for the oppurtunity!</div>
                        <div class="user-message">Woow thats great! Looking forward to see you on set.</div>
                    </div>
                </div>

                <div class="input-group message-box clearfix">
                  <input class="form-control" placeholder="Enter a Message...">
                     <span class="input-group-btn">
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
                     </span>
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
