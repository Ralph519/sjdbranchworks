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
                    $IssueRepCtr = 0;

                    $date1 = substr($repdatefrom,6,4).substr($repdatefrom,0,2).substr($repdatefrom,3,2);
                    $date2 = substr($repdatethru,6,4).substr($repdatethru,0,2).substr($repdatethru,3,2);
                  ?>
                  @foreach($repdata as $repitem)
                  <tr>
                    @foreach($repitem as $column_name => $value)
                      <?php
                        // get Issue Type Code from the column name
                        $lIssueType = substr($column_name,strlen($column_name)-1,1);
                        $status = substr($column_name,strlen($column_name)-2,1);
                        // check which report type will be passed based on the column name if C(closed) or P(pending)
                        if (substr($column_name,strlen($column_name)-2,1) == 'C'):
                          $lRepType = '2';
                        else:
                          $lRepType = '3';
                        endif;

                        if ($column_name == 'totl'):
                          $lRepType = '1';
                          $tTotal = $tTotal + $value;
                        endif;
                      ?>
                      @if($column_name != 's_brnccode' && $column_name != 's_brncname')
                        <td><a href="{{ route('summarybybranchissuerepdetail', ['brnccode' => $repitem->s_brnccode, 'brncname' => $repitem->s_brncname, 'date1' => $date1, 'date2' => $date2, 'reptype' => $lRepType, 'issuetype' => $lIssueType]) }}">{{$value}}</a></td>
                        <?php
                        ${"t".$status.$lIssueType} = (isset(${"t".$status.$lIssueType}) ? ${"t".$status.$lIssueType} : 0) + $value;
                        ?>
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
                        <th style="text-align:center">{{$tTotal}}</th>
                        @foreach($issuetypes as $issuetype)
                        <th style="text-align:center"><?php echo ${"tP".trim($issuetype->issuetype_code)} ?></th>
                        <th style="text-align:center"><?php echo ${"tC".trim($issuetype->issuetype_code)} ?></th>
                        @endforeach
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
