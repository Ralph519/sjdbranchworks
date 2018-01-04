@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Your Assigned Tickets </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="cardsmall">
            <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
              <i class="material-icons">assignment</i>
            </div>

            <div id="opendiv" class="cardsmall-content">
              <h4 class="cardsmall-title">Your Open/Pending Tickets</h4>

              <div id="loadpage">
                  <p align="center" style="font-size: large;">
                    <img src="{{ asset("imgs/animated-gif-loading.gif")}}" style="width:200px;">
                  </p>
              </div>

              <table id="open" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
                          <th>Issue Type</th>
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
                        <th>Priority</th>
                        <th>Created at</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($opentickets10 as $openticket10)
                        <tr>
                            <td>{{$openticket10->id}}</td>
                            <td><a href="{{ route('ticket-management.edit', ['id' => $openticket10->id]) }}">{{$openticket10->s_brnccode.$openticket10->s_trannmbr}}</a></td>
                            <td>{{$openticket10->branch->implode('s_brncname')}}</td>
                            <td>{{$openticket10->issuesubject}}</td>
                            <td>{{$openticket10->ticketissues->first()->issuetype_desc}}</td>
                            <td>
                              @if($openticket10->s_priority=='1')
                                High
                              @elseif($openticket10->s_priority=='2')
                                Medium
                              @elseif($openticket10->s_priority=='3')
                                Low
                              @endif
                            </td>
                            <td>{{ $openticket10->created_at }}</td>
                        </tr>
                        @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="cardsmall">
            <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
              <i class="material-icons">assignment</i>
            </div>

            <div id="closeddiv" class="cardsmall-content">
              <h4 class="cardsmall-title">Your Closed/Resolved Tickets</h4>

              <table id="closed" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
                          <th>Issue Type</th>
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
                        <th>Priority</th>
                        <th>Created at</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($closedtickets10 as $closedticket10)
                        <tr>
                            <td>{{$closedticket10->id}}</td>
                            <td><a href="{{ route('ticket-management.show', ['id' => $closedticket10->id]) }}">{{$closedticket10->s_brnccode.$closedticket10->s_trannmbr}}</a></td>
                            <td>{{$closedticket10->branch->implode('s_brncname')}}</td>
                            <td>{{$closedticket10->issuesubject}}</td>
                            <td>{{$closedticket10->ticketissues->first()->issuetype_desc}}</td>
                            <td>
                              @if($closedticket10->s_priority=='1')
                                High
                              @elseif($closedticket10->s_priority=='2')
                                Medium
                              @elseif($closedticket10->s_priority=='3')
                                Low
                              @endif
                            </td>
                            <td>{{ date('m/d/Y', strtotime($closedticket10->created_at)) }}</td>
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
  $('#open').DataTable( {
      "order": [[ 0, "asc" ]],
  });
  $('#closed').DataTable( {
      "order": [[ 0, "asc" ]],
  });
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
