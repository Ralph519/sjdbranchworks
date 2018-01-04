@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Employee List </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-icon" data-background-color="purple">
                  <h4 class="title">Employee List</h4>
                  <a href="{{ route('employee-management.create')}}" class="pull-right"><i class="material-icons" rel="tooltip" title="Add new Employee">note_add</i></a>
                  <small>Employees Management</small>
              </div>
              <div id="loadpage" class="card-content">
                  <p align="center" style="font-size: large;">
                    <img src="/imgs/animated-gif-loading.gif" style="width:200px;">
                  </p>
              </div>
              <div id="employeedata" class="card-content">
                <table id="employees" class="table-striped table-no-bordered table-hover dataTable dtr-inline" role="grid" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Family Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Branch</th>
                            <th>Position</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Employee ID</th>
                            <th>Family Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Branch</th>
                            <th>Position</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td><a href="{{ route('employee-management.edit', ['id' => $employee->id]) }}">{{ $employee->s_employid }}</a></td>
                            <td>{{ $employee->s_lastname }}</td>
                            <td>{{ $employee->s_frstname }}</td>
                            <td>{{ $employee->s_middname }}</td>
                            <td>{{ $employee->branch->first()->s_brncdesc }}</td>
                            <td>{{ $employee->hrmsposition->implode('s_posidesc') }}</td>
                            <td>{{ $employee->s_emplstat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('pagescripts')
  <link href="{{ asset("/css/jquery.dataTables.css")}}" rel="stylesheet" />
  <script src="{{ asset("/js/jquery.datatables.js")}}"></script>

  <script>
  $(document).ready(function() {
    $('#employees').DataTable( {
        "order": [[ 0, "asc" ]]
    } );
  } );

  </script>

  <script>
  $(document).ready(function()
    {
      $("#loadpage").hide();
      $("#employeedata").show();
    });
  </script>
@endsection
