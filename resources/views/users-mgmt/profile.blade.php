@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Profile </a>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header card-header-icon" data-background-color="purple">
                      <h4 class="title">{{ $user->name}}'s Profile</h4>
                  </div>
                  <div class="card-content">
                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors-> all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif

                      <div class="box-body">
                        <img src="{{ asset("/uploads/avatars/$user->avatar")}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px; margin-bottom:15px;" alt="">
                          <form enctype="multipart/form-data" action="{{route('user-management.update_avatar')}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value=" {{ csrf_token()}}">
                            <label for="">Update Profile Image</label>
                            <input type="file" name="avatar">

                            </br>
                            <input type="submit" class="pull-left btn btn-sm btn-primary">
                          </form>
                      </div>
                  </div>


              </div>
          </div>
      </div>

  </div>
</div>
@endsection
