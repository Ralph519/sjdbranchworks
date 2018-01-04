@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Summary Reports </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="cardsmall">
            <h2 class="invoice-header">
              <i class="fa fa-file-text-o"></i> Open tickets for more than 24 hours
              <small class="pull-right">Date: {{ Carbon\carbon::now()->format('m/d/Y')}}</small>
            </h2>

            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-striped">
                <thead>
                <tr>
                  <th>Ticket Number</th>
                  <th>Branch</th>
                  <th>Subject</th>
                  <th>Issue Type</th>
                  <th>Priority</th>
                  <th>Assigned to</th>
                  <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($overduetickets as $overdueticket)
                  <tr>
                    <td>{{$overdueticket->s_brnccode.$overdueticket->s_trannmbr}}</td>
                    <td>{{$overdueticket->s_brnccode}}</td>
                    <td>{{$overdueticket->issuesubject}}</td>
                    <td>{{$overdueticket->issuetype_desc}}</td>
                    <td>
                      @if($overdueticket->s_priority=='1')
                        High
                      @elseif($overdueticket->s_priority=='2')
                        Medium
                      @elseif($overdueticket->s_priority=='3')
                        Low
                      @endif
                    </td>
                    @if(is_null($overdueticket->s_assignto))
                    <td>Not yet assigned</td>
                    @else
                    <td>{{ $overdueticket->s_assignto }}</td>
                    @endif
                    <td>{{ $overdueticket->created_at }}</td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            <br>
            <a href="javascript:history.back()" type="button" class="btn btn-primary btn-simple pull-right">Go Back</a>

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
    $('#reptable').DataTable( {
        'paging'      : false,
        'searching'   : true
    } );
} );
</script>


@endsection
