<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Branch;
use App\User;
use App\ticket;
use App\tickethistories;
use App\issuetype;
use Carbon\Carbon;
use Alert;

use App\Notifications\notifyticketcreated;
use App\Notifications\notifyticketassigned;
use App\Notifications\notifyticketclosed;
use App\Events\ticketcreatedevent;
use App\Events\ticketassignedevent;
use App\Events\ticketclosedevent;

use Illuminate\Http\Request;

class TicketsManagementController extends Controller
{
    protected $redirectTo = '/ticket-management';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $branches = Branch::orderBy('s_brnccode')->get();

      $users = User::all();

      // $assignments = User::where('Usertype', '=', '2')
      //                     ->orderBy('fullname', 'desc')
      //                     ->get();

      $issuetypes = Issuetype::all();

      $supports = user::where([
                ['usertype','=','2'],
                ['empstatus','=','A']
                ])->get();

      return view ('tickets-mgmt/create', compact('branches','users','issuetypes','supports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'subject' => 'required',
        'ticketdesc' => 'required'
      ]);

      $bc = substr($request->input('branch'),0,2);

      // Generate the last 4 digits from random alpahnumeric array_count_values

      $characters = 'bcdfghjklmnopqrstuvwxyz0123456789';
      $random_string_length = 4;

       $dd = '';
       $max = strlen($characters) - 1;
       for ($i = 0; $i < $random_string_length; $i++) {
            $dd .= $characters[mt_rand(0, $max)];
       }

       $dd = strtoupper($dd);

      // $dd = microtime();
      $tn = substr(Carbon::now()->year ,2,2). str_pad(Carbon::now()->month,2,"0",STR_PAD_LEFT) . str_pad(Carbon::now()->day,2,"0",STR_PAD_LEFT) . $dd ;

      $ticket = new ticket;
      $ticket->s_trannmbr = $tn;
      $ticket->s_brnccode = $bc;
      $ticket->s_reportby =  Auth::user()->loginname;
      $ticket->issuetype = $request->input('issuereported');
      $ticket->s_priority = $request->input('priority');
      $ticket->issuesubject = $request->input('subject');
      $ticket->m_issuedesc = $request->input('ticketdesc');
      $ticket->s_assignto = $request->input('assignto');

      $tIssue = issuetype::find($request->input('issuereported'));
      $ticketissue = $tIssue->issuetype_desc;

      $ticket->save();

      $ticketid = $ticket->id;

      $tickethistory = new tickethistories;
      $tickethistory->s_trannmbr = $bc.$tn;
      $tickethistory->s_modifyby = Auth::user()->loginname;
      $tickethistory->s_activity = 'Created';

      $tickethistory->save();

      $useravatar = substr(Auth::user()->avatar,0,strlen(Auth::user()->avatar)-4);
      $admins = user::where([
                        ['isadmin','=','Y'],
                        ['empstatus','=','A']
                        ])->get();


      switch($request->input('priority')) {
          case 1:
              $ticketpriority = 'High';
              break;
          case 2:
              $ticketpriority = 'Medium';
              break;
          case 3:
              $ticketpriority = 'Low';
              break;
      }

      $userid = Auth::user()->id;
      $notiftype = 1; // Created new ticket

      // If not connected to internet don't send real-time notification to continue saving the notification in database and don't return an error
      $connected = @fsockopen("www.example.com", 80);
      if($connected) {
       foreach($admins as $user){
           if ($user->loginname <> Auth::user()->loginname){
             // This will create record in notification table
            $user->notify(new notifyticketcreated(Auth::user()->loginname,$useravatar,$ticketid,$ticketissue,$ticketpriority,$userid,$notiftype));
          }
        }
       }
      event(new ticketcreatedevent(Auth::user()->loginname,$useravatar,$ticketid,$ticketissue,$ticketpriority,$userid));

