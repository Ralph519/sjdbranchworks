@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> ISSUES REPORTED - {{ $issues->first()->ticketissues->first()->issuetype_desc }} </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="cardsmall">
            <div class="cardsmall-header cardsmall-header-icon" data-background-color="green">
              <i class="material-icons">assignment</i>
            </div>

            <div id="userdata" class="cardsmall-content">
              <h4 class="cardsmall-title">{{ $issues->first()->ticketissues->first()->issuetype_desc }}</h4>
              <table id="employees" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
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
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created at</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($issues as $issue)
                        <tr>
                            <td>{{$issue->id}}</td>
                            @if($issue->s_statusxx=='P')
                              <td><a href="{{ route('ticket-management.edit', ['id' => $issue->id]) }}">{{$issue->s_brnccode.$issue->s_trannmbr}}</a></td>
                            @else
                              <td><a href="{{ route('ticket-management.show', ['id' => $issue->id]) }}">{{$issue->s_brnccode.$issue->s_trannmbr}}</a></td>
                            @endif
                            <td>{{$issue->s_brnccode.' - '.$issue->branch->first()->s_brncname}}</td>
                            <td>{{$issue->issuesubject}}</td>
                            <td>
                              @if($issue->s_statusxx=='P')
                                <span class="label label-success">Open</span>
                              @else
                                <span class="label label-danger">Closed</span>
                              @endif
                            </td>
                            <td>
                              @if($issue->s_priority=='1')
                                High
                              @elseif($issue->s_priority=='2')
                                Medium
                              @elseif($issue->s_priority=='3')
                                Low
                              @endif
                            </td>
                            <td>{{ $issue->created_at }}</td>
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
