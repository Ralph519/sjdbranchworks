@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> Click on the links below to preview a report </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5">

        <div class="cardsmall">
            <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="cardsmall-content">
              <h4 class="cardsmall-title">Summary of Ticket Created</h4>

              <div class="row">

                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">

                        <li><a href="#" data-toggle="modal" data-target="#modal-summbybranch"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Count By Branch</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-summbyissuerep"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Count By Issue Reported</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-summbybranchissuerep"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Count By Branch and Issue Reported</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-summbyassignedto"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Count By Assigned to</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-summbyassignedtoissuereported"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Count By Assigned to and Issue Reported</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-summbyreportby"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Count By Reported By</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-summbyreportbyissuereported"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Count By Reported By and Issue Reported</a></li>

                    </ul>
                  </div>

                </div>

          </div>
        </div>

        <div class="cardsmall">
            <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="cardsmall-content">
              <h4 class="cardsmall-title">New Tickets</h4>

              <div class="row">

                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">

                        <li><a href="#" data-toggle="modal" data-target="#modal-newTicketByDaily"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp; Daily new Tickets in a week</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-newTicketByMonth"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp; By Month</a></li>
                        <li><a href="{{ route('getNewTicketsByYear') }}"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp; For the last Five(5) years</a></li>

                    </ul>
                  </div>

                </div>

          </div>
        </div>

     </div>

     <div class="col-md-5">

       <div class="cardsmall">
           <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
               <i class="material-icons">assignment</i>
           </div>
           <div class="cardsmall-content">
             <h4 class="cardsmall-title">Other Reports</h4>

             <div class="row">

               <div class="box-footer no-padding">
                   <ul class="nav nav-stacked">

                       <li><a href="{{ route('morethan24hours') }}"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Open Tickets for more than 24 Hours</a></li>
                       <li><a href="{{ route('averageresolvetime') }}"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Average Resolve Time(in Hours)</a></li>

                   </ul>
                 </div>

               </div>

         </div>
       </div>

       <div class="cardsmall">
           <div class="cardsmall-header cardsmall-header-icon" data-background-color="purple">
               <i class="material-icons">assignment</i>
           </div>
           <div class="cardsmall-content">
             <h4 class="cardsmall-title">References</h4>

             <div class="row">

               <div class="box-footer no-padding">
                   <ul class="nav nav-stacked">

                       <li><a href="{{ route('branches') }}"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Branches</a></li>
                       <li><a href="{{ route('issuesreported') }}"><i class="fa fa-dot-circle-o"></i> &nbsp;&nbsp;Issues Reported</a></li>

                   </ul>
                 </div>

               </div>

         </div>
       </div>


     </div>

    </div>
  </div>
</div>

@include('reports.showreportparameters')
@endsection

@section('pagescripts')
<!-- Input Mask -->
<script src="{{asset ("/js/inputmask.js") }}"></script>
<script src="{{asset ("/js/inputmask.date.extensions.js") }}"></script>
<script src="{{asset ("/js/inputmask.extensions.js") }}"></script>

<script>
  $(function () {
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    $('[data-mask]').inputmask()
  })
</script>

<script>
$('#repParam').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});
</script>


@endsection
