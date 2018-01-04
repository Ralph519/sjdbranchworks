@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> New Tickets </a>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="cardsmall">
            <h2 class="invoice-header">
              <i class="fa fa-file-text-o"></i> New Tickets Yearly
              <br>
              <small>For the past 5 Years</small>
            </h2>

            <div class="col-xs-12 table-responsive">
              <table id="reptable" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 8.33%;">{{ date('Y')-4 }}</th>
                    <th class="text-center" style="width: 8.33%;">{{ date('Y')-3 }}</th>
                    <th class="text-center" style="width: 8.33%;">{{ date('Y')-2 }}</th>
                    <th class="text-center" style="width: 8.33%;">{{ date('Y')-1 }}</th>
                    <th class="text-center" style="width: 8.33%;">{{ date('Y') }}</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($repdata as $repitem)
                  <tr>
                    <td>{{$repitem->year1}}</td>
                    <td>{{$repitem->year2}}</td>
                    <td>{{$repitem->year3}}</td>
                    <td>{{$repitem->year4}}</td>
                    <td>{{$repitem->year5}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-chart" data-background-color="green">
                        <div class="ct-chart" id="dailySalesChart"></div>
                    </div>
                    <div class="card-content">
                        <h4 class="title">Daily Tickets - Line Chart</h4>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-chart" data-background-color="red">
                        <div class="ct-chart" id="emailsSubscriptionChart"></div>
                    </div>
                    <div class="card-content">
                        <h4 class="title">Daily Tickets - Bar Chart</h4>
                    </div>
                    <div class="card-footer">

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

<script src="{{ asset("js/chartist.min.js")}}"></script>
<script src="{{ asset("js/material-dashboard.js")}}"></script>
<script>
type = ['', 'info', 'success', 'warning', 'danger'];

dashchart = {

  initDashboardPageCharts: function() {

        /* ----------==========     Daily Sales Chart initialization    ==========---------- */

        dataDailySalesChart = {
            labels:[
              '{{ date('Y')-4 }}','{{ date('Y')-3 }}','{{ date('Y')-2 }}','{{ date('Y')-1 }}','{{ date('Y') }}'
            ],
            series: [
                [
                  @foreach($repdata as $repitem)
                     '{{$repitem->year1}}',
                     '{{$repitem->year2}}',
                     '{{$repitem->year3}}',
                     '{{$repitem->year4}}',
                     '{{$repitem->year5}}'
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

        var dataEmailsSubscriptionChart = {
            labels: ['{{ date('Y')-4 }}', '{{ date('Y')-3 }}', '{{ date('Y')-2 }}', '{{ date('Y')-1 }}', '{{ date('Y') }}'],
            series: [
                [
                  @foreach($repdata as $repitem)
                    '{{$repitem->year1}}',
                    '{{$repitem->year2}}',
                    '{{$repitem->year3}}',
                    '{{$repitem->year4}}',
                    '{{$repitem->year5}}'
                  @endforeach
                ]
            ]
        };
        var optionsEmailsSubscriptionChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: 50,
            chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
            }
        };
        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];
        var emailsSubscriptionChart = Chartist.Bar('#emailsSubscriptionChart', dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(emailsSubscriptionChart);
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
