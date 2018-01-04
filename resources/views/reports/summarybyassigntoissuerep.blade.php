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
              <i class="fa fa-file-text-o"></i> Summary of Tickets created by Assigned To and Issue Reported
              <br>
              <small>From: {{$repdatefrom}} To: {{$repdatethru}}</small>
            </h2>




            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center" rowspan="2" style="width: 15%;">Employee Name</th>
                    <th class="text-center" rowspan="2" style="width: 10%;">Total Count</th>
                    <th class="text-center" colspan="2" style="width: 10%;">AIRCON</th>
                    <th class="text-center" colspan="2" style="width: 10%;">GENERAL SERVICES</th>
                    <th class="text-center" colspan="2" style="width: 10%;">CARPENTRY</th>
                    <th class="text-center" colspan="2" style="width: 10%;">SIGNAGES</th>
                  </tr>
                  <tr>
                    <th style="color: red" class="text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i></th>
                    <th style="color: green" class="text-center"><i class="fa fa-check-circle-o" aria-hidden="true"></i></th>
                    <th style="color: red" class="text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i></th>
                    <th style="color: green" class="text-center"><i class="fa fa-check-circle-o" aria-hidden="true"></i></th>
                    <th style="color: red" class="text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i></th>
                    <th style="color: green" class="text-center"><i class="fa fa-check-circle-o" aria-hidden="true"></i></th>
                    <th style="color: red" class="text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i></th>
                    <th style="color: green" class="text-center"><i class="fa fa-check-circle-o" aria-hidden="true"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $tTotal = 0;
                    $tissue1_rslv = 0;
                    $tissue1_open = 0;
                    $tissue2_rslv = 0;
                    $tissue2_open = 0;
                    $tissue3_rslv = 0;
                    $tissue3_open = 0;
                    $tissue4_rslv = 0;
                    $tissue4_open = 0;

                    $date1 = substr($repdatefrom,6,4).substr($repdatefrom,0,2).substr($repdatefrom,3,2);
                    $date2 = substr($repdatethru,6,4).substr($repdatethru,0,2).substr($repdatethru,3,2);
                  ?>
                  @foreach($repdata as $repitem)
                    <?php
                      $tTotal = $tTotal + $repitem->totalcnt;
                      $tissue1_rslv = $tissue1_rslv + $repitem->issuetype1_rslv;
                      $tissue1_open = $tissue1_open + $repitem->issuetype1_open;
                      $tissue2_rslv = $tissue2_rslv + $repitem->issuetype2_rslv;
                      $tissue2_open = $tissue2_open + $repitem->issuetype2_open;
                      $tissue3_rslv = $tissue3_rslv + $repitem->issuetype3_rslv;
                      $tissue3_open = $tissue3_open + $repitem->issuetype3_open;
                      $tissue4_rslv = $tissue4_rslv + $repitem->issuetype4_rslv;
                      $tissue4_open = $tissue4_open + $repitem->issuetype4_open;
                    ?>
                  <tr>
                    <td>{{$repitem->name}}</td>
                    <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 1, 'issuetype' => 1]) }}">{{$repitem->totalcnt}}</a></td>
                    @if ($repitem->issuetype1_open != '0')
                      <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 3, 'issuetype' => 1]) }}">{{$repitem->issuetype1_open}}</a></td>
                    @else
                      <td></td>
                    @endif

                    @if ($repitem->issuetype1_rslv!= '0')
                      <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 2, 'issuetype' => 1]) }}">{{$repitem->issuetype1_rslv}}</a></td>
                    @else
                      <td></td>
                    @endif

                    @if ($repitem->issuetype2_open != '0')
                      <td lass="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 3, 'issuetype' => 2]) }}">{{$repitem->issuetype2_open}}</a></td>
                    @else
                      <td></td>
                    @endif

                    @if ($repitem->issuetype2_rslv != '0')
                      <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 2, 'issuetype' => 2]) }}">{{$repitem->issuetype2_rslv}}</a></td>
                    @else
                      <td></td>
                    @endif

                    @if ($repitem->issuetype3_open != '0')
                      <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 3, 'issuetype' => 3]) }}">{{$repitem->issuetype3_open}}</a></td>
                    @else
                      <td></td>
                    @endif

                    @if ($repitem->issuetype3_rslv != '0')
                      <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 2, 'issuetype' => 3]) }}">{{$repitem->issuetype3_rslv}}</a></td>
                    @else
                      <td></td>
                    @endif

                    @if ($repitem->issuetype4_open != '0')
                      <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 3, 'issuetype' => 4]) }}">{{$repitem->issuetype4_open}}</a></td>
                    @else
                      <td></td>
                    @endif

                    @if ($repitem->issuetype4_rslv != '0')
                      <td class="text-center"><a href="{{ route('summaryByAssignedtoIssueRepDetail', ['assignto' => $repitem->s_assignto, 'fullname' => $repitem->name, 'date1' => $date1, 'date2' => $date2, 'reptype' => 2, 'issuetype' => 4]) }}">{{$repitem->issuetype4_rslv}}</a></td>
                    @else
                      <td></td>
                    @endif

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                      <tr>
                        <th style="text-align:right">Total:</th>
                        <th class="text-center">{{$tTotal}}</th>
                        <th class="text-center">{{$tissue1_open}}</th>
                        <th class="text-center">{{$tissue1_rslv}}</th>
                        <th class="text-center">{{$tissue2_open}}</th>
                        <th class="text-center">{{$tissue2_rslv}}</th>
                        <th class="text-center">{{$tissue3_open}}</th>
                        <th class="text-center">{{$tissue3_rslv}}</th>
                        <th class="text-center">{{$tissue4_open}}</th>
                        <th class="text-center">{{$tissue4_rslv}}</th>
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
