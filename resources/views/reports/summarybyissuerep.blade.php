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
              <i class="fa fa-file-text-o"></i> Summary of Tickets created per Issue Reported
              <br>
              <small>From: {{$repdatefrom}} To: {{$repdatethru}}</small>
            </h2>

            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 5%;">Issue Type Code</th>
                    <th class="text-center" style="width: 30%;">Issue Type Description</th>
                    <th class="text-center" style="width: 10%;">Total Count</th>
                    <th class="text-center" style="width: 10%;">Resolved Ticket</th>
                    <th class="text-center" style="width: 10%;">Open Ticket</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $tTotal = 0;
                    $tResol = 0;
                    $tOpenc = 0;

                    $date1 = substr($repdatefrom,6,4).substr($repdatefrom,0,2).substr($repdatefrom,3,2);
                    $date2 = substr($repdatethru,6,4).substr($repdatethru,0,2).substr($repdatethru,3,2);
                  ?>
                  @foreach($repdata as $repitem)
                    <?php
                      $tTotal = $tTotal + $repitem->totalcnt;
                      $tResol = $tResol + $repitem->resolvedcnt;
                      $tOpenc = $tOpenc + $repitem->opencnt;
                    ?>
                  <tr>
                    <td>{{$repitem->issuetype}}</td>
                    <td>{{$repitem->issuetype_desc}}</td>
                    <td><a href="{{ route('summaryByIssueRepDetail', ['issuetype' => $repitem->issuetype, 'issuetypedesc' => $repitem->issuetype_desc, 'date1' => $date1, 'date2' => $date2, 'reptype' => 1]) }}">{{$repitem->totalcnt}}</a></td>
                    <td><a href="{{ route('summaryByIssueRepDetail', ['issuetype' => $repitem->issuetype, 'issuetypedesc' => $repitem->issuetype_desc, 'date1' => $date1, 'date2' => $date2, 'reptype' => 2]) }}">{{$repitem->resolvedcnt}}</a></td>
                    <td><a href="{{ route('summaryByIssueRepDetail', ['issuetype' => $repitem->issuetype, 'issuetypedesc' => $repitem->issuetype_desc, 'date1' => $date1, 'date2' => $date2, 'reptype' => 3]) }}">{{$repitem->opencnt}}</a></td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                      <tr>
                        <th colspan="2" style="text-align:right">Total:</th>
                        <th>{{$tTotal}}</th>
                        <th>{{$tResol}}</th>
                        <th>{{$tOpenc}}</th>
                    </tr>
                </tfoot>
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
