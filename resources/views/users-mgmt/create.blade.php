@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Create New user </a>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-6  ">
              <div class="cardsmall">
                  <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
                      <i class="material-icons">face</i>
                      <!-- <h4 class="title">New User</h4>
                      <p class="category">user login details for SJD - Employee Self Service</p> -->
                  </div>
                  <div class="cardsmall-content">

                      <h4 class="title">New User -
                        <small class="category">user login details</small>
                      </h4>

                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif

                      <form action="{{route('user-management.store')}}" method="post" >
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group label-floating">
                                      <label class="control-label">Select Employee</label>
                                      <!--<input type="text" class="form-control" id="empno" name="empno" required autofocus> -->
                                      <select name="employee" id="employee" class="form-control" type="text" required autofocus>
                                          <option value="" disabled selected></option>
                                          @foreach ($employees as $employee)
                                            @if(old('employee')==$employee['s_lastname'].', '.$employee['s_frstname'].' '.substr($employee['s_middname'],1,1).'. - '.$employee['s_employid'])
                                              <option value="{{ $employee['s_lastname'].', '.$employee['s_frstname'].' '.substr($employee['s_middname'],1,1).'. - '.$employee['s_employid'] }}" class="form-control" selected>
                                                {{$employee['s_lastname'].', '.$employee['s_frstname'].' '.substr($employee['s_middname'],1,1).'. - '.$employee['s_employid']}}
                                              </option>
                                            @else
                                            <option value="{{ $employee['s_lastname'].', '.$employee['s_frstname'].' '.substr($employee['s_middname'],1,1).'. - '.$employee['s_employid'] }}" class="form-control">
                                              {{$employee['s_lastname'].', '.$employee['s_frstname'].' '.substr($employee['s_middname'],1,1).'. - '.$employee['s_employid']}}
                                            </option>
                                            @endif
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group label-floating">
                                <label class="control-label">User Name</label>
                                @if(old('username', null) != null)
                                  <input type="text" class="form-control" name="username" value="{{old('username')}}" required>
                                @else
                                  <input type="text" class="form-control" name="username" required>
                                @endif
                              </div>
                            </div>
                          </div>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group label-floating">
                                  <label class="control-label">is Administrator?</label>
                                  <select class="form-control" id="isAdmin" name="isAdmin" onchange="showUserType()" required>
                                    @if(old('isAdmin', null) != null)
                                      @if (old('isAdmin') == "Y")
                                        <option value="" disabled></option>
                                        <option value="Y" selected>Yes</option>
                                        <option value="N">No</option>
                                      @else
                                        <option value="" disabled></option>
                                        <option value="Y">Yes</option>
                                        <option value="N" selected>No</option>
                                      @endif
                                    @else
                                        <option value="" disabled selected></option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6" id="usertype">
                                  <div class="form-group label-floating">
                                      <label class="control-label">User Type</label>
                                      <select class="form-control" id="usertypeselect" name="usertypeselect">
                                        <option value="" disabled selected></option>
                                        <option value="1">Branch Personnel</option>
                                        <option value="2">Technician</option>
                                      </select>
                                  </div>
                              </div>
                            </div>

                            <!-- <div class="col-md-4">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="isadmin">
                                  <span class="checkbox-material"></span>
                                  is Admin?
                                </label>
                              </div>
                            </div>
                          </div> -->

                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group label-floating">
                                      <label class="control-label">Password</label>
                                      <input type="password" class="form-control" id="password" name="password" required>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group label-floating">
                                      <label class="control-label">Confirm Password</label>
                                      <input type="password" class="form-control" id="confpassword" name="confpassword" required>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <button type="submit" class="btn btn-primary pull-right">Save New user</button>
                              <div class="clearfix"></div>
                              {{csrf_field()}}
                          </div>
                        </form>
                      <!-- @foreach ($employees as $employee)
                        <p>{{ $employee['s_employid'].','.$employee['s_lastname'] }}</p>
                      @endforeach -->
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

@section('pagescripts')
<script>
  function showUserType(){
    var isAdmin = document.getElementById("isAdmin").value
    var usertype = document.getElementById("usertype")

    if (isAdmin == "Y")
    {
      usertype.style.display = "none";
    }
    else {
      usertype.style.display = "block";
    }
  }
</script>
@endsection
