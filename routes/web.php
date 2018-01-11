<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/', 'pages.index')->middleware('auth');

Route::get('/', [
  'uses' => 'PagesController@index',
  'as' => 'index',
  'middleware' => 'auth'
]);

Route::get('pages/filemaintenance', [
  'uses' => 'PagesController@filemaintenance',
  'as' => 'filemaintenance',
  'middleware' => ['auth','isAdmin']
]);

Route::get('pages/showassigned', [
  'uses' => 'PagesController@showassigned',
  'as' => 'showassigned',
  'middleware' => ['auth','isAdmin']
]);

Route::get('pages/reports', [
  'uses' => 'PagesController@reports',
  'as' => 'reports',
  'middleware' => ['auth','isAdmin']
]);

// Reports

Route::any('reports/summarybybranch', [
  'uses' => 'ReportsController@summarybybranch',
  'as' => 'summarybybranch',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports.summaryByBranchDetail/{brnccode}/{brncname}/{date1}/{date2}/{reptype}', [
  'uses' => 'ReportsController@summaryByBranchDetail',
  'as' => 'summaryByBranchDetail',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/summarybyissuerep', [
  'uses' => 'ReportsController@summarybyissuerep',
  'as' => 'summarybyissuerep',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports.summaryByIssueRepDetail/{issuetype}/{issuetypedesc}/{date1}/{date2}/{reptype}', [
  'uses' => 'ReportsController@summaryByIssueRepDetail',
  'as' => 'summaryByIssueRepDetail',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/summarybybranchissuerep', [
  'uses' => 'ReportsController@summarybybranchissuerep',
  'as' => 'summarybybranchissuerep',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports.summarybybranchissuerepdetail/{brnccode}/{brncname}/{date1}/{date2}/{reptype}/{issuetype}', [
  'uses' => 'ReportsController@summarybybranchissuerepdetail',
  'as' => 'summarybybranchissuerepdetail',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/summarybyassignedto', [
  'uses' => 'ReportsController@summarybyassignedto',
  'as' => 'summarybyassignedto',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports.summaryByAssignedtoDetail/{assignto}/{assigntoname}/{date1}/{date2}/{reptype}', [
  'uses' => 'ReportsController@summaryByAssignedtoDetail',
  'as' => 'summaryByAssignedtoDetail',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/summarybyassignedtoissuereported', [
  'uses' => 'ReportsController@summarybyassignedtoissuereported',
  'as' => 'summarybyassignedtoissuereported',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports.summaryByAssignedtoIssueRepDetail/{assignto}/{assigntoname}/{date1}/{date2}/{reptype}/{issuetype}', [
  'uses' => 'ReportsController@summaryByAssignedtoIssueRepDetail',
  'as' => 'summaryByAssignedtoIssueRepDetail',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/summarybyreportby', [
  'uses' => 'ReportsController@summarybyreportby',
  'as' => 'summarybyreportby',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports.summarybyreportbydetail/{assignto}/{assigntoname}/{date1}/{date2}/{reptype}', [
  'uses' => 'ReportsController@summarybyreportbydetail',
  'as' => 'summarybyreportbydetail',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/summarybyreportbyissuerep', [
  'uses' => 'ReportsController@summarybyreportbyissuerep',
  'as' => 'summarybyreportbyissuerep',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports.summarybyreportbyissuerepdetail/{s_reportbyname}/{reportbyname}/{date1}/{date2}/{reptype}/{issuetype}', [
  'uses' => 'ReportsController@summarybyreportbyissuerepdetail',
  'as' => 'summarybyreportbyissuerepdetail',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/getNewTicketsByDaily', [
  'uses' => 'ReportsController@getNewTicketsDaily',
  'as' => 'getNewTicketsByDaily',
  'middleware' => ['auth','isAdmin']
]);

Route::any('reports/getNewTicketsByMonth', [
  'uses' => 'ReportsController@getNewTicketsByMonth',
  'as' => 'getNewTicketsByMonth',
  'middleware' => ['auth','isAdmin']
]);

Route::get('reports/newticketsyearly',[
    'uses' => 'ReportsController@getNewTicketsByYear',
    'middleware' => ['auth','isAdmin'],
    'as' => 'getNewTicketsByYear'
]);

Route::get('reports/morethan24hours', [
  'uses' => 'ReportsController@morethan24hours',
  'middleware' => ['auth','isAdmin'],
  'as' => 'morethan24hours'
]);

Route::get('reports/morethan24hoursexcel',[
    'uses' => 'ReportsController@morethan24hoursexcel',
    'middleware' => ['auth','isAdmin'],
    'as' => 'morethan24hoursexcel'
]);

