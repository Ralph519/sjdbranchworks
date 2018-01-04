<div class="modal fade" id="modal-summbybranch" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
        <h4 class="modal-title">Please specify a date range to filter the report</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('summarybybranch') }}" method="POST" id="repParam">
           {{ csrf_field() }}
             <div class="form-group">
               <label>Date From: </label>
               <div class="col-md-10 input-group">
                 <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
               </div>
             </div>

            <div class="form-group">
              <label>Date Thru: </label>
              <div class="col-md-10 input-group">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
               <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datethru" name="datethru" required data-mask>
              </div>
            </div>
          </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
       </div>
       </form>
      </div>
    </div>
  </div>

<!--  -->

<div class="modal fade" id="modal-summbyissuerep" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
        <h4 class="modal-title">Please specify a date range to filter the report</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('summarybyissuerep') }}" method="POST" id="repParam">
           {{ csrf_field() }}
             <div class="form-group">
               <label>Date From: </label>
               <div class="col-md-10 input-group">
                 <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
               </div>
             </div>

            <div class="form-group">
              <label>Date Thru: </label>
              <div class="col-md-10 input-group">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
               <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datethru" name="datethru" required data-mask>
              </div>
            </div>
          </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
       </div>
       </form>
      </div>
    </div>
  </div>


<!--  -->

<div class="modal fade" id="modal-summbybranchissuerep" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
        <h4 class="modal-title">Please specify a date range to filter the report</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('summarybybranchissuerep') }}" method="POST" id="repParam">
           {{ csrf_field() }}
             <div class="form-group">
               <label>Date From: </label>
               <div class="col-md-10 input-group">
                 <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
               </div>
             </div>

            <div class="form-group">
              <label>Date Thru: </label>
              <div class="col-md-10 input-group">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
               <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datethru" name="datethru" required data-mask>
              </div>
            </div>
          </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
       </div>
       </form>
      </div>
    </div>
  </div>


<!--  -->

<div class="modal fade" id="modal-summbyassignedto" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
        <h4 class="modal-title">Please specify a date range to filter the report</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('summarybyassignedto') }}" method="POST" id="repParam">
           {{ csrf_field() }}
             <div class="form-group">
               <label>Date From: </label>
               <div class="col-md-10 input-group">
                 <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
               </div>
             </div>

            <div class="form-group">
              <label>Date Thru: </label>
              <div class="col-md-10 input-group">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
               <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datethru" name="datethru" required data-mask>
              </div>
            </div>
          </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
       </div>
       </form>
      </div>
    </div>
  </div>

<!--  -->

<div class="modal fade" id="modal-summbyassignedtoissuereported" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">


      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
        <h4 class="modal-title">Please specify a date range to filter the report</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('summarybyassignedtoissuereported') }}" method="POST" id="repParam">
           {{ csrf_field() }}
             <div class="form-group">
               <label>Date From: </label>
               <div class="col-md-10 input-group">
                 <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
               </div>
             </div>

            <div class="form-group">
              <label>Date Thru: </label>
              <div class="col-md-10 input-group">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
               <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datethru" name="datethru" required data-mask>
              </div>
            </div>
          </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
       </div>
       </form>
      </div>
    </div>
  </div>

  <!--  -->

  <div class="modal fade" id="modal-summbyreportby" role="dialog" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">


        <div class="modal-header">
          <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
          <h4 class="modal-title">Please specify a date range to filter the report</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('summarybyreportby') }}" method="POST" id="repParam">
             {{ csrf_field() }}
               <div class="form-group">
                 <label>Date From: </label>
                 <div class="col-md-10 input-group">
                   <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
                 </div>
               </div>

              <div class="form-group">
                <label>Date Thru: </label>
                <div class="col-md-10 input-group">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                   </div>
                 <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datethru" name="datethru" required data-mask>
                </div>
              </div>
            </div>

         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
         </div>
         </form>
        </div>
      </div>
    </div>

  <!--  -->

  <div class="modal fade" id="modal-summbyreportbyissuereported" role="dialog" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">


        <div class="modal-header">
          <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
          <h4 class="modal-title">Please specify a date range to filter the report</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('summarybyreportbyissuerep') }}" method="POST" id="repParam">
             {{ csrf_field() }}
               <div class="form-group">
                 <label>Date From: </label>
                 <div class="col-md-10 input-group">
                   <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
                 </div>
               </div>

              <div class="form-group">
                <label>Date Thru: </label>
                <div class="col-md-10 input-group">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                   </div>
                 <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datethru" name="datethru" required data-mask>
                </div>
              </div>
            </div>

         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
         </div>
         </form>
        </div>
      </div>
    </div>

  <!--  -->

  <div class="modal fade" id="modal-newTicketByDaily" role="dialog" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">


        <div class="modal-header">
          <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
          <h4 class="modal-title">Please specify a starting date of a week to filter the report</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('getNewTicketsByDaily') }}" method="POST" id="repParam">
             {{ csrf_field() }}
               <div class="form-group">
                 <label>Date From: </label>
                 <div class="col-md-10 input-group">
                   <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" id="datefrom" name="datefrom" required data-mask autofocus>
                 </div>
               </div>

            </div>

         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
         </div>
         </form>
        </div>
      </div>
    </div>

<!--  -->

<div class="modal fade" id="modal-newTicketByMonth" role="dialog" tabindex="-1" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button aria-hidden="true" class="close" data-dismiss="modal" type="button"> <i class="material-icons">clear</i> </button>
        <h4 class="modal-title">Please select a year from the list below to filter the report</h4>
      </div>

      <div class="modal-body">
        <form action="{{ route('getNewTicketsByMonth') }}" method="POST" id="repParam">
           {{ csrf_field() }}
            <div class="form-group">
              <label>Select Year: </label>
              <div class="col-md-10 input-group">
                <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
               <select class="form-control" name="yearSelect">
                 @foreach($newTicketYear as $ticketYr)
                  <option value="{{$ticketYr->Year}}">{{$ticketYr->Year}}</option>
                 @endforeach
               </select>
              </div>
            </div>
          </div>

       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="myFormSubmit">Run Report</button>
       </div>
       </form>
      </div>
    </div>
  </div>
