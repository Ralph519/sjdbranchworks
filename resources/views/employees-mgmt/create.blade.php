@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Add new Employee </a>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-8">
              <div class="cardsmall">
                  <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
                      <i class="material-icons">person</i>
                  </div>
                  <div class="cardsmall-content">
                      <h4 class="title">Add New Employee -
                        <small class="category">Employee Profile</small>
                      </h4>

                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors-> all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif


                      <form action="{{route('employee-management.store')}}" method="post" >
                          <!-- First row  -->
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Employee No.</label>
                                    <input type="number" class="form-control" id="s_employid" name="s_employid" style="text-transform:uppercase" required>
                                </div>
                            </div>
                          </div>
                          <!-- Second Row  -->
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" style="text-transform:uppercase" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Family Name</label>
                                    <input type="text" class="form-control" id="familyname" name="familyname" style="text-transform:uppercase" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" style="text-transform:uppercase" required>
                                </div>
                            </div>
                          </div>
                          <!-- Third Row  -->
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                  <label class="control-label">Select Branch</label>
                                  <select name="branch" id="branch" class="form-control" type="text" required>
                                      <option value="" disabled selected></option>
                                      @foreach ($branches as $branch)
                                        <option value="{{ $branch['s_brnccode'] }}" class="form-control">
                                          {{$branch['s_brncdesc']}}
                                        </option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                  <label class="control-label">Select Department</label>
                                  <select name="department" id="department" class="form-control" type="text" required>
                                      <option value="" disabled selected></option>
                                      @foreach ($departments as $department)
                                        <option value="{{ $department['id'] }}" class="form-control">
                                          {{$department['dept_desc']}}
                                        </option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group label-floating is-empty">
                                  <label class="control-label">Select HRMS Position</label>
                                  <select name="position" id="position" class="form-control" type="text" required>
                                      <option value="" disabled selected></option>
                                      @foreach ($positions as $position)
                                        <option value="{{ $position['s_posicode'] }}" class="form-control">
                                          {{$position['s_posidesc']}}
                                        </option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            <!-- fourth Row  -->
                            <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group label-floating is-empty">
                                    <label class="control-label">TIN No.</label>
                                    <input type="text" class="form-control" id="tinno" name="tinno">
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating is-empty">
                                    <label class="control-label">SSS No.</label>
                                    <input type="text" class="form-control" id="sssno" name="sssno">
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating is-empty">
                                    <label class="control-label">HDMF No.</label>
                                    <input type="text" class="form-control" id="hdmfno" name="hdmfno">
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating is-empty">
                                    <label class="control-label">Philhealth No.</label>
                                    <input type="text" class="form-control" id="philhealthno" name="philhealthno">
                                  </div>
                                </div>
                              </div>
                              <!-- last Row  -->
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group label-floating is-empty">
                                    <label class="control-label">Select Pay Type</label>
                                    <select name="paytype" id="paytype" class="form-control" type="text" required>
                                        <option value="" disabled selected></option>
                                        @foreach ($paytypes as $paytype)
                                          <option value="{{ $paytype['s_paytypex'] }}" class="form-control">
                                            {{$paytype['s_paydescx']}}
                                          </option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group label-floating is-empty">
                                    <label class="control-label">Rate</label>
                                    <input type="text" class="form-control" id="rate" name="rate">
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group label-floating is-empty">
                                    <label class="control-label">Date Hired</label>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'"  id="datehired" name="datehired" data-mask>
                                  </div>
                                </div>
                              </div>

                            <button type="submit" class="btn btn-success btn-round pull-right">Save New Information</button>
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
                      <img class="img" src="/uploads/avatar/default.png" alt="">
                    </a>
                  </div>
                  <div class="cardsmall-content">
                    <p class="description">
                      <a class="btn btn-primary btn-round" href="/">Upload Photo</a>
                    </p>
                  </div>
                </div>
              </div>

          </div>
      </div>
  </div>
@endsection

@section('pagescripts')
<script>
  $(function () {
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    $('[data-mask]').inputmask()
  })
</script>
@endsection
