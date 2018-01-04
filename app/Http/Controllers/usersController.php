<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Employee;
use App\hrmsposition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use Alert;
use XBase\Table;

class usersController extends Controller
{
    protected $redirectTo = '/user-management';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function profile()
    {
      return view('users-mgmt/profile', ['user' => Auth::user()]);
    }

    public function update_avatar(Request $request)
     {
       if ($request->hasfile('avatar' )){
         $avatar = $request->file('avatar');
         $filename = time();
         $filenameOrigX = $filename . '.' . $avatar->getClientOriginalExtension();
         $filenamePNG = $filename . '.png';
         Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filenameOrigX));

         $user = Auth::user();
         $user->avatar = $filenameOrigX;
         $user->save();

         imagepng(imagecreatefromstring(file_get_contents('uploads/avatars/' . $filenameOrigX)), 'uploads/avatars/'.$filenamePNG);

         return view('users-mgmt/profile', ['user' => Auth::user()]);
       }else{
          return 'wala laman';
       }
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // $empmaster = new Table('C:\sjd_ibms\Data\Bad\empmaster.dbf', array('s_employid','s_lastname','s_frstname','s_middname','s_emplstat'));

      // $employees = array();
      // $ctr = 0;
      // while ($record = $empmaster->nextRecord()) {
      //   if ($record->s_emplstat == 'R'){
      //     $employees[$ctr] = ['s_lastname' => $record->s_lastname,
      //                         's_frstname' => $record->s_frstname,
      //                         's_middname' => $record->s_middname,
      //                         's_employid' => $record->s_employid];
      //     $ctr++;
      //   }
      // }
      //
      // sort($employees);

      $employees = employee::where('s_emplstat', '!=', 'S')->orderby('s_lastname')->get();

      // $hrmspositions = hrmsposition::has('s_jobgrade','>','08')->get();

      // $managers = employee::whereHas('s_posicode', function($query) use ($hrmspositions){
      //     $query->wheres_jobgrade('s_jobgrade','>','08');
      // })->get();

      return view ('users-mgmt/create',compact('employees'));
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
        'password' => 'required|min:4',
        'confpassword' => 'same:password',
        'username' => 'required'
      ]);

      $user = new User;
      $user->empno = substr($request->input('employee'),strlen($request->input('employee'))-10,10) ;
      $user->name = substr($request->input('employee'),0,strlen($request->input('employee'))-13) ;
      $user->password = bcrypt($request->input('password'));
      $user->loginname = $request->input('username');
      $user->isadmin = $request->input('isAdmin');

      if ($request->input('isAdmin') == "N")
      {
        $this->validate($request, [
          'usertypeselect' => 'required'
        ]);
        $user->usertype = $request->input('usertypeselect');
      }
      else {
        $user->usertype = "";
      }

      $user->save();

      Alert::success('New user have been added');
      // flash()->overlay('New user have been added', 'Add New user');
      return redirect()->intended('user-management/view_users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $users = User::find($id);

      return view('users-mgmt/edit', compact('users'));
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
        'username' => 'required'
      ]);

      $user = User::find($id);
      $user->loginname = $request->input('username');
      $user->isadmin = $request->input('isAdmin');
      if ($request->has('empstatus')){
        $user->empstatus = "A";
      }else{
        $user->empstatus = "I";
      }

      if ($request->input('isAdmin') == "N")
      {
        $this->validate($request, [
          'usertypeselect' => 'required'
        ]);
        $user->usertype = $request->input('usertypeselect');
      }
      else {
        $user->usertype = "";
      }


      $user->save();

      Alert::success('User details have been updated');
      // flash()->overlay('User details have been updated', 'User Management');
      return redirect()->intended('user-management/view_users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $users = User::find($id);
      $users->delete();

      // alert()->success('User have been deleted', 'User Management');
      Alert::success('User have been deleted');
      // flash()->overlay('User have been deleted', 'User Management');
      // notification.showNotification('top','right');
      return redirect()->intended('user-management/view_users');
    }

    public function login(){
      return view ('auth.login');
    }

    public function view_users(){
      $users = User::all();

      return view ('users-mgmt/view_users', compact('users'));
    }

    public function show_reset_userpassword($id){
      $users = User::find($id);
      return view('users-mgmt/show_reset_userpassword', compact('users'));
    }

    public function update_reset_userpassword(Request $request, $id){
      $this->validate($request, [
        'password' => 'required|min:4',
        'confpassword' => 'same:password'
      ]);

      $user = User::findOrFail($id);
      $input = [
          'password' => bcrypt($request->input('password'))
        ];

      User::where('id', $id)
        ->update($input);

      flash()->overlay('User password has been updated', 'Password Changed');
      return redirect()->intended('/');
    }

    public function show_change_password(){

      return view('users-mgmt/show_change_password', compact('users'));
    }

    public function update_change_password(Request $request, $id){
      $this->validate($request, [
        'password' => 'required|min:4',
        'confpassword' => 'same:password'
      ]);

      $user = User::findOrFail($id);
      $input = [
          'password' => bcrypt($request->input('password'))
        ];

      User::where('id', $id)
        ->update($input);

      flash()->overlay('User password has been updated', 'Password Changed');
      return redirect()->intended('/');
    }
}
