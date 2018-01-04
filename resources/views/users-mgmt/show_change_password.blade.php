@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Change Password </a>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header card-header-icon" data-background-color="purple">
                      <h4 class="title">Change Password</h4>
                  </div>
                  <div class="card-content">
                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors-> all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif

                      <form action="{{route('user-management.update_change_password', ['id' => Auth::user()->id])}}" method="post" >
                          <input type="hidden" name="_method" value="PATCH">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group label-floating">
                                      <label class="control-label">Password</label>
                                      <input type="password" class="form-control" id="password" name="password" required autofocus>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group label-floating">
                                      <label class="control-label">Confirm password</label>
                                      <input type="password" class="form-control" id="confpassword" name="confpassword" required>
                                  </div>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-primary pull-right">Change Password</button>
                          <div class="clearfix"></div>
                          {{csrf_field()}}
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
