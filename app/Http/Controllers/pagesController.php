<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ticket;
use App\branch;
use App\user;
use App\issuetype;
use Carbon\Carbon;
use Excel;
use Alert;

use Illuminate\Support\Facades\Input;

class pagesController extends Controller
{
    public function index(Request $request){
      if (Auth::user()->isadmin=='Y'):
        $opentickets = ticket::where('s_statusxx','=','P')->get();
        $closedtickets = ticket::where('s_statusxx','=','C')->get();
        $newtickets = ticket::with('branch')
                              ->where([
                              ['s_statusxx','=','P']
                              ])
                              ->whereDate('created_at','=',Carbon::today()->toDateString())
                            ->get();

        $opentickets10 = ticket::where('s_statusxx','=','P')
                          ->orderBy('created_at', 'desc')
                            ->paginate(10);

        $closedtickets10 = ticket::where('s_statusxx','=','C')->orderby('d_rslvdate','desc')->take(10)->get();
        $newtickets10 = ticket::where([
                              ['s_statusxx','=','P']
                              ])
                              ->whereDate('created_at','=',Carbon::today()->toDateString())
                              ->orderBy('created_at', 'desc')
                              ->paginate(10);

        $issuetypes = issuetype::all();

        $toprepbranches = \DB::table('tickets')
                      ->select('tickets.s_brnccode', 'branches.s_brncname', \DB::raw("COUNT('tickets.s_brnccode') AS branch_count"))
                      ->join('branches', 'branches.s_brnccode', '=', 'tickets.s_brnccode')
                      ->orderBy('branch_count', 'desc')
                      ->groupBy('tickets.s_brnccode', 'branches.s_brncname')
                      ->take(5)
                      ->get();

        $newusers = user::orderby('created_at','desc')->take(4)->get();

        $ticketsperday = DB::select("select calendar.datefield AS DATE, substring(dayname(calendar.datefield),1,1) as day,
                                           IFNULL(COUNT(tickets.id),0) AS total_tickets
                                    FROM tickets RIGHT JOIN calendar ON (DATE(tickets.created_at) = calendar.datefield)
                                    WHERE (calendar.datefield BETWEEN (SELECT MAX(DATE_sub(date(created_at),INTERVAL 6 DAY)) FROM tickets) AND (SELECT MAX(DATE(created_at)) FROM tickets))
                                    GROUP BY date");

        $chartlastupdated = ticket::orderBy('id', 'desc')
                              ->take(1)
                              ->get();

        $increaseinticket = DB::select("select IF(b.yestdatecnt = '' , a.curdatecnt * 100 , round(((IFNULL(a.curdatecnt,0)-b.yestdatecnt)/b.yestdatecnt)*100,0)) as diff from
                                        (select count(*) as curdatecnt from tickets where date(created_at) = curdate()) a,
                                        (select count(*) as yestdatecnt from tickets where date(created_at) = curdate()-1) b");

        $alltickets = ticket::all();

        return view('pages.index', compact('opentickets','closedtickets', 'newtickets', 'alltickets',
          'opentickets10', 'closedtickets10', 'newtickets10', 'toprepbranches','newusers',
          'newtickets10branches','issuetypes', 'ticketsperday', 'chartlastupdated','increaseinticket'));
        else:
          $opentickets10 = ticket::where([
                            ['s_statusxx','=','P'],
                            ['s_assignto','=',Auth::user()->loginname]
                            ])
                            ->orderBy('created_at', 'desc')
                            ->paginate();

          $closedtickets10 = ticket::where([
                            ['s_statusxx','=','C'],
                            ['s_assignto','=',Auth::user()->loginname],
                            ])
                            ->orderby('d_rslvdate','desc')
                            ->paginate();

          $createdtickets = ticket::where([
                            ['s_reportby','=',Auth::user()->loginname],
                            ])
                            ->orderby('created_at','desc')
                            ->paginate(5);

          if ($request->ajax()) {
        		$view = view('data',compact('createdtickets'))->render();
                return response()->json(['html'=>$view]);
            }

          return view('pages.index', compact('opentickets10','closedtickets10','createdtickets'));
        endif;

    }

    public function filemaintenance(){
      return view('pages/filemaintenance');
    }

    public function showassigned()
    {
      $opentickets10 = ticket::where([
                        ['s_statusxx','=','P'],
                        ['s_assignto','=',Auth::user()->loginname]
                        ])
                        ->orderBy('created_at', 'desc')
                        ->paginate();

      $closedtickets10 = ticket::where([
                        ['s_statusxx','=','C'],
                        ['s_assignto','=',Auth::user()->loginname],
                        ])
                        ->orderby('d_rslvdate','desc')
                        ->paginate();

      return view('pages/showassigned', compact('opentickets10','closedtickets10'));
    }

    public function reports()
    {
      $newTicketYear = DB::select("select DISTINCT year(created_at) as Year FROM tickets order by year(created_at) desc");

      return view('pages/reports', compact('newTicketYear'));
    }

    public function searchresult(Request $request)
    {
      $branches = Branch::all();

      if (strlen($request['ticketno'])==12){
        $tickets = ticket::where([
                  ['s_brnccode','=',substr($request['ticketno'],0,2)],
                  ['s_trannmbr','=',substr($request['ticketno'],2,10)]
                  ])->get();

        if ($tickets->count()<=0){
          flash()->overlay('No record retrieved with the specified Ticket Number/topic', 'Search Ticket');
          return redirect()->intended('/');
        }
        else {
          return view ('tickets-mgmt/showticket', compact('tickets','branches'));
        }
      }else{
        // Search related topics
        $q = Input::get ( 'q' );

        $query = DB::table('Tickets');
        $query->where('s_statusxx','=','C');


        if($q != ""){

          $searchissues = DB::table('tickets')
            ->selectRaw('*')
            ->whereRaw('MATCH(issuesubject) AGAINST("' . $q . '")  AND s_statusxx = "C"')
            ->paginate(10)->setPath('');

          //$searchissues = $query->paginate(10)->setPath('');

          $pagination = $searchissues->appends ( array (
                				'q' => Input::get ( 'q' )
                		) );
        }else{
          $searchissues = DB::table('tickets')
            ->selectRaw('*')
            ->whereRaw('MATCH(issuesubject) AGAINST("' . $request['ticketno'] . '")  AND s_statusxx = "C"')
            ->paginate(10)->setPath('');

          $pagination = $searchissues->appends ( array (
                				'q' => Input::get ( 'ticketno' )
                		) );
        }

        if (count($searchissues)<=0){
          // flash()->overlay('No record retrieved with the specified topic', 'Search Ticket');
          Alert::warning('No record retrieved with the specified topic');
          return redirect()->intended('/');
        }
        else {
          return view ('pages/topicssearchresult', compact('searchissues'))->withDetails ($searchissues)->withQuery($q);
        }
      }
    }

}
