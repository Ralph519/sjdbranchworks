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
              <i class="fa fa-file-text-o"></i> SJD Branches Masterfile
              <small class="pull-right">Date: {{ Carbon\carbon::now()->format('m/d/Y')}}</small>
            </h2>

            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-striped">
                <thead>
                <tr>
                  <th>Branch Code</th>
                  <th>Branch Description</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($branches as $branch)
                  <tr>
                    <td>{{$branch->s_brnccode}}</td>
                    <td>{{$branch->s_brncname}}</td>
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
