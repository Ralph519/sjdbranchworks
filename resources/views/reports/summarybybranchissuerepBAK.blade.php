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
              <i class="fa fa-file-text-o"></i> Summary of Tickets created per Branch and Issue Reported
              <br>
              <small>From: {{$repdatefrom}} To: {{$repdatethru}}</small>
            </h2>

            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center" rowspan="2" style="width: 5%;">Branch Code</th>
                    <th class="text-center" rowspan="2" style="width: 15%;">Branch Name</th>
                    <th class="text-center" rowspan="2" style="width: 5%;">Total Count</th>
                    @foreach($issuetypes as $issuetype)
                    <th class="text-center" colspan="2" style="width: 10%;">
                      {{$issuetype->issuetype_desc}}
                    </th>
                    @endforeach
                  </tr>

                  <tr>
                  @foreach($issuetypes as $issuetype)
                    <th style="color: green" class="text-center"><i class="fa fa-check-circle-o" aria-hidden="true"></i></th>
                    <th style="color: red" class="text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i></th>
                  @endforeach
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $tTotal = 0;
                    $thardw_rslv = 0;
                    $thardw_open = 0;
                    $tsoftw_rslv = 0;
                    $tsoftw_open = 0;
                    $tnetwo_rslv = 0;
                    $tnetwo_open = 0;
                    $tsystm_rslv = 0;
                    $tsystm_open = 0;
                    $tothrs_rslv = 0;
                    $tothrs_open = 0;
                    $topstm_rslv = 0;
                    $topstm_open = 0;
                    $tcctvv_rslv = 0;
                    $tcctvv_open = 0;

                    $date1 = substr($repdatefrom,6,4).substr($repdatefrom,0,2).substr($repdatefrom,3,2);
                    $date2 = substr($repdatethru,6,4).substr($repdatethru,0,2).substr($repdatethru,3,2);
                  ?>
                  @foreach($repdata as $repitem)
                    <?php
                      // $tTotal = $tTotal + $repitem->totalcnt;
                      // $thardw_rslv = $thardw_rslv + $repitem->hardwarecnt_rslv;
                      // $thardw_open = $thardw_open + $repitem->hardwarecnt_open;
                      // $tsoftw_rslv = $tsoftw_rslv + $repitem->softwarecnt_rslv;
                      // $tsoftw_open = $tsoftw_open + $repitem->softwarecnt_open;
                      // $tnetwo_rslv = $tnetwo_rslv + $repitem->networkcnt_rslv;
                      // $tnetwo_open = $tnetwo_open + $repitem->networkcnt_open;
                      // $tsystm_rslv = $tsystm_rslv + $repitem->systemcnt_rslv;
                      // $tsystm_open = $tsystm_open + $repitem->systemcnt_open;
                      // $tothrs_rslv = $tothrs_rslv + $repitem->otherscnt_rslv;
                      // $tothrs_open = $tothrs_open + $repitem->otherscnt_open;
                      // $topstm_rslv = $topstm_rslv + $repitem->oscnt_rslv;
                      // $topstm_open = $topstm_open + $repitem->oscnt_open;
                      // $tcctvv_rslv = $tcctvv_rslv + $repitem->cctvcnt_rslv;
                      // $tcctvv_open = $tcctvv_open + $repitem->cctvcnt_open;
                      $testvar = '$repitem->aircon_p'
                    ?>
                  <tr>
                    @foreach($repitem as $column_name => $value)
                      @if($column_name != 's_brnccode' && $column_name != 's_brncname' && $column_name != 'totl')
                      <td><a href="{{ route('summarybybranchissuerepdetail', ['brnccode' => $repitem->s_brnccode, 'brncname' => $repitem->s_brncname, 'date1' => $date1, 'date2' => $date2, 'reptype' => 1, 'issuetype' => 1]) }}">{{$value}}</a></td>
                      @else
                      <td>{{$value}}</td>
                      @endif
                    @endforeach
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                      <tr>
                        <th colspan="2" style="text-align:right">Total:</th>


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
