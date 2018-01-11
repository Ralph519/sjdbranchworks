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
use Illuminate\Support\Facades\Input;

class ReportsController extends Controller
{
  // COUNT BY BRANCH
  public function summaryByBranch(Request $request)
  {
    $repdatefrom = $request->input('datefrom');
    $repdatethru = $request->input('datethru');

    $date1 = Carbon::parse($request->input('datefrom'));
    $date2 = Carbon::parse($request->input('datethru'));

    $repdata = DB::select(DB::raw("select tickets.s_brnccode, branches.s_brncname, count(*) as totalcnt,
                                  	sum(case when s_statusxx ='C' then 1 else 0 end) as resolvedcnt,
                                      sum(case when s_statusxx ='P' then 1 else 0 end) as opencnt
                                  FROM tickets
                                  	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      WHERE tickets.created_at between :datefrom and :datethru
                                  GROUP BY tickets.s_brnccode, branches.s_brncname;
                                      "), array('datefrom' => $date1, 'datethru' => $date2));

    return view('reports.summarybybranch', compact('repdata','repdatefrom','repdatethru'));
  }

  // COUNT BY BRANCH - DETAIL
  public function summaryByBranchDetail($brnccode,$brncname,$date1,$date2,$reptype)
  {
    $s_brnccode = $brnccode;
    $s_brncname = $brncname;

    $repdatefrom = $date1;
    $repdatethru = $date2;

    switch ($reptype){
      case 1:
        $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                    	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_brnccode = :brnccode;"), array('datefrom' => $date1, 'datethru' => $date2, 'brnccode' => $s_brnccode));
        break;
      case 2:
          $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                      INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_brnccode = :brnccode
                                    AND tickets.s_statusxx = 'C';"), array('datefrom' => $date1, 'datethru' => $date2, 'brnccode' => $s_brnccode));
          break;
        case 3:
            $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                      FROM tickets
                                        INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                        INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                        LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      AND tickets.s_brnccode = :brnccode
                                      AND tickets.s_statusxx = 'P';"), array('datefrom' => $date1, 'datethru' => $date2, 'brnccode' => $s_brnccode));
            break;
    }
    return view('reports/summaryByBranchDetail',compact('repdata', 's_brncname','repdatefrom','repdatethru'));
  }

  // COUNT BY ISSUE REPORTED
  public function summaryByIssueRep(Request $request)
  {
    $repdatefrom = $request->input('datefrom');
    $repdatethru = $request->input('datethru');

    $date1 = Carbon::parse($request->input('datefrom'));
    $date2 = Carbon::parse($request->input('datethru'));

    $repdata = DB::select(DB::raw("select issuetype, issuetypes.issuetype_desc, count(*) as totalcnt,
                                    	sum(case when s_statusxx ='C' then 1 else 0 end) as resolvedcnt,
                                        sum(case when s_statusxx ='P' then 1 else 0 end) as opencnt
                                    FROM tickets
                                    INNER JOIN issuetypes on tickets.issuetype = issuetypes.issuetype_code
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    group by issuetype, issuetype_desc;
                                      "), array('datefrom' => $date1, 'datethru' => $date2));

    return view('reports.summaryByIssueRep', compact('repdata','repdatefrom','repdatethru'));
  }

  // COUNT BY ISSUE REPORTED - DETAIL
  public function summaryByIssueRepDetail($issuetype,$issuetypedesc,$date1,$date2,$reptype)
  {
    $s_issuetype = $issuetype;
    $s_issuetypedesc = $issuetypedesc;

    $repdatefrom = $date1;
    $repdatethru = $date2;

    switch ($reptype){
      case 1:
        $repdata = DB::select(DB::raw("select concat(tickets.s_brnccode,s_trannmbr) as trannmbr, s_brncname, issuetypes.issuetype_desc, tickets.*, users.name
                                        FROM tickets
                                        	INNER JOIN issuetypes on tickets.issuetype = issuetypes.issuetype_code
                                        	INNER JOIN branches on tickets.s_brnccode = branches.s_brnccode
                                        	LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                        WHERE tickets.created_at between :datefrom and :datethru
                                        ORDER BY tickets.s_brnccode;"), array('datefrom' => $date1, 'datethru' => $date2, 'issuetype' => $s_issuetype));
          $reptitle = 'Total Tickets with ';
          break;
      case 2:
        $repdata = DB::select(DB::raw("select concat(tickets.s_brnccode,s_trannmbr) as trannmbr, s_brncname, issuetypes.issuetype_desc, tickets.*, users.name
                                        FROM tickets
                                        	INNER JOIN issuetypes on tickets.issuetype = issuetypes.issuetype_code
                                        	INNER JOIN branches on tickets.s_brnccode = branches.s_brnccode
                                        	LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                        WHERE tickets.created_at between :datefrom and :datethru
                                        	AND issuetype = :issuetype
                                          AND tickets.s_statusxx = 'C'
                                        ORDER BY tickets.s_brnccode;"), array('datefrom' => $date1, 'datethru' => $date2, 'issuetype' => $s_issuetype));
          $reptitle = 'Resolved Tickets with ';
          break;
        case 3  :
          $repdata = DB::select(DB::raw("select concat(tickets.s_brnccode,s_trannmbr) as trannmbr, s_brncname, issuetypes.issuetype_desc, tickets.*, users.name
                                          FROM tickets
                                          	INNER JOIN issuetypes on tickets.issuetype = issuetypes.issuetype_code
                                          	INNER JOIN branches on tickets.s_brnccode = branches.s_brnccode
                                          	LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                          WHERE tickets.created_at between :datefrom and :datethru
                                          	AND issuetype = :issuetype
                                            AND tickets.s_statusxx = 'P'
                                          ORDER BY tickets.s_brnccode;"), array('datefrom' => $date1, 'datethru' => $date2, 'issuetype' => $s_issuetype));
            $reptitle = 'Open Tickets with ';
            break;
        }
    return view('reports/summaryByIssueRepDetail',compact('repdata', 's_issuetypedesc','repdatefrom','repdatethru','reptitle'));
  }

  // COUNT BY BRANCH AND ISSUE REPORTED
  public function summaryByBranchIssueRep(Request $request)
  {
    $repdatefrom = $request->input('datefrom');
    $repdatethru = $request->input('datethru');

    $date1 = substr($repdatefrom,6,4).substr($repdatefrom,0,2).substr($repdatefrom,3,2);
    $date2 = substr($repdatethru,6,4).substr($repdatethru,0,2).substr($repdatethru,3,2);

    $repdata = DB::select('call bybranchissuerep(?,?)',array($date1,$date2));

    $issuetypes = issuetype::all();

    $repTypeDesc = " Per Branch ";

    // $repdata = DB::select(DB::raw("select tickets.s_brnccode, branches.s_brncname, count(*) as totalcnt,
    //                                   sum(case when issuetype = 1 and s_statusxx = 'C' then 1 else 0 end) as issuetype1_rslv,
    //                                   sum(case when issuetype = 1 and s_statusxx = 'P' then 1 else 0 end) as issuetype1_open,
    //                                   sum(case when issuetype = 2 and s_statusxx = 'C' then 1 else 0 end) as issuetype2_rslv,
    //                                   sum(case when issuetype = 2 and s_statusxx = 'P' then 1 else 0 end) as issuetype2_open,
    //                                   sum(case when issuetype = 3 and s_statusxx = 'C' then 1 else 0 end) as issuetype3_rslv,
    //                                   sum(case when issuetype = 3 and s_statusxx = 'P' then 1 else 0 end) as issuetype3_open,
    //                                   sum(case when issuetype = 4 and s_statusxx = 'C' then 1 else 0 end) as issuetype4_rslv,
    //                                   sum(case when issuetype = 4 and s_statusxx = 'P' then 1 else 0 end) as issuetype4_open
    //                               FROM tickets
    //                               	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
    //                                   WHERE tickets.created_at between :datefrom and :datethru
    //                               GROUP BY tickets.s_brnccode, branches.s_brncname;
    //                                   "), array('datefrom' => $date1, 'datethru' => $date2));

    return view('reports.summaryByBranchIssueRep', compact('repdata', 'issuetypes', 'repdatefrom', 'repdatethru', 'repTypeDesc'));

  }

  // COUNT BY BRANCH AND ISSUE REPORTED - DETAIL
  public function summaryByBranchIssueRepDetail($brnccode,$brncname,$date1,$date2,$reptype,$issuetype)
  {
    $s_brnccode = $brnccode;
    $s_brncname = $brncname;
    $s_issuetype = $issuetype;

    $repdatefrom = $date1;
    $repdatethru = $date2;

    $repTypeDesc = " Per Branch ";

    switch ($reptype){
      case 1:
        $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                    	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_brnccode = :brnccode;"),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'brnccode' => $s_brnccode));
        $reptitle = 'Total Tickets of ' . $s_brncname;
        break;
      case 2:
          $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                      INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_brnccode = :brnccode
                                    AND tickets.s_statusxx = 'C'
                                    AND tickets.issuetype = :issuetype;"),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'brnccode' => $s_brnccode, 'issuetype' => $s_issuetype));
          $reptitle = 'Closed Tickets of ' . $s_brncname;
          break;
        case 3:
            $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                      FROM tickets
                                        INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                        INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                        LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      AND tickets.s_brnccode = :brnccode
                                      AND tickets.s_statusxx = 'P'
                                      AND tickets.issuetype = :issuetype;"),
                                      array('datefrom' => $date1, 'datethru' => $date2, 'brnccode' => $s_brnccode, 'issuetype' => $s_issuetype));
            $reptitle = 'Open Tickets with ' . $s_brncname;
            break;
    }
    return view('reports/summaryByReportWithIssueRepDetail',compact('repdata', 's_brncname','repdatefrom','repdatethru','reptitle', 'repTypeDesc'));
  }

  // COUNT BY ASSIGNED TO
  public function summaryByAssignedTo(Request $request)
  {
    $repdatefrom = $request->input('datefrom');
    $repdatethru = $request->input('datethru');

    $date1 = Carbon::parse($request->input('datefrom'));
    $date2 = Carbon::parse($request->input('datethru'));

    $repdata = DB::select(DB::raw("select users.name, tickets.s_assignto, count(*) as totalcnt,
                                      	sum(case when s_statusxx ='C' then 1 else 0 end) as resolvedcnt,
                                      	sum(case when s_statusxx ='P' then 1 else 0 end) as opencnt
                                      FROM tickets
                                      INNER JOIN users on tickets.s_assignto = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      group by loginname, name, s_assignto;
                                      "), array('datefrom' => $date1, 'datethru' => $date2));

    return view('reports.summaryByAssignTo', compact('repdata','repdatefrom','repdatethru'));
  }

  // COUNT BY ASSIGNED TO - DETAIL
  public function summaryByAssignedToDetail($assignto,$assigntoname,$date1,$date2,$reptype)
  {
    $s_assignto = $assignto;
    $s_assigntoname = $assigntoname;

    $repdatefrom = $date1;
    $repdatethru = $date2;

    switch ($reptype){
      case 1:
        $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                    	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_assignto = :assignto;"),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'assignto' => $s_assignto));
        break;
      case 2:
          $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                      INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_assignto = :assignto
                                    AND tickets.s_statusxx = 'C';"),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'assignto' => $s_assignto));
          break;
        case 3:
            $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                      FROM tickets
                                        INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                        INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                        LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      AND tickets.s_assignto = :assignto
                                      AND tickets.s_statusxx = 'P';"),
                                      array('datefrom' => $date1, 'datethru' => $date2, 'assignto' => $s_assignto));
            break;
    }
    return view('reports/summaryByAssigntoDetail',compact('repdata', 's_assigntoname','repdatefrom','repdatethru'));
  }


  // COUNT BY ASSIGNED TO AND ISSUE REPORTED
  public function summaryByAssignedToIssueReported(Request $request)
  {
    $repdatefrom = $request->input('datefrom');
    $repdatethru = $request->input('datethru');

    // $date1 = Carbon::parse($request->input('datefrom'));
    // $date2 = Carbon::parse($request->input('datethru'));

    $date1 = substr($repdatefrom,6,4).substr($repdatefrom,0,2).substr($repdatefrom,3,2);
    $date2 = substr($repdatethru,6,4).substr($repdatethru,0,2).substr($repdatethru,3,2);

    $repdata = DB::select('call byassigntoissuerep(?,?)',array($date1,$date2));

    $issuetypes = issuetype::all();

    // $repdata = DB::select(DB::raw("select s_assignto, name, count(*) as totalcnt,
    //                                   sum(case when issuetype = 1 and s_statusxx = 'C' then 1 else 0 end) as issuetype1_rslv,
    //                                   sum(case when issuetype = 1 and s_statusxx = 'P' then 1 else 0 end) as issuetype1_open,
    //                                   sum(case when issuetype = 2 and s_statusxx = 'C' then 1 else 0 end) as issuetype2_rslv,
    //                                   sum(case when issuetype = 2 and s_statusxx = 'P' then 1 else 0 end) as issuetype2_open,
    //                                   sum(case when issuetype = 3 and s_statusxx = 'C' then 1 else 0 end) as issuetype3_rslv,
    //                                   sum(case when issuetype = 3 and s_statusxx = 'P' then 1 else 0 end) as issuetype3_open,
    //                                   sum(case when issuetype = 4 and s_statusxx = 'C' then 1 else 0 end) as issuetype4_rslv,
    //                                   sum(case when issuetype = 4 and s_statusxx = 'P' then 1 else 0 end) as issuetype4_open
    //                                 FROM tickets
    //                                 INNER JOIN users on users.loginname = tickets.s_assignto
    //                                 WHERE tickets.created_at between :datefrom and :datethru
    //                                 group by s_assignto, name;
    //
    //                                   "), array('datefrom' => $date1, 'datethru' => $date2));

    return view('reports.summaryByAssignToIssueRep', compact('repdata', 'issuetypes','repdatefrom','repdatethru'));

  }

  // COUNT BY ASSIGNED TO AND ISSUE REPORTED - DETAIL
  public function summaryByAssignedtoIssueRepDetail($assignto,$assigntoname,$date1,$date2,$reptype,$issuetype)
  {
    $s_assignto = $assignto;
    $s_assigntoname = $assigntoname;
    $s_issuetype = $issuetype;

    $repdatefrom = $date1;
    $repdatethru = $date2;

    $repTypeDesc = " Per Assigned To ";

    switch ($reptype){
      case 1:
        $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                    	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_assignto = :assignto;
                                    "),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'assignto' => $s_assignto));
        $reptitle = 'Total Tickets of ' . $s_assigntoname;
        break;
      case 2:
          $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                      INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_assignto = :assignto
                                    AND tickets.s_statusxx = 'C'
                                    AND tickets.issuetype = :issuetype;
                                    "),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'assignto' => $s_assignto, 'issuetype' => $s_issuetype));
          $reptitle = 'Closed Tickets of ' . $s_assigntoname;
          break;
        case 3:
            $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                      FROM tickets
                                        INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                        INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                        LEFT OUTER JOIN users ON tickets.s_assignto = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      AND tickets.s_assignto = :assignto
                                      AND tickets.s_statusxx = 'P'
                                      AND tickets.issuetype = :issuetype;
                                      "),
                                      array('datefrom' => $date1, 'datethru' => $date2, 'assignto' => $s_assignto, 'issuetype' => $s_issuetype));
            $reptitle = 'Open Tickets of ' . $s_assigntoname;
            break;
    }
    return view('reports/summaryByReportWithIssueRepDetail',compact('repdata', 's_assigntoname','repdatefrom','repdatethru','reptitle','repTypeDesc'));
  }

  // COUNT BY REPORTED BY
  public function summaryByReportBy(Request $request)
  {
    $repdatefrom = $request->input('datefrom');
    $repdatethru = $request->input('datethru');

    $date1 = Carbon::parse($request->input('datefrom'));
    $date2 = Carbon::parse($request->input('datethru'));

    $repdata = DB::select(DB::raw("select users.name, tickets.s_reportby, count(*) as totalcnt,
                                      	sum(case when s_statusxx ='C' then 1 else 0 end) as resolvedcnt,
                                      	sum(case when s_statusxx ='P' then 1 else 0 end) as opencnt
                                      FROM tickets
                                      INNER JOIN users on tickets.s_reportby = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      group by loginname, name, s_reportby;
                                      "), array('datefrom' => $date1, 'datethru' => $date2));

    return view('reports.summarybyreportby', compact('repdata','repdatefrom','repdatethru'));
  }

  // COUNT BY REPORTED BY - DETAIL
  public function summaryByReportByDetail($reportby,$reportbyname,$date1,$date2,$reptype)
  {
    $s_reportby = $reportby;
    $s_reportbyname = $reportbyname;

    $repdatefrom = $date1;
    $repdatethru = $date2;

    switch ($reptype){
      case 1:
        $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                    	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_reportby = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_reportby = :reportby;"),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'reportby' => $s_reportby));
        break;
      case 2:
          $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                      INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_reportby = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_reportby = :reportby
                                    AND tickets.s_statusxx = 'C';"),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'reportby' => $s_reportby));
          break;
        case 3:
            $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                      FROM tickets
                                        INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                        INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                        LEFT OUTER JOIN users ON tickets.s_reportby = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      AND tickets.s_reportby = :reportby
                                      AND tickets.s_statusxx = 'P';"),
                                      array('datefrom' => $date1, 'datethru' => $date2, 'reportby' => $s_reportby));
            break;
    }
    return view('reports/summaryByReportByDetail',compact('repdata', 's_reportbyname','repdatefrom','repdatethru'));
  }

  // COUNT BY REPORTED BY AND ISSUE REPORTED
  public function summaryByReportByIssueRep(Request $request)
  {
    $repdatefrom = $request->input('datefrom');
    $repdatethru = $request->input('datethru');

    // $date1 = Carbon::parse($request->input('datefrom'));
    // $date2 = Carbon::parse($request->input('datethru'));

    $date1 = substr($repdatefrom,6,4).substr($repdatefrom,0,2).substr($repdatefrom,3,2);
    $date2 = substr($repdatethru,6,4).substr($repdatethru,0,2).substr($repdatethru,3,2);

    $repdata = DB::select('call byreportbyissuerep(?,?)',array($date1,$date2));

    $issuetypes = issuetype::all();

    // $repdata = DB::select(DB::raw("select s_reportby, name, count(*) as totalcnt,
    //                                   sum(case when issuetype = 1 and s_statusxx = 'C' then 1 else 0 end) as issuetype1_rslv,
    //                                   sum(case when issuetype = 1 and s_statusxx = 'P' then 1 else 0 end) as issuetype1_open,
    //                                   sum(case when issuetype = 2 and s_statusxx = 'C' then 1 else 0 end) as issuetype2_rslv,
    //                                   sum(case when issuetype = 2 and s_statusxx = 'P' then 1 else 0 end) as issuetype2_open,
    //                                   sum(case when issuetype = 3 and s_statusxx = 'C' then 1 else 0 end) as issuetype3_rslv,
    //                                   sum(case when issuetype = 3 and s_statusxx = 'P' then 1 else 0 end) as issuetype3_open,
    //                                   sum(case when issuetype = 4 and s_statusxx = 'C' then 1 else 0 end) as issuetype4_rslv,
    //                                   sum(case when issuetype = 4 and s_statusxx = 'P' then 1 else 0 end) as issuetype4_open
    //                                 FROM tickets
    //                                 INNER JOIN users on users.loginname = tickets.s_reportby
    //                                 WHERE tickets.created_at between :datefrom and :datethru
    //                                 group by s_reportby, name;
    //
    //                                   "), array('datefrom' => $date1, 'datethru' => $date2));

    return view('reports.summaryByReportByIssueRep', compact('repdata', 'issuetypes','repdatefrom','repdatethru'));
  }

  // COUNT BY REPORTED BY AND ISSUE REPORTED - DETAIL
  public function summaryByReportByIssueRepDetail($reportby,$reportbyname,$date1,$date2,$reptype,$issuetype)
  {
    $s_reportby = $reportby;
    $s_reportbyname = $reportbyname;
    $s_issuetype = $issuetype;

    $repdatefrom = $date1;
    $repdatethru = $date2;

    $repTypeDesc = " Per Reported By ";

    switch ($reptype){
      case 1:
        $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                    	INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_reportby = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_reportby = :reportby;
                                    "),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'reportby' => $s_reportby));
        $reptitle = 'Total Tickets of ' . $s_reportbyname;
        break;
      case 2:
          $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                    FROM tickets
                                      INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                      INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                      LEFT OUTER JOIN users ON tickets.s_reportby = users.loginname
                                    WHERE tickets.created_at between :datefrom and :datethru
                                    AND tickets.s_reportby = :reportby
                                    AND tickets.s_statusxx = 'C'
                                    AND tickets.issuetype = :issuetype;
                                    "),
                                    array('datefrom' => $date1, 'datethru' => $date2, 'reportby' => $s_reportby, 'issuetype' => $s_issuetype));
          $reptitle = 'Closed Tickets of ' . $s_reportbyname;
          break;
        case 3:
            $repdata = DB::select(DB::raw("select tickets.*, branches.s_brncname, issuetypes.issuetype_desc, users.name
                                      FROM tickets
                                        INNER JOIN branches ON tickets.s_brnccode = branches.s_brnccode
                                        INNER JOIN issuetypes ON tickets.issuetype = issuetypes.issuetype_code
                                        LEFT OUTER JOIN users ON tickets.s_reportby = users.loginname
                                      WHERE tickets.created_at between :datefrom and :datethru
                                      AND tickets.s_reportby = :reportby
                                      AND tickets.s_statusxx = 'P'
                                      AND tickets.issuetype = :issuetype;
                                      "),
                                      array('datefrom' => $date1, 'datethru' => $date2, 'reportby' => $s_reportby, 'issuetype' => $s_issuetype));
            $reptitle = 'Open Tickets of ' . $s_reportbyname;
            break;
    }
    return view('reports/summaryByReportWithIssueRepDetail',compact('repdata', 's_reportbyname','repdatefrom','repdatethru','reptitle','repTypeDesc'));
  }

  public function getNewTicketsDaily(Request $request)
  {
    $repdatefrom = Carbon::parse($request->input('datefrom'));
    $repdatefrom1 = Carbon::parse($request->input('datefrom'));
    $repdatethru1 = date_add($repdatefrom1,date_interval_create_from_date_string("6 days"));

    $repdatefrom = $repdatefrom->format('Ymd');
    $repdatethru = $repdatethru1->format('Ymd');

    $datefromstr = $request->input('datefrom');
    $datethrustr = $request->input('datethru');


    $ticketsperday = DB::select(DB::raw("select calendar.datefield AS DATE, substring(dayname(calendar.datefield),1,1) as day,
                                        dayname(calendar.datefield) as dname,
                                       IFNULL(COUNT(tickets.id),0) AS total_tickets
                                FROM tickets RIGHT JOIN calendar ON (DATE(tickets.created_at) = calendar.datefield)
                                WHERE calendar.datefield BETWEEN :datefrom AND :datethru
                                GROUP BY date"),
                                array('datefrom' => $repdatefrom, 'datethru' => $repdatethru));

    return view('reports.newTicketsDaily', compact('ticketsperday', 'datefromstr', 'datethrustr'));
  }

  public function getNewTicketsByMonth(Request $request)
  {
    $repYear = $request->input('yearSelect');

    $repdata = DB::select(DB::raw("select sum(case when month(created_at) = 1 then 1 else 0 end) as jan_cnt,
                                	sum(case when month(created_at) = 2 then 1 else 0 end) as feb_cnt,
                                    sum(case when month(created_at) = 3 then 1 else 0 end) as mar_cnt,
                                    sum(case when month(created_at) = 4 then 1 else 0 end) as apr_cnt,
                                    sum(case when month(created_at) = 5 then 1 else 0 end) as may_cnt,
                                    sum(case when month(created_at) = 6 then 1 else 0 end) as jun_cnt,
                                    sum(case when month(created_at) = 7 then 1 else 0 end) as jul_cnt,
                                    sum(case when month(created_at) = 8 then 1 else 0 end) as aug_cnt,
                                    sum(case when month(created_at) = 9 then 1 else 0 end) as sep_cnt,
                                    sum(case when month(created_at) = 10 then 1 else 0 end) as oct_cnt,
                                    sum(case when month(created_at) = 11 then 1 else 0 end) as nov_cnt,
                                    sum(case when month(created_at) = 12 then 1 else 0 end) as dec_cnt
                                From tickets
                                WHERE year(created_at) = :yearParam;
                                      "), array('yearParam' => $repYear));

    return view('reports.newTicketsMonthly', compact('repdata','repYear'));
  }

  public function getNewTicketsByYear(Request $request)
  {
    $repdata = DB::select(DB::raw("select sum(case when year(created_at) = YEAR(curdate())-4 then 1 else 0 end) as year1,
                                        	sum(case when year(created_at) = YEAR(curdate())-3 then 1 else 0 end) as year2,
                                            sum(case when year(created_at) = YEAR(curdate())-2 then 1 else 0 end) as year3,
                                            sum(case when year(created_at) = YEAR(curdate())-1 then 1 else 0 end) as year4,
                                            sum(case when year(created_at) = YEAR(curdate()) then 1 else 0 end) as year5
                                        From tickets;"));

    return view('reports.newTicketsYearly', compact('repdata'));
  }

  public function getAvgResolveTime()
  {

    $repdata = DB::select(DB::raw("select tickets.s_assignto, round(avg(time_to_sec(timediff(d_rslvdate, tickets.created_at)) / 3600),0) as avgresolvetime,
                                  	count(*) as ticketcnt, users.name
                                  from tickets
                                  	LEFT OUTER JOIN users on tickets.s_assignto = users.loginname
                                  where s_statusxx = 'C' group by s_assignto, users.name
                                  order by avgresolvetime;"));

    return view('reports.averageResolveTime', compact('repdata'));
  }

  public function moreThan24hours()
  {
    $branches = Branch::all();
    $overduetickets = DB::select("SELECT tickets.*, issuetypes.issuetype_desc FROM sjd_branchworks.tickets inner join issuetypes on tickets.issuetype = issuetypes.issuetype_code where datediff(now(), tickets.created_at) > 1 and s_statusxx = 'P'");

    return view('reports.morethan24hours', compact('branches', 'overduetickets'));
  }

  public function moreThan24hoursexcel()
  {
    Excel::create('overduetickets', function($excel) {
      $excel->sheet('Sheet1', function($sheet) {

        // Select using Query Builder, NOT Eloquent
        $overduetickets = DB::select("SELECT concat(t.s_brnccode,s_trannmbr) as 'Ticket Number',
                                      	b.s_brncname as 'Branch Name',
                                          issuesubject,
                                      	CASE WHEN issuetype = '1' THEN 'Hardware'
                                      		WHEN issuetype = '2' THEN 'Software'
                                              WHEN issuetype = '3' THEN 'Network'
                                              WHEN issuetype = '4' THEN 'Procedural'
                                      		ELSE 'Others'
                                      	END as 'Issue Type',
                                          CASE WHEN s_priority = '1' THEN 'High'
                                      		WHEN s_priority = '2' THEN 'Medium'
                                              ELSE 'LOW'
                                      	END as 'Priority',
                                          t.created_at as 'Created at'
                                       FROM sjd_helpdesk.tickets t
                                       INNER JOIN branches b on t.s_brnccode = b.s_brnccode
                                       WHERE datediff(now(), t.created_at) > 1 and s_statusxx = 'P';");
        // cast the stdClass Objects as Array
        $tickets = array_map(function ($value) {
          return (array)$value;
        }, $overduetickets);

        $sheet->mergeCells('A1:F1');
         $sheet->row(1, function ($row) {
             $row->setFontFamily('Calibri');
             $row->setFontSize(14);
             $row->setFontWeight('bold');
         });
         $sheet->row(1, array('St. Joseph Drug IT Help Desk'));

         $sheet->mergeCells('A2:F2');
         $sheet->row(2, function ($row) {
             $row->setFontFamily('Calibri');
             $row->setFontSize(12);
         });
         $sheet->row(2, array('OPEN TICKETS FOR MORE THAN 24 HOURS'));

         $sheet->row(3, array(''));

         $sheet->row(4, function ($row) {
             $row->setAlignment('center');
             $row->setFontWeight('bold');
             $row->setFontSize(12);
         });

         $sheet->cells('A4:F4', function($cells) {
            $cells->setBorder('medium', 'medium', 'none', 'none');
          });

         $data = array('Ticket Number', 'Branch Name', 'Subject', 'Issue Type', 'Priority', 'Created at');
         $sheet->fromArray($data, null, 'A4', false, false);

        $totalrows = 0;
        $currentrow = 5;
        foreach ($tickets as $ticket) {
            $sheet->appendRow($ticket);
            $totalrows++;

            $sheet->cells('A'.$currentrow.':F'.$currentrow, function($cells) {
               $cells->setBorder('thin', 'medium', 'thin', 'none');
             });

             $currentrow++;
          }

         $totalrows = $totalrows + 4;
         $sheet->cells('A'.$totalrows.':F'.$totalrows, function($cells) {
            $cells->setBorder('none', 'medium', 'thin', 'none');
          });

          $totalrows = $totalrows + 1;
          $sheet->setHeight($totalrows, 5);
          $sheet->cells('A'.$totalrows.':F'.$totalrows, function($cells) {
             $cells->setBorder('none', 'medium', 'medium', 'none');
           });
      });
    })->export('xlsx');
  }

  public function averagesupportratings()
  {
    $repdata = DB::select(DB::raw("select users.name, ratings.s_assignto, avg(rating) as avgrate, count(*) as ticketcnt
                                  from ratings
                                  	inner join users on users.loginname = ratings.s_assignto
                                   group by users.name, s_assignto
                                   order by avgrate desc;
                                "));

    return view('reports.avgratings', compact('repdata'));
  }

  public function avgratingsdetails($assignto, $assigntoname)
  {
    $assigname = $assigntoname;
    $repdata = DB::select(DB::raw("select users.name, rating, concat(tickets.s_brnccode,tickets.s_trannmbr) as ticketno,
                                    		tickets.issuesubject, tickets.m_resodesc, users1.name as ratedby
                                     from ratings
                                    	inner join tickets on tickets.id = ratings.rateable_id
                                    	inner join users on users.loginname = ratings.s_assignto
                                        inner join users as users1 on users1.id = user_id
                                    where ratings.s_assignto = :assignto;
                                "), array('assignto' => $assignto));

  return view('reports.avgratingsdetail', compact('repdata','assigname'));
  }

  public function branches()
  {
    $branches = Branch::all();

    return view('reports.branches', compact('branches'));
  }

  public function issuesreported()
  {
    $issuetypes = issuetype::all();

    return view('reports.issuesreported', compact('issuetypes'));
  }
}
