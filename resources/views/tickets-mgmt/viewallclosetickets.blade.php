@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> View All Closed Tickets </a>
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
              <h4 class="cardsmall-title">All Closed Tickets</h4>
              <table id="employees" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
                          <th>Issue Type</th>
                          <th>Resolved By</th>
                          <th>Resolved Date</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Ticket No.</th>
                        <th>Branch</th>
                        <th>Subject</th>
                        <th>Issue Type</th>
                        <th>Resolved By</th>
                        <th>Resolved Date</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($closetickets as $closeticket)
                        <tr>
                            <td>{{$closeticket->id}}</td>
                            <td><a href="{{ route('ticket-management.show', ['id' => $closeticket->id]) }}">{{$closeticket->s_brnccode.$closeticket->s_trannmbr}}</a></td>
                            <td>{{$closeticket->s_brnccode.' - '.$closeticket->branch->first()->s_brncname}}</td>
                            <td>{{$closeticket->issuesubject}}</td>
                            <td>{{$closeticket->ticketissues->first()->issuetype_desc}}</td>
                            <td>{{ $closeticket->user->name }}</td>
                            <td>{{ $closeticket->updated_at }}</td>
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
      "order": [[ 6, "desc" ]],
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
