@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> View All Tickets </a>
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
              <h4 class="cardsmall-title">All Tickets</h4>

              <div id="loadpage">
                  <p align="center" style="font-size: large;">
                    <img src="{{ asset("imgs/animated-gif-loading.gif")}}" style="width:200px;">
                  </p>
              </div>

              <table id="employees" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
                          <th>Issue Type</th>
                          <th>Status</th>
                          <th>Priority</th>
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
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created at</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($alltickets as $allticket)
                        <tr>
                            <td>{{$allticket->id}}</td>
                            <td><a href="{{ route('ticket-management.edit', ['id' => $allticket->id]) }}">{{$allticket->s_brnccode.$allticket->s_trannmbr}}</a></td>
                            <td>{{$allticket->s_brnccode.' - '.$allticket->branch->first()->s_brncname}}</td>
                            <td>{{$allticket->issuesubject}}</td>
                            <td>{{$allticket->ticketissues->first()->issuetype_desc}}</td>
                            <td>
                              @if($allticket->s_statusxx=='P')
                                <span class="label label-success">Open</span>
                              @else
                                <span class="label label-danger">Closed</span>
                              @endif
                            </td>
                            <td>
                              @if($allticket->s_priority=='1')
                                High
                              @elseif($allticket->s_priority=='2')
                                Medium
                              @elseif($allticket->s_priority=='3')
                                Low
                              @endif
                            </td>
                            <td>{{ $allticket->created_at }}</td>
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
      "order": [[ 7, "desc" ]],
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