      // flash()->overlay('Ticket have been submitted to the help desk', 'New Ticket');
      Alert::success('Ticket have been submitted');
      return redirect()->intended('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tickets = ticket::find($id);
      $branches = Branch::all();

      return view ('tickets-mgmt/show', compact('branches','tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewallopentickets(){
      if (Auth::user()->isadmin == 'Y'):
        $opentickets = ticket::where('s_statusxx','=','P')->get();
      else:
        $opentickets = ticket::where([
                          ['s_statusxx','=','P'],
                          ['s_assignto','=',Auth::user()->username]
                          ])->get();
      endif;

      return view ('tickets-mgmt/viewallopentickets', compact('opentickets'));
    }

    public function viewallclosetickets(){
      $closetickets = ticket::where('s_statusxx','=','C')->get();

      return view ('tickets-mgmt/viewallclosetickets', compact('closetickets'));
    }

    public function viewnewtickets(){
      $newtickets = ticket::where([
                      ['s_statusxx','=','P']
                      ])
                      ->whereDate('created_at','=',Carbon::today()->toDateString())
                      ->orderBy('created_at', 'desc')
                      ->get();

      return view ('tickets-mgmt/viewnewtickets', compact('newtickets'));
    }

    public function viewalltickets(){
      $alltickets = ticket::all();

      return view ('tickets-mgmt/viewalltickets', compact('alltickets'));
    }

    public function dispissues($issuetype){
      $issues = ticket::where('issuetype','=',$issuetype)
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/dispissues', compact('issues'));
    }

    public function disphardware(){
      $issues = ticket::where('issuetype','=','1')
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/disphardware', compact('issues'));
    }

    public function dispsoftware(){
      $issues = ticket::where('issuetype','=','2')
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/dispsoftware', compact('issues'));
    }

    public function dispnetwork(){
      $issues = ticket::where('issuetype','=','3')
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/dispnetwork', compact('issues'));
    }

    public function dispprocedural(){
      $issues = ticket::where('issuetype','=','4')
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/dispprocedural', compact('issues'));
    }

    public function dispopsystem(){
      $issues = ticket::where('issuetype','=','6')
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/dispopsystem', compact('issues'));
    }

    public function dispcctv(){
      $issues = ticket::where('issuetype','=','7')
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/dispcctv', compact('issues'));
    }

    public function dispothers(){
      $issues = ticket::where('issuetype','=','5')
                ->orderBy('created_at', 'desc')
                ->get();

      return view ('tickets-mgmt/dispothers', compact('issues'));
    }

    public function toprepbranches($brnccode){
      $repbranches = ticket::where('s_brnccode','=',$brnccode)->get();

      $branchnames = branch::where('s_brnccode','=',$brnccode)->get();

      return view ('tickets-mgmt/toprepbranches', compact('repbranches','branchnames'));
    }

    public function edit($id)
    {
      $tickets = ticket::find($id);
      $branches = Branch::all();

      // Search related topics
      $searchissues = DB::select('SELECT * FROM sjd_helpdesk.tickets where MATCH(issuesubject) AGAINST ("' . $tickets->issuesubject . '") AND s_statusxx = "C" LIMIT 10');

      return view ('tickets-mgmt/edit', compact('branches','tickets','searchissues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'resolution' => 'required'
      ]);

      $ticket = ticket::find($id);
      $ticket->s_assignto = Auth::user()->loginname;
      $ticket->d_rslvdate = Carbon::now('Asia/Manila');
      $ticket->s_statusxx = 'C';
      $ticket->m_resodesc = $request->input('resolution');
      $ticket->m_notesxxx = $request->input('notes');

      $reportbyname = $ticket->s_reportby;
      $ticketid = $ticket->id;

      $tIssue = issuetype::find($ticket->issuetype);
      $ticketissue = $tIssue->issuetype_desc;

      $ticket->save();

      $tickethistory = new tickethistories;
      $tickethistory->s_trannmbr = $ticket->s_brnccode.$ticket->s_trannmbr;
      $tickethistory->s_modifyby = Auth::user()->loginname;
      $tickethistory->s_activity = 'Closed';

      $tickethistory->save();

      $reportby = user::where([
                    ['loginname','=',$reportbyname]
                    ])->get();

      switch($ticket->s_priority) {
          case 1:
              $ticketpriority = 'High';
              break;
          case 2:
              $ticketpriority = 'Medium';
              break;
          case 3:
              $ticketpriority = 'Low';
              break;
      }


      $notiftype = 3; // Closed a ticket
      $useravatar = substr(Auth::user()->avatar,0,strlen(Auth::user()->avatar)-4);
      $ticketno = $ticket->s_brnccode.$ticket->s_trannmbr;

      // If not connected to internet don't send real-time notification to continue saving the notification in database and don't return an error
      $connected = @fsockopen("www.example.com", 80);
      if($connected) {
       foreach($reportby as $user){
          if ($user->loginname <> Auth::user()->loginname){
            $userid = $user->id;
            $user->notify(new notifyticketclosed(Auth::user()->loginname,$useravatar,$ticketid,$ticketissue,$ticketpriority,$userid,$notiftype,$ticketno));
            event(new ticketclosedevent(Auth::user()->loginname,$useravatar,$ticketid,$ticketissue,$ticketpriority,$userid,$ticketno));
          }
        }
       }

      Alert::success('Ticket have been closed');
      return redirect()->intended('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reopen($id)
    {
      $ticket = ticket::find($id);

      $input = [
          's_statusxx' => 'P'
        ];

      ticket::where('id', $id)
        ->update($input);

      $tickethistory = new tickethistories;
      $tickethistory->s_trannmbr = $ticket->s_brnccode.$ticket->s_trannmbr;
      $tickethistory->s_modifyby = Auth::user()->username;
      $tickethistory->s_activity = 'Re-opened';

      $tickethistory->save();

      flash()->overlay('Ticket have been re-opened', 'Re-Open Ticket');
        return redirect()->intended('/');
    }

    public function managetickets()
    {
      $assigntickets = ticket::where([
                          ['s_statusxx','=','P'],
                          ['s_assignto','=',Null]
                          ])->get();

      $assignedtickets = ticket::where([
                          ['s_statusxx','=','P'],
                          ['s_assignto','<>',Null]
                          ])->get();

      $supports = user::where([
                ['Usertype','=','2'],
                ['empstatus','=','A']
                ])->get();

      $closetickets = ticket::where('s_statusxx','=','C')->get();

      return view('tickets-mgmt/managetickets', compact('closetickets','assigntickets','assignedtickets','supports'));
    }

    public function assigntickets($id)
    {
      $branches = Branch::all();
      $tickets = ticket::find($id);
      $supports = user::where([
                ['Usertype','=','2'],
                ['Statusxx','=','A']
                ])->get();

      return view ('tickets-mgmt/assigntickets', compact('tickets','supports','branches'));
    }

    public function saveassigned(Request $request)
    {
      // $this->validate($request, [
      //   'assignto' => 'required'
      // ]);
      $assignedto = $request->input('assignto');
      $id = $request->input('ticketid');
      $ticket = ticket::find($id);
      $ticket->s_assignto = $assignedto;
      $ticketid = $id;

      $ticket->save();

      $supports = user::where([
                ['Usertype','=','2'],
                ['empstatus','=','A'],
                ['loginname','=',$request->input('assignto')]
                ])->get();


      $assigntoinfo = user::where([
                        ['loginname','=',$request->input('assignto')]
                        ])->first();

      $useravatar = substr(Auth::user()->avatar,0,strlen(Auth::user()->avatar)-4);

      $ticketissue = $request->input('issuereported');
      // switch($request->input('issuereported')) {
      //     case 'AC':
      //         $ticketissue = 'Aircon';
      //         break;
      //     case 'GS':
      //         $ticketissue = 'General Services';
      //         break;
      // }

      switch($ticket->s_priority) {
          case 1:
              $ticketpriority = 'High';
              break;
          case 2:
              $ticketpriority = 'Medium';
              break;
          case 3:
              $ticketpriority = 'Low';
              break;
      }

      $userid = Auth::user()->id;
      $notiftype = 2; // Assigned ticket

      $connected = @fsockopen("www.example.com", 80);
      if($connected) {
       foreach($supports as $user){
         $userid = $user->id;
         $user->notify(new notifyticketassigned(Auth::user()->loginname,$useravatar,$ticketid,$ticketissue,$ticketpriority,$userid,$notiftype));
         event(new ticketassignedevent(Auth::user()->loginname,$useravatar,$ticketid,$ticketissue,$ticketpriority,$userid));
       }
      }


      // flash()->overlay('Ticket have been assigned to a support', 'Assign Ticket');
      $AlertMessage = 'Ticket have been assigned to ' . $assignedto;
      Alert::success($AlertMessage);
      return redirect()->intended('ticket-management/managetickets');
    }

    public function saveRatings(Request $request)
    {
        request()->validate(['rate' => 'required']);

        $ticket = ticket::find($request->ticketid);

        $rating = new \willvincent\Rateable\Rating;

        $rating->rating = $request->rate;

        $rating->user_id = auth()->user()->id;
        $rating->s_assignto = $request->assignto;

        $ticket->ratings()->save($rating);

        Alert::success('Your ratings have been submitted');
        return redirect()->intended('/');
    }

    public function notificationview($ticketid)
    {
        $branches = Branch::all();
        //return substr($request['ticketno'],0,2) ;
        //return substr($request['ticketno'],2,10);
        $tickets = ticket::where([
                  ['id','=',$ticketid]
                  ])->get();

        if ($tickets->count()<=0){
          flash()->overlay('No record retrieved with the specified Ticket Number', 'Search Ticket');
          return redirect()->intended('/');
        }
        else {
          return view ('tickets-mgmt/showticket', compact('tickets','branches'));
        }
    }

    public function viewallnotifications(){

      return view ('tickets-mgmt/viewallnotifications');
    }

    public function searchclosedtickets(Request $request, $fromPage)
    {
      $assigntickets = ticket::where([
                          ['s_statusxx','=','P'],
                          ['s_assignto','=',Null]
                          ])->get();

        $closetickets = ticket::where([
                  ['s_brnccode','=',substr($request['closedticketno'],0,2)],
                  ['s_trannmbr','=',substr($request['closedticketno'],2,10)]
                  ])->get();

        if ($fromPage=='1'){
          return view('tickets-mgmt/managetickets', compact('closetickets','assigntickets'));
        }else {
          return view('tickets-mgmt/viewallclosetickets', compact('closetickets'));
        }
    }

    private function dosearchquery($constraints)
    {
      $query = ticket::query();
      $fields = array_keys($constraints);
      $index = 0;
      foreach ($constraints as $constraint){
        if ($constraint != null){
          $query = $query->where($fields[$index], 'like', '%' . $constraint . '%');
        }

        $index++;
      }

      return $query->get();
    }

    public function autocomplete(){
    	$term = Input::get('term');

    	$results = array();

    	$queries = DB::table('tickets')
    		->where('s_brnccode', 'LIKE', '%'.$term.'%')
    		->orWhere('s_trannmbr', 'LIKE', '%'.$term.'%')
    		->take(5)->get();

    	foreach ($queries as $query)
    	{
    	    $results[] = [ 'id' => $query->id, 'value' => $query->s_brnccode.$query->s_trannmbr ];
    	}
    return Response::json($results);
    }
}
