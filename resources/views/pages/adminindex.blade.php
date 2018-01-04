@section('content')
<div class="content">
    <div class="container-fluid">

      <!-- First Row Items -->

      <div class="row">
         <div class="col-lg-3 col-md-6 col-sm-6">
             <div class="card card-stats">
                 <div class="card-header" data-background-color="red">
                     <i class="fa fa-ticket"></i>
                 </div>
                 <div class="card-content">
                     <p class="category">Open Tickets</p>
                     <h3 class="title">{{$opentickets->count()}}</h3>
                 </div>
                 <div class="card-footer">
                     <div class="stats">
                         <a href="{{route('ticket-management.viewallopentickets')}}">More Info...</a>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-3 col-md-6 col-sm-6">
             <div class="card card-stats">
                 <div class="card-header" data-background-color="red">
                     <i class="fa fa-check-square"></i>
                 </div>
                 <div class="card-content">
                     <p class="category">Resolved </p>
                     <h3 class="title">{{$closedtickets->count()}}</h3>
                 </div>
                 <div class="card-footer">
                   <div class="stats">
                       <a href="{{route('ticket-management.viewallclosetickets')}}">More Info...</a>
                   </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-3 col-md-6 col-sm-6">
             <div class="card card-stats">
                 <div class="card-header" data-background-color="red">
                     <i class="fa fa-plus-circle"></i>
                 </div>
                 <div class="card-content">
                     <p class="category">New Tickets</p>
                     <h3 class="title">{{$newtickets->count()}}</h3>
                 </div>
                 <div class="card-footer">
                   <div class="stats">
                       <a href="{{route('ticket-management.viewnewtickets')}}">More Info...</a>
                   </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-3 col-md-6 col-sm-6">
             <div class="card card-stats">
                 <div class="card-header" data-background-color="red">
                     <i class="fa fa-list"></i>
                 </div>
                 <div class="card-content">
                     <p class="category">Total Tickets</p>
                     <h3 class="title">{{$alltickets->count()}}</h3>
                 </div>
                 <div class="card-footer">
                   <div class="stats">
                       <a href="{{route('ticket-management.viewalltickets')}}">More Info...</a>
                   </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- 2nd Row Items -->
     <div class="row">
       <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">New Tickets</h4>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                            <th>ID</th>
                            <th>Ticket No.</th>
                            <th>Subject</th>
                            <th>Issue Type</th>
                            <th>Created</th>
                        </thead>
                        <tbody>
                            @foreach($newtickets10 as $newticket10)
                            <tr>
                                <td>{{$newticket10->id}}</td>
                                <td><a href="{{ route('ticket-management.edit', ['id' => $newticket10->id]) }}">{{$newticket10->s_brnccode.$newticket10->s_trannmbr}}</a></td>
                                <td>{{$newticket10->issuesubject}}</td>
                                <td>{{$newticket10->ticketissues->first()->issuetype_desc}}</td>
                                <td>{{ $newticket10->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        <!-- 2nd Table  -->

             <div class="card">
                 <div class="card-header" data-background-color="purple">
                     <h4 class="title">Open Tickets</h4>
                 </div>
                 <div class="card-content table-responsive">
                     <table class="table table-hover">
                         <thead class="text-warning">
                             <th>ID</th>
                             <th>Ticket No.</th>
                             <th>Subject</th>
                             <th>Assigned To</th>
                             <th>Created</th>
                         </thead>
                         <tbody>
                            @foreach($opentickets10 as $openticket10)
                             <tr>
                                 <td>{{$openticket10->id}}</td>
                                 <td><a href="{{ route('ticket-management.edit', ['id' => $openticket10->id]) }}">{{$openticket10->s_brnccode.$openticket10->s_trannmbr}}</a></td>
                                 <td>{{$openticket10->issuesubject}}</td>
                                 <td>{{$openticket10->s_assignto}}</td>
                                 <td>{{ $openticket10->created_at->diffForHumans() }}</td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>

             <!-- 3rd Table  -->

              <div class="card">
                  <div class="card-header" data-background-color="purple">
                      <h4 class="title">Recently Resolved Tickets</h4>
                  </div>
                  <div class="card-content table-responsive">
                      <table class="table table-hover">
                          <thead class="text-warning">
                              <th>ID</th>
                              <th>Ticket No.</th>
                              <th>Subject</th>
                              <th>Resolved By</th>
                              <th>Resolved Date</th>
                          </thead>
                          <tbody>
                              @foreach($closedtickets10 as $closedticket10)
                              <tr>
                                  <td>{{$closedticket10->id}}</td>
                                  <td><a href="{{ route('ticket-management.show', ['id' => $closedticket10->id]) }}">{{$closedticket10->s_brnccode.$closedticket10->s_trannmbr}}</a></td>
                                  <td>{{$closedticket10->issuesubject}}</td>
                                  <td>{{$closedticket10->s_assignto}}</td>
                                  <td>{{$closedticket10->d_rslvdate}}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
           </div>

      <!-- Right side panel  -->
      <div class="col-md-4">
          <div class="card">
              <div class="card-header card-chart" data-background-color="green">
                  <div class="ct-chart" id="dailySalesChart"></div>
              </div>
              <div class="card-content">
                  <h4 class="title">Daily Tickets</h4>
                  <p class="category">
                      @foreach($increaseinticket as $inctick)
                        @if($inctick->diff==0)
                          no movement in today's ticket count.</p>
                        @elseif($inctick->diff < 0)
                          <span class="text-danger"><i class="fa fa-long-arrow-down"></i> {{$inctick->diff}}% </span> decrease in today's tickets.</p>
                        @else
                          <span class="text-success"><i class="fa fa-long-arrow-up"></i> {{$inctick->diff}}% </span> increase in today's tickets.</p>
                        @endif
                      @endforeach
              </div>
              <div class="card-footer">
                  <div class="stats">
                      @foreach($chartlastupdated as $clastupdated)
                      <i class="material-icons">access_time</i> updated {{ $clastupdated->created_at->diffForHumans() }}
                      @endforeach
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-4">
          <div class="cardsmall">
              <div class="cardsmall-header cardsmall-header-icon" data-background-color="green">
                  <i class="material-icons">assignment</i>
              </div>
              <div class="cardsmall-content">
                <h4 class="cardsmall-title">Issues Reported</h4>

                <div class="row">

                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                      @foreach ($issuetypes as $issuetype)
                        <li><a href="{{ route('ticket-management.dispissues', ['issuetype' => $issuetype->issuetype_code]) }}">{{ $issuetype->issuetype_desc }}<span class="pull-right badge bg-blue">{{count($alltickets->where("issuetype",$issuetype->issuetype_code))}}</span></a></li>
                      @endforeach
                    </ul>

                  </div> <!-- application/fillings row -->
              </div>
            </div>
        </div>
     </div>

     <div class="col-md-4">
         <div class="cardsmall">
             <div class="cardsmall-header cardsmall-header-icon" data-background-color="green">
                 <i class="material-icons">perm_phone_msg</i>
             </div>
             <div class="cardsmall-content">
               <h4 class="cardsmall-title">Top 5 Reporting Branches</h4>

               <div class="row">

               <div class="box-footer no-padding">
                   <ul class="nav nav-stacked">
                     @foreach($toprepbranches as $toprepbranch)
                      <li><a href="{{ route('ticket-management.toprepbranches', ['brnccode' => $toprepbranch->s_brnccode]) }}">{{$toprepbranch->s_brncname}} <span class="pull-right badge bg-blue">{{$toprepbranch->branch_count}}</span></a></li>
                     @endforeach
                   </ul>

                 </div> <!-- application/fillings row -->
             </div>
           </div>
       </div>
     </div>

     <div class="col-md-4">
         <div class="cardsmall">
             <div class="cardsmall-header cardsmall-header-icon" data-background-color="green">
                 <i class="material-icons">face</i>
             </div>
             <div class="cardsmall-content">
               <h4 class="cardsmall-title">Recently Added Users </h4>

               <div class="row">

                 <div class="col-md-12">
                   <div class="content table-responsive">
                    <table class="table">
                      <tbody>
                        @foreach($newusers as $newuser)
                        <tr>
                          <td width="40px;">
                            <div>
                              <img src="{{  URL::asset('/uploads/avatars/' . $newuser->avatar) }}" style="width:48px; height:48px; border-radius:50%;" alt="User Pic">
                            </div>
                          </td>
                          <td class="pull-left"> <a href="#"> {{$newuser->name}} </a> <br> <small>{{$newuser->empno}}</small>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                   </div>
                 </div>

             </div>
           </div>
       </div>
     </div>

  </div> <!-- container-fluid -->
</div> <!-- content -->
@endsection

@section('pagescripts')
<script src="{{ asset("js/chartist.min.js")}}"></script>
<script src="{{ asset("js/material-dashboard.js")}}"></script>
<script>
type = ['', 'info', 'success', 'warning', 'danger'];

dashchart = {

  initDashboardPageCharts: function() {

        /* ----------==========     Daily Sales Chart initialization    ==========---------- */

        dataDailySalesChart = {
            labels:[
            @foreach($ticketsperday as $ticketperday)
              @if($ticketperday == end($ticketsperday))
               '{{$ticketperday->day}}'
              @else
                '{{$ticketperday->day}}',
              @endif
            @endforeach
            ],
            series: [
                [
                  @foreach($ticketsperday as $ticketperday)
                    @if($ticketperday == end($ticketsperday))
                     '{{$ticketperday->total_tickets}}'
                    @else
                      '{{$ticketperday->total_tickets}}',
                    @endif
                  @endforeach
                ]
            ]
        };

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 30, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        }

        var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

        md.startAnimationForLineChart(dailySalesChart);
      }
    }

</script>

<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        dashchart.initDashboardPageCharts();

    });
</script>


@endsection
