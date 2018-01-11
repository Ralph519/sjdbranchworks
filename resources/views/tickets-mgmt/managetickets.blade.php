@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Manage/Assigned Tickets </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="cardsmall">
            <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
              <i class="material-icons">folder_shared</i>
            </div>

            <div id="opendiv" class="cardsmall-content">
              <h4 class="cardsmall-title">Assign Ticket to a support</h4>

              <div id="loadpage">
                  <p align="center" style="font-size: large;">
                    <img src="{{ asset("imgs/animated-gif-loading.gif")}}" style="width:200px;">
                  </p>
              </div>

              <table id="open" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
                          <th>Issue Type</th>
                          <th>Reported By</th>
                          <th>Created at</th>
                          <th>Assign</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Ticket No.</th>
                        <th>Branch</th>
                        <th>Subject</th>
                        <th>Issue Type</th>
                        <th>Reported By</th>
                        <th>Created at</th>
                        <th>Assign</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    <?php $priority = ''; ?>
                    @foreach($assigntickets as $assignticket)
                        <tr>
                            <td>{{$assignticket->s_brnccode.$assignticket->s_trannmbr}}</td>
                            <td>{{$assignticket->s_brnccode.' - '.$assignticket->branch->implode('s_brncname')}}</td>
                            <td>{{$assignticket->issuesubject}}</td>
                            <td>{{$assignticket->ticketissues->first()->issuetype_desc}}</td>
                            <td>{{ $assignticket->s_reportby }}</td>
                            <td>{{ $assignticket->created_at }}</td>
                            <td>
                              <a href="#" data-toggle="modal"
                                  data-target="#assignModal"
                                  data-ticketno="{{$assignticket->s_brnccode.$assignticket->s_trannmbr}}"
                                  data-id="{{$assignticket->id}}"
                                  data-branch="{{$assignticket->branch->implode('s_brncname')}}"
                                  data-subject="{{$assignticket->issuesubject}}"
                                  data-issuedesc="{{$assignticket->m_issuedesc}}"
                                  data-issuetype="{{$assignticket->ticketissues->first()->issuetype_desc}}"
                                  data-priority="{{$priority}}"
                                  class="btn-block btn-info btn-xs">
                              Assign
                              </a>
                            </td>
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
              <i class="material-icons">event_note</i>
            </div>

            <div id="closeddiv" class="cardsmall-content">
              <h4 class="cardsmall-title">Assigned Open Tickets</h4>
              <table id="closed" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Ticket No.</th>
                          <th>Branch</th>
                          <th>Subject</th>
                          <th>Issue Type</th>
                          <th>Priority</th>
                          <th>Assigned to</th>
                          <th>Created at</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Ticket No.</th>
                        <th>Branch</th>
                        <th>Subject</th>
                        <th>Issue Type</th>
                        <th>Priority</th>
                        <th>Assigned to</th>
                        <th>Created at</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @foreach($assignedtickets as $assignedticket)
                        <tr>
                            <td>{{$assignedticket->s_brnccode.$assignedticket->s_trannmbr}}</td>
                            <td>{{$assignedticket->branch->implode('s_brncname')}}</td>
                            <td>{{$assignedticket->issuesubject}}</td>
                            <td>{{$assignedticket->ticketissues->first()->issuetype_desc}}</td>
                            <td>
                              @if($assignedticket->s_priority=='1')
                                High
                              @elseif($assignedticket->s_priority=='2')
                                Medium
                              @elseif($assignedticket->s_priority=='3')
                                Low
                              @endif
                            </td>
                            <td>{{ $assignedticket->s_assignto}}</td>
                            <td>{{ $assignedticket->created_at }}</td>
                        </tr>
                        @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
    <div class="modal fade" id="assignModal" role="dialog" tabindex="-1" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">


          <div class="modal-header">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
            <h4 class="modal-title">Assign Ticket to a support</h4>
          </div>
          <div class="modal-body">
            <form action="{{route('ticket-management.saveassigned')}}" method="POST" id="repParam">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="ticketid" id="ticketid">
              <input type="hidden" name="issuereported" id="issuereported">
              <p>Assign Ticket No. <b><span id="modalTicketno">TicketNoToAssign</span></b></p>
              <hr>
              <p>From <b> <span id="modalBranch">BrancNamehere</span> </b> </p>
              <p>Subject : <b> <span id="modalSubject">SubjectNamehere</span> </b> </p>
              <p>Issue Type : <b> <span id="modalType">Typehere</span> </b> </p>
              <p>Priority : <b> <span id="modalPriority">PriorityHere</span> </b> </p>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group label-floating-empty">
                    <label for="usertype" class="control-label">Select a personnel to assign the ticket</label>
                    <select class="form-control" name="assignto" id="assignto" required>
                      <option value=""></option>
                      @foreach($supports as $support)
                          <option value="{{ $support->loginname}}">{{$support->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger btn-simple" data-dismiss="modal" type="button" name="button">Close</button>
              <button class="btn btn-primary" type="submit">Assign</button>
            </div>
            </form>
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
$(function() {
    $('#assignModal').on('show.bs.modal', function(e){
      $("#modalTicketno").html($(e.relatedTarget).data('ticketno'));
      $("#modalBranch").html($(e.relatedTarget).data('branch'));
      $("#modalSubject").html($(e.relatedTarget).data('subject'));
      $("#modalType").html($(e.relatedTarget).data('issuetype'));
      $("#modalPriority").html($(e.relatedTarget).data('priority'));
      $("#ticketid").val($(e.relatedTarget).data('id'));
      $("#issuereported").val($(e.relatedTarget).data('issuetype'));
    });
  });
</script>

<script>
  $(document).ready(function()
    {
      $("#loadpage").hide();
      $("#opendiv").show();
    });
  </script>

@endsection
