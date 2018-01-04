@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Search Results </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="cardsmall">

          <div class="row  invoice-info">
            <div class="col-sm-12 invoice-col">
              <h3 class="box-title">Search Results</h3>

              @foreach($searchissues as $searchissue)
              <h4 ><a href="{{ route('ticket-management.show', ['ticketid' => $searchissue->id]) }}" >{{ $searchissue->s_brnccode.$searchissue->s_trannmbr.' - '.$searchissue->issuesubject }}</a></h4>
              <dd style="margin-top: -1em;">{{str_limit($searchissue->m_issuedesc, 125)}}</dd>
              @endforeach

              {{ $searchissues->render() }}

            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
</div>
@endsection
