@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Edit user details </a>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header card-header-icon" data-background-color="purple">
                      <h4 class="title">Edit user details</h4>
                  </div>



                  <div class="card-content">
                    @if(count($errors) > 0)
                      <div class="form-group alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                      </div>
                      <br>
                    @endif

                      <form action="{{route('user-management.update',['id' => $users->id])}}" method="post">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                          <div class="form-group label-floating">
                              <label class="control-label">Full Name</label>
                              <input type="text" class="form-control" id="username" name="username" value="{{$users->name}}" disabled>
                          </div>

                          <div class="form-group label-floating">
                              <label class="control-label">User Name</label>
                              <input type="text" class="form-control" id="username" name="username" value="{{$users->loginname}}" required autofocus>
                          </div>

                          <div class="form-group label-floating">
                            <label class="control-lable">is Admin?</label>
                            <select class="form-control" id="isAdmin" name="isAdmin" onchange="showUserType()">
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
                                @if ($users->isadmin == "Y")
                                  <option value="" disabled></option>
                                  <option value="Y" selected>Yes</option>
                                  <option value="N">No</option>
                                @else
                                  <option value="" disabled></option>
                                  <option value="Y">Yes</option>
                                  <option value="N" selected>No</option>
                                @endif
                              @endif
                            </select>
                          </div>

                          <!-- <div class="checkbox" id="isAdmin">
                            <label>
                              @if ($users->isadmin == "Y")
                                <input type="checkbox" checked name="isadmin">
                              @else
                                <input type="checkbox" name="isadmin">
                              @endif
                              <span class="checkbox-material"></span>
                              is Admin?
                            </label>
                          </div> -->
                            <div class="form-group label-floating" id="usertype">
                              <label for="usertype" class="control-label">User Type</label>
                              <select class="form-control" id="usertypeselect" name="usertypeselect">
                                @if($users->usertype == "1")
                                  <option value="" disabled></option>
                                  <option value="1" selected>Branch Personnel</option>
                                  <option value="2">Technician</option>
                                @elseif($users->usertype == '2')
                                  <option value="" disabled></option>
                                  <option value="1">Branch Personnel</option>
                                  <option value="2" selected>Technician</option>
                                @else
                                  <option value="" disabled selected></option>
                                  <option value="1">Branch Personnel</option>
                                  <option value="2">Technician</option>
                                @endif
                              </select>
                            </div>

                          <div class="checkbox">
                            <label>
                              @if ($users->empstatus == "A")
                                <input type="checkbox" checked name="empstatus">
                              @else
                                <input type="checkbox" name="empstatus">
                              @endif
                              <span class="checkbox-material"></span>
                              is Active?
                            </label>
                          </div>

                          <button type="submit" class="btn btn-primary pull-right">Update</button>
                          <a href="{{ route('user-management.view_users')}}" type="button" class="btn btn-primary pull-right">Back</a>
                          <div class="clearfix"></div>
                          {{csrf_field()}}
                      </form>
                  </div>

              </div>
          </div>

          <div class="col-md-4">
        <div class="cardsmall cardsmall-profile">
          <div class="cardsmall-avatar">
            <a href="#">
              <img class="img" src="/sjdbranchworks/public/uploads/avatars/{{ $users->avatar}}" alt="">
            </a>
          </div>
          <div class="cardsmall-content">
            <h6 class="category text-gray">{{ $users->name}}</h6>
          </div>
        </div>
      </div>

      </div>
  </div>
</div>
@endsection

@section('pagescripts')
<script>
  $(document).ready(function() {
    var isAdmin = document.getElementById("isAdmin").value
    var usertype = document.getElementById("usertype")

    if (isAdmin == "Y")
    {
      usertype.style.display = "none";
    }
    else {
      usertype.style.display = "block";
    }
  })
</script>
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
