@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Ticket </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="cardsmall">
            <h2 class="invoice-header">
              @foreach($tickets as $ticket)
              <i class="fa fa-ticket"></i> {{ $ticket->s_brnccode.$ticket->s_trannmbr }}

              @if($ticket->s_statusxx != 'P')
                <small class="pull-right">Resolve Date: {{$ticket->d_rslvdate}}</small>
              @else
                <small class="pull-right"><a href="{{ route('ticket-management.edit', ['id' => $ticket->id]) }}">Edit Ticket</a></small>
              @endif

            </h2>


            <div class="row  invoice-info">
              <div class="col-sm-12 invoice-col">

                <address>
                  From:
                  <strong>{{$ticket->branch->first()->s_brncname}}</strong><br>
                  Subject: <strong>{{$ticket->issuesubject}}</strong><br>
                  Issue Type: <strong>{{ $ticket->ticketissues->first()->issuetype_desc }} </strong>
                  <br>
                    Priority: <strong>
                    @if ($ticket->s_priority=="1")
                      High
                    @elseif ($ticket->s_priority=="2")
                      Medium
                    @elseif ($ticket->s_priority=="3")
                      Low
                    @endif
                    </strong>
                  <br>
                </address>

                <div class="row">
                  <div class="col-xs-12">
                    <p class="lead">Issue Description :</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$ticket->m_issuedesc}}
                    </p>
                  </div>

                  <div class="col-xs-12">
                    <p class="lead">Resolution :</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {!! nl2br(e($ticket->m_resodesc)) !!}
                    </p>
                  </div>
                </div>

                <div class="row">
                  @if ($ticket->m_notesxxx!="")
                  <div class="col-xs-12">
                    <p class="lead">Notes :</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$ticket->m_notesxxx}}
                    </p>
                  </div>
                  @endif

                  <hr>

                  <div class="col-xs-6">
                    <p class="lead">Reported By :</p>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$ticket->s_reportby}}
                    </p>
                  </div>
                  <div class="col-xs-6">
                    <p class="lead">Assigned To :</p>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      {{$ticket->s_assignto}}
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
@endforeach


  </div>
</div>
@endsection
