@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Resolved Ticket </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="cardsmall">
            <h2 class="invoice-header">
              <i class="fa fa-ticket"></i> {{$tickets->s_brnccode.$tickets->s_trannmbr}}
              <small class="pull-right">Resolve Date: {{$tickets->d_rslvdate}}</small>
            </h2>


            <div class="row  invoice-info">
              <div class="col-sm-12 invoice-col">

                <address>
                  From:
                  @foreach($branches as $branch)
                    @if ($tickets->s_brnccode==$branch->s_brnccode)
                  <strong>{{$branch->s_brnccode.' - '.$branch->s_brncname}}</strong><br>
                    @endif
                  @endforeach
                  Subject: <strong>{{$tickets->issuesubject}}</strong><br>
                  Issue Type: <strong>{{ $tickets->ticketissues->first()->issuetype_desc }} </strong>
                  <br>
                    Priority: <strong>
                    @if ($tickets->s_priority=="1")
                      High
                    @elseif ($tickets->s_priority=="2")
                      Medium
                    @elseif ($tickets->s_priority=="3")
                      Low
                    @endif
                    </strong>
                  <br>
                </address>

                <div class="row">
                  <div class="col-xs-12">
                    <p class="lead">Issue Description :</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$tickets->m_issuedesc}}
                    </p>
                  </div>

                  <div class="col-xs-12">
                    <p class="lead">Resolution :</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {!! nl2br(e($tickets->m_resodesc)) !!}
                    </p>
                  </div>
                </div>

                <div class="row">
                  @if ($tickets->m_notesxxx!="")
                  <div class="col-xs-12">
                    <p class="lead">Notes :</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$tickets->m_notesxxx}}
                    </p>
                  </div>
                  @endif

                  <div class="col-xs-6">
                    <p class="lead">Reported By :</p>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$tickets->s_reportby}}
                    </p>
                  </div>
                  <div class="col-xs-6">
                    <p class="lead">Resolved By :</p>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$tickets->s_assignto}}
                    </p>
                  </div>
                </div>

              </div>
            </div>

            <br>
            <a href="javascript:history.back()" type="button" class="btn btn-primary btn-simple pull-right">Go Back</a>

          </div>
        </div>
      </div>



  </div>
</div>
@endsection
