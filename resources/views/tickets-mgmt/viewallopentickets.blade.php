@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Open Tickets </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="cardsmall">
            <div class="cardsmall-header cardsmall-header-icon" data-background-color="red">
              <i class="material-icons">assignment</i>
            </div>

            <div id="userdata" class="cardsmall-content">
              <h4 class="cardsmall-title">All Open Tickets</h4>
              <table id="employees" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
                          <th>Issue Type</th>
                          <th>Assigned to</th>
                          <th>Reported By</th>
                          <th>Created at</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Ticket No.</th>
                        <th>Branch</th>
                        <th>Subject</th>
                        <th>Issue Type</th>
                        <th>Assigned to</th>
                        <th>Reported By</th>
                        <th>Created at</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($opentickets as $openticket)
                        <tr>
                            <td>{{$openticket->id}}</td>
                            <td><a href="{{ route('ticket-management.edit', ['id' => $openticket->id]) }}">{{$openticket->s_brnccode.$openticket->s_trannmbr}}</a></td>
                            <td>{{$openticket->branch->implode('s_brncname')}}</td>
                            <td>{{$openticket->issuesubject}}</td>
                            <td>{{$openticket->ticketissues->first()->issuetype_desc}}</td>
                            <td>{{$openticket->s_assignto}}</td>
                            <td>{{ $openticket->s_reportby }}</td>
                            <td>{{ $openticket->created_at }}</td>
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
    document.querySelector('#deleteuser').addEventListener('submit', function(e) {
        var form = this;
        e.preventDefault();
        swal({
              title: "Are you sure?",
              text: "Employee information will be permanently deleted",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Yes, I am sure!',
              cancelButtonText: "No, cancel it!",
              closeOnConfirm: true,
              closeOnCancel: false,
          },
          function(isConfirm) {
              if (isConfirm) {
                form.submit();
              } else {
                  swal("Cancelled", "", "error");
              }
          });
    });

</script>

<script>
$(document).ready(function() {
  $('#employees').DataTable( {
      "order": [[ 0, "asc" ]],
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
