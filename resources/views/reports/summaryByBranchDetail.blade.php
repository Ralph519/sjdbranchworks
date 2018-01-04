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
              <i class="fa fa-file-text-o"></i> Details of Tickets created per branch - <strong>{{$s_brncname}}</strong>
              <br>
              <small>From: {{substr($repdatefrom,4,2).'/'.substr($repdatefrom,6,2).'/'.substr($repdatefrom,0,4)}} To: {{substr($repdatethru,4,2).'/'.substr($repdatethru,6,2).'/'.substr($repdatethru,0,4)}}</small>
            </h2>

            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 5%;">Tran. Nmbr</th>
                    <th class="text-center" style="width: 10%;">Issue Reported</th>
                    <th class="text-center" style="width: 15%;">Ticket Subject</th>
                    <th class="text-center" style="width: 25%;">Ticket Description</th>
                    <th class="text-center" style="width: 10%;">Assigned To</th>
                    <th class="text-center" style="width: 10%;">Status</th>
                    <th class="text-center" style="width: 10%;">Date Reported</th>
                    <th class="text-center" style="width: 10%;">Date Resolved</th>
                  </tr>

                </thead>
                <tbody>
                  @foreach($repdata as $repitem)
                  <tr>
                    <td>{{$repitem->s_brnccode.$repitem->s_trannmbr}}</td>
                    <td>{{$repitem->issuetype_desc}}</td>
                    <td>{{$repitem->issuesubject}}</td>
                    <td>{{$repitem->m_issuedesc}}</td>
                    <td>{{$repitem->name}}</td>
                    @if($repitem->s_statusxx=='C')
                      <td>Resolved</td>
                    @else
                      <td>Pending</td>
                    @endif
                    <td>{{date('M d, Y', strtotime($repitem->created_at))}}</td>
                    @if($repitem->s_statusxx=='C')
                      <td>{{date('M d, Y', strtotime($repitem->d_rslvdate))}}</td>
                    @else
                      <td></td>
                    @endif
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
