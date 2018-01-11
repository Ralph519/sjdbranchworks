@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Create New Ticket </a>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-8 col-sm-offset-2 ">
              <div class="cardsmall">
                  <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
                      <i class="material-icons">note_add</i>
                      <!-- <h4 class="title">New User</h4>
                      <p class="category">user login details for SJD - Employee Self Service</p> -->
                  </div>
                  <div class="cardsmall-content">

                      <h4 class="title">New Ticket -
                        <small class="category">report a request for service</small>
                      </h4>

                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif

                      <form action="{{route('ticket-management.store')}}" method="post" >
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group label-floating">
                                <label for="branch" class="control-label">Branch</label>
                                    <select class="form-control" name="branch" required autofocus>
                                      <option value=""></option>
                                      @foreach($branches as $branch)
                                        @if (old('branch')==$branch->s_brnccode)
                                          <option value="{{ $branch->s_brnccode}}" selected>{{$branch->s_brnccode.' - '.$branch->s_brncname}}</option>
                                        @else
                                          <option value="{{ $branch->s_brnccode}}">{{$branch->s_brnccode.' - '.$branch->s_brncname}}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group label-floating">
                                  <label for="issuereported" class="control-label">Issue Type</label>
                                  <select class="form-control" name="issuereported" required>
                                      <option value=""></option>
                                      @foreach($issuetypes as $issuetype)
                                          @if (old('issuereported')==$issuetype->issuetype_code)
                                            <option value="{{ $issuetype->issuetype_code }}" selected>{{ $issuetype->issuetype_desc }}</option>
                                          @else
                                            <option value="{{ $issuetype->issuetype_code }}">{{ $issuetype->issuetype_desc }}</option>
                                          @endif
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div class="form-group label-floating">
                                    <label for="priority" class="control-label">Priority Level</label>
                                      <select class="form-control" name="priority" required>
                                        <option value=""></option>
                                        @if (old('priority')=="1")
                                          <option value="1">High</option>
                                        @else
                                          <option value="1">High</option>
                                        @endif

                                        @if (old('priority')=="2")
                                          <option value="2" selected>Medium</option>
                                        @else
                                          <option value="2">Medium</option>
                                        @endif

                                        @if (old('priority')=="3")
                                          <option value="3" selected>Low</option>
                                        @else
                                          <option value="3">Low</option>
                                        @endif
                                      </select>
                                    </div>
                                  </div>
                            </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group label-floating">
                                  <label for="subject" class="control-label">Ticket Subject</label>
                                  <input type="text" class="form-control" id="subject" name="subject" maxlength="80" required>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-ticket"></i>Ticket Description</label>
                                  <textarea rows="5" class="form-control" id="ticketdesc" name="ticketdesc" required></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6 pull-left">
                              <div class="form-group label-floating">
                                <label for="usertype" class="control-label">Assign To</label>
                                <select class="form-control" name="assignto" id="assignto">
                                  <option value=""></option>
                                  @foreach($supports as $support)
                                      <option value="{{$support->loginname}}">{{$support->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6 pull-right">
                              <button type="submit" class="btn btn-primary pull-right">Create New Ticket</button>
                              <div class="clearfix"></div>
                              {{csrf_field()}}
                            </div>
                          </div>
                        </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