Route::get('reports/averageresolvetime', [
  'uses' => 'ReportsController@getAvgResolveTime',
  'middleware' => ['auth','isAdmin'],
  'as' => 'averageresolvetime'
]);

Route::get('reports/avgratings',[
    'uses' => 'ReportsController@averagesupportratings',
    'middleware' => ['auth','isAdmin'],
    'as' => 'avgratings'
]);

Route::get('reports/avgratingsdetails/{assignto}/{assigntoname}',[
    'uses' => 'ReportsController@avgratingsdetails',
    'middleware' => ['auth','isAdmin'],
    'as' => 'avgratingsdetails'
]);

Route::get('reports/branches',[
    'uses' => 'ReportsController@branches',
    'middleware' => ['auth','isAdmin'],
    'as' => 'branches'
]);

Route::get('reports/issuesreported',[
    'uses' => 'ReportsController@issuesreported',
    'middleware' => ['auth','isAdmin'],
    'as' => 'issuesreported'
]);

// [End] Reports


Route::get('/login', [
  'uses' => 'UsersController@login',
  'as' => 'login',
  'middleware' => 'auth'
]);

Route::any('pages/searchresult', 'PagesController@searchresult')->name('searchresult')->middleware('auth');
// Route::get('pages/showassigned','PagesController@showassigned')->name('showassigned')->middleware(['auth']);

Route::get('user-management/view_users','UsersController@view_users')->name('user-management.view_users')->middleware(['auth', 'isAdmin']);
Route::get('user-management/show_reset_userpassword/{id}','UsersController@show_reset_userpassword')->name('user-management.show_reset_userpassword')->middleware('auth');
Route::any('user-management/update_reset_userpassword/{id}','UsersController@update_reset_userpassword')->name('user-management.update_reset_userpassword')->middleware('auth');
Route::get('user-management/show_change_password','UsersController@show_change_password')->name('user-management.show_change_password')->middleware('auth');
Route::any('user-management/update_change_password/{id}','UsersController@update_change_password')->name('user-management.update_change_password')->middleware('auth');
Route::get('user-management/profile','UsersController@profile')->name('user-management.profile')->middleware('auth');
Route::any('user-management/update_avatar', 'UsersController@update_avatar')->name('user-management.update_avatar')->middleware('auth');
Route::group(['middleware' => ['auth', 'isAdmin']],function(){
  Route::resource('user-management', 'UsersController');
});

Route::group(['middleware' => ['auth', 'isAdmin']],function(){
  Route::resource('employee-management', 'EmployeesController');
});

Route::get('ticket-management/dispissues/{issuetype}','TicketsManagementController@dispissues')->name('ticket-management.dispissues')->middleware(['auth']);
Route::get('ticket-management/toprepbranches/{brnccode}','TicketsManagementController@toprepbranches')->name('ticket-management.toprepbranches')->middleware(['auth']);
Route::get('ticket-management/viewallopentickets','TicketsManagementController@viewallopentickets')->name('ticket-management.viewallopentickets')->middleware(['auth']);
Route::get('ticket-management/viewnewtickets','TicketsManagementController@viewnewtickets')->name('ticket-management.viewnewtickets')->middleware(['auth']);
Route::get('ticket-management/viewalltickets','TicketsManagementController@viewalltickets')->name('ticket-management.viewalltickets')->middleware(['auth']);
Route::get('ticket-management/viewallclosetickets','TicketsManagementController@viewallclosetickets')->name('ticket-management.viewallclosetickets')->middleware(['auth']);
Route::get('ticket-management/managetickets','TicketsManagementController@managetickets')->name('ticket-management.managetickets')->middleware(['auth']);
Route::get('ticket-management/assigntickets/{id}','TicketsManagementController@assigntickets')->name('ticket-management.assigntickets')->middleware(['auth']);
Route::put('ticket-management/saveassigned', 'TicketsManagementController@saveassigned')->name('ticket-management.saveassigned')->middleware(['auth']);
Route::put('ticket-management/saveRatings', 'TicketsManagementController@saveRatings')->name('ticket-management.saveRatings')->middleware(['auth']);
Route::get('ticket-management/notificationview/{ticketid}','TicketsManagementController@notificationview')->name('ticket-management.notificationview')->middleware(['auth']);
Route::group(['middleware' => 'auth'],function(){
  Route::resource('ticket-management', 'TicketsManagementController');
});

Route::group(['middleware' => ['auth', 'isAdmin']],function(){
  Route::resource('branches-management', 'BranchesController');
});

Route::group(['middleware' => ['auth', 'isAdmin']],function(){
  Route::resource('issuetypes-management', 'IssueTypesController');
});

Route::get('markAsRead', function(){
  auth()->user()->unreadNotifications->markAsRead();
});

Auth::routes();
