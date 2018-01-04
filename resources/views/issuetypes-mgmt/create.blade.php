@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Add New Issues Reported by branches </a>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-6">
              <div class="cardsmall">
                  <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
                      <i class="material-icons">note_add</i>
                      <!-- <h4 class="title">New User</h4>
                      <p class="category">user login details for SJD - Employee Self Service</p> -->
                  </div>
                  <div class="cardsmall-content">

                      <h4 class="title">New Issues Reported -
                        <small class="category">add new issues reported</small>
                      </h4>

                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif

                      <form action="{{route('issuetypes-management.store')}}" method="post" >
                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group label-floating">
                                <label for="branch" class="control-label">Issue Description</label>
                                <input type="text" class="form-control"  maxlength="45" name="issuedesc" required>
                                </div>
                              </div>
                            </div>


                          <div class="row">
                              <button type="submit" class="btn btn-primary pull-right">Save new Branch</button>
                              <div class="clearfix"></div>
                              {{csrf_field()}}
                          </div>
                        </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
