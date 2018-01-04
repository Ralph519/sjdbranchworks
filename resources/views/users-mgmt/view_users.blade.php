@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> View users </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
              <h3 class="title">SJD Branch Works Users List</h3>
              <a href="{{ route('user-management.create')}}" class="pull-right"><i class="material-icons" rel="tooltip" title="Add new user">group add</i></a>
              <p>User Management</p>
            </div>

            <div id="loadpage" class="card-content">
                <p align="center" style="font-size: large;">
                  <img src="{{ asset("imgs/animated-gif-loading.gif")}}" style="width:200px;">
                </p>
            </div>
            <div id="userdata" class="card-content">
              <table id="employees" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Employee ID</th>
                          <th>Employee Name</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      @foreach ($users as $user)
                      <tr>
                          <td>{{ $user->empno }}</td>
                          <td>{{ $user->name }}</td>
                          @if ($user->empstatus == 'A')
                            <td>Active</td>
                          @else
                            <td>Inactive</td>
                          @endif
                          <td class="td-actions text-right">
                            <a href="{{ route('user-management.show_reset_userpassword', ['id' => $user->id]) }}" class="btn btn-info btn-simple" name="button" rel="tooltip" title="Reset password">
                              <i class="material-icons"> person </i>
                            </a>
                            <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-success btn-simple" name="edituser" rel="tooltip" title="Edit user details">
                              <i class="material-icons"> edit </i>
                            </a>
                            @if ($user->empno != Auth::user()->empno)
                              <form method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure you want to delete this user?')">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-danger btn-simple" rel="tooltip" title="Delete user">
                                  <i class="material-icons"> delete </i>
                                </button>
                              </form>
                            @endif
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
            <!-- <div class="card-content table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name" aria-sort="ascending">Employee Number</th>
                    <th width="40%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email">Employee Name</th>
                    <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Full Name">Status</th>
                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Full Name">Action</th>
                  </tr>

                  @foreach ($users as $user)
                    <tr>
                      <td class="sorting_1">{{ $user->empno }}</td>
                      <td>{{ $user->name }}</td>
                      @if ($user->empstatus == 'A')
                        <td>Active</td>
                      @else
                        <td>Inactive</td>
                      @endif
                      <td class="td-actions text-right">
                        <a href="{{ route('user-management.show_reset_userpassword', ['id' => $user->id]) }}" class="btn btn-info btn-simple" name="button" rel="tooltip" title="Reset password">
                          <i class="material-icons"> person </i>
                        </a>
                        <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="btn btn-success btn-simple" name="edituser" rel="tooltip" title="Edit user details">
                          <i class="material-icons"> edit </i>
                        </a>
                        @if ($user->empno != Auth::user()->empno)
                          <form method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure you want to delete this user?')">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-danger btn-simple" rel="tooltip" title="Delete user">
                              <i class="material-icons"> delete </i>
                            </button>
                          </form>
                        @endif
                      </td>
                  @endforeach
                </table>
            </div> -->
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
      "order": [[ 0, "asc" ]],
      "columnDefs": [
        { "orderable": false, "targets": 3 },
        { "targets": 3, "classname": "right",}
      ]
  } );
} );

</script>

<script>
$(document).ready(function()
  {
    $("#loadpage").hide();
    $("#userdata").show();
  });
</script>
@endsection
