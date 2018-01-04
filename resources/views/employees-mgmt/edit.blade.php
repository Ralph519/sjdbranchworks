@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Edit Employee Data </a>
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
                      <h4 class="title">Edit Employee Data -
                        <small class="category">Employee Profile</small>
                      </h4>

                      @if(count($errors) > 0)
                        <div class="alert alert-danger">
                          @foreach($errors-> all() as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif

                      <form action="{{route('employee-management.update', ['id' => $employees->id])}}" method="post" >
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <!-- First row  -->
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">First Name</label>
                                    <input type="text" value="{{$employees->s_frstname}}" class="form-control" id="firstname" name="firstname" style="text-transform:uppercase" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Family Name</label>
                                    <input type="text" value="{{$employees->s_lastname}}" class="form-control" id="familyname" name="familyname" style="text-transform:uppercase" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" value="{{$employees->s_middname}}" class="form-control" id="middlename" name="middlename" style="text-transform:uppercase" required>
                                </div>
                            </div>
                          </div>
                          <!-- Second Row  -->
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                  <label class="control-label">Select Branch</label>
                                  <select name="branch" id="branch" class="form-control" type="text" required autofocus>
                                      <option value="" disabled selected></option>
                                      @foreach ($branches as $branch)
                                        @if ($employees->s_brnccode==$branch->s_brnccode)
                                        <option value="{{ $branch['s_brnccode'] }}" class="form-control" selected>
                                          {{$branch['s_brncdesc']}}
                                        </option>
                                        @else
                                        <option value="{{ $branch['s_brnccode'] }}" class="form-control">
                                          {{$branch['s_brncdesc']}}
                                        </option>
                                        @endif
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group label-floating">
                                  <label class="control-label">Select Department</label>
                                  <select name="department" id="department" class="form-control" type="text" required autofocus>
                                      <option value="" disabled selected></option>
                                      @foreach ($departments as $department)
                                        @if ($employees->n_deptid==$department->id)
                                          <option value="{{ $department['id'] }}" class="form-control" selected>
                                            {{$department['dept_desc']}}
                                          </option>
                                        @else
                                          <option value="{{ $department['id'] }}" class="form-control">
                                            {{$department['dept_desc']}}
                                          </option>
                                        @endif
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group label-floating">
                                  <label class="control-label">Select HRMS Position</label>
                                  <select name="position" id="position" class="form-control" type="text" required autofocus>
                                      <option value="" disabled selected></option>
                                      @foreach ($positions as $position)
                                        @if($employees->s_posicode==$position->s_posicode)
                                          <option value="{{ $position['s_posicode'] }}" class="form-control" selected>
                                            {{$position['s_posidesc']}}
                                          </option>
                                        @else
                                        <option value="{{ $position['s_posicode'] }}" class="form-control">
                                          {{$position['s_posidesc']}}
                                        </option>
                                        @endif
                                      @endforeach
                                  </select>
                                </div>
                              </div>

                            </div>
                            <!-- Third Row  -->
                            <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">TIN No.</label>
                                    <input type="text" value="{{$employees->s_tinumber}}" class="form-control" id="tinno" name="tinno" required>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">SSS No.</label>
                                    <input type="text" value="{{$employees->s_ssnumber}}" class="form-control" id="sssno" name="sssno" required>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">HDMF No.</label>
                                    <input type="text" value="{{$employees->s_hdmfidno}}" class="form-control" id="hdmfno" name="hdmfno" required>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">Philhealth No.</label>
                                    <input type="text" value="{{$employees->s_medinmbr}}" class="form-control" id="philhealthno" name="philhealthno" required>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">Employee Status</label>
                                    <select name="paytype" id="paytype" class="form-control" type="text" required autofocus>
                                      <option value="" disabled selected></option>
                                      @if($employees->s_emplstat=='P')
                                        <option value="P" class="form-control" selected>Probationary</option>
                                      @else
                                        <option value="P" class="form-control">Probationary</option>
                                      @endif
                                      @if($employees->s_emplstat=='R')
                                        <option value="R" class="form-control" selected>Regular</option>
                                      @else
                                        <option value="R" class="form-control">Regular</option>
                                      @endif
                                      @if($employees->s_emplstat=='S')
                                        <option value="S" class="form-control" selected>Separated</option>
                                      @else
                                        <option value="S" class="form-control">Separated</option>
                                      @endif
                                      @if($employees->s_emplstat=='T')
                                        <option value="T" class="form-control" selected>Trainee</option>
                                      @else
                                        <option value="T" class="form-control">Trainee</option>
                                      @endif
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">Select Pay Type</label>
                                    <select name="paytype" id="paytype" class="form-control" type="text" required autofocus>
                                        <option value="" disabled selected></option>
                                        @foreach ($paytypes as $paytype)
                                          @if($employees->s_paytypex==$paytype->s_paytypex)
                                            <option value="{{ $paytype['s_paytypex'] }}" class="form-control" selected>
                                              {{$paytype['s_paydescx']}}
                                            </option>
                                          @else
                                            <option value="{{ $paytype['s_paytypex'] }}" class="form-control">
                                              {{$paytype['s_paydescx']}}
                                            </option>
                                          @endif
                                        @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">Rate</label>
                                    <input type="text" value="{{$employees->s_ratecode}}" class="form-control" id="rate" name="rate" required>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group label-floating">
                                    <label class="control-label">Date Hired</label>
                                    <input type="text" value="{{date('m/d/Y',strtotime($employees->d_datehired))}}" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datehired" name="datehired" data-mask>
                                  </div>
                                </div>
                              </div>
                            <button type="submit" class="btn btn-success btn-round pull-right">Update Information</button>
                            <button type="submit" class="btn btn-danger btn-round pull-left">Delete Employee</button>
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
                    <h6 class="category text-gray">Employee Id: {{$employees->s_employid }}</h6>
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
