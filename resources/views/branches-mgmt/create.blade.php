@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Add New Branch </a>
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

                      <h4 class="title">New Branch -
                        <small class="category">add new branch</small>
                      </h4>

                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif

                      <form action="{{route('branches-management.store')}}" method="post" >
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group label-floating">
                                <label for="branch" class="control-label">Branch Code</label>
                                <input type="text" class="form-control"  maxlength="2" name="branchcode" id="branchcode" required>
                                </div>
                              </div>
                            </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group label-floating">
                                  <label for="subject" class="control-label">Branch Description</label>
                                  <input type="text" class="form-control" name="branchdesc" id="branchdesc" name="subject" maxlength="80" required>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group label-floating">
                                  <label class="control-label">Telephone No.</label>
                                    <input type="text" class="form-control" id="branchtelno" name="branchtelno" maxlength="13">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12 pull-right">
                              <button type="submit" class="btn btn-primary pull-right">Save new Branch</button>
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
