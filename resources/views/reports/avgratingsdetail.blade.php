@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Average Ratings Details </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="cardsmall">
            <h2 class="invoice-header">
              <i class="fa fa-file-text-o"></i> Average Support Ratings - Details - {{$assigname}}
              <small class="pull-right">Date: {{ Carbon\carbon::now()->format('m/d/Y')}}</small>
            </h2>

            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-striped">
                <thead>
                <tr>
                  <th>Ticket No</th>
                  <th>Ratings</th>
                  <th>Issue Subject</th>
                  <th>Resolution</th>
                  <th>Rate Given By</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($repdata as $repitem)
                  <tr>
                    <td>{{$repitem->ticketno}}</td>
                    <td><input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{$repitem->rating}}" data-size="xs" disabled=""></td>
                    <td>{{$repitem->issuesubject}}</td>
                    <td>{{$repitem->m_resodesc}}</td>
                    <td>{{$repitem->ratedby}}</td>
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
        'searching'   : true,
        'order'       : [[ 1, "desc" ]]
    } );
} );
</script>


@endsection
